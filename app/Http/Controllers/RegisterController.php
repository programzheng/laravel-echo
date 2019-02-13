<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Users;

class RegisterController extends FrontController
{
    public function register(Request $request) {
        $user = new Users;
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password = bcrypt($request->input('password'));
        if($user->save()){
            $this->data['status'] = true;
        }
        else{
            $this->data['status'] = false;
        }
        return response()->json($this->data);
    }
}
