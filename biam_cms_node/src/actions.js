/* Homepage */

const User = require('./data/models/users')

const index = (request,response) => {
	  	  response.render('index', { msg: request.session.msg || " " })
}

const userId = (request, response) => {
	const userId = request.params.id
	 if (!/^\d+$/.test(userId)) { 
        return response.status(400).send("Invalid user ID");
    } else {
    	response.send(userId)
    }
}

/* Canteen Login System*/

const login = (request, response) => {
	const id = request.body.username
	response.send(id)
}



const getLogin = (request, response) => {
	response.render('getLogin', { _csrf: request.session._csrf })
}



/* User Registration */

const register = (request, response) => {
	response.render('register',  { _csrf: request.session._csrf, msg: response.locals.flashMessage })
}

const registered = async (request, response) => {

	const {username, password , email, phone } = request.body


 try {
    const user = await User.create({ username, password, email, phone });
    request.session.flashMessage = "Registration successful"
    response.redirect('/cms/create')
  } catch (error) {
  	request.session.flashMessage = "You have already registered. Please contact with admin"
  	response.redirect('/cms/create')
  }
}
/* Dashboard */

const dashboard = (request, response) => {
	response.render('dashboard')
}


/* Group */

const cc = { 
	// Methods of CMS
	index,  userId,    login,   getLogin,  register, registered, dashboard
}

/* Export */

module.exports = cc