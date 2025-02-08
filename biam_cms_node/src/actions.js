const cms = {
	 index: (request , response) => {
		response.render('index', { _csrf: request.session._csrf })
	},

	user_id: (request, response)=> {
		const a = request.params.id
		response.send(a)
	},

	login: (request, response)=> {
		 response.send("Validation OK")
	}
}

module.exports = cms