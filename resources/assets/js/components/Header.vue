<template>
    <div>
        <template v-if="notificationCount > 0">
            新通知({{notificationCount}})
        </template>
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
                    notificationCount: 0
                }
            },
            created(){
                var self = this;
                if(self.$store.state.auth){
                    window.Echo.private('user.' + self.$store.getters.userId)
                    .listen('PraviteUserNotification', (e) => {
                        self.notification = true;
                    });
                }
            },
            methods:{
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
