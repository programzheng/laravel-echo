<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link href="{{asset('css/app.css')}}" rel="stylesheet">
        <title>PushNotification</title>
    </head>
    <body>
        <label>session:{{session()->getId()}}</label>
        <div id="page">
            <div class="layout">
                <router-view name="header"></router-view>
                <router-view></router-view>
                <router-view name="footer"></router-view>
            </div>
        </div>
    </body>
    <script src="{{asset('js/app.js')}}"></script>
    <script>
        @if($user)
            window.Echo.private('user.' + '{{$user->id}}')
            .listen('PraviteUserNotification', (e) => {
                console.log(`會員私人頻道訂閱成功`);
                alert("success");
            });
        @endif
        // Echo.private('session.' + '{{session()->getId()}}')
        // .listen('PraviteSessionNotification', (e) => {
        //     console.log(`暫時私人頻道訂閱成功`);
        //     console.log(e);
        // });
    </script>

</html>
