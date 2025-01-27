/**
 * BIAM Canteen Management System (BIAM CMS)
 * Author: Adal Khan - A01799729507@gmail.com
 * Since: 10 JAN 2025
 */

require('dotenv').config();

/* Import modules */
const express                    = require('express');
const helmet                     = require('helmet');
const cors                       = require('cors');
const rateLimit                  = require('express-rate-limit');
const path                       = require('path');
const cookieParser               = require('cookie-parser');
const session                    = require('express-session');
const crypto                     = require('crypto');
const { body, validationResult } = require('express-validator');

/* Application Configuration */
const app = express();
const PORT = process.env.PORT || 8000;
const sessionSecret = process.env.SESSION_SECRET || crypto.randomBytes(32).toString('hex');

/* Security Configurations */
const corsOptions    = {  origin: process.env.CORS_ORIGIN || 'http://localhost:8000', methods: ['GET', 'POST'], credentials: true};
const limiter        = rateLimit({ windowMs: 15 * 60 * 1000,  max: process.env.RATE_LIMIT || 100, message: "Too many requests from this IP, please try again later." });

/* Middleware Setup */
app.use(helmet());
app.use(cors(corsOptions));
app.use(limiter);
app.use(cookieParser());
app.use(express.json());
app.use(express.urlencoded({ extended: true }));
app.use(express.static(path.join(__dirname, 'public')));

/* Session Configuration */
app.use(session({secret: sessionSecret, resave: false, saveUninitialized: false, cookie: { httpOnly: true, secure: process.env.NODE_ENV === 'production', maxAge: 24 * 60 * 60 * 1000},}));


/* Set View Engine */
app.set('view engine', 'ejs');
app.set('views', path.join(__dirname, 'src', 'views'));

/* Routes */
// Example: Adding a CSRF-protected form
app.get('/form', (req, res) => {

  res.render('user_index', { csrfToken: req.csrfToken() });
});

app.post(
  '/submit-form',
  [
    body('username').isLength({ min: 3 }).withMessage('Username must be at least 3 characters long.'),
    body('email').isEmail().withMessage('Invalid email address.'),
  ],
  (req, res) => {
    const errors = validationResult(req);
    if (!errors.isEmpty()) {
      return res.status(400).json({ errors: errors.array() });
    }
  }
);

/* Global Error Handler */
app.use((err, req, res, next) => {
  console.error(err.stack);
  res.status(err.status || 500).json({
    message: err.message || 'Internal Server Error',
  });
});

/* Catch-All Route */
app.use((req, res) => {
  res.status(404).json({ message: 'Route not found.' });
});

/* Start Server */
app.listen(PORT, () => {
  console.log(`Server is running on port ${PORT}`);
});
