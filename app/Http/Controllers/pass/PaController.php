<?php

namespace App\Http\Controllers\pass;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PaController extends Controller
{
    public function decrypt(){
        $method="AES-256-CBC";
        $key="124abc";
        $option=OPENSSL_RAW_DATA;
        $iv="12345tgvfred2346";

        $str=$_GET['str'];
        $arrInfo=base64_decode($str);
        $pass=openssl_decrypt($arrInfo,$method,$key,$option,$iv);
        echo $pass;
    }

}
