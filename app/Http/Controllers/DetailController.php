<?php

namespace App\Http\Controllers;

use App\Events\PushNotification;
use App\Events\PraviteUserNotification;
use Illuminate\Http\Request;

class DetailController extends FrontController
{
    public function getlist ($key){
        $redisArray = json_decode($this->redis->get('data'),true);
        $data = $redisArray[$key];
        return $data;
    }

    public function push (Request $request, $key){
        $redisArray = json_decode($this->redis->get('data'),true);
        $detailArray = $redisArray[$key]['detail'];
        array_push($detailArray, [
            'name' => $request->input('title'),
            'detail' => $request->input('detail')
        ]);
        $redisArray[$key]['detail'] = $detailArray;

        broadcast(new PushNotification(['log'=>$redisArray]));
        broadcast(new PraviteUserNotification($redisArray[$key]['id'], ['log'=>$redisArray]))->toOthers();
        $this->redis->set('data', json_encode($redisArray));
        return $redisArray;
    }

    public function clear($key){
        $redisArray = json_decode($this->redis->get('data'),true);
        $redisArray[$key]['detail'] = [];
        
        broadcast(new PushNotification(['log'=>$redisArray]));
        $this->redis->set('data', json_encode($redisArray));
    }
}
