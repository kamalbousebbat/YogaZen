export default {
  modules: ['vuetify-nuxt-module'],
  buildModules: ['@nuxtjs/axios'],
  vuetify: {},
  axios: {
    baseURL: 'http://localhost:8000/api' // Adjust to your Laravel API URL
  },
  build: {}
}
