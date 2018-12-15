<template>
<div class="container">
  <div>
    {{debate.nb_vote_total}} vote<span v-if="debate.nb_vote_total > 1">s</span>
  </div>
  <div class="bars">
    <div class="bar pro" :style="{height: debate.percent_relative_vote_pro + '%'}"></div>
    <div class="bar neutral" :style="{height: debate.percent_relative_vote_neutral + '%'}"></div>
    <div class="bar con" :style="{height: debate.percent_relative_vote_con + '%'}"></div>
  </div>
  <div>
    <div class="label">{{debate.percent_vote_pro}}%</div>
    <div class="label">{{debate.percent_vote_neutral}}%</div>
    <div class="label">{{debate.percent_vote_con}}%</div>
  </div>
</div>
</template>

<script>
export default {
  computed: {
    debate(){
      return this.$store.state.debate
    }
  }
}
</script>

<style lang="scss" scoped>
@import "assets/scss/main_variables.scss";
.container{
  width: 300px;
  height: 150px;
  margin: auto;
}
.bars{
  width: 100%;
  height: 100%;
  display: flex;
  .bar{
    flex: 1;
    align-self: flex-end;
    transition: 0.5s;
  }
  .pro{
    background: $color-pro;
  }
  .neutral{
    background: $color-neutral;
  }
  .con{
    background: $color-con;
  }
}
.label{
  display: inline-block;
  float: left;
  width: 100px;
  text-align: center;
}
</style>