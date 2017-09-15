<?php

namespace App\Http\Controllers\Base;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


class BaseController extends Controller
{
    //
    function __construct()
    {
        $this->middleware('login');
    }


}
