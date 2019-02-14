<template>
    <div>
        登入
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
                method: `post`,
                url: `/login`,
                data: self.form
            })
                .then(function(response){
                    if(response.status){
                        location.href = `/`;
                    }
                })
        }
    }
}
</script>
