// any CSS you require will output into a single css file (app.css in this case)

import Vue from 'vue'
import VueRouter from 'vue-router'
import BootstrapVue from 'bootstrap-vue'
import Moment from 'moment'

import AuthorIndex from './components/AuthorIndex'
import BookIndex from './components/BookIndex'

require('../css/app.css')

// Define Route
Vue.use(VueRouter)
const router = new VueRouter({
  routes: [
    { path: '/author', component: AuthorIndex },
    { path: '/book', component: BookIndex },
    { path: '/', redirect: '/book' }
  ]
})

// register globally Bootstrap vue , all components "b-*" will be availables
Vue.use(BootstrapVue)

// Register globally the filter "formatDate"
Vue.filter('formatDate', function (date) {
  var format = arguments[1] || 'd/m/Y'
  return Moment(date).format(format)
})

const vueApp = new Vue({
  el: '#app',
  router: router,
  template: '<router-view></router-view>' // will include the Component AuthorIndex or BookIndex regarding the route
})

// just to avoid error on eslint fix style library!!!
vueApp.$emit('started')

// As webpack Encore hot reload does not support CSS reload, call this function in browser console
window.reloadCSS = function () {
  document.querySelectorAll('link').forEach(function (e) {
    var clone = e.cloneNode()
    clone.setAttribute('href', clone.getAttribute('href') + '?v' + new Date().getTime())
    e.parentNode.insertBefore(clone, e)
    setTimeout(function () {
      e.remove()
    }, 300)
  })
}
