/**
 * @author Adal Khan 06 May 2025
 * <A01799729507@gmail.com>
 * */

import path                           from 'path';
import { execSync }                   from 'child_process';
import { existsSync }                 from 'fs';
import { fileURLToPath }              from 'url';
import { mkdir, writeFile, readFile } from 'fs/promises';

const __filename  = fileURLToPath(import.meta.url);
const __dirname   = path.dirname(__filename);
const projectName = 'BIAM_SMA';
const projectPath = path.join(__dirname, projectName);

const log = msg => console.log(`\x1b[36m${msg}\x1b[0m`);
const run = (cmd, cwd = projectPath) => execSync(cmd, { stdio: 'inherit', cwd });

const createDir  = async dir => {
  const fullPath = path.join(projectPath, dir);
  if (!existsSync(fullPath)) await mkdir(fullPath, { recursive: true });
};

const setup = async () => {
  log(`Creating project folder: ${projectName}`);
  if (!existsSync(projectPath)) await mkdir(projectPath);
  process.chdir(projectPath);

  log('Initializing package.json...');
  run('npm init -y');

  log('Installing dependencies...');
  run('npm install fastify @fastify/cors @fastify/helmet @fastify/jwt @fastify/rate-limit dotenv');

  log('Installing dev dependencies...');
  run('npm install -D typescript ts-node-dev @types/node @types/fastify');

  log('Creating tsconfig.json...');
  const tsconfig = {
    compilerOptions: {
      target: 'ES2020',
      module: 'ESNext',
      moduleResolution: 'Node',
      esModuleInterop: true,
      outDir: 'dist',
      rootDir: 'src',
      strict: true,
      skipLibCheck: true
    }
  };
  await writeFile('tsconfig.json', JSON.stringify(tsconfig, null, 2));

  log('Creating folders...');
  const dirs = ['src', 'src/routes', 'src/controllers', 'src/services', 'src/schemas', 'src/plugins'];
  for (const dir of dirs) await createDir(dir);

  log('Adding example src/index.ts...');
  const indexTs = `import Fastify from 'fastify';
import cors from '@fastify/cors';
import helmet from '@fastify/helmet';
import jwt from '@fastify/jwt';
import rateLimit from '@fastify/rate-limit';
import dotenv from 'dotenv';

dotenv.config();
const fastify = Fastify({ logger: true });

await fastify.register(helmet);
await fastify.register(cors, { origin: process.env.FRONTEND_URL || true });
await fastify.register(rateLimit, { max: 100, timeWindow: '1 minute' });
await fastify.register(jwt, { secret: process.env.JWT_SECRET || 'supersecret' });

fastify.decorate('authenticate', async function (req, reply) {
  try {
    await req.jwtVerify();
  } catch (err) {
    reply.send(err);
  }
});

fastify.get('/health', async () => ({ status: 'ok' }));

fastify.listen({ port: 3000, host: '0.0.0.0' }, err => {
  if (err) {
    fastify.log.error(err);
    process.exit(1);
  }
});
`;
  await writeFile('src/index.ts', indexTs);

  log('Updating package.json scripts...');
  const pkgPath = path.join(projectPath, 'package.json');
  const pkgJson = JSON.parse(await readFile(pkgPath, 'utf8'));
  pkgJson.type = 'module';
  pkgJson.scripts = {
    dev: 'ts-node-dev --respawn --transpile-only --loader ts-node/esm src/index.ts',
    build: 'tsc',
    start: 'node dist/index.mjs'
  };
  await writeFile(pkgPath, JSON.stringify(pkgJson, null, 2));

  log('Creating .env file...');
  await writeFile('.env', 'JWT_SECRET=your_super_secret_key\nFRONTEND_URL=http://localhost:5173\n');

  log('Setup complete!');
  console.log(`\nTo start the project:\n  cd ${projectName}\n  npm run dev\n`);
};

setup().catch(err => {
  console.error('Setup failed:', err);
  process.exit(1);
});
