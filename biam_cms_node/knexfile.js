require('dotenv').config()

const host = process.env.DB_HOST
const user = process.env.DB_USER
const pass = process.env.DB_PASS
const dbn  = process.env.DB_NAME

module.exports = {
      client: 'mysql2', 
  connection: { host: host,  user: user, password: pass, database: dbn, charset: 'utf8mb4'} ,    
  migrations: { directory: './src/data/migrations'},
       seeds: { directory: './src/data/seeds' }
}


