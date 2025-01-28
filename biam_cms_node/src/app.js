require('dotenv').config()

/**
 * BIAM Canteen Management System (BIAM CMS)
 * Author: Adal Khan - A01799729507@gmail.com
 * Since: 10 JAN 2025
 */

const         cms  = require('./actions')
const         path = require('path')
const      initMWS = require('./mws')
const      express = require('express')
const cookieParser = require('cookie-parser')


const  app = express();
const PORT = process.env.PORT || 8000;

initMWS(app) 

app.use(cookieParser());
app.use(express.static(path.join(__dirname, 'public')));

app.set('view engine', 'ejs');
app.set('views', path.join(__dirname, 'src', 'views'));

/* route map */

app.get('/',         cms.index)
app.get('/user/:id', cms.userId)


app.get('/csrf', (req, res) => {
  res.json({csrf: res.locals._csrf});
})


app.post('/secure', (req, res) => {
  res.json({ message: 'Secure endpoint accessed!' });
});



app.use((req, res) => {
  res.status(200)
  res.send('Error(NRF)')
})


 // app.listen(PORT) 

module.exports = app  // Enable it to test the APP
