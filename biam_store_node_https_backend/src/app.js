import fs                from 'fs'
import jwt               from '@fastify/jwt'
import path              from 'path'
import cors              from '@fastify/cors'
import helmet            from '@fastify/helmet'
import dotenv            from 'dotenv'
import rateLimit         from '@fastify/rate-limit'
import fastifyFactory    from 'fastify'
import { fileURLToPath } from 'url'

/**/

dotenv.config()

const __filename = fileURLToPath(import.meta.url)
const __dirname  = path.dirname(__filename)



const fastify = fastifyFactory({
  bodyLimit: 1_048_576, // 1MB
  https: {
    key: fs.readFileSync(path.join(__dirname,  './../cert', 'localhost-key.pem')),
    cert: fs.readFileSync(path.join(__dirname, './../cert', 'localhost.pem')),
  },
  logger: true
})




// JWT auth decorator
fastify.decorate('authenticate', async (request, reply) => {
  try {
    await request.jwtVerify()
  } catch (err) {
    reply.code(401).send({ error: 'Unauthorized' })
  }
})



const start = async () => {
  try {
    await fastify.register(helmet, {
      global: true,
      contentSecurityPolicy: false
    })


    await fastify.register(rateLimit, {
      max: 100,
      timeWindow: '1 minute'
    })


    await fastify.register(cors, {
      origin: 'https://localhost:4433',
      credentials: true
    })


    await fastify.register(jwt, {
      secret: process.env.JWT_SECRET || 'supersecuredevtoken'
    })


    // Public route
    fastify.get('/', async () => {
      return { secure: true, message: 'Hello over HTTPS (ESM)' }
    })


    // Login route
    fastify.post('/login', {
      schema: {
        body: {
          type: 'object',
          required: ['username', 'password'],
          properties: {
            username: { type: 'string' },
            password: { type: 'string' }
          },
          additionalProperties: false
        }
      }
    }, async (request, reply) => {
      const { username, password } = request.body

      // Dummy authentication (replace with DB check)
      if (username !== 'admin' || password !== 'secret') {
        return reply.code(401).send({ error: 'Invalid credentials' })
      }

      const token = fastify.jwt.sign({ username }, { expiresIn: '1h' })
      return { token }
    })

    // Protected route
    fastify.get('/user/:id', {
      preHandler: [fastify.authenticate],
      schema: {
        params: {
          type: 'object',
          properties: {
            id: { type: 'string', pattern: '^[0-9]+$' }
          },
          required: ['id']
        }
      }
    }, async (request, reply) => {
      const { id } = request.params
      return {
        userId: id,
        user: request.user,
        message: 'Secure data accessed.'
      }
    })

    // Start server
    await fastify.listen({ port: 4433 })
    console.log('✅ HTTPS server running at https://localhost:4433')
  } catch (err) {
    fastify.log.error(err)
    process.exit(1)
  }
}

start()




