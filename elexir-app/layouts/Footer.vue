<template>
  <div>
    <div style="text-align: center; margin: auto; display: none;">
      cookie_token: {{cookie_token}}
    </div>
    <footer>
      © 2018 Elexir | created by 
      <a class="link" href="https://simergie.ch" target="_blank">
        &nbsp;Simergie
      </a>
    </footer>
  </div>
</template>

<script>
export default {
  props: [
    'is_homepage',
  ],
  data(){
    return {
      is_back_btn: false
    }
  },
  methods: {
    go_back(){
      this.$router.back()
      this.is_back_btn = true
    },
    go_home(){
      this.$router.push('/')
      this.is_back_btn = true
    },
  },
  computed: {
    cookie_token(){
      return this.$store.state.user.cookie_token
    }
  }
}
</script>




<style lang="scss" scoped>
@import "assets/scss/main_variables.scss";

footer{
  background: $color-dark-1;
  color: #fff;
  width: 100%;
  display: flex;
  min-height: 50px;
  text-align: center;
  align-items: center;
  justify-content: center;
  font-size: 12px;
  a{
    color: #fff;
    text-decoration: none;
    transition: 0.5s;
    &:hover{
      color: #89bad2;
    }
  }
}
</style>