require('./bootstrap-front');

require('../../../node_modules/bootstrap-sass/assets/javascripts/bootstrap');

import 'babel-polyfill';
import Vue from 'vue';
import VueI18n from 'vue-i18n';
import VueRouter from 'vue-router';
import ElementUI from 'element-ui';
import VueEvents from 'vue-events';
import locale from 'element-ui/lib/locale/lang/en';
import ItemRoutes from '../../../Modules/Item/Assets/js/ItemRoutes';

Vue.use(ElementUI, { locale });
Vue.use(VueI18n);
Vue.use(VueRouter);
Vue.use(require('vue-shortkey'), { prevent: ['input', 'textarea'] });

Vue.use(VueEvents);
require('./mixins');

Vue.component('navbar', require('./components/Navbar.vue'));

const currentLocale = window.AsgardCMS.currentLocale;

const router = new VueRouter({
    mode: 'history',
    routes: [
        ...ItemRoutes,
    ],
});

const messages = {
    [currentLocale]: window.AsgardCMS.translations,
};

const i18n = new VueI18n({
    locale: currentLocale,
    messages,
});

const app = new Vue({
    el: '#app',
    router,
    i18n,
});

window.axios.interceptors.response.use(null, (error) => {
    if (error.response === undefined) {
        console.log(error);
        return;
    }
    if (error.response.status === 403) {
        app.$notify.error({
            title: app.$t('core.unauthorized'),
            message: app.$t('core.unauthorized-access'),
        });
        window.location = route('dashboard.index');
    }
    if (error.response.status === 401) {
        app.$notify.error({
            title: app.$t('core.unauthenticated'),
            message: app.$t('core.unauthenticated-message'),
        });
        window.location = route('login');
    }
    return Promise.reject(error);
});
