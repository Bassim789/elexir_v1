<template>
    <footer>
      © 2018 Elexir | created by 
      <a class="link" href="https://simergie.ch" target="_blank">
        &nbsp;Simergie
      </a>
    </footer>
</template>

<style lang="scss" scoped>
@import "assets/scss/main_variables.scss";

footer{
  background: $color-dark-1;
  color: #fff;
  width: 100%;
  display: flex;
  min-height: 50px;
  text-align: center;
  align-items: center;
  justify-content: center;
  font-size: 12px;
  a{
    color: #fff;
    text-decoration: none;
    transition: 0.5s;
    &:hover{
      color: #89bad2;
    }
  }
}
</style>