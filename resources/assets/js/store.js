import Vue from 'vue';
import Vuex from 'vuex'

//使用components模塊化方式需寫上
Vue.use(Vuex);

const store = new Vuex.Store({
    state: {
        auth: false
    },
    mutations: {
        verify (state) {
            state.auth = true;
        }
    }
})

export default store;