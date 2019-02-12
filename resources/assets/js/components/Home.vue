<template>
    <div>
        <label>標題:</label>
        <input type="text" v-model="form.title">
        <button type="button" @click="push()">送出</button>
        <button type="button" @click="clear()">清空所有資料</button>
        <div>
            <div v-for="(data, dataKey) in dataList" :key="dataKey">
                <router-link :to="`/detail/${dataKey}`">{{data.title}}</router-link>
                <!-- <label>{{data.message}}</label> -->
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data(){
            return{
                form:{},
                title:``,
                dataList:[]
            }
        },
        created(){
            var self = this;
            var io = require('socket.io-client');
            // 建立 socket.io 的連線
            var notification = io.connect(`http://${window.location.hostname}:3000`);
            // 當從 socket.io server 收到 notification 時將訊息印在 console 上
            notification.on('notification', function(dataList) {
                if(dataList){
                    self.dataList = JSON.parse(dataList);
                }
            });
            self.init();

        },
        methods:{
            init(){
                var self = this;
                axios({
                    method: 'post',
                    url: '/getlist',
                })
                    .then(function(response){
                        self.dataList = response.data;
                    })
            },
            push(){
                var self = this;
                axios({
                    method: 'post',
                    url: '/push',
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
                    url: '/clear',
                    data: self.form
                })
                    .then(function(response){
                        console.log(response);
                    })
            }
        }
    }
</script>