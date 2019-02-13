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
            <router-view></router-view>
        </div>
    </body>
    <script src="{{asset('js/app.js')}}"></script>
    <script>
        Echo.private('session.' + '{{session()->getId()}}')
        .listen('PraviteSessionNotification', (e) => {
            console.log(`私人頻道訂閱成功`);
            console.log(e);
        });
    </script>

</html>
