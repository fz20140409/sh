<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Base\BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/**
 * 个人信息详情
 * @package App\Http\Controllers\Admin
 */
class UserManageController extends BaseController
{

    public function index(Request $request)
    {
        $user = session('user');
        $info = DB::table('user as a')->select('a.*','b.type_name')->leftJoin('user_type_info as b','a.utype','=','b.id')->where('a.uid', $user->uid)->first();

        return view('um.create',compact('info'));
    }


    //个人信息
    function getPersonInfo($id){
        $info=DB::table('user as a')->select('a.*','b.type_name')->leftJoin('user_type_info as b','a.utype','=','b.id')->where('a.uid',$id)->first();
        $honesty = DB::table('merchant')->where('uid', $id)->value('honesty');

        return view('um.person_info',compact('info', 'honesty'));
    }

    //老板信息
    function getBossInfo($id){
        return view('um.boss_info',compact('info'));
    }

    //业务信息
    function getBusinessInfo($id){
        // 商户信息
        $merchant = DB::table('merchant')->where('uid', $id)->first();

        // 主营渠道
        $salechanel = DB::table('merchant_salechanel as ms')
                        ->select('cs.sid as id', 'cs.sale_name as name', 'cs.parent_id as pid')
                        ->leftJoin('cfg_salechanel as cs', 'ms.sid', '=', 'cs.sid')
                        ->where('ms.sr_id', $merchant->sr_id)
                        ->where('ms.enabled', 1)
                        ->where('cs.enabled', 1)
                        ->get()
                        ->toArray();
        $salechanel = array_map('get_object_vars', $salechanel);
        $salechanel = toLayer($salechanel);

        // 品类
        $category = DB::table('merchant_category as mc')
                        ->select('cc.cat_id as id', 'cc.cat_name as name', 'cc.parent_id as pid')
                        ->leftJoin('cfg_category as cc', 'mc.cat_id', '=', 'cc.cat_id')
                        ->where('mc.sr_id', $merchant->sr_id)
                        ->where('mc.enabled', 1)
                        ->where('cc.enabled', 1)
                        ->get()
                        ->toArray();
        $category = array_map('get_object_vars', $category);
        $category = toLayer($category);

        // 业务辐射区
        $merchant_dealers_ywfs = DB::table('merchant_dealers_ywfs as md')
                                    ->select('cl.*', 'cl.parent_id as pid')
                                    ->leftJoin('cfg_locations as cl', 'md.bizarea_id', '=', 'cl.id')
                                    ->where('md.sr_id', $merchant->sr_id)
                                    ->where('md.enabled', 1)
                                    ->orderBy('cl.parent_id', 'asc')
                                    ->get()
                                    ->toArray();
        $merchant_dealers_ywfs = array_map('get_object_vars', $merchant_dealers_ywfs);
        $merchant_dealers_ywfs = toLayer($merchant_dealers_ywfs);

        // 主要经销品牌
        $brand = DB::table('merchant_dealers_brand as m')
                    ->select('cb.zybrand', 'm.proportion')
                    ->leftJoin('cfg_brand as cb', 'm.bid', '=', 'cb.bid')
                    ->where('m.sr_id', $merchant->sr_id)
                    ->where('m.enabled', 1)
                    ->get();

        return view('um.business_info',compact('merchant', 'salechanel', 'category', 'merchant_dealers_ywfs', 'brand'));
    }

    //经营人
    function getTransactorInfo($id){
        return view('um.transactor_info',compact('info'));
    }

    //企业信息
    function getCompanyInfo($id){
        // 用户信息
        $user = DB::table('user')->where('uid', $id)->first();
        // 商户信息
        $merchant = DB::table('merchant')->where('uid', $id)->first();
        // 营业执照
        $merchant_file = DB::table('merchant_file')->where('sr_id', $merchant->sr_id)->where('filetype', 2)->where('enabled', 1)->get();

        $data = compact('user', 'merchant', 'merchant_file', 'merchant_dealers_ywfs');
        return view('um.company_info', $data);
    }
}
