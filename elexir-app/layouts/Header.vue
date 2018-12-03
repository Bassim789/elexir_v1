<template>
<div>
  <header>
    <div class="header_inner">

        <div class="back_btn left_area">

          <div v-if="is_back_btn">
            <a v-on:click="go_back">
              <i class="fa fa-chevron-left"></i>
            </a>
          </div>

          <div v-if="!is_back_btn && !is_homepage">
            <a v-on:click="go_home">
              <i class="fas fa-home"></i>
            </a>
          </div>

        </div>
        
        <a v-on:click="go_home" class="center area">
          <img class="logo_header" src="/img/elexir_logo_v2_transparent_192px.png" />
        </a>
        
        <div v-on:click="go_to_user_info" class="user_info_btn right_area">
          {{user_name}}
          <!-- <i class="fas fa-user user_icon"></i> -->
          <img :src="profil_picture" class="profil_picture" />
        </div>
    </div>
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
    return {
      is_back_btn: false
    }
  },
  beforeMount() {
    this.$store.commit('set_cookie')
    this.$store.commit('set_user_info')
    console.log('user: ', this.$store.state.user)
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
    go_to_user_info(){
      this.$router.push('/user_info')
      this.is_back_btn = true
    }
  },
  computed: {
    user_name(){
      return this.$store.state.user.public_entities[0].title
    },
    profil_picture(){
      return this.$store.state.user.public_entities[0].profil_picture
    }
  }
}
</script>


<style lang="scss" scoped>
@import "assets/scss/main_variables.scss";


header{
  position: fixed;
  top: 0;
  left: 0;
  right: 0;
  background: #fff;
  color: #333;
  width: 100%;
  height: 50px;
  border-bottom: 1px solid #ddd;
  z-index: 10;
  .profil_picture{
    max-height: 50px;
    max-width: 100px;
    margin-left: 10px;
  }
  .header_inner{
    width: 100%;
    height: 100%;
    position: relative;
    text-align: center;
    .left_area{
      position: absolute;
      top: 0;
      left: 0;
      bottom: 0;
      display: flex;
      align-items: center;
      justify-content: space-between;
    }
    .right_area{
      position: absolute;
      top: 0;
      right: 0;
      bottom: 0;
      display: flex;
      align-items: center;
      justify-content: space-between;
    }
    .center_area{
      margin: auto;
    }
    a{
      color: #fff;
      text-decoration: none;
      cursor: pointer;
      margin: auto;
      height: 100%;
      width: auto;
    }
    .back_btn{
      margin-left: 10px;
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
    .user_info_btn{
      cursor: pointer;
      margin-right: 0px;
      .user_icon{
        color: $color-neutral;
        font-size: 26px;
      }
    }
  }
}
#header_margin{
  min-height: 50px;
  width: 100%;
}
</style>