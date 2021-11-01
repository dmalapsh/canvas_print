import VueHead from 'vue-head';
Vue.use(VueHead, {
    separator: ' — ',
    complement: 'Votel'
})

require('./bootstrap');
import VueRouter from 'vue-router'
Vue.use(VueRouter);


import helpers from './helpers'
Vue.use(helpers);

const moment = require('moment');
moment.updateLocale("ru");
require('moment/locale/ru');
Vue.use(require('vue-moment'), { moment });

import axios from 'axios'
import VueAxios from 'vue-axios';
Vue.use(VueAxios, axios);

import { nativeroutes } from "./routes";
window.routes = nativeroutes;

import permissions from './permissions';
Vue.mixin(permissions);


const router = new VueRouter({
    mode: 'history',
    linkExactActiveClass: 'active',
    routes: nativeroutes
})

import Vue from 'vue'
import VueNoty from 'vuejs-noty'
Vue.use(VueNoty)

import BootstrapVue from 'bootstrap-vue'
Vue.use(BootstrapVue);


import Vuex from 'vuex'
import StoreData from './store';
Vue.use(Vuex);
const store = new Vuex.Store(StoreData);
let app = new Vue({
    el: '#app',
    store: store,
    router: router
});
