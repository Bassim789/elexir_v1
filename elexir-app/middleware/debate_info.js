import api from '~/components/axios_public_api'

export default function ({ params, store }) {
  console.log('params: ', params)
  const cookie_token = store.state.user.cookie_token
  const debate_id = params.id
  return api.post('/debate?action=get_basic_info', {cookie_token, debate_id}).then(res => {
    store.commit('set_debate', res.data)
  })
}