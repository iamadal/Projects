/**
 * @param { import("knex").Knex } knex
 * @returns { Promise<void> }
 */
exports.up = function(knex) {
   return knex.schema.createTable('users',(table)=>{
   		table.increments('id').primary()
   		table.string('username', 255).notNullable().unique()
   		table.string('password', 255).notNullable()
   		table.string('email',    255).notNullable().unique()
   		table.string('phone',    255).notNullable().unique()
   		table.string('role',     255).notNullable().defaultTo('user')
   		table.string('status',   255).notNullable().defaultTo('inactive')
   		table.timestamps(true,true)
   })
}

/**
 * @param { import("knex").Knex } knex
 * @returns { Promise<void> }
 */
exports.down = function(knex) {
   return knex.schema.dropTableIfExist('users')
}
