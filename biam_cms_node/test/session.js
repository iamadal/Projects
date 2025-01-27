const express = require('express');
const session = require('express-session');
const app = express();

// Create a session store
const store = new session.MemoryStore();

// Configure session middleware
const sessionMiddleware = session({
  secret: 'your-secret-key',
  resave: false,
  saveUninitialized: false,
  store: store,
  cookie: { maxAge: 60000 }
});

// Manually simulate a request and access session
const simulateRequest = () => {
  // Create a mock request and response
  const req = { session: {} };
  const res = { send: console.log };

  // Apply the session middleware to the request
  sessionMiddleware(req, res, () => {
    // Setting session data
    req.session.username = 'testuser';
    req.session.role = 'admin';

    // Simulating another request to check the session data
    console.log('Session Data After First Request: ', req.session);

    // Simulating a second request where session is read
    const secondReq = { session: req.session }; // Reuse the same session data
    const secondRes = { send: console.log };
    sessionMiddleware(secondReq, secondRes, () => {
      console.log('Session Data After Second Request: ', secondReq.session);
    });
  });
};

// Simulate requests
simulateRequest();
