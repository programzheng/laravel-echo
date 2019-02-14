import Vue from 'vue';
import Vuex from 'vuex'

//使用components模塊化方式需寫上
Vue.use(Vuex);

const store = new Vuex.Store({
    state: {
        auth: false,
        user: {}
    },
    mutations: {
        verify (state, user) {
            state.auth = true;
            state.user = user;
        },
    },
    getters: {
        userId: state => {
            return state.user.id;
        }
    }
})

export default store;