/**
 * @param { import("knex").Knex } knex
 * @returns { Promise<void> } 
 */

require('dotenv').config()

const username = process.env.ADMIN_NAME
const pass     = process.env.ADMIN_PASS
const email    = process.env.ADMIN_EMAIL
const phone    = process.env.ADMIN_PHONE
const role     = process.env.ADMIN_ROLE
const status   = process.env.ADMIN_STATUS


exports.seed = async function(knex) {
  await knex('users').del()
  await knex('users').insert([
      { username: username, password: pass, email: email, phone: phone, role: role, status: status }
  ]);
};
