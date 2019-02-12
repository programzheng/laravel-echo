<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Routing\Route;

class IndexController extends FrontController
{
    public function index (Request $request){
        return view('page');
    }
}
