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
    function doLogin()
    {
        return redirect()->route('Home.index');
    }

    /**
     * 注销
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    function logout()
    {
        return view('login.login');
    }

}
