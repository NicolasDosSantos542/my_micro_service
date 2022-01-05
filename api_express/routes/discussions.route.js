const express = require('express');
const router = express.Router();
const tchat = require('../controllers/discussion.controller')
module.exports = router;

router.post('/', tchat.createDiscussion )
router.get('/{id}',tchat.getDiscussion )
router.post('message', tchat.createMessage )