/**
 * BIAM Canteen Management System (BIAM CMS)
 * Author: Adal Khan - A01799729507@gmail.com
 * Since: 10 JAN 2025
 * TESTS 
 */

const     app = require('../src/app')
const request = require('supertest')

require('dotenv').config();


describe('CORS Middleware TEST: ', () => {
  it('should allow requests from the specified origin', async () => {
    const response = await request(app)
      .get('/')
      .set('Origin', process.env.CORS_ORIGIN);

    expect(response.headers['access-control-allow-origin']).toBe(process.env.CORS_ORIGIN);
    expect(response.status).toBe(200);
  });

  it('should block requests from an unspecified origin', async () => {
    const response = await request(app)
      .get('/')
      .set('Origin', 'https://notallowed.com');

    expect(response.headers['access-control-allow-origin']).toBeUndefined();
    expect(response.status).toBe(200);
  });

  it('should allow specified HTTP methods', async () => {
    const response = await request(app)
      .options('/') // Preflight request
      .set('Origin', process.env.CORS_ORIGIN);

    expect(response.headers['access-control-allow-methods']).toBe('GET,POST,PUT,DELETE');
    expect(response.status).toBe(204); // Preflight responses typically have status 204
  });

  it('should allow credentials', async () => {
    const response = await request(app)
      .get('/')
      .set('Origin', process.env.CORS_ORIGIN);

    expect(response.headers['access-control-allow-credentials']).toBe('true');
    expect(response.status).toBe(200);
  });
});


