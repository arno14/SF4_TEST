// any CSS you require will output into a single css file (app.css in this case)

import Vue from 'vue';
import VueRouter from 'vue-router';
import BootstrapVue from 'bootstrap-vue';
import Moment from 'moment';

import AuthorIndex from './components/AuthorIndex.vue';
import BookIndex from './components/BookIndex.vue';

require('../css/app.css');

// Define Route
Vue.use(VueRouter);
const router = new VueRouter({
  // mode: 'history',
  // base: 'spa',
  // mode: 'hash',
  routes: [
    { path: '/author', component: AuthorIndex },
    { path: '/book', component: BookIndex },
    { path: '/book/:book_id', name: 'book_detail', component: BookIndex },
    { path: '/', redirect: '/book' },
  ],
});

// register globally Bootstrap vue , all components "b-*" will be availables
Vue.use(BootstrapVue);

// Register globally the filter "formatDate"
// locale format @see https://momentjs.com/docs/#/parsing/string-format/
Vue.filter('formatDate', (date, format = 'L') => {
  if (!date) {
    return null;
  }
  return Moment(date).format(format);
});

const vueApp = new Vue({
  el: '#app',
  router,
  template: '<router-view></router-view>', // will include the Component AuthorIndex or BookIndex regarding the route
});

// just to avoid error on eslint fix style library!!!
vueApp.$emit('started');

// As webpack Encore hot reload does not support CSS reload, call this function in browser console
window.reloadCSS = () => {
  document.querySelectorAll('link').forEach((e) => {
    const clone = e.cloneNode();
    clone.setAttribute('href', `${clone.getAttribute('href')}?v${new Date().getTime()}`);
    e.parentNode.insertBefore(clone, e);
    setTimeout(() => {
      e.remove();
    }, 300);
  });
};
