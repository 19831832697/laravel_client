<?php

namespace App\Http\Controllers\user;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    /**
     * 注册视图
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function reg(){
        return view('user/reg');
    }

    /**
     * 注册执行
     */
    public function regDo(Request $request){
        $data=$request->input();
        $dataInfo=json_encode($data);
        $k=openssl_pkey_get_private('file://'.storage_path('app/key/private.pem'));
        openssl_private_encrypt($dataInfo,$enc_data,$k);

        $url="http://lumen.1809a.com/regDo";
        $ch=curl_init($url);
        curl_setopt($ch,CURLOPT_URL,$url);
        curl_setopt($ch,CURLOPT_POST,1);
        curl_setopt($ch,CURLOPT_POSTFIELDS,$enc_data);
        curl_setopt($ch,CURLOPT_HTTPHEADER,['content-Type:text/plain']);
        $response=curl_exec($ch);
        $err_code=curl_errno($ch);
        if($err_code>0){
            echo "err_code:".$err_code;
        }
    }

    /**
     * 登录视图
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function login(){
        return view('user/login');
    }

    /**
     * 登录执行
     * @param Request $request
     */
    public function loginDo(Request $request){
        $data=$request->input();
//        var_dump($data);die;
        $dataInfo=json_encode($data);
        $k=openssl_pkey_get_private('file://'.storage_path('app/key/private.pem'));
        openssl_private_encrypt($dataInfo,$enc_data,$k);

        $url="http://lumen.1809a.com/loginDo";
        $ch=curl_init($url);
        curl_setopt($ch,CURLOPT_URL,$url);
        curl_setopt($ch,CURLOPT_POST,1);
        curl_setopt($ch,CURLOPT_POSTFIELDS,$enc_data);
        curl_setopt($ch,CURLOPT_HTTPHEADER,['content-Type:text/plain']);
        $response=curl_exec($ch);
        $err_code=curl_errno($ch);
        if($err_code>0){
            echo "err_code:".$err_code;
        }
    }
}
