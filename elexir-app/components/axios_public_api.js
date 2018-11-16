import axios from 'axios'
import Qs from 'qs'

export default axios.create({
  baseURL: 'https://elexir.ch/api/public/',
  timeout: 5000
})