/**
 * BIAM Canteen Management System (BIAM CMS)
 * Author: Adal Khan - A01799729507@gmail.com
 * Since: 10 JAN 2025
 * TESTS 
 */

const     app = require('../src/app')
const request = require('supertest')

require('dotenv').config();



describe('GET Homepage - Route is: /', () => {
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



