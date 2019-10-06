// any CSS you require will output into a single css file (app.css in this case)
import Vue from 'vue'
import App from './vue_components/App'

require('../css/app.css')

const vueApp = new Vue({
  el: '#app',
  components: { App },
  template: '<App/>'
})

// just to avoid error on eslint fix style library!!!
vueApp.$emit('started')
