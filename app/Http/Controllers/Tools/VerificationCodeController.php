<?php

namespace App\Http\Controllers\Tools;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

/**
 * 验证码
 * Class VerificationCodeController
 * @package App\Http\Controllers\Tools
 */
class VerificationCodeController extends Controller
{
    function sendCode(Request $request)
    {
        $response = [];
        $phone = $request->phone;
        $url = config('custom.api_url')."/user/SendCode";
        $data = [
            'param' => ['phone' => $phone]
        ];
        $data = curl_request($url, true, $data);
        $data=json_decode($data);
        if($data->identifier){
            $response['status']=0;
            $response['msg']=" 发生成功";
        }else{
            $response['status']=1;
            $response['msg']=" 发生失败";
        }

        return response()->json($response);
    }
}
