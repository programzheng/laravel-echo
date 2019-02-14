export default function auth({ next, router }) {
    axios({
        method: 'post',
        url: `/auth`,
    })
        .then(function(response){
            if(response.data.status){
                return next();
            }
            else{
                return router.push({ name: 'login' });
            }
        })
}