<template>
    <div>
        <label>姓名:</label>
        <input type="text" v-model="form.title">
        <label>內容:</label>
        <textarea v-model="form.detail"></textarea>
        <button type="button" @click="push()">送出</button>
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
                var io = require('socket.io-client');
                // 建立 socket.io 的連線
                var notification = io.connect(`http://${window.location.hostname}:3000`);
                notification.on('notification', function(resoponse) {
                    let dataList = JSON.parse(resoponse);
                    if(self.$route.params.key){
                        self.dataList = dataList[self.$route.params.key].detail;
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
                push(){
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
