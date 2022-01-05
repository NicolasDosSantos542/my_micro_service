const service = require('../services/discussions.service')



exports.createDiscussion = (req, res) => {

    console.log('toto')
    let response = service.create(req.body.data)
    res.json({ result: "success", message: "youpi ça marche!", response: response })
}

exports.getDiscussion = (req, res) => {
    
    res.status(200).json({ result: "success", response: service.getDiscussion(req.params.id) });

}