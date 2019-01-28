// any CSS you require will output into a single css file (app.css in this case)
require('../css/app.css');

import Vue from 'vue'
import App from './vue_components/App'

new Vue({
  el: '#app',
  template: '<App/>',
  components: { App }
});


