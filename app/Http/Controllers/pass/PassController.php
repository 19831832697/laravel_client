<?php

namespace App\Http\Controllers\pass;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Psy\Util\Str;

class PassController extends Controller
{
    /**
     * 凯撒加密
     * @param $str
     * @param int $n
     * @return string
     */
    public function mi($n=3){
        $str="abc";
        $pass="";
        $length=strlen($str);
        for($i=0;$i<$length;$i++){
            $ascii=$str[$i];
            $p0=ord($ascii) + $n;
            $pass .= chr($p0);
        }
        return $pass;
    }

    /**
     * 凯撒解密
     * @param $pass
     * @param $n
     * @return string
     */
    public function jie($n=3){
        $pass=$this->mi();
        $length=strlen($pass);
        $str="";
        for($i=0;$i<$length;$i++){
            $ascii=$pass[$i];
            $pas = ord($ascii);
            $str .= chr($pas - $n);
        }
        return $str;
    }

    /**
     * 对称加密
     * openssl_encrypt
     * @param Request $request
     */
    public function encrypt(Request $request){
        $dataInfo=[
            'name'=>'zhangsan',
            'age'=>19,
            'email'=>'zhangsan@qq.com'
        ];
        $data=json_encode($dataInfo);
        $method="AES-256-CBC";
        $key="124abc";
        $option=OPENSSL_RAW_DATA;
        $iv="12345tgvfred2346";
        $pass=openssl_encrypt($data,$method,$key,$option,$iv);
        $enc_str=base64_encode($pass);
//        $str=urlencode($enc_str);

        $url="http://lumen.1809a.com/decrypt";
        $ch=curl_init($url);
        curl_setopt($ch,CURLOPT_URL,$url);
        curl_setopt($ch,CURLOPT_POST,1);
        curl_setopt($ch,CURLOPT_POSTFIELDS,$enc_str);
        curl_setopt($ch,CURLOPT_HTTPHEADER,['content-Type:text/plain']);
        $response=curl_exec($ch);
        //监控错误码
        $err_code=curl_errno($ch);
        if($err_code>0){
            echo "err_code:".$err_code;
        }
    }

    /**
     * 公钥秘钥加密解密
     */
    public function rec(){
        $dataInfo=[
            'name'=>'zhangsan',
            'age'=>19,
            'email'=>'zhangsan@qq.com'
        ];
        $json_str=json_encode($dataInfo);
        $k=openssl_pkey_get_private('file://'.storage_path('app/key/private.pem'));
        openssl_private_encrypt($json_str,$enc_data,$k);
        var_dump($enc_data);

        $url="http://lumen.1809a.com/rsa";
        $ch=curl_init($url);
        curl_setopt($ch,CURLOPT_URL,$url);
        curl_setopt($ch,CURLOPT_POST,1);
        curl_setopt($ch,CURLOPT_POSTFIELDS,$enc_data);
        curl_setopt($ch,CURLOPT_HTTPHEADER,['content-Type:text/plain']);
        $response=curl_exec($ch);
        //监控错误码
        $err_code=curl_errno($ch);
        if($err_code>0){
            echo "err_code:".$err_code;
        }
    }

    /**
     * 验签
     */
    public function sign(){
        $data=[
            'oid'=>123123,
            'amount'=>2000,
            'title'=>'订单',
        ];
        $json_str=json_encode($data);
        $k=openssl_pkey_get_private('file://'.storage_path('app/key/private.pem'));

        openssl_sign($json_str,$signature,$k);

        echo 'signature:'.$signature;echo "<br/>";
        $b64=base64_encode($signature);
        echo 'b64:'.$b64;echo "<br/>";

        $url="http://lumen.1809a.com/verify?sign=".urlencode($b64);

        $ch=curl_init($url);
        curl_setopt($ch,CURLOPT_URL,$url);
        curl_setopt($ch,CURLOPT_POST,1);
        curl_setopt($ch,CURLOPT_POSTFIELDS,$json_str);
        curl_setopt($ch,CURLOPT_HTTPHEADER,['content-Type:text/plain']);
        $response=curl_exec($ch);
        //监控错误码
        $err_code=curl_errno($ch);
        if($err_code>0){
            echo "err_code:".$err_code;
        }

    }
}