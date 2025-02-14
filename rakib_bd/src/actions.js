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


const login = async (request,response) => {
		const {username, password} = request.body
		const u = username.trim()
		const p = password.trim()
			try {
				const users = await User.login({username:u, password:p}) // Passing Object, here username, password is the column name of given table
			 	request.session.logininfo = {id: users.id, role: users.role, username: users.username, status: users.status}
			 	console.log(request.session.logininfo)
				response.redirect('/cms/home') // Header must be send to the browser first before sending data
	} catch(error) {
			request.session.flashMessage = ["Invalid Username or Password"] // Return as array
			response.redirect('/cms/login')
	}
}


const getLogin = (request, response) => {
	response.render('getLogin', { _csrf: request.session._csrf, flashMessage: response.locals.flashMessage })
}



/* User Registration */

const register = (request, response) => {
	response.render('register',  { _csrf: request.session._csrf, flashMessage: response.locals.flashMessage })
}

const registered = async (request, response) => {

	const {username, password , email, phone } = request.body


 try {
    const user = await User.create({ username, password, email, phone }); // Must send as  Object {} not the direct parameters
    request.session.flashMessage = ["Registration successful"] // Flash Messages is accepting list of messages so return it as array
    response.redirect('/cms/create')
  } catch (error) {
  	request.session.flashMessage = ["You have already registered. Please contact with admin"]
  	response.redirect('/cms/create')
  }
}
/* Dashboard */

const dashboard = (request, response) => {
    if (request.session.logininfo && request.session.logininfo.username) {
        response.render('dashboard');
    } else {
        response.redirect('/cms/login');
    }
}


const logout = (request,response)=> {
	request.session.destroy()
	response.redirect('/cms/login')
}



/* Group */

const cc = {
   // Universal Methods
   logout,  
	// Methods of CMS
	index,  userId,    login,   getLogin,  register, registered, dashboard
}

/* Export */

module.exports = cc