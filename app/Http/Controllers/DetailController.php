<?php

namespace App\Http\Controllers;

use App\Events\PushNotification;
use App\Events\PraviteUserNotification;
use Illuminate\Http\Request;

class DetailController extends FrontController
{
    public function getlist ($key){
        $data = json_decode($this->redis->hget('data', $key),true);
        return $data;
    }

    public function push (Request $request, $key){
        $parentArray = json_decode($this->redis->hget('data', $key),true);
        $parentArray['detail'][] = [
            'name' => $request->input('title'),
            'detail' => $request->input('detail')
        ];
        $this->redis->hdel('data', $key);
        $this->redis->hset('data', $key, json_encode($parentArray));

        broadcast(new PushNotification(['log'=>$parentArray]));
        broadcast(new PraviteUserNotification($parentArray['id'], ['log'=>$parentArray]))->toOthers();
        return $parentArray;
    }

    public function clear($key){
        $parentArray = json_decode($this->redis->hget('data', $key),true);
        $parentArray['detail'] = [];
        $this->redis->hset('data', $key, json_encode($parentArray));
        broadcast(new PushNotification(['log'=>$parentArray]));
    }
}
