import api from '~/components/axios_public_api'
import cookie from '~/components/cookie'

export default (url, action, data, callback) => {
  data.cookie_token = cookie.get('cookie_token')
  api.post('/' + url + '?action=' + action, data).then(res => {
    callback(res)
  }).catch(e => {
    console.log(e)
  })
}