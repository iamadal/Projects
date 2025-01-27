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

require('dotenv').config();

function init(app) {
    const       limiter = rateLimit({ windowMs: 15 * 60 * 1000, max: process.env.RATE_LIMIT || 100, message: "MRPM ERROR" });
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

    if (process.env.NODE_ENV === 'production') app.set('trust proxy', 1);
}

module.exports = init;
