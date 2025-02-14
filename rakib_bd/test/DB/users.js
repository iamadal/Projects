const request = require("supertest");
const app = require("../../src/app");
const knexConfig = require("../../knexfile"); 
const knex = require("knex")(knexConfig); // Initialize knex

describe("User API Endpoints", () => {
  let testUser = { username: "testuser", password: "01234567899", email: "test@example.com", phone: "01234567891" };
  let userId;
  let cookie;

  beforeAll(async () => {
    await knex("users").del(); // Clear users table before tests
  });

  afterAll(async () => {
    await knex("users").del(); // Clean up database after tests
    await knex.destroy(); // Close DB connection
  });

  test("1. Should register a new user", async () => {
    const res = await request(app)
      .post("/cms/create")
      .send(testUser);
    
    expect(res.status).toBe(201);
    expect(res.body.username).toBe(testUser.username);
    userId = res.body.id;
  });


  test("2. Should find user by phone", async () => {
    const res = await request(app)
      .get(`/cms/users/find${testUser.phone}`)
      .set("Cookie", cookie);

    expect(res.status).toBe(200);
    expect(res.body.phone).toBe(testUser.phone);
  });

  test("3. Should update user details", async () => {
    const res = await request(app)
      .put(`/cms/users/update/${userId}`)
      .set("Cookie", cookie)
      .send({ username: "updateduser", email: "new@example.com", phone: "9876543210" });

    expect(res.status).toBe(200);
    expect(res.body.username).toBe("updateduser");
  });

  test("4. Should delete user", async () => {
    const res = await request(app)
      .delete(`/cms/users/delete/${userId}`)
      .set("Cookie", cookie);

    expect(res.status).toBe(200);
    expect(res.body.message).toBe("User deleted successfully");
  });
});
