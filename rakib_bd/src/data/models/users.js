const bcrypt = require('bcryptjs');
const knexConfig = require('../../../knexfile');
const knex = require('knex')(knexConfig);

class User {
  static async create({ username, password, email, phone }) { // Receive Argument 
    try {
      const existingUser = await knex('users')
        .where({ username })
        .orWhere({ email })
        .orWhere({ phone })
        .first();
        
      if (existingUser) {
        throw new Error('Username, email, or phone already exists');
      }

      const hashedPassword = await bcrypt.hash(password, 10);

      const [user] = await knex('users')
        .insert({
          username,
          password: hashedPassword,
          email,
          phone,
          role: 'user',   
          status: 'inactive' 
        });

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

 

  static async findByPhone(phone) {
    try {
      const user = await knex('users').where({ phone }).first();
      if (!user) {
        throw new Error('User not found');
      }
      return user;
    } catch (error) {
      throw new Error('Error retrieving user: ' + error.message);
    }
  }


  static async update(userId, { username, email, phone, role, status }) {
    try {
      const [updatedUser] = await knex('users')
        .where({ id: userId })
        .update({ username, email, phone, role, status })
        .returning('*');

      if (!updatedUser) {
        throw new Error('User not found or update failed');
      }

      return updatedUser;
    } catch (error) {
      throw new Error('Error updating user: ' + error.message);
    }
  }


  static async delete(userId) {
    try {
      const deletedCount = await knex('users').where({ id: userId }).del();
      if (deletedCount === 0) {
        throw new Error('User not found');
      }
      return { message: 'User deleted successfully' };
    } catch (error) {
      throw new Error('Error deleting user: ' + error.message);
    }
  }
}

module.exports = User;
