<template>
<Modal :show="show" @close="close">
  <div class="close_btn_wrap">
    <CloseBtn :click_btn="close" />  
  </div>
  <h3>Ajouter un argument</h3>
  <form v-on:submit.prevent>
    <input type="hidden" ref="debate_id" :value="debate_id">
    <input type="hidden" ref="parent_argument_id" :value="parent_argument_id">
    <input type="text" ref="title" placeholder="Titre" autocomplete="off">
    <textarea ref="description" placeholder="Argument"></textarea>
  </form>
  <div v-if="!loading" class="btn-modal-submit" @click="submit">Ajouter</div>
  <div v-else class="btn-modal-loading">
    <img src="/img/loading.gif" />
  </div>
</Modal>
</template>

<script>
import Modal from '~/components/Modal.vue'
import CloseBtn from '~/components/CloseBtn.vue'
import api from '~/components/axios_public_api'
export default {
  props: ['show', 'debate_id', 'parent_argument_id', 'reload_debate_data'],
  components: {
    Modal, CloseBtn
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
      console.log('submit')
      this.loading = true
      let data = {
        debate_id: this.$refs.debate_id.value,
        parent_argument_id: this.$refs.parent_argument_id.value,
        title: this.$refs.title.value,
        description: this.$refs.description.value
      }
      console.log(data)
      api.post('/debate?action=add_new_argument', data).then(res => {
        console.log(res.data)
        this.loading = false
        this.reload_debate_data()
        this.close()
      }).catch(e => {
        console.log(e)
        this.loading = false
      })
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
  background: rgba($color-neutral, 0.8);
  &:active {
    background: rgba($color-neutral, 1);
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