<template>
  <div class="main-content">
    <Header is_homepage="true" />
    <section class="container">
      <div>
        <img :src="profil_picture" class="img_picture" @click="upload_file_to_client" />
        <input id="upload_file_to_client_btn" type="file" @change="onFileChanged" />
      </div>
      <div>
        <input v-on:change="name_changed" type="text" ref="name" :value="user_name" class="big_input">
      </div>
      <br><br>
      <div>
        Mes appareils:
        <div v-for="session in user.sessions">
          <br>
          <table class="session_box">
            <tbody>
              <tr>
                <td>IP</td>
                <td>{{session.ip}}</td>
              </tr>
              <tr>
                <td>Navigateur</td>
                <td>{{session.browser}}</td>
              </tr>
              <tr>
                <td>Appareil</td>
                <td>{{session.device}}</td>
              </tr>
              <tr>
                <td>OS</td>
                <td>{{session.os}}</td>
              </tr>
              <tr>
                <td>Région</td>
                <td>{{session.country}} / {{session.region}}</td>
              </tr>
              <tr>
                <td>Première connexion</td>
                <td>{{session.timestamp_creation_clean}} ({{session.timestamp_creation_ago}})</td>
              </tr>
              <tr>
                <td>Dernière connexion</td>
                <td>{{session.timestamp_last_access_clean}} ({{session.timestamp_last_access_ago}})</td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </section>
    <br><br>
    <Footer />
  </div>
</template>

<script>
import Header from '~/layouts/Header.vue'
import axios from '~/components/axios_public_api'
import api_front from '~/components/api_front'
import Footer from '~/layouts/Footer.vue'
import moment from 'moment'
import cookie from '~/components/cookie'

moment.locale('fr')

function unix_to_date(timestamp){
  return moment.unix(timestamp).format('LLLL')
}
function unix_to_ago(timestamp){
  return moment.unix(timestamp).fromNow();
}

export default {
  middleware: 'index',
  components: {
    Header, Footer
  },
  data(){
    return {
      selectedFile: null
    }
  },
  methods: {
    name_changed(){
      console.log('name_changed')
      const new_name = this.$refs.name.value
      console.log(new_name + ' === ' + this.user_name)
      if(new_name === this.user_name) return
      this.user_name = new_name
      api_front('user', 'change_name', {new_name}, (res => console.log(res)))
    },
    onFileChanged(event) {
      this.selectedFile = event.target.files[0]
      this.onUpload()
    },
    onUpload() {
      const formData = new FormData()
      formData.append('cookie_token', cookie.get('cookie_token'))
      formData.append('userfile', this.selectedFile, this.selectedFile.name)
      axios.post('/user?action=upload_profil_picture', formData, {
        onUploadProgress: progressEvent => {
          console.log(progressEvent.loaded / progressEvent.total)
          console.log(progressEvent)
        },
      }).then(res => {
        console.log(res.data)
        this.profil_picture = res.data.profil_picture
      })
    },
    upload_file_to_client(){
      console.log('upload_file_to_client()')
      document.getElementById('upload_file_to_client_btn').click()
    },
  },
  computed: {
    user(){
      const user = this.$store.state.user
      user.sessions = user.sessions.map((session) => {
        session.timestamp_creation_clean = unix_to_date(session.timestamp_creation)
        session.timestamp_creation_ago = unix_to_ago(session.timestamp_creation)
        session.timestamp_last_access_clean = unix_to_date(session.timestamp_last_access)
        session.timestamp_last_access_ago = unix_to_ago(session.timestamp_last_access)
        return session
      })
      return user
    },
    user_name: {
      get(){
        return this.$store.state.user.public_entities[0].title
      },
      set(new_value) {
        this.$store.state.user.public_entities[0].title = new_value
      }
    },
    profil_picture: {
      get(){
        return this.$store.state.user.public_entities[0].profil_picture
      },
      set(new_value) {
        this.$store.state.user.public_entities[0].profil_picture = new_value
      }
    },
  }
}
</script>

<style lang="scss" scoped>
@import "assets/scss/main_variables.scss";
.img_picture{
  width: 200px;
  cursor: pointer;
}
.big_input{
  border: none;
  border-bottom: 1px solid #ddd;
  outline: none;
  padding: 10px 20px;
  width: 300px;
  max-width: 80%;
  background: transparent;
  text-align: center;
  font-size: 22px;
}
#upload_file_to_client_btn{
  display: none;
}
.session_box{
  border: 1px solid #ddd;
  td{
    padding: 5px 10px;
    text-align: left;
  }
}


</style>
