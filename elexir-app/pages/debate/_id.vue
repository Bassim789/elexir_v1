<template>
  <div class="main-content">
    <Header back_btn_val="true" search_value="Débat" />
    <section class="container">
      <div>
        <DebateInfo />
        <DebateBarChart />
        <SelectVote />
        <br><br>
        <NewArgument />
        <br><br>
        <Arguments />
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
  middleware: 'debate_info',
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
  /*
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
  },*/
  head() {
    console.log('head this.debate.title: ', this.debate.title)
    return {
      title: this.debate.title + ' | ELEXIR',
      meta: [
        { hid: 'description', name: 'description', content: this.debate.description }
      ]
    }
  },
  computed: {
    debate(){
      return this.$store.state.debate
    }
  }
}
</script>

<style lang="scss" scoped>
@import "assets/scss/main_variables.scss";

</style>