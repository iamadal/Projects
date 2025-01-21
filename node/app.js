// Import
const express    = require('express');
const helmet     = require('helmet');
const cors       = require('cors');
const rateLimit  = require('express-rate-limit');
const path       = require('path');
const dotenv     = require('dotenv');
const web        = require('./src/actions.js')
const route      = require('./src/routes.js')

// config
dotenv.config();
const app = express();


// Options
const corsOptions = { origin: 'http://localhost:3000', methods: ['GET', 'POST']};
const limiter     = rateLimit({ windowMs: 15 * 60 * 1000, max: 100 });

// Middlewares
app.use(helmet());
app.use(cors(corsOptions));
app.use(limiter);
app.use(express.json());
app.use(express.urlencoded({ extended: false }));
app.use(express.static(path.join(__dirname, 'public')));

// View Engine
app.set('view engine','ejs');
app.set('views', path.join(__dirname, 'src','views'));


// Front Controller ---------------------------------------------------------------------------------

app.get(route.index , web.index)
app.get(route.about , web.about)

//---------------------------------------------------------------------------------------------------

// Error Handler

app.use((req, res) => {
  res.render('error');
});

// Serve
const PORT = process.env.PORT || 3000;
app.listen(PORT, () => {
  console.log(`Server is running on port ${PORT}`);
});
