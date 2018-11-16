<template>
<div>
  <div class="container_titles">
    <div v-for="side in debate.sides" class="side">
      <div  :class="['side_title_box', side.name, selected(side.name)]" 
            @click="show_side_arguments(side.name)">
        <div class="side_title">
          {{side.arguments.length}} argument<span v-if="side.arguments.length > 1">s</span>
        </div>
      </div>
    </div>
  </div>
  <div class="container_arguments">
    <div v-for="side in debate.sides" :class="['side', selected(side.name)]">
      <div v-for="argument in side.arguments">
          <Argument :argument="argument" :side_name="side.name" />
      </div>
    </div>
  </div>
</div>
</template>

<script>
import Argument from '~/components/Argument.vue'
export default {
  props: ['debate'],
  components: {
    Argument
  },
  data(){
    return {
      side_argument_selected: 'pro'
    }
  },
  methods: {
    show_side_arguments(side) {
      console.log('clicked', side)
      this.side_argument_selected = side
    },
    selected(side){
      return this.side_argument_selected === side ? 'selected' : ''
    }
  }
}
</script>

<style lang="scss" scoped>
@import "assets/scss/main_variables.scss";
@import "assets/scss/main_mixins.scss";
.container_titles{
  display: flex;
}
.container_arguments{
  display: flex;
}
.side{
  flex: 1;
}
.side_title_box{
  display: flex;
  height: 50px;
  align-items: center;
  justify-content: center;
  .side_title{
    margin: auto 10px;
  }
}
@each $side in $sides {
  .side_title_box.#{$side}{
    color: $color-white-1;
    background: get_color_side($side);
    // transition: 0.5s;
  }
}

@media all and (max-width: 800px) {
  .container_arguments{
    flex-direction: column;
  }
  @each $side in $sides {
    .side_title_box.#{$side}.selected{
      // color: $color-dark-1;
      // background: rgba(get_color_side($side), 0.2);
      font-weight: bold;
    }
    .container_arguments .side{
      display: none;
    }
    .container_arguments .side.selected{
      display: block;
    }
  }
}

</style>