<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Routing\Route;

class IndexController extends FrontController
{
    public function index (Request $request){
        $user = Auth::user();
        return view('page')->with('user', $user);
    }
}
