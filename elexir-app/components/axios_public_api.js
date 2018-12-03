import axios from 'axios'
import cookie from '~/components/cookie'

const api = axios.create({
  baseURL: 'https://elexir.ch/api/public/',
  timeout: 5000
})


// api.interceptors.request.use(config => {

//   const cookie_token = cookie.get('cookie_token')
//   console.log('axios_public_api.js cookie_token:', cookie_token)

//   config.headers = {
//     Cookie: 'cookie_token=' + cookie_token + ';'
//   }
//   console.log('api.interceptors config cookie_token: ', cookie_token)
//   //console.log(config)
//   return config
// }, (error) => {
//   console.log('api.interceptors error')
//   return Promise.reject(error)
// })


export default api