require('dotenv').config()

/**
 * BIAM Canteen Management System (BIAM CMS)
 * Author: Adal Khan - A01799729507@gmail.com
 * Since: 10 JAN 2025
 */
const       cors = require('cors')
const      mysql = require('mysql2')
const     helmet = require('helmet')
const     morgan = require('morgan')
const     crypto = require('crypto')
const    session = require('express-session')
const    express = require('express')
const  rateLimit = require('express-rate-limit')


// Security Warning: All routes should be included here. except /logout. if we do not map public routes it will redirect to dashboard after login

const allowedRoutes = [
       '/',
       '/cms/login',
       '/cms/create',
       '/cms/menu'
      ] 


//-------------------------------------------------------------------------------------------------------
const auth = (req, res, next) => {
    // Check if the user is trying to access a public route like /login
    if (allowedRoutes.includes(req.path)) {
        // If the user is already authenticated, redirect to dashboard
        if (req.session?.logininfo?.username) {
            return res.redirect('/cms/home'); // Redirect to dashboard if logged in
        }
        return next(); // Otherwise, proceed to the login page
    }

    // Check if the user is logged in for other routes
    if (!req.session?.logininfo?.username) {
        return res.redirect('/cms/login'); // Redirect to login if not authenticated
    }

    next(); // User is authenticated, proceed to the route
};


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
        res.locals._csrf = req.session._csrf; 
    } 

    if (['POST', 'PUT', 'DELETE'].includes(req.method)) {
        const token = req.headers['x-csrf-token'] || req.body._csrf; 
        if (!token || token !== req.session._csrf) {
            return res.status(403).render('404')
        }
        req.session._csrf = createToken(); 
    }

    next();
}





function initMWS(app) {
    const       limiter = rateLimit({ windowMs: 15 * 60 * 1000, max: process.env.RATE_LIMIT || 100, message: "App Shutdown. Please try again later" });
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
    app.use(session({ secret: sessionSecret , resave: false, saveUninitialized: false, cookie: { httpOnly: true, secure: process.env.NODE_ENV === 'production', maxAge: 24 * 60 * 60 * 1000 } }));
    app.use(csrf)
    app.use(auth)

    app.use((req, res, next) => {
    res.locals.flashMessage = req.session.flashMessage || null;
    delete req.session.flashMessage; 
    next();
});

    if (process.env.NODE_ENV === 'production') app.set('trust proxy', 1);
}

module.exports =  initMWS ;
