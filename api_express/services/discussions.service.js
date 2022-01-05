const Discussion = require("../models/discussionModel");


exports.create =(data) => {

    return discussion = new Discussion(data);
}

exports.getDiscussion = (id)=>{
    return Discussion.find({participants: id})
}