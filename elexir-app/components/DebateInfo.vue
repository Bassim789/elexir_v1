<template>
<div class="info_area">
  <h1 class="title">{{debate.title}}</h1>
  <div class="description">{{debate.description}}</div>
</div>
</template>

<script>
export default {
    props: ['debate']
}
</script>

<style lang="scss" scoped>
@import "assets/scss/main_variables.scss";
.info_area{
  padding: 20px;
  max-width: 800px;
  text-align: left;
  margin: auto;
}

.title {
  display: block;
  font-weight: 300;
  font-size: 40px;
  color: $color-dark-1;
  letter-spacing: 1px;
  margin-bottom: 20px;
  text-align: center;
}

.description {
  font-weight: 300;
  font-size: 24px;
  color: $color-dark-1;
  word-spacing: 5px;
  padding-bottom: 15px;
}

@media all and (max-width: 600px) {
  .title {
    font-size: 32px;
  }
  .description {
    font-size: 18px;
  }
}
</style>