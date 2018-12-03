module.exports = {
  /*
  ** Headers of the page
  */
  head: {
    title: 'elexir-app',
    meta: [
      { charset: 'utf-8' },
      { name: 'viewport', content: 'width=device-width, initial-scale=1' },
      { hid: 'description', name: 'description', content: 'Nuxt.js project' }
    ],
    link: [
      { rel: 'icon', type: 'image/x-icon', href: '/img/elexir_logo_v2_transparent_48px.png?v=1' },
      { rel: 'stylesheet', type: 'text/css', href: '/lib/font-awesome/css/font-awesome.css' },
    ],
    script: [
      {type: 'text/javascript', src: '/lib/user_agent_parser.js'}
    ]
  },

  // css: [
  //   {src: '/assets/font-awesome.css', lang: 'css'}
  // ],


  /*
  ** Customize the progress bar color
  */
  loading: { color: '#3B8070' },
  /*
  ** Build configuration
  */
  build: {
      // extractCSS: true
  },
 
  // modules: [
  //   'bootstrap-vue/nuxt',
  // ],

  // css: [
  //   { src: '~assets/scss/main_variables.scss', lang: 'scss' },
  //   { src: '~assets/scss/main_mixins.scss', lang: 'scss' },
  // ],

  

  // css: {
  //   loaderOptions: {
  //     // pass options to sass-loader
  //     sass: {
  //       // @/ is an alias to src/
  //       // so this assumes you have a file named `src/variables.scss`
  //       data: `@import "@/assets/scss/main_variables.scss";`
  //     }
  //   }
  // }

}

