/**
 * BIAM Canteen Management System (BIAM CMS)
 * Author: Adal Khan - A01799729507@gmail.com
 * Since: 10 JAN 2025
 * TESTS 
 */

const     app = require('../src/app')
const request = require('supertest')

require('dotenv').config();

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

