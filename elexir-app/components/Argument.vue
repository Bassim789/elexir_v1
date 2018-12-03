<template>
<div :class="['argument_box ' + side_name, hide ? 'hide' : '', hiding ? 'hiding' : '']">
  <div v-if="argument.is_own_argument" class="close_btn_wrap">
     <CloseBtn :click_btn="delete_argument" />  
  </div>
  <div class="user_info">
    <img class="user_picture" :src="argument.profil_picture" />
    <div class="user_name">{{argument.user_name}}</div>
  </div>
  <h2>{{argument.title}}</h2>
  <div style="white-space: pre-wrap;">{{argument.description}}</div>
</div>
</template>

<script>
import CloseBtn from '~/components/CloseBtn.vue'
import api_front from '~/components/api_front'

export default {
  props: ['side_name', 'argument'],
  data(){
    return {
      hide: false,
      hiding: false
    }
  },
  components: {
    CloseBtn
  },
  methods:{
    delete_argument(){
      console.log('delete_argument()')
      this.hiding = true
      setTimeout(() => {
        this.hide = true
      }, 500)
      const argument_id = this.argument.id
      api_front('debate', 'delete_argument', {argument_id}, (res => {
        console.log(res)
      }))
    }
  }
}
</script>

<style lang="scss" scoped>
@import "assets/scss/main_variables.scss";
@import "assets/scss/main_mixins.scss";
.argument_box{
  text-align: left;
  border: 0;
  position: relative;
  border-bottom: 1px solid $color-white-1;
  padding: 20px;
  opacity: 1;
  transition: 0.5s;
  &.hiding{
    opacity: 0;
  }
  &.hide{
    display: none;
  }
}
.user_info{
  display: flex;
  align-items: center;
  justify-content: right;
  width: 100%;
  .user_name{
    font-weight: bold;
  }
  .user_picture{
    height: 50px;
  }
}
@each $side in $sides {
  .argument_box.#{$side}{
    background: rgba(get_color_side($side), 0.2);
  }
}
.close_btn_wrap{
  position: absolute;
  top: 5px;
  right: 5px;
}
</style>