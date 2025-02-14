const { body, validationResult } = require('express-validator');

/* CMS Registration Form Validation */
const vRegForm = [
  body('username')
    .notEmpty()
    .withMessage('Username field is empty!')
    .isLength({ min: 4 })
    .withMessage('Username must be at least 4 characters long'),

  body('password')
    .notEmpty()
    .withMessage('Password is required')
    .isLength({ min: 8 })
    .withMessage('Password must be at least 8 characters long'),

  body('email')
    .isEmail()
    .withMessage('Invalid Email Address'),

  body('phone')
    .isNumeric()
    .withMessage('Phone number is not valid')
    .isLength({ min: 11 })
    .withMessage('Phone number must be 11 digits'),
];


/* Middleware to Handle Validation */
const validate = (req, res, next) => {
  const errors = validationResult(req);
  if (!errors.isEmpty()) {
    req.session.flashMessage = errors.array().map(error => error.msg)
    return res.redirect('/cms/create')
  }
  next();
};





module.exports = { vRegForm, validate };
