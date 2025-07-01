import path              from 'path';
import Fastify           from 'fastify';
import fastifyStatic     from '@fastify/static';
import { fileURLToPath } from 'url';


const __filename = fileURLToPath(import.meta.url);
const __dirname = path.dirname(__filename);


export function createServer() {
  const app = Fastify({ logger: true });

  // Absolute path to UI/dist
  const uiDistPath = path.join(__dirname, '../UI/dist');

  app.register(fastifyStatic, {
    root: uiDistPath,
    prefix: '/',
    index: false,    // Disable default index handling to control fallback manually
    wildcard: false, // Prevent automatic catch-all route registration
  });

  // SPA fallback: serve index.html for any unmatched route
  app.get('/*', async (_, reply) => {
    return reply.sendFile('index.html');
  });

  // Optional test route
  app.get('/ping', async () => 'pong');

  return app;
}



export async function startServer() {
  const app = createServer();

  try {
    await app.listen({ port: 3000 });
    console.log('🚀 Server running at http://localhost:3000');
  } catch (err) {
    app.log.error(err);
    process.exit(1);
  }
}
