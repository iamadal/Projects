/**
 * @author Adal Khan
 * import require modules.
 * */

const express           = require('express')
const helmet            = require('helmet')
const cors              = require('cors')
const rateLimit         = require('express-rate-limit');
const path              = require('path')
const dotenv            = require('dotenv')
const mongoose          = require('mongoose')
const cookieParser      = require('cookie-parser')
const csrf              = require('csurf')
const passport          = require('passport')
const session           = require('express-session')
const bcrypt            = require('bcryptjs')
const {body,validation} = require('express-validator')
const crypto            = require('crypto')
const web               = require('./src/actions.js')
const route             = require('./src/routes.js')
const m_users           = require('./src/data/m_users.js')
const m_items           = require('./src/data/m_items.js')


/**
 * Configurations.
 * */
const corsOptions    = { origin: 'http://localhost:3000', methods: ['GET', 'POST']};
const limiter        = rateLimit({ windowMs: 15 * 60 * 1000, max: 100 });
const csrfProtection = csrf({cookie: true})
const sessionSecret  = crypto.randomBytes(32).toString('hex'); 
const app            = express()

/**
 * Template Engine(EJS) configuration.
 * */
app.set('view engine','ejs');
app.set('views', path.join(__dirname, 'src','views'));


/**
 * Middlewares
 * */
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



/**
 * Database Connection
 * */

// MongoDB connection
mongoose.connect('mongodb://localhost:27017/biam_app_data')
  .then(() => console.log('Connected to MongoDB'))
  .catch((err) => console.error('Error connecting to MongoDB:', err));







/**
 * Route Maps
 * */

app.get(route.index ,  web.index)
app.get(route.about ,  web.about)


/* Global Error Handler */

app.use((req, res) => {
  res.render('error');
});


/* Server Configurations */
const PORT = process.env.PORT || 3000;
app.listen(PORT, () => {
  console.log(`Server is running on port ${PORT}`);
});
