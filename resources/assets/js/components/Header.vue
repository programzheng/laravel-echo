<template>
    <div>
        <label>Header</label>
        <!-- vuex內的auth判斷 -->
        <div v-if="$store.state.auth">
            <a @click="logout()">登出</a>
        </div>
        <div v-else>
            <router-link to="/register">註冊</router-link>
            <router-link to="/login">登入</router-link>
        </div>
    </div>
</template>
<script>
    export default {
            data(){
                return{
                }
            },
            created(){
                
            },
            methods:{
                init(){
                    var self = this;
                    axios({
                        method: 'post',
                        url: '/auth',
                    })
                        .then(function(response){
                            if(response.data.status){
                                self.login = true;
                            }
                            else{
                                self.login = false;
                            }
                        });
                },
                logout(){
                    var self = this;
                    axios({
                        method: 'post',
                        url: '/logout',
                    })
                        .then(function(response){
                            if(response.data.status){
                                self.$router.push({ name: 'login' });
                            }
                        });
                }
            }
    }
</script>
