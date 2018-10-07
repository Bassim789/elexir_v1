<template>
  <section class="container">
    <div>
      <h1 class="title">
        Démo débat
      </h1>
      <div class="links">
        <a
          href="/"
          class="button--grey">home</a>
      </div>
      <br><br>
      <DebateInfo :debate="debate" />
    </div>
  </section>
</template>

<script>
import api from '~/components/axios_public_api'
import DebateInfo from '~/components/DebateInfo.vue'

export default {
  components: {
    DebateInfo
  },
  data() {
    return {
      title: 'test title'
    }
  },
  asyncData(context, callback) {
    console.log('asyncData start')
    const debate_id = 1
    api.get('/debate?action=get_basic_info', {params: {debate_id}}).then(res => {
      console.log(res.data)
      callback(null, {debate: res.data})
    }).catch(e => {
      console.log(e)
      callback(null, {debate_info: {}})
    })
  }
}
</script>

<style>
.container {
  min-height: 100vh;
  display: flex;
  justify-content: center;
  align-items: center;
  text-align: center;
}

.title {
  font-family: "Quicksand", "Source Sans Pro", -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif; /* 1 */
  display: block;
  font-weight: 300;
  font-size: 100px;
  color: #35495e;
  letter-spacing: 1px;
}

.subtitle {
  font-weight: 300;
  font-size: 42px;
  color: #526488;
  word-spacing: 5px;
  padding-bottom: 15px;
}

.links {
  padding-top: 15px;
}
</style>

