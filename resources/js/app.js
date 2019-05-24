/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i);
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));

// Bring in quasar
import { Quasar,QList,QListHeader,QItem,QItemMain,QToolbar,QToolbarTitle } from 'quasar-framework/dist/quasar.mat.esm';
/**
window.Quasar = require('quasar');
Vue.use(Quasar, { config: {},components: {QLayout,QLayoutHeader,QLayoutDrawer,QPageContainer,QPage,QToolbar,QToolbarTitle,QBtn,QIcon,QList,QListHeader,QItem,QItemMain,QItemSide},directives: {Ripple},plugins: {Notify} })
*/
import { QDatetimePicker } from 'quasar-framework';
import {QLayout,QLayoutHeader,QLayoutDrawer,QItemSide} from 'quasar-framework'
import {QPageContainer,QPage,QBtn,QIcon,Ripple,Notify} from 'quasar'


Vue.use(Quasar, { config: {},components: {QLayout,QLayoutHeader,QLayoutDrawer,QPageContainer,QPage,QToolbar,QToolbarTitle,QBtn,QIcon,QList,QListHeader,QItem,QItemMain,QItemSide},directives: {Ripple},plugins: {Notify} })

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
});
