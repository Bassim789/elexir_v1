<template>
  <div class="main-content">
    <Header is_homepage="true" />
    <section class="container">
      <h1>Erreur</h1>
      <p>
        Cette page n'existe pas. 
      </p>
      <p>
        Retourner sur la <nuxt-link to="/">page d'accueil</nuxt-link>
      </p>
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
  }
}
</script>

<style lang="scss" scoped>
@import "assets/scss/main_variables.scss";


</style>

