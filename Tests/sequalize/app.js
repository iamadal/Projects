/**/
/* Load Environment Variable */
require('dotenv').config(); 

/* Initialization */

const DB_NAME = process.env.DB_NAME
const DB_USER = process.env.DB_USER
const DB_PASS = process.env.DB_PASSWORD
const DB_HOST = process.env.DB_HOST


/* */



const { Sequelize } = require('sequelize');
const sequelize     = new Sequelize(DB_NAME,DB_USER,DB_PASS, { host: 'localhost', dialect: 'mariadb',port: 3306, logging: false });


async function testConnection() {
  try {
    await sequelize.authenticate();
    console.log('Connection has been established successfully.');
  } catch (error) {
    console.error('Unable to connect to the database:', error);
  }
}


testConnection();


const { DataTypes } = require('sequelize');

// Define the User model
const User = sequelize.define('User', {
  name: {
         type: DataTypes.STRING,
    allowNull: false,
  },
  email: {
         type: DataTypes.STRING,
       unique: true,
    allowNull: false,
  },
});

// Sync the model with the database
sequelize.sync().then(() => {
  console.log('User model synced with the database');
});

// Seeding

async function insertData() {
  try {
    // Insert a new user
    const newUser = await User.create({
      name: 'John Doe',
      email: 'johndoe@example.com',
    });

    console.log('User inserted:', newUser.toJSON());
  } catch (error) {
    console.error('Error inserting data:', error);
  }
}

// Run the insert function
insertData();


