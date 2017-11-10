<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Base\BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OnlineShopController extends BaseController
{
    // 网店设置编辑页
    public function index(Request $request)
    {
        $user = session('user');
        $merchant = DB::table('merchant')->where('sr_id', $user->sr_id)->first();
        $merchant_notice = DB::table('merchant_notice')->where('sr_id', $user->sr_id)->where('enabled', 1)->value('text');
        $merchant_type_name = DB::table('user_type_info')->where('id', $merchant->mtype)->value('type_name');

        // 客服电话
        $kefu_phone = DB::table('cfg_kefu')->select('id', 'tel')->where('sr_id', $user->sr_id)->where('enabled', 1)->get();

        // 背景图
        $background = DB::table('merchant_background')->select('id', 'bgurl')->where('type', 0)->where('enabled', 1)->get();

        // 促销商品
        $cx_goods = DB::table('goods')
                        ->select('goods_smallname', 'img')->where('sr_id', $user->sr_id)
                        ->where('is_cuxiao', 1)
                        ->where('enabled', 1)
                        ->limit(2)
                        ->get();
        // 新品推荐
        $new_goods = DB::table('goods')
                        ->select('goods_smallname', 'img')->where('sr_id', $user->sr_id)
                        ->where('is_new', 1)
                        ->where('enabled', 1)
                        ->limit(2)
                        ->get();

        // 热销推荐
        $hot_goods = DB::table('goods')
                        ->select('goods_smallname', 'img')->where('sr_id', $user->sr_id)
                        ->where('is_hot', 1)
                        ->where('enabled', 1)
                        ->limit(2)
                        ->get();

        return view('os.index', compact(
            'user',
            'merchant',
            'merchant_notice',
            'cx_goods',
            'new_goods',
            'hot_goods',
            'merchant_type_name',
            'kefu_phone',
            'background'
        ));
    }

    // 网店设置保存
    public function store(Request $request)
    {
        $user = session('user');
        $input = $request->all();

        $merchant = array();
        $merchant['background'] = $input['background'];
        $merchant['recoshowcase_type'] = $input['recoshowcase_type'];
        $merchant['recoshowcaseInfo'] = $input['recoshowcaseInfo'];
        $merchant['notice'] = $input['notice'];
        $merchant['recoshowcase'] = $input['recoshowcase'];
        $merchant['cxGood'] = $input['cxGood'];
        $merchant['newGood'] = $input['newGood'];
        $merchant['hotGood'] = $input['hotGood'];
        $merchant['disphone'] = $input['disphone'];
        DB::table("merchant")->where('sr_id', $user->sr_id)->update($merchant);

        DB::table('merchant_notice')->where('sr_id', $user->sr_id)->where('enabled', 1)->update(['text' => $input['merchant_notice']]);

        if ($input['kefu'] != 'none') {
            DB::table('cfg_kefu')->where('sr_id', $user->sr_id)->update(['enabled' => 0]);
            if (!empty($input['kefu'])) {
                foreach ($input['kefu'] as $value) {
                    $cfg_kefu = array();
                    $cfg_kefu['sr_id'] = $user->sr_id;
                    $cfg_kefu['tel'] = $value;
                    $cfg_kefu['enabled'] = 1;
                    DB::table('cfg_kefu')->insert($cfg_kefu);
                }
            }
        }

        return response()->json(['message' => '应用成功！'], 200);
    }
}
