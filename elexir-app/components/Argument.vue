<template>
<div :class="['argument_box ' + side_name]">
  <h2>{{argument.title}}</h2>
  <div style="white-space: pre-wrap;">{{argument.description}}</div>
</div>
</template>

<script>
export default {
  props: ['side_name', 'argument']
}
</script>

<style lang="scss" scoped>
@import "assets/scss/main_variables.scss";
@import "assets/scss/main_mixins.scss";
.argument_box{
  text-align: left;
  padding: 20px;
  border-bottom: 1px solid $color-white-1;
  transition: 0.5s;
}
@each $side in $sides {
  .argument_box.#{$side}{
    background: rgba(get_color_side($side), 0.2);
  }
}
</style>