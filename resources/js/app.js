/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

import 'bootstrap-icons/font/bootstrap-icons.css'

import Orders from "./components/pages/Orders";

require('./bootstrap');
import Vue from 'vue';
import VueRouter from 'vue-router';
import App from './components/layout/App.vue';
import Home from "./components/pages/Home.vue";
import excel from 'vue-excel-export'
import Documentation from "./components/pages/Documentation.vue";


Vue.use(excel)
Vue.use(VueRouter)


const router = new VueRouter({
    mode: 'history',
    linkExactActiveClass: 'active',
    routes: [
        {
            path: '/dashboard/home',
            name: 'home',
            component: Home
        },
        {
            path: '/dashboard/orders',
            name: 'orders',
            component: Orders
        },
        {
            path: '/dashboard/documentation',
            name: 'documentation',
            component: Documentation
        },
    ]
});

const app = new Vue({
    el: '#app',
    router,
    render: h => h(App),
});
