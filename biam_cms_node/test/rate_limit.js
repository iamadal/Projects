/**
 * BIAM Canteen Management System (BIAM CMS)
 * Author: Adal Khan - A01799729507@gmail.com
 * Since: 10 JAN 2025
 * TESTS 
 */

const     app = require('../src/app')
const request = require('supertest')

require('dotenv').config();


describe('Rate Limit TEST:', () => {
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
