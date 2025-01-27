module.exports = {
  rootDir: ".", 
  testMatch: ["<rootDir>/test/**/*.test.js"], 
  moduleDirectories: ["node_modules", "src"], 
  collectCoverage: true, 
  collectCoverageFrom: ["src/**/*.js"], 
  coverageDirectory: "coverage"
};
