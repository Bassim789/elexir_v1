import Vuex from 'vuex'
import api from '~/components/axios_public_api'
import Cookie from 'js-cookie'

function get_cookie(name, cookies) {
  if(cookies === undefined) return false
  var nameEQ = name + "="
  var ca = cookies.split(';')
  for (var i = 0; i < ca.length; i++) {
    var c = ca[i];
    while (c.charAt(0) == ' ') c = c.substring(1, c.length);
    if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length, c.length);
  }
  return false;
}

const store = {
  state: {
    user: {}
  },
  mutations: {
    set_user(state, user){
      state.user = user
    },
    set_cookie(state){
      if(state.user.is_new_session_token){
        Cookie.set('cookie_token', state.user.session_token, { expires: 9999 })
      }
    }
  },
  actions: {
    nuxtServerInit ({ commit }, { req }) {
      const session_token = get_cookie('cookie_token', req.headers.cookie)
      return api.get('/user?action=get', {
        params: {session_token: session_token}
      }).then(res => {
        commit('set_user', res.data)
      }).catch(e => {
        console.log('error nuxtServerInit:', e)
      })
    }
  }
}

export default () => new Vuex.Store(store)