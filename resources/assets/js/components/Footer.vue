<template>
    <div>
        <label>Footer</label>
        <div v-if="notification" class="notification">有新的訊息</div>
    </div>
</template>
<script>
    export default {
            data(){
                return{
                    notification: false,
                    form:{},
                    dataList:[]
                }
            },
            created(){
                var self = this;
                window.Echo.private('user.' + self.$store.getters.userId)
                .listen('PraviteUserNotification', (e) => {
                    self.notification = true;
                });
            },
            methods:{

            }
    }
</script>
