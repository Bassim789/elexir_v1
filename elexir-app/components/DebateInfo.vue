<template>
  <div>
      <h1>{{debate.title}}</h1>
      <h2>{{debate.description}}</h2>
      <div>user id: {{debate.user_id}}</div>
      <br><br>
      <div>nb vote pour: {{debate.nb_vote_pro}}</div>
      <div>nb vote neutre: {{debate.nb_vote_neutral}}</div>
      <div>nb vote contre: {{debate.nb_vote_con}}</div>
      <br><br>
      <div v-for="opinion in debate.opinions">
            <div>
                <h3>{{opinion.title}}</h3>
                <div>{{opinion.description}}</div>
                <div>user id: {{opinion.user_id}}</div>
            </div>
            <br>
      </div>
  </div>
</template>

<style scoped>
  
</style>

<script>
export default {
    props: ['debate']
}
</script>