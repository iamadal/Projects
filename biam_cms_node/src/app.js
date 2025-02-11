require('dotenv').config()

/**
 * BIAM Canteen Management System (BIAM CMS)
 * Author: Adal Khan - A01799729507@gmail.com
 * Since: 10 JAN 2025
 * Error Code
 */

const         cmap = require('./actions')
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

app.get('/',                  cmap.index)
app.get('/user/:id',          cmap.userId)


/* Canteen routes*/

app.get('/cms/create',      cmap.register)
app.get('/cms/home',        cmap.dashboard) // Dashboard
app.get('/cms/login',       cmap.getLogin)

app.post('/cms/create',   cmap.registered)
app.post('/cms/login',      cmap.login)

/* End of canteen routes */





app.use((request, response) => {
      response.render('404')
})


 app.listen(PORT,()=> console.log(`Listening on Port ${PORT}`)) 

 //module.exports = app  // Enable it to test the APP



/**
 * Error Code
 * 
 * 
 * */


 