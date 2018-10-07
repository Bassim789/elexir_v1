import axios from 'axios'

export default axios.create({
  baseURL: 'https://elexir.ch/api/public/',
  timeout: 5000
})