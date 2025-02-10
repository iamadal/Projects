require('dotenv').config()

/**
 * BIAM Canteen Management System (BIAM CMS)
 * Author: Adal Khan - A01799729507@gmail.com
 * Since: 10 JAN 2025
 * Error Code
 * #00001 - Rate Limit Error
 * #00002 - Maximu Request Limited
 */

const         ac   = require('./actions')
const         path = require('path')
const      initMWS = require('./mws')
const      express = require('express')
const cookieParser = require('cookie-parser')

const  app = express();
const PORT = process.env.PORT || 8000;

const {body , validationResult } = require('express-validator')

initMWS(app) 

app.use(cookieParser());
app.use(express.static(path.join(__dirname, 'public')));

app.set('view engine', 'ejs');
app.set('views', path.join(__dirname, 'views'));

/* route map */

app.get('/',              ac.index)
app.get('/user/:id',      ac.userId)
app.get('/register',      ac.register)
app.get('/dashboard',     ac.dashboard) // Dashboard
app.get('/login',         ac.getLogin)

app.post('/register',     ac.registered)
app.post('/login',        ac.login)






app.use((request, response) => {
      response.render('404')
})


app.listen(PORT) 

// module.exports = app  // Enable it to test the APP
