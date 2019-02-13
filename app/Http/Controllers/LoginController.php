<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Users;

class LoginController extends FrontController
{
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