<?php

namespace App\Http\Controllers;

use App\Events\PushNotification;
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
        $data = json_encode($redisArray);
        $this->redis->set('data', $data);

        event(new PushNotification('message',$data));

    }

    public function clear($key){
        $redisArray = json_decode($this->redis->get('data'),true);
        $redisArray[$key]['detail'] = [];
        $data = json_encode($redisArray);
        $this->redis->set('data', $data);

        event(new PushNotification('log',$data));
    }
}
