<template>
<div>
  <header>
        
        <div class="back_btn">

          <div v-if="is_back_btn">
            <a v-on:click="go_back">
              <i class="fa fa-chevron-left"></i>
            </a>
          </div>

          <div class="back_btn" v-if="!is_back_btn && !is_homepage">
            <a v-on:click="go_home">
              <i class="fas fa-home"></i>
            </a>
          </div>

        </div>
        
        <a v-on:click="go_home">
          <img class="logo_header" src="/img/elexir_logo_v2_transparent_192px.png" />
        </a>
 
  </header>
  <div id="header_margin"></div>
</div>
</template>

<script>

export default {
  props: [
    'is_homepage',
  ],
  data(){
    return {is_back_btn: false}
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
  }
}
</script>


<style lang="scss" scoped>
@import "assets/scss/main_variables.scss";

header::after {
  content: '';
  width: 50px;
}
header{
  position: fixed;
  top: 0;
  left: 0;
  right: 0;
  background: #fff;
  color: #333;
  width: 100%;
  display: flex;
  height: 50px;
  text-align: center;
  align-items: center;
  justify-content: space-between;
  border-bottom: 1px solid #ddd;
  z-index: 10;
  a{
    color: #fff;
    text-decoration: none;
    cursor: pointer;
    margin: auto;
    height: 100%;
    width: auto;
  }
  .back_btn{
    width: 50px;
  }
  .back_btn a{
    color: #ddd;
    font-size: 30px;
  }
  .logo_header{
    height: 100%;
    width: auto;
    margin: auto;
  }
}
#header_margin{
  min-height: 50px;
  width: 100%;
}
</style>