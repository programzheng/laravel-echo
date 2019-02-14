import Vue from 'vue';
import Router from 'vue-router';

//使用components模塊化方式需寫上
Vue.use(Router);

//vuex
import store from './store.js';

//middleware
import auth from './middleware/auth';
import log from './middleware/log';

//components
import notFound from './components/404.vue';
import header from './components/Header.vue';
import footer from './components/Footer.vue';
import register from './components/Register.vue';
import login from './components/Login.vue';
import home from './components/Home.vue';
import detail from './components/Detail.vue';

const router = new Router({
    mode: 'history',
    routes: [
        { path: '*', component: notFound, name: '404' },
        { path: '/register', component: register, name: 'register'},
        { path: '/login', component: login, name: 'login'},
        { path: '/', components: {
            default: home,
            header: header,
            footer: footer
        }, meta:{
            middleware: [auth, log]
        }, name: 'home' },
        { path: '/detail/:key', component: detail, name: 'detail' },
    ],
    value: {
        auth: false
    }
});

function nextFactory(context, middleware, index) {
    const subsequentMiddleware = middleware[index];
    // If no subsequent Middleware exists,
    // the default `next()` callback is returned.
    if (!subsequentMiddleware) return context.next;

    return (...parameters) => {
        // Run the default Vue Router `next()` callback first.
        context.next(...parameters);
        // Than run the subsequent Middleware with a new
        // `nextMiddleware()` callback.
        const nextMiddleware = nextFactory(context, middleware, index + 1);
        subsequentMiddleware({ ...context, next: nextMiddleware, store });
    };
}

router.beforeEach((to, from, next) => {
    if (to.meta.middleware) {
    const middleware = Array.isArray(to.meta.middleware)
        ? to.meta.middleware
        : [to.meta.middleware];

    const context = {
        from,
        next,
        router,
        to,

    };
    const nextMiddleware = nextFactory(context, middleware, 1);

    return middleware[0]({ ...context, next: nextMiddleware, store });
    }

    return next();
});

export default router;