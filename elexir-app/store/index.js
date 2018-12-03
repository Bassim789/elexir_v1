import Vuex from 'vuex'
import api from '~/components/axios_public_api'
import api_front from '~/components/api_front'
import axios from 'axios'
import cookie from '~/components/cookie'

const createStore = () => {
  return new Vuex.Store({
    strict: false,
    state: {
      user: {},
      debate: {}
    },
    mutations: {
      set_debate(state, debate){
        state.debate = debate
        console.log('set_debate()')
      },
      reload_debate_data(state){
        const debate_id = state.debate.id
        api_front('debate', 'get_basic_info', {debate_id}, (res => {
          state.debate = res.data
        }))
      },
      set_user(state, user){
        state.user = user
      },
      set_cookie(state){
        if(!state.user.is_new_cookie_token) return false
        cookie.set('cookie_token', state.user.cookie_token, 3999)
      },
      set_user_info(state){
        if(state.user.is_user_info_set) return false
        const parser = new UAParser()
        const user_agent_info = parser.getResult()
        axios.get('https://api.ipify.org?format=json').then(res_ipify => {
          const ip = res_ipify.data.ip
          const cookie_token = state.user.cookie_token
          api.post('/user?action=set_device_info', {cookie_token, ip, user_agent_info}).then(res => {
            state.user.is_user_info_set = res.data.is_user_info_set
          }).catch(e => {
            console.log(e)
          })
        }).catch(e => {
          console.log('Request failed.  Returned status of', e)
        })
      }
    },
    actions: {
      nuxtServerInit ({ commit }, { req }) {
        const data = {
          cookie_token: cookie.get_parse('cookie_token', req.headers.cookie),
          from_nuxt_server_init: true,
          first_url: req.url
        }
        return api.post('/user?action=get', data).then(res => {
          req.headers.cookie = 'cookie_token=' + res.data.cookie_token + ';'
          commit('set_user', res.data)
        }).catch(e => {
          console.log('error nuxtServerInit:', e)
        })
      }
    }
  })
}

export default createStore