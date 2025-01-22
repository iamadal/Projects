/**
 * @author Adal Khan
 *
 */


/*@name: create   @method: get*/
const web = {
	index: (req,res)=> {
		res.render('base',{'message':"This is Working Fine"})
	},

	about: (req,res)=>{
		const id = req.params.id
		res.send(id)		
	}
}


module.exports = web;