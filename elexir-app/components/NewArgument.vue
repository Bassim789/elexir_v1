<template>
  <div>
    <div class="button" @click="show_modal_new_argument = true">Ajouter un argument</div>
    <NewArgumentModal 
      :reload_debate_data="reload_debate_data"
      :debate_id="debate_id"
      :parent_argument_id="0"
      :show="show_modal_new_argument" 
      @close="show_modal_new_argument = false"
    />
  </div>
</template>

<script>
import NewArgumentModal from '~/components/NewArgumentModal.vue'
export default {
  props: ['debate_id', 'reload_debate_data'],
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
  &:hover{
    color: #fff;
    background: $color-neutral
  }
}

</style>