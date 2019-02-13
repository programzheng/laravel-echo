import Vue from 'vue';
import Router from 'vue-router';

//使用components模塊化方式需寫上
Vue.use(Router);

import notFound from './components/404.vue';
import register from './components/Register.vue';
import login from './components/Login.vue';
import home from './components/Home.vue';
import detail from './components/Detail.vue';

export default new Router({
    mode: 'history',
    routes: [
        { path: '*', component: notFound, name: '404' },
        { path: '/register', component: register, name: 'register'},
        { path: '/login', component: login, name: 'login'},
        { path: '/', component: home, name: 'home' },
        { path: '/detail/:key', component: detail, name: 'detail' },
    ]
});
