<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    /**
     * 展示登录页
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    function showLogin()
    {

        return view('login.login');

    }

    /**
     * 登录
     * @return \Illuminate\Http\RedirectResponse
     */
    function doLogin(Request $request)
    {
        $phone=$request->phone;
        $code=$request->code;

        $url = config('custom.api_url')."/user/loginv2";
        $data=[
            'param'=>['phone'=>$phone,'code'=>$code]
        ];
        $data=json_decode(curl_request($url,true,$data));
        if($data->code==0){
            //成功
            $info=$data->data[0];
            //存入session
            $request->session()->put('user',$info);
            //重定向主页
            return redirect()->route('Home.index');

        }else{
            return redirect()->back()->with('error',$data->msg);


        }

    }

    /**
     * 注销
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    function logout(Request $request)
    {
        //删除登录数据
        $request->session()->forget('user');
        return view('login.login');
    }

}
