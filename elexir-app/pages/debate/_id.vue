<template>
  <div class="main-content">
    <Header back_btn_val="true" search_value="Débat" />
    <section class="container">
      <div>
        <DebateInfo :debate="debate" />
        <DebateBarChart :debate="debate" />
        <br><br>
        <NewArgument :debate_id="debate.id" :reload_debate_data="reload_debate_data"/>
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
import DebateInfo from '~/components/DebateInfo.vue'
import DebateBarChart from '~/components/DebateBarChart.vue'
import NewArgument from '~/components/NewArgument.vue'
import Arguments from '~/components/Arguments.vue'
import Footer from '~/layouts/Footer.vue'

export default {
  middleware: 'index',
  components: {
    Header,
    DebateInfo,
    DebateBarChart,
    NewArgument,
    Arguments,
    Footer
  },
  data() {
    return {}
  },
  asyncData(context, callback) {
    const debate_id = context.params.id
    api.get('/debate?action=get_basic_info', {params: {debate_id}}).then(res => {
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
  beforeMount() {
    this.$store.commit('set_cookie')
  },
  methods: {
    reload_debate_data(){
      console.log('reload_debate_data()')
      const debate_id = this.debate.id
      api.get('/debate?action=get_basic_info', {params: {debate_id}}).then(res => {
        console.log(res.data)
        this.debate = res.data
      }).catch(e => {
        console.log(e)
        callback(null, {debate: {}})
      })
    }
  }
}
</script>

<style lang="scss" scoped>
@import "assets/scss/main_variables.scss";

</style>