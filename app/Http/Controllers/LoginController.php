<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Users;

class LoginController extends FrontController
{
    public function auth(Request $request) {
        if(Auth::check()){
            $this->data['status'] = true;
            $this->data['user'] = Auth::user();
        }
        else{
            $this->data['status'] = false;
        }
        return response()->json($this->data);
    }
    public function login(Request $request) {
        if (Auth::attempt(['email' => $request->input('email'), 'password' => $request->input('password')])) {
            $this->data['status'] = true;
        }
        else{
            $this->data['status'] = false;
        }
        return response()->json($this->data);
    }
}
