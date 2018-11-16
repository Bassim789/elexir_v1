<template>
  <div class="close_btn" @click="click_btn"></div>  
</template>

<script>
export default {
  props: ['click_btn']
}
</script>

<style lang="scss" scoped>
@import "assets/scss/main_variables.scss";
@import "assets/scss/main_mixins.scss";

.close_btn{
  position: relative;
  display: inline-block;
  width: 30px;
  height: 30px;
  overflow: hidden;
  cursor: pointer;
  &::before, &::after {
    content: '';
    position: absolute;
    height: 8px;
    width: 100%;
    top: 50%;
    left: 0;
    margin-top: -4px;
    background: rgba($color-neutral, 0.8);
    border-radius: 5px;
  }
  &::before {
    transform: rotate(45deg);
  }
  &::after {
    transform: rotate(-45deg);
  }
  &:hover {
    &::before, &::after {
      background: rgba($color-neutral, 0.9);
    }
  }
  &:active {
    &::before, &::after {
      background: rgba($color-neutral, 1);
    }
  }
}
</style>