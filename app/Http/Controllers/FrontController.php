<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Redis;

class FrontController extends Controller
{
    protected $data,$redis;
    public function __construct(){
        $this->redis = Redis::connection();
        $this->data = [];
    }
}
