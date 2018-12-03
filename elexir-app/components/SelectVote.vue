<template>
<div class="container">
  Ton vote
  <div class="sides">
    <div v-for="side in vote_select_sides" class="side" @click="select_vote(side.name)"
      :class="[side.name, {vote_selected: side.vote_selected}]">
      {{side.title}}
    </div>
  </div>
</div>
</template>

<script>
import api_front from '~/components/api_front'

export default {
  props: ['debate', 'reload_debate_data'],
  beforeMount(){
    this.vote_select_sides.forEach(vote => {
      if(vote.name === this.debate.user_own_vote) vote.vote_selected = true
    })
  },
  data(){
    return {
      vote_select_sides: [{
          name: 'pro',
          title: 'Pour',
          vote_selected: false,
        }, {
          name: 'neutral',
          title: 'Neutre',
          vote_selected: false,
        }, {
          name: 'con',
          title: 'Contre',
          vote_selected: false,
      }]
    }
  },
  methods:{
    select_vote(side_name){
      const debate_id = this.debate.id
      let vote_side = 'nothing'
      this.vote_select_sides.forEach(vote => {
        if(vote.name === side_name && !vote.vote_selected){
          vote.vote_selected = true
          vote_side = vote.name
        } else {
          vote.vote_selected = false
        }
      })
      console.log('vote_side: ', vote_side)
      api_front('debate', 'select_vote', {vote_side, debate_id}, (res => {
        console.log(res)
        this.reload_debate_data()
      }))
    },
  },
}
</script>

<style lang="scss" scoped>
@import "assets/scss/main_variables.scss";
@import "assets/scss/main_mixins.scss";
.container{
  width: 300px;
  height: 70px;
  margin: auto;
  margin-top: 20px;
}
.sides{
  width: 100%;
  height: 100%;
  display: flex;
  .side{
    display: flex;
    flex: 1;
    align-self: flex-end;
    align-items: center;
    justify-content: center;
    height: 50px;
    transition: 0.5s;
    cursor: pointer;
  }
}
.label{
  display: inline-block;
  float: left;
  width: 100px;
  text-align: center;
}
@each $side in $sides {
  .side.#{$side}{
    background: rgba(get_color_side($side), 0.2);
  }
  .side.#{$side}:hover{
    background: rgba(get_color_side($side), 0.6);
    color: #fff;
  }
  .side.#{$side}.vote_selected{
    background: rgba(get_color_side($side), 1);
    color: #fff;
  }
}
</style>