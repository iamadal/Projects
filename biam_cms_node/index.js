/**
 * BIAM Canteen Management System (BIAM CMS)
 * @author Adal Khan - A01799729507@gmail.com
 * From 10 JAN 2025
 * */

require('dotenv').config() 

/* Import modules */
const express           = require('express')
const helmet            = require('helmet')
const cors              = require('cors')
const rateLimit         = require('express-rate-limit');
const path              = require('path')
const cookieParser      = require('cookie-parser')
const csrf              = require('csurf')
const passport          = require('passport')
const session           = require('express-session')
const bcrypt            = require('bcryptjs')
const {body,validation} = require('express-validator')
const crypto            = require('crypto')


/* Configurations */
const corsOptions    = { origin: 'http://localhost:8000', methods: ['GET', 'POST']};
const limiter        = rateLimit({ windowMs: 15 * 60 * 1000, max: process.env.rateLimit });
const csrfProtection = csrf({cookie: true})
const sessionSecret  = crypto.randomBytes(32).toString('hex'); 
const app            = express()

/* Load Environment Variables */



/* Set View Engine */
app.set('view engine','ejs');
app.set('views', path.join(__dirname, 'src','views'));


/* Middlewares */
app.use(helmet())
app.use(cors(corsOptions))
app.use(limiter)
app.use(cookieParser())
app.use(session({secret: sessionSecret, resave: false, saveUninitialized: true }))
app.use(csrfProtection)
app.use(passport.initialize())
app.use(passport.session())
app.use(express.json())
app.use(express.urlencoded({ extended: true }))
app.use(express.static(path.join(__dirname, 'public')))


/* Routes */

app.get('/',(request,response)=>{
    response.send("OK")
	response.end()
})

/* Global Error Handler */

app.use((req,res)=>{ 
	res.redirect('/')
	res.end()
})

/* Serve */
app.listen(8000)