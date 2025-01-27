const cms = {
	 index: (req , res) => {
		res.send('OK')
	},

	userId: (req, res)=> {
		const a = req.params.id
		res.send(a)
	}
}

module.exports = cms