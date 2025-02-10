/* Homepage */

const User = require('./data/models/users')

const index = (request,response) => {
	  response.render('index')
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
	response.render('register',  { _csrf: request.session._csrf })
}

const registered = async (request, response) => {
	const {username, password , email, phone } = request.body


 try {
    const user = await User.register({ username, password, email, phone });
    response.redirect('/register')
  } catch (error) {
    response.status(401).json({ message: error.message });
    response.send(`${username} ${password} ${email} ${phone}`)
  }
}
/* Dashboard */

const dashboard = (request, response) => {
	response.render('dashboard')
}


/* Group */

const cc = { index,  userId,    login,   getLogin,  register, registered, dashboard }

/* Export */

module.exports = cc