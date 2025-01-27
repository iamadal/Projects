'use strict'

const add = require('../src/math.js')

describe('Math',()=>{
	test('adding two numbers',()=>{
		expect(add(1,2)).toBe(3)
	})
})