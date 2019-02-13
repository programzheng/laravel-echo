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
            'id' => session()->getId(),
            'title' => $request->input('title'),
            'detail' => []
        ]);
        broadcast(new PushNotification(['log'=>$redisArray]));
        $this->redis->set('data', json_encode($redisArray));
        return $redisArray;
    }

    public function clear(){
        $this->redis->flushdb();
        broadcast(new PushNotification(['log'=>'[]']));
    }
}
