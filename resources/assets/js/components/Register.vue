<template>
    <div>
        註冊
        <div class="input">
            <label>姓名:</label>
            <input type="text" v-model="form.name">
        </div>
        <div class="input">
            <label>電子信箱:</label>
            <input type="text" v-model="form.email">
        </div>
        <div class="input">
            <label>密碼:</label>
            <input type="password" v-model="form.password">
        </div>
        <button type="button" @click="send()">送出</button>
    </div>
</template>

<script>
export default {
    data(){
        return{
            form:{},
        }
    },
    created(){

    },
    methods:{
        send(){
            var self = this;
            axios({
                method: 'post',
                url: `/register`,
                data: self.form
            })
                .then(function(response){
                    console.log(response);
                })
        }
    }
}
</script>
