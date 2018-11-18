<template>
  <div class="main-content">
    <Header is_homepage="true" />
    <section class="container">
      <img class="logo_with_name_banner" src="/img/elexir_logo_v2_with_name.png">
      <h1 class="title">
        Election et débat intelligent
      </h1>
      <div class="links">
        <nuxt-link to="/debate/1" class="button btn-color-pro">Démo</nuxt-link>
      </div>
    </section>
    <Footer />
  </div>
</template>

<script>
import Header from '~/layouts/Header.vue'
import Footer from '~/layouts/Footer.vue'

export default {
  middleware: 'index',
  components: {
    Header, Footer
  },
  beforeMount() {
    this.$store.commit('set_cookie')
  },
  head() {
    return {
      title: 'ELEXIR | Election et débat intelligent',
      meta: [
        { hid: 'description', name: 'description', content: 'Election et débat intelligent' }
      ]
    }
  },
  methods: {
    
  }
}
</script>

<style lang="scss" scoped>
@import "assets/scss/main_variables.scss";

.logo_with_name_banner{
  width: 100%;
  max-width: 600px;
}

.title {
  font-family: LOVES, "Helvetica Neue", Arial, sans-serif;
  display: block;
  font-weight: 300;
  font-size: 30px;
  color: $color-dark-1;
  letter-spacing: 1px;
}

.links {
  padding-top: 15px;
}
.links a{
  margin: 10px;
  margin-bottom: 10px;
}


@media all and (max-width: 600px) {
  .title {
    font-size: 18px;
  }
}

</style>

