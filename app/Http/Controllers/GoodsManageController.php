<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

/**
 * 商品管理
 * Class GoodsManageController
 * @package App\Http\Controllers
 */
class GoodsManageController extends Controller
{
    /**
     * 商品列表
     */
    function index()
    {

    }

    /**
     * 增加商品
     */
    function create()
    {
       return view('goods_manage.create');

    }

    function store(Request $request){
        dd($request->all());

    }


}
