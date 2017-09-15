<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Base\BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;


/**
 * 店铺分类
 * Class ShopCateController
 * @package App\Http\Controllers
 */
class ShopCateController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $info = DB::table('merchant_shopclassify')->select('cat_id as id', 'parent_id as pid', 'sc_name', 'createtime')->where(['sr_id' => session('user')->uid, 'enabled' => 1])->get()->toArray();
        //转换
        if (!empty($info)) {
            $info = objectToArray($info);
            $info = toLayer($info);
        }
        return view('shop_cate.index', compact('info'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $info = DB::table('merchant_shopclassify')->select('cat_id', 'sc_name')->where(['sr_id' => session('user')->uid, 'parent_id' => 0, 'enabled' => 1])->get();
        return response()->json(['data' => $info]);
    }

    //添加子分类
    public function createSub($id)
    {
        $info = DB::table('merchant_shopclassify')->select('cat_id', 'sc_name')->where(['sr_id' => session('user')->uid, 'parent_id' => 0, 'enabled' => 1])->get();
        $shopclassify = DB::table('merchant_shopclassify')->where('cat_id', $id)->select('sc_name', 'parent_id', 'cat_id')->first();
        return response()->json(['data' => $info, 'shopclassify' => $shopclassify]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $pid = $request->pid;
        $catename = $request->catename;
        //同名检测
        $count = DB::table('merchant_shopclassify')->where(['parent_id' => $pid, 'sc_name' => $catename, 'sr_id' => session('user')->uid, 'enabled' => 1])->count();
        if (!empty($count)) {
            return response()->json(['status' => 1, 'msg' => '不允许同名']);
        }
        $insert = [
            'sc_name' => $catename,
            'parent_id' => $pid,
            'createtime' => date('Y-m-d H:i:s'),
            'enabled' => 1,
            'sr_id' => session('user')->uid,
        ];

        if ($pid == 0) {
            $insert['level'] = 1;
        } else {
            $insert['level'] = 2;
        }
        DB::table('merchant_shopclassify')->insert($insert);

        return response()->json(['status' => 0, 'msg' => '添加成功']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $info = DB::table('merchant_shopclassify')->select('cat_id', 'sc_name')->where(['sr_id' => session('user')->uid, 'parent_id' => 0, 'enabled' => 1])->get();
        $shopclassify = DB::table('merchant_shopclassify')->where('cat_id', $id)->select('sc_name', 'parent_id', 'cat_id')->first();
        return response()->json(['data' => $info, 'shopclassify' => $shopclassify]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $pid = $request->pid;
        $catename = $request->catename;
        //同名检测
        $count = DB::table('merchant_shopclassify')->where(['parent_id' => $pid, 'sc_name' => $catename, 'sr_id' => session('user')->uid, 'enabled' => 1])->where('cat_id', '!=', $id)->count();
        if (!empty($count)) {
            return response()->json(['status' => 1, 'msg' => '不允许同名']);
        }

        $update = [
            'sc_name' => $catename,
            'parent_id' => $pid,
        ];
        if ($pid == 0) {
            $update['level'] = 1;
        } else {
            $update['level'] = 2;
        }
        DB::table('merchant_shopclassify')->where('cat_id', $id)->update($update);

        return response()->json(['status' => 0, 'msg' => '更新成功']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Request $request)
    {

        //有无子分类
        $info = DB::table('merchant_shopclassify')->where('parent_id', $id)->pluck('cat_id')->toArray();
        if (!isset($request->flag)) {
            if (!empty($info)) {
                return response()->json(['status' => 1, 'msg' => '其下子分类不会被删除，且会变成一级分类?', 'flag' => 1]);
            } else {
                DB::table('merchant_shopclassify')->where('cat_id', $id)->update(['enabled' => 0]);

                return response()->json(['status' => 0, 'msg' => '删除成功']);
            }
        } else {
            DB::beginTransaction();
            try {
                //删除当前分类
                DB::table('merchant_shopclassify')->where('cat_id', $id)->update(['enabled' => 0]);
                //当前分类下子分类变一级
                DB::table('merchant_shopclassify')->whereIn('cat_id', $info)->update(['parent_id' => 0]);
                DB::commit();
                return response()->json(['status' => 0, 'msg' => '删除成功']);
            } catch (\Exception $exception) {
                Log::error($exception->getMessage());
                DB::rollBack();
                return response()->json(['status' => 2, 'msg' => '删除失败']);
            }

        }
    }

    public function changeOne(Request $request)
    {
        $id=$request->id;
        DB::table('merchant_shopclassify')->where('cat_id',$id)->update(['parent_id'=>0]);
        return response()->json(['status' => 0, 'msg' => '操作成功']);

    }

    public function goodsManage($id,Request $request){


        $merchant_shopclassify=DB::table('merchant_shopclassify')->where('cat_id',$id)->first();
        $ids=DB::table('goods_shopclassify')->where('sc_id',$id)->pluck('good_id')->toArray();


        $goods=DB::table('goods as a');
        $where_link=[];
        $where=['a.enabled'=>1,'a.sr_id'=>session('user')->uid];
        //销量排序
        $sell_count=isset($request->sell_count)?$request->sell_count:-1;
        if($sell_count==1){
            $goods=$goods->orderBy('a.sell_count','desc');
            $where_link['sell_count']=$sell_count;
        }
        if($sell_count==2){
            $goods=$goods->orderBy('a.sell_count','asc');
            $where_link['sell_count']=$sell_count;
        }
        //库存排序
        $kc=isset($request->kc)?$request->kc:-1;
        if($kc==1){
            $goods=$goods->orderBy('a.kc','desc');
            $where_link['kc']=$kc;
        }
        if($kc==2){
            $goods=$goods->orderBy('a.kc','asc');
            $where_link['kc']=$kc;
        }


        $sql='a.*,(SELECT GROUP_CONCAT(f.sc_name) FROM goods_shopclassify as g LEFT JOIN merchant_shopclassify AS f ON g.sc_id=f.cat_id WHERE g.good_id=a.goods_id ) as cate';
        $info=$goods->select(DB::raw($sql))->where($where)->whereIn('a.goods_id',$ids)->orderBy('a.createtime','desc')->paginate(10);



        return view('shop_cate.goods',compact('info','sell_count','kc','where_link','id','merchant_shopclassify'));


    }
    public function cancelCate(Request $request){
        $goods_id=$request->goods_id;
        $cate_id=$request->cate_id;

        if(!isset($goods_id)||empty($goods_id)||!isset($cate_id)||empty($cate_id)){
            return response()->json(['status'=>1,'msg'=>'缺少参数']);
        }

        DB::table('goods_shopclassify')->where(['good_id'=>$goods_id,'sc_id'=>$cate_id])->delete();
        return response()->json(['status'=>200,'msg'=>'操作成功']);

    }


}
