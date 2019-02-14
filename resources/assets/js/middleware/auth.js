export default function auth({ next, router, store }) {
    axios({
        method: 'post',
        url: `/auth`,
    })
        .then(function(response){
            if(response.data.status){
                store.commit('verify')
                return next();
            }
            else{
                return router.push({ name: 'login' });
            }
        })
}

// export default {
//     data(){
//         return{
//             form:{},
//             dataList:[]
//         }
//     },
//     created(){

//     },
//     methods:{
//     }
// }