<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Base\BaseController;
use Illuminate\Http\Request;

class OnlineShopController extends BaseController
{
    // 网店设置编辑页
    public function index(Request $request)
    {
        return view('os.index');
    }
}
