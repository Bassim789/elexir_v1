<template>
  <div class="main-content">
    <Header back_btn_val="true" search_value="Débat" />
    <section class="container">
      <div>
        <DebateInfo :debate="debate" />
        <DebateBarChart :debate="debate" />
        <SelectVote :debate="debate" :reload_debate_data="reload_debate_data" />
        <br><br>
        <NewArgument :debate_id="debate.id" 
            :debate_user_own_vote="debate.user_own_vote" 
            :reload_debate_data="reload_debate_data"/>
        <br><br>
        <Arguments :debate="debate" />
      </div>
    </section>
    <Footer />
  </div>
</template>

<script>
import Header from '~/layouts/Header.vue'
import api from '~/components/axios_public_api'
import api_front from '~/components/api_front'
import DebateInfo from '~/components/DebateInfo.vue'
import DebateBarChart from '~/components/DebateBarChart.vue'
import SelectVote from '~/components/SelectVote.vue'
import NewArgument from '~/components/NewArgument.vue'
import Arguments from '~/components/Arguments.vue'
import Footer from '~/layouts/Footer.vue'
import cookie from '~/components/cookie'

export default {
  middleware: 'index',
  components: {
    Header,
    DebateInfo,
    DebateBarChart,
    SelectVote,
    NewArgument,
    Arguments,
    Footer
  },
  data() {
    return {}
  },
  asyncData(context, callback) {
    const cookie_token = cookie.get_token(context)
    const debate_id = context.params.id
    api.post('/debate?action=get_basic_info', {cookie_token, debate_id}).then(res => {
      console.log(res)
      callback(null, {debate: res.data})
    }).catch(e => {
      console.log(e)
      callback(null, {debate: {}})
    })
  },
  head() {
    return {
      title: this.debate.title + ' | ELEXIR',
      meta: [
        { hid: 'description', name: 'description', content: this.debate.description }
      ]
    }
  },
  methods: {
    reload_debate_data(){
      const debate_id = this.debate.id
      api_front('debate', 'get_basic_info', {debate_id}, (res => {
        this.debate = res.data
      }))
    }
  }
}
</script>

<style lang="scss" scoped>
@import "assets/scss/main_variables.scss";

</style>