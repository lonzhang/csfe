import fr from "element-ui/src/locale/lang/fr";

require('./bootstrap');

// Import modules...
import Vue from 'vue';
import { App as InertiaApp, plugin as InertiaPlugin } from '@inertiajs/inertia-vue';
import PortalVue from 'portal-vue';

import VueI18n from 'vue-i18n'
import elementUi from 'element-ui'
import 'element-ui/lib/theme-chalk/index.css'

import axiosLoading from './Utils/AxiosLoading'
Vue.prototype.$ajax = axios  // 请求命名为$ajax

import utils from './Utils/Utils'
Vue.prototype.$utils = utils

import api from './Config/Api'
Vue.prototype.$api = api

import global_ from './Config/Global'
Vue.prototype.$global = global_.global_

import { encryptString, decodeString, getUrlQuery } from './Utils/JsBase64'
Vue.prototype.encryptString = encryptString
Vue.prototype.decodeString = decodeString
Vue.prototype.getUrlQuery = getUrlQuery

import VueSimplebar from 'vue-simplebar'
import 'vue-simplebar/dist/vue-simplebar.min.css'
import store from './Store'

Vue.use(VueSimplebar)

Vue.mixin({ methods: { route } });
Vue.use(InertiaPlugin);
Vue.use(PortalVue);
Vue.use(VueI18n);
Vue.use(elementUi);


const i18n = new VueI18n({
    locale: 'en-US',    // 语言标识
    //this.$i18n.locale // 通过切换locale的值来实现语言切换
    messages: {
        'en-US': require('./Lang/en.json'),    // 英文语言包
    }
});


const app = document.getElementById('app');

new Vue({
    store,
    i18n,
    render: (h) =>
        h(InertiaApp, {
            props: {
                initialPage: JSON.parse(app.dataset.page),
                resolveComponent: (name) => require(`./Pages/${name}`).default,
            },
        }),
}).$mount(app);
