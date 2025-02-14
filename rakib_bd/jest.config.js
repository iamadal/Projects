module.exports = {
  rootDir: ".", 
  testMatch: ["<rootDir>/test/**/*.js"], // Matches all `.test.js` files in the `test` folder
  moduleDirectories: ["node_modules", "src"],
  collectCoverage: false, 
  collectCoverageFrom: ["src/**/*.js"], 
  coverageDirectory: "coverage"
};
