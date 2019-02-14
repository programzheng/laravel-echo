<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Events\PushNotification;
use Illuminate\Http\Request;

class HomeController extends FrontController
{
    public function getlist (Request $request){
        $data = array_map(function($item){
            return json_decode($item,true);
        },$this->redis->hgetall('data'));
        return $data;
    }

    public function push (Request $request){
        $redisArray = [
            'id' => Auth::check() ? Auth::user()->id : null,
            'title' => $request->input('title'),
            'detail' => []
        ];
        $this->redis->hset('data', $this->redis->hlen('data'), json_encode($redisArray));
        
        //解析所有data
        $data = array_map(function($item){
            return json_decode($item,true);
        },$this->redis->hgetall('data'));
        broadcast(new PushNotification(['log'=>$data]));
        return $redisArray;
    }

    public function clear(){
        $this->redis->flushdb();
        broadcast(new PushNotification(['log'=>'[]']));
    }
}
