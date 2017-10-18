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
        if (session('user')){
            return redirect()->route('Home.index');
        }
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

        $url = config('custom.api_url')."/seller/login";
        $data=[
            'param'=>['phone'=>$phone,'code'=>$code]
        ];
        $data=json_decode(curl_request($url,true,$data));


        if($data->code==0){
            if($data->data->flag==1){
                return redirect()->back()->with('error','未注册用户,请前往买家版注册');
            }else{
                //成功
                $info=$data->data->userInfo[0];
                //存入session
                $request->session()->put('user',$info);
                $request->session()->put('uid',$info->sr_id);
                //重定向主页
                return redirect()->route('Home.index');
            }
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
        $request->session()->forget('uid');
        return view('login.login');
    }

}
