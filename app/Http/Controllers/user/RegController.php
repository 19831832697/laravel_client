<?php

namespace App\Http\Controllers\user;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RegController extends Controller
{
    public function register(Request $request){
        $user_name=$request->input('user_name');
        $user_email=$request->input('user_email');
        $user_pwd=$request->input('user_pwd');
        var_dump($user_name);
        var_dump($user_email);
        var_dump($user_pwd);
    }
}
