
const mongoose = require('mongoose');
const { Schema } = mongoose;

const DiscussionSchema= new Schema({
  participants:  [{name: String, id : Number}], 
  messages: [{ owner_id: Number, date: Date }],
  
});

const Discussions = mongoose.model('discussions', DiscussionSchema)

module.exports = Discussions;
