<template>
  <div>
    <div class="button" :class="debate_user_own_vote" @click="show_modal_new_argument = true">
      Ajouter un argument
    </div>
    <NewArgumentModal 
      :reload_debate_data="reload_debate_data"
      :debate_id="debate_id"
      :debate_user_own_vote="debate_user_own_vote"
      :parent_argument_id="0"
      :show="show_modal_new_argument" 
      @close="show_modal_new_argument = false"
    />
  </div>
</template>

<script>
import NewArgumentModal from '~/components/NewArgumentModal.vue'
export default {
  props: ['debate_id', 'debate_user_own_vote', 'reload_debate_data'],
  components: {
    NewArgumentModal
  },
  data(){
    return {
      show_modal_new_argument: false
    }
  },  
}
</script>

<style lang="scss" scoped>
@import "assets/scss/main_variables.scss";
@import "assets/scss/main_mixins.scss";

.button{
  color: $color-neutral;
  border-color: $color-neutral;
  background: rgba($color-neutral, 0);
  &:hover{
    color: #fff;
    background: $color-neutral;
  }
}
@each $side in $sides {
  .button.#{$side}{
    color: get_color_side($side);
    border-color: get_color_side($side);
    background: rgba(get_color_side($side), 0);
    transition: 0.5s;
  }
  .button.#{$side}:hover{
    color: #fff;
    background: rgba(get_color_side($side), 1);
  }
}

</style>