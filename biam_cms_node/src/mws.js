require('dotenv').config()

/**
 * BIAM Canteen Management System (BIAM CMS)
 * Author: Adal Khan - A01799729507@gmail.com
 * Since: 10 JAN 2025
 */

const      cors = require('cors')
const    helmet = require('helmet')
const    morgan = require('morgan')
const    crypto = require('crypto')
const   session = require('express-session')
const   express = require('express')
const rateLimit = require('express-rate-limit')





function createToken() {
    return crypto.randomBytes(24).toString('hex');
}

function csrf(req, res, next) {
    if (!req.session) {
        return next(new Error('SESSION ERROR'));
    }

    if (req.method === 'GET') {
        if (!req.session._csrf) {
            req.session._csrf = createToken();
        }
        res.locals._csrf = req.session._csrf; // Make token available in templates
    } 

    if (['POST', 'PUT', 'DELETE'].includes(req.method)) {
        const token = req.headers['x-csrf-token'] || req.body._csrf; // Check header OR hidden input field
        if (!token || token !== req.session._csrf) {
            return res.status(403).render('404')
        }
        req.session._csrf = createToken(); // Rotate the CSRF token
    }

    next();
}


function initMWS(app) {
    const       limiter = rateLimit({ windowMs: 15 * 60 * 1000, max: process.env.RATE_LIMIT || 100, message: "#00001" });
    const   corsOptions = { origin: (origin, callback) => (origin === process.env.CORS_ORIGIN ? callback(null, true) : callback(null, false)), methods: ['GET', 'POST', 'PUT', 'DELETE'], credentials: true }
    const sessionSecret = process.env.SESSION_SECRET || crypto.randomBytes(32).toString('hex');
    
    app.use(morgan(process.env.NODE_ENV === 'production' ? 'combined' : 'dev'))
    app.use(helmet())
    app.use(helmet.frameguard({ action: 'DENY' }))
    app.use(helmet.referrerPolicy({ policy: 'strict-origin-when-cross-origin' })); 
    app.use(limiter)
    app.use(cors(corsOptions))
    app.use(express.json())
    app.use(express.urlencoded({ extended: true }))
    app.use(session({ secret: sessionSecret, resave: false, saveUninitialized: false, cookie: { httpOnly: true, secure: process.env.NODE_ENV === 'production', maxAge: 24 * 60 * 60 * 1000 } }));
    app.use(csrf)

    if (process.env.NODE_ENV === 'production') app.set('trust proxy', 1);
}

module.exports =  initMWS ;
