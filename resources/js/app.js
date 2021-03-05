require('./bootstrap');

import Vue from 'vue'
import VueRouter from 'vue-router'
Vue.use(VueRouter)

// Import User Class
import User from './Helpers/User'
window.User = User

// Routes Import
import {routes} from './routes'

const router = new VueRouter({
    routes,
    mode: 'history'
})

// Snotify Plugin Import Here
import Snotify, { SnotifyPosition } from 'vue-snotify'

const SnotifyOptions = {
  toast: {
    position: SnotifyPosition.rightTop
  }
}
Vue.use(Snotify, SnotifyOptions)

// Progress Bar Plugin Import Here
import VueProgressBar from 'vue-progressbar'

const VueProgressBarOptions = {
    color: '#00C853',
    failedColor: '#D80000',
    thickness: '5px',
    transition: {
        speed: '0.2s',
        opacity: '0.6s',
        termination: 300
    },
    autoRevert: true,
    location: 'top',
    inverse: false
}
Vue.use(VueProgressBar, VueProgressBarOptions)

// VForm Plugin Import Here
import { Form, HasError, AlertError } from 'vform'

window.Form = Form

Vue.component(HasError.name, HasError)
Vue.component(AlertError.name, AlertError)

// Laravel Vue Datatable Import Here
import DataTable from 'laravel-vue-datatable';

Vue.use(DataTable);

Vue.component('navbar-component', require('./components/pages/partials/navbar.vue').default);
Vue.component('aside-component', require('./components/pages/partials/aside.vue').default);
Vue.component('footer-component', require('./components/pages/partials/footer.vue').default);
Vue.component('pagination-component', require('./components/pages/partials/pagination.vue').default);
Vue.component('loading-component', require('./components/pages/partials/LoadingComponent.vue').default);

const app = new Vue({
    el: '#app',
    router
});
