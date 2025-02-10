const     app = require('../src/app')
const request = require('supertest')

describe('CSRF Protection Tests', () => {
    let csrfToken;
    let cookies;

    it('should get CSRF token from GET /', async () => {
        const res = await request(app).get('/');
        expect(res.status).toBe(200);
        expect(res.body.csrfToken).toBeDefined();
        
        // Store CSRF token and cookies for later use
        csrfToken = res.body.csrfToken;
        cookies = res.headers['set-cookie'];
    });

    it('should fail POST request without CSRF token', async () => {
        const res = await request(app).post('/login');
        expect(res.status).toBe(403);
        expect(res.body.error).toBe('Invalid CSRF token');
    });

    it('should succeed POST request with valid CSRF token', async () => {
        const res = await request(app)
            .post('/login')
            .set('Cookie', cookies) // Send stored cookies
            .set('X-CSRF-Token', csrfToken); // Send CSRF token
        expect(res.status).toBe(200);
        expect(res.text).toBe('Form submitted successfully!');
    });
});
