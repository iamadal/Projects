const bcrypt     = require('bcryptjs');
const knexConfig = require('../../../knexfile');
const knex       = require('knex')(knexConfig);

class User {
  static async register({ username, password, email, phone }) {
    try {
      const existingUser = await knex('users').where({ username }).orWhere({ email }).orWhere({ phone }).first();
      if (existingUser) {
        throw new Error('Username, email, or phone already exists');
      }

     
      const hashedPassword = await bcrypt.hash(password, 10);

  
      const [user] = await knex('users').insert({
        username,
        password: hashedPassword,
        email,
        phone,
        role: 'user',    // Set default role as 'user'
        status: 'inactive' // Default status as 'inactive'
      }).returning('*');

      return user;

    } catch (error) {
      if (error.code === 'ER_DUP_ENTRY') {
        throw new Error('Username, email, or phone already exists');
      }

      throw new Error('Error registering user: ' + error.message);
    }
  }


  static async login({ username, password }) {
    try {
      const user = await knex('users').where({ username }).first();
      if (!user) {
        throw new Error('User not found');
      }

      const isPasswordMatch = await bcrypt.compare(password, user.password);
      if (!isPasswordMatch) {
        throw new Error('Invalid password');
      }

      return user;
    } catch (error) {
      throw new Error('Login failed: ' + error.message);
    }
  }
}

module.exports = User;
