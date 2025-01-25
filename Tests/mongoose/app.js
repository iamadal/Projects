const mongoose = require('mongoose')

mongoose.connect('mongodb://127.0.0.1:27017/biam_app_data')
  .then(() => console.log('MongoDB connected'))
  .catch(err => console.log(err));

const users = new mongoose.Schema({
    name: String,
    Password: String,
    Phone: Number
})

const m_user = mongoose.model('m_user', users)

const ins = new m_user({
    name: 'Adal', 
    Password: '233', 
    Phone: 1233
});

ins.save()
  .then(() => console.log('User added successfully'))
  .catch(err => console.log('Error saving user:', err));



