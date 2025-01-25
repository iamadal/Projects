'use strict';

module.exports = {
  async up(queryInterface, Sequelize) {
    await queryInterface.bulkInsert('Users', [
      {
        name: 'John Doe',
        email: 'johndoe@example.com',
        created_at: new Date(),
        updated_at: new Date(),
      },
      {
        name: 'Jane Doe',
        email: 'janedoe@example.com',
        created_at: new Date(),
        updated_at: new Date(),
      },
    ]);
  },

  async down(queryInterface, Sequelize) {
    await queryInterface.bulkDelete('Users', null, {});
  },
};
