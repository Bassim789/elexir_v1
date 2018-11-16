<template>
  <transition name="modal">
    <div class="modal-mask" @click="close" v-show="show">
      <div class="modal-container" @click.stop>
        <slot></slot>
      </div>
    </div>
  </transition>
</template>

<script>
export default {
  props: ['show'],
  components: {},
  methods: {
    close: function () {
      this.$emit('close');
    }
  },
  mounted: function () {
    document.addEventListener('keydown', (e) => {
      if (this.show && e.keyCode === 27) {
        this.close()
      }
    })
  }
}
</script>

<style lang="scss" scoped>
@import "assets/scss/main_variables.scss";
@import "assets/scss/main_mixins.scss";
.modal-mask {
  position: fixed;
  z-index: 999;
  top: 0;
  left: 0;
  width: 100%;
  height: calc(100% + 100px);
  margin-top: -50px;
  background-color: rgba(0, 0, 0, .5);
  transition: opacity .3s ease;
  display: flex;
  align-items: center;
  justify-content: center;
}
.modal-container {
  position: relative;
  width: 100%;
  max-width: 420px;
  margin: auto;
  background-color: $color-white-1;
  border-radius: 2px;
  box-shadow: 0 0 40px rgba(0,0,0,.80);
  transition: all .3s ease;
}
.modal-enter {
  opacity: 0;
}
.modal-leave-active {
  opacity: 0;
}
.modal-enter .modal-container,
.modal-leave-active .modal-container {
  -webkit-transform: scale(0);
  transform: scale(0);
}
</style>