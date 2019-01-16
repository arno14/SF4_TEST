// any CSS you require will output into a single css file (app.css in this case)
require('../css/app.css');

// Need jQuery? Install it with "yarn add jquery", then uncomment to require it.
// const $ = require('jquery');

console.log('Hello World');

import Vue from 'vue'
import App from './vue_components/App'

new Vue({
  el: '#app',
  template: '<App/>',
  components: { App }
});


