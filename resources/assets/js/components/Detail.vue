<template>
    <div>
        <label>姓名:</label>
        <input type="text" v-model="form.title" @keyup.enter="send()">
        <label>內容:</label>
        <textarea v-model="form.detail" @keyup.enter="send()"></textarea>
        <button type="button" @click="send()">送出</button>
        <button type="button" @click="clear()">清空所有資料</button>
        <div>
            <div v-for="(data, dataKey) in dataList" :key="dataKey">
                <div>姓名:{{data.name}}</div>
                <div>內容:{{data.detail}}</div>
            </div>
        </div>
    </div>
</template>
<script>
    export default {
            data(){
                return{
                    form:{},
                    dataList:[]
                }
            },
            created(){
                var self = this;
                window.Echo.channel('notification').listen('PushNotification', (e) => {
                    if(e.data.log.detail){
                        self.dataList = e.data.log.detail;
                    }
                });
                self.init();
            },
            methods:{
                init(){
                    var self = this;
                    axios({
                        method: 'post',
                        url: `${self.$route.path}/getlist`,
                    })
                        .then(function(response){
                            self.title = response.data.title;
                            self.dataList = response.data.detail;
                        })
                },
                send(){
                    var self = this;
                    axios({
                        method: 'post',
                        url: `${self.$route.path}/push`,
                        data: self.form
                    })
                        .then(function(response){
                            console.log(response);
                        })
                },
                clear(){
                    var self = this;
                    axios({
                        method: 'post',
                        url: `${self.$route.path}/clear`,
                        data: self.form
                    })
                        .then(function(response){
                            console.log(response);
                        })
                }
            }
    }
</script>
