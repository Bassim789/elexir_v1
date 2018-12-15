<template>
<Modal :show="show" @close="close">
  <div class="close_btn_wrap">
    <CloseBtn :click_btn="close" />  
  </div>
  <form v-on:submit.prevent>
    <input type="hidden" ref="debate_id" :value="debate.id">
    <input type="hidden" ref="parent_argument_id" :value="parent_argument_id">
    <input type="text" ref="title" placeholder="Titre" autocomplete="off">
    <textarea ref="description" placeholder="Argument"></textarea>
  </form>
  <div v-if="!loading" class="btn-modal-submit" :class="debate.user_own_vote" @click="submit">
    Ajouter argument
  </div>
  <div v-else class="btn-modal-loading">
    <img src="/img/loading.gif" />
  </div>
</Modal>
</template>

<script>
import Modal from '~/components/Modal.vue'
import CloseBtn from '~/components/CloseBtn.vue'
import api from '~/components/axios_public_api'
import api_front from '~/components/api_front'
export default {
  props: ['show', 'parent_argument_id'],
  components: {
    Modal, CloseBtn
  },
  beforeMount(){
    console.log('this.debate_user_own_vote: ', this.debate.user_own_vote)
  },
  data(){
    return {
      loading: false,
    }
  },
  methods: {
    close(){
      this.$emit('close')
    },
    submit(){
      this.loading = true
      let data = {
        debate_id: this.$refs.debate_id.value,
        parent_argument_id: this.$refs.parent_argument_id.value,
        title: this.$refs.title.value,
        description: this.$refs.description.value,
        side: this.debate.user_own_vote
      }
      api_front('debate', 'add_new_argument', data, (res => {
        console.log(res)
        this.loading = false
        this.$store.commit('reload_debate_data')
        this.close()
      }))
    }
  },
  watch: {
    show() {
      console.log('this.$refs.description: ', this.$refs.title)
      setTimeout(() => {
        if (this.show) this.$refs.description.focus().select()
      }, 100)
    }
  },
  computed: {
    debate(){
      return this.$store.state.debate
    }
  }
}
</script>

<style lang="scss" scoped>
@import "assets/scss/main_variables.scss";
@import "assets/scss/main_mixins.scss";
h3 {
  padding-top: 20px;
}
form{
  display: flex;
  flex-direction: column;
  margin: auto;
  input, textarea{
    border: none;
    outline: none;
    padding: 10px 20px;
    background: transparent;
  }
  input{
    font-weight: bold;
    font-size: 22px;
  }
  textarea{
    height: 100px;
    resize: none;
    font-size: 16px;
  }
}
.btn-modal-submit{
  width: 100%;
  padding: 10px;
  cursor: pointer;
  color: #fff;
  border-color: $color-neutral;
  background: rgba($color-neutral, 1);
  &:active {
    background: rgba($color-neutral, 0.5);
  }
}

@each $side in $sides {
  .btn-modal-submit.#{$side}{
    border-color: get_color_side($side);
    background: rgba(get_color_side($side), 1);
    transition: 0.5s;
    &:active{
      background: rgba(get_color_side($side), 0.5);
    }
  }
}


.btn-modal-loading{
  width: 100%;
  padding: 2px;
  height: 38px;
  img{
    height: 100%;
  }
}
.close_btn_wrap{
  position: absolute;
  top: 5px;
  right: 5px;
}
</style>