const cron = require('node-cron')
const request = require('request')
const fs = require('fs')

const config = JSON.parse(fs.readFileSync('./config.json'))
const cron_api = config.http_mode + '://' + config.site_name + '/api/public/cron/'

// every minute
cron.schedule('* * * * *', () => {
  request(cron_api + 'clean_session',  (err, res, body) => console.log(body))
})