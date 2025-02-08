'use strict'

const add = require('../src/math.js')

describe('Math',()=>{
	it('Should add two numbers: ',()=>{
		expect(add(1,2)).toBe(3)
	})
})


