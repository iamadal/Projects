/**
 * BIAM Canteen Management System (BIAM CMS)
 * Author: Adal Khan - A01799729507@gmail.com
 * Since: 10 JAN 2025
 * TESTS 
 */

const     app = require('./src/app')
const request = require('supertest')

require('dotenv').config();

/*

describe('GET /', () => {
  it('should return 200 and #3312', async () => {
    const response = await request(app).get('/');  // Use `request` instead of `req`
    expect(response.status).toBe(200);  
    expect(response.text).toBe('OK');  
  });
});





describe('GET /app', () => {
  it('should return 200 and Error(NRF)', async () => {
    const response = await request(app).get('/app')
    expect(response.status).toBe(200)
    expect(response.text).toBe('Error(NRF)')
  });
});





describe('Rate Limiting', () => {
  it('should allow 100 requests within 1 minute', async () => {
    for (let i = 0; i < 100; i++) {
      const response = await request(app).get('/')
      expect(response.status).toBe(200);  
    }
  });


  it('should block the 101th request within 1 minute', async () => {
    // First 100 requests should pass
    for (let i = 0; i < 100; i++) {
      await request(app).get('/')
    }

    // The 101th request should be blocked
    const response = await request(app).get('/')
    expect(response.status).toBe(429);  
    expect(response.text).toBe('MRPM ERROR');
  })
})




describe('Helmet Default Security Headers', () => {
  it('should have the X-Content-Type-Options header set to "nosniff"', async () => {
    const response = await request(app).get('/');
    expect(response.headers['x-content-type-options']).toBe('nosniff');
  });
  it('should have the X-Frame-Options header set to "DENY"', async () => {
    const response = await request(app).get('/');
    expect(response.headers['x-frame-options']).toBe('DENY');
  });
  it('should have the Strict-Transport-Security header', async () => {
    const response = await request(app).get('/');
    expect(response.headers['strict-transport-security']).toBeDefined();
  });
  it('should have the Content-Security-Policy header set', async () => {
    const response = await request(app).get('/');
    expect(response.headers['content-security-policy']).toBeDefined();
  });
  it('should have the X-Powered-By header removed', async () => {
    const response = await request(app).get('/');
    expect(response.headers['x-powered-by']).toBeUndefined();
  });
  it('should have the Referrer-Policy header set to "strict-origin-when-cross-origin"', async () => {
    const response = await request(app).get('/');
    expect(response.headers['referrer-policy']).toBe('strict-origin-when-cross-origin');
  });
});




describe('CORS Middleware', () => {
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


*/





// Tests for Data Validation and Database access

