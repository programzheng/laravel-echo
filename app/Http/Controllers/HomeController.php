<?php

namespace App\Http\Controllers;

use App\Events\PushNotification;
use Illuminate\Http\Request;

class HomeController extends FrontController
{
    public function getlist (Request $request){
        $data = $this->redis->get('data');
        return $data;
    }

    public function push (Request $request){
        if(!$this->redis->get('data')){
            $this->redis->set('data', "[]");
        }
        $redisArray = json_decode($this->redis->get('data'),true);
        array_push($redisArray, [
            'title' => $request->input('title'),
            'detail' => []
        ]);
        $data = json_encode($redisArray);
        $this->redis->set('data', $data);

        event(new PushNotification('log',$data));

    }

    public function clear(){
        $this->redis->flushdb();
        event(new PushNotification('message','[]'));
    }
}
