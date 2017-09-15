<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Base\BaseController;
use Illuminate\Http\Request;

class HomeController extends BaseController
{
    function index()
    {
        return view('home.index');
    }
}
