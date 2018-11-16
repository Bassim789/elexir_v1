<template>
  <div>
    <nuxt/>
  </div>
</template>

<style lang="scss">
@import "assets/scss/main_variables.scss";

html {
  font-family: "Helvetica Neue", Arial, sans-serif;
  font-size: 16px;
  word-spacing: 1px;
  -ms-text-size-adjust: 100%;
  -webkit-text-size-adjust: 100%;
  -moz-osx-font-smoothing: grayscale;
  -webkit-font-smoothing: antialiased;
  box-sizing: border-box;
}

body {
  background: #fff;
}

*, *:before, *:after {
  box-sizing: border-box;
  margin: 0;
  -webkit-tap-highlight-color: rgba(0, 0, 0, 0) !important;
}

@font-face {
    font-family: LOVES;
    src: url(/font/LOVES.ttf);
}

a{
  cursor: pointer;
}

// .page-enter-active, .page-leave-active {
//   transition: opacity .3s;
// }
// .page-enter, .page-leave-active {
//   opacity: 0;
// }

.container {
  flex: 1;
  display: flex;
  justify-content: center;
  align-items: center;
  text-align: center;
  flex-direction: column;
}
.main-content{
  display: flex;
  flex-direction: column;
  min-height: 100vh;
}


.button {
  display: inline-block;
  border-radius: 4px;
  border: 1px solid #35495e;
  color: #35495e;
  text-decoration: none;
  padding: 10px 30px;
  cursor: pointer;
  transition: 0.5s;
}

.button:hover {
  color: #fff;
  background-color: #35495e;
}

.btn-color-pro{
  color: $color-pro;
  background-color: fff;
  border-color: $color-pro;
}
.btn-color-pro:hover{
  background-color: $color-pro;
}

</style>

