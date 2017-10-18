<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Base\BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Tools\ExcelController;
/**
 * 商品管理
 * Class GoodsManageController
 * @package App\Http\Controllers
 */
class GoodsManageController extends BaseController
{
    /**
     * 商品列表
     */
    function index(Request $request)
    {
        $goods=DB::table('goods as a');
        $where_link=[];
        $where=['a.enabled'=>1,'a.sr_id'=>session('uid')];
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
        //商品状态
        $state=isset($request->state)?$request->state:-1;
        if($state==1){
            //在售
            $where['a.state']=1;
            $where_link['state']=$state;
        }
        if($state==3){
            //下架
            $where['a.state']=3;
            $where_link['state']=$state;
        }
        //商品名称
        $goods_name=$request->goods_name;
        if(isset($goods_name)){
            $goods=$goods->where('a.goods_name', 'like', "%$goods_name%")->orWhere('a.goods_smallname', 'like', "%$goods_name%");
            $where_link['goods_name']=$goods_name;
        }
        $sql=<<<SQL
a.*,
(SELECT GROUP_CONCAT(g.sc_id) FROM goods_shopclassify as g LEFT JOIN merchant_shopclassify AS f ON g.sc_id=f.cat_id WHERE g.good_id=a.goods_id and f.enabled=1 and g.enabled=1) as sc_id, 
(SELECT GROUP_CONCAT(f.parent_id) FROM goods_shopclassify as g LEFT JOIN merchant_shopclassify AS f ON g.sc_id=f.cat_id WHERE g.good_id=a.goods_id and f.enabled=1 and g.enabled=1) as parent_id, 
(SELECT GROUP_CONCAT(f.sc_name) FROM goods_shopclassify as g LEFT JOIN merchant_shopclassify AS f ON g.sc_id=f.cat_id WHERE g.good_id=a.goods_id and f.enabled=1 and g.enabled=1) as cate,
(select concat(price,'/',spec_name) from goods_spec where good_id=a.goods_id limit 1) as a_price, 
(select concat(changespec_price,'/',changespec_name) from goods_spec where good_id=a.goods_id limit 1) as a_changeprice ,
(select concat(kc,spec_name) from goods_spec where good_id=a.goods_id limit 1) as a_kc ,
(select concat(changespec_kc,changespec_name) from goods_spec where good_id=a.goods_id limit 1) as a_changekc 
SQL;


        $info=$goods->select(DB::raw($sql))->where($where)->orderBy('a.createtime','desc')->paginate(10);

        foreach ($info as $value) {
            if (strpos($value->sc_id, ',') === false) {
                continue;
            }
            $sc_id = explode(',', $value->sc_id);
            $parent_id = explode(',', $value->parent_id);
            $sc_ids = array_diff($sc_id, $parent_id);
            $value->cate = DB::table('merchant_shopclassify')->whereIn('cat_id', $sc_ids)->value(DB::raw('group_concat(sc_name) as sc_name'));
        }

        $shopclassify = DB::table('merchant_shopclassify')->select('cat_id as id', 'parent_id as pid', 'sc_name', 'createtime')->where(['sr_id' => session('uid'), 'enabled' => 1])->get()->toArray();
        if (!empty($shopclassify)) {
            //转换
            $shopclassify = objectToArray($shopclassify);
            $shopclassify = toLayer($shopclassify);
        }

        return view('goods_manage.index',compact('info','sell_count','kc','where_link','state','goods_name','shopclassify'));

    }

    /**
     * 增加商品
     */
    function create()
    {
        //品牌
        $brands = DB::table('cfg_brand')->get();
        //店铺分类

        $shopclassify = DB::table('merchant_shopclassify')->select('cat_id as id', 'parent_id as pid', 'sc_name', 'createtime')->where(['sr_id' => session('uid'), 'enabled' => 1])->orderBy('orderby','asc')->get()->toArray();
        if (!empty($shopclassify)) {
            //转换
            $shopclassify = objectToArray($shopclassify);
            $shopclassify = toLayer($shopclassify);
        }
        //规格
        $unitspec = DB::table('cfg_unitspec')->where(['enabled' => 1])->get();
        return view('goods_manage.create', compact('brands', 'shopclassify', 'unitspec'));

    }

    function store(Request $request)
    {

        //商品id
        $g_id= $request->goods_id;
        //商品详情

        $key= $request->key;
        //商品图片
        $file = $request->file;
        //商品标题
        $goods_name = $request->goods_name;
        //商品简称
        $goods_smallname = $request->goods_smallname;
        //商品品牌
        $bid = $request->bid;
        //是否上架
        $state = $request->state;

        //规格
        $spec=$request->spec;
        //one
        $spec_id=$spec[0];
        $price=$spec[3];
        $kc=$spec[5];
        //two
        $changespec_price=$spec[4];
        $changespec_value=$spec[1];
        $changespec_id=$spec[2];
        $changespec_kc=$spec[6];
        //three

        //商品标签
        $cu_xiao = $request->cu_xiao;
        $new = $request->new;
        $hot = $request->hot;
        //店铺分类
        $cat_ids = $request->cat_ids;
        //所属品类
        $cate1 = $request->cate1;//一级
        $cate2 = $request->cate2;//二级
        $cate3 = $request->cate3;//三级

        //应用标题
        $yy_title = isset($request->yy_title)?$request->yy_title:"";
        //应用视频
        $vd_url = $request->vd_url;

        $goods = [
            'sr_id' => session('uid'),
            'bid' => $bid,
            'goods_smallname' => $goods_smallname,
            'goods_name' => $goods_name,
            'createtime' => date('Y-m-d H:i:s'),
            'price' => $price,
            'original_price' => $price,
            'kc' => $kc,
            'enabled' => 1,
            'product_area'=>"",
            'sell_info'=>'',
            'state'=>1,
            'sell_count'=>0

        ];
        //上架
            if($state==1){
                $goods['state']=1;
            }
            if($state==3){
                $goods['state']=3;
            }

            //促销商品
            if (isset($cu_xiao)) {
                $goods['is_cuxiao'] = 1;
            }else{
                $goods['is_cuxiao'] = 0;
            }
            //新品推荐
            if (isset($new)) {
                $goods['is_new'] = 1;
            }else{
                $goods['is_new'] = 0;
            }
            //热销推荐
            if (isset($hot)) {
                $goods['is_hot'] = 1;
            }else{
                $goods['is_hot'] = 0;
            }



        if (isset($file) && count($file) > 0) {
            //商品主图，默认第一张
            //$goods['img'] = explode(';',$file[0])[1];
            $goods['img'] = $file[0];
        }

        DB::beginTransaction();
        try {
            //商品主表
            if(isset($g_id)){
                //编辑
                DB::table('goods')->where('goods_id',$g_id)->update($goods);
                // 更改商品品牌关联
                DB::table('goods_brand_rela')->where('good_id', $g_id)->update(['bid' => $bid, 'enabled' => 1]);
            }else{
                //新增
                $goods_id = DB::table('goods')->insertGetId($goods);
                // 新增商品品牌关联
                DB::table('goods_brand_rela')->insert(['good_id' => $goods_id, 'bid' => $bid, 'enabled' => 1]);
            }

            //---------------------------------------------商品应用(一条)
            //商品应用
            if(isset($vd_url)){
                $goods_apply=[
                    'title'=>$yy_title,
                    'videourl'=>$vd_url,
                    'videoimg'=>$vd_url,//todo
                    'createtime'=>date('Y-m-d H:i:s'),
                    'enabled'=>1,


                ];
                //有上传应用
                if(isset($g_id)){
                    $goods_apply['good_id']=$g_id;
                    //编辑操作
                    DB::table('goods_apply')->where('good_id',$g_id)->delete();
                }else{
                    $goods_apply['good_id']=$goods_id;

                }
                DB::table('goods_apply')->insert($goods_apply);

            }else{
                //不上传应用,如果是更新操作
                if(isset($g_id)){
                    DB::table('goods_apply')->where('good_id',$g_id)->delete();
                }

            }
            //-------------------------------------------------商品详情(多条)

            if(isset($key)){
                $key=json_decode($key,true);
                $goods_attr=[
                    'createtime'=>date('Y-m-d H:i:s'),
                    'updatetime'=>date('Y-m-d H:i:s'),
                    'enabled'=>1,
                    'remark'=>'',
                    'attr_name'=>'descrip',
                    ];
                    if(isset($g_id)){
                        $goods_attr['good_id']=$g_id;
                        //删掉原先，重新插入
                        DB::table('goods_attr')->where(['good_id'=>$g_id,'attr_name'=>'descrip'])->delete();

                    }else{
                        $goods_attr['good_id']=$goods_id;

                    }
                    foreach ($key as $v){
                        $goods_attr['attr_type']=$v['type'];
                        $goods_attr['attr_value']=$v['value'];
                        DB::table('goods_attr')->insert($goods_attr);
                    }



            }else{
                //不上传详情,如果是更新操作
                if(isset($g_id)){
                    DB::table('goods_attr')->where(['good_id'=>$g_id,'attr_name'=>'descrip'])->delete();
                }
            }

            //------------------------------------------------商品规格(多条)
            $ids=[$spec_id,$changespec_id];
            if(count($spec)>7){
                $ids[]=$spec[8];
            }
            $arrs=DB::table('cfg_unitspec')->whereIn('spec_id',$ids)->select('spec_id','spec_name')->get();
            $temp=[];
            foreach ($arrs as $arr){
                $temp[$arr->spec_id]=$arr->spec_name;
            }
            //规格一
            $goods_spec=[
                'price'=>$price,
                'kc'=>$kc,
                'enabled'=>1,
                'create_time'=>date('Y-m-d H:i:s'),
                'spec_name'=>$temp[$spec_id],
                'spec_unic'=>$temp[$spec_id],
                'spec_id'=>$spec_id,
                'changespec_name'=>$temp[$changespec_id],
                'changespec_id'=>$changespec_id,
                'changespec_price'=>$changespec_price,
                'changespec_kc'=>$changespec_kc,
                'changespec_value'=>$changespec_value,


            ];
            if(isset($g_id)){
                $goods_spec['good_id']=$g_id;
                //删掉原先，重新插入
                DB::table('goods_spec')->where('good_id',$g_id)->delete();
            }else{
                $goods_spec['good_id']=$goods_id;

            }

            DB::table('goods_spec')->insert($goods_spec);


            //规格二
            if(count($spec)>7){
                $goods_spec2=[
                    'price'=>$changespec_price,
                    'kc'=>$changespec_kc,
                    'enabled'=>1,
                    'create_time'=>date('Y-m-d H:i:s'),
                    'spec_name'=>$temp[$changespec_id],
                    'spec_unic'=>$temp[$changespec_id],
                    'spec_id'=>$changespec_id,
                    'changespec_name'=>$temp[$spec[8]],
                    'changespec_id'=>$spec[8],
                    'changespec_price'=>$spec[9],
                    'changespec_kc'=>$spec[10],
                    'changespec_value'=>$spec[7],


                ];
                if(isset($g_id)){
                    $goods_spec2['good_id']=$g_id;
                }else{
                    $goods_spec2['good_id']=$goods_id;

                }

                DB::table('goods_spec')->insert($goods_spec2);



            }

            //---------------------------------------------商品图片(多)
            $goods_img=[
                'attr_name'=>'banner',
                'createtime'=>date('Y-m-d H:i:s'),
                'enabled'=>1,
            ];


            if(isset($g_id)){
                //编辑
                $goods_img['good_id']=$g_id;
                DB::table('goods_attr')->where(['good_id'=>$g_id,'attr_name'=>'banner'])->delete();

            }else{
                //新增
                $goods_img['good_id']=$goods_id;

            }
            foreach ($file as $img){
                //list($uf_id,$url)=explode(';',$img);
                $goods_img['attr_value']=$img;
                DB::table('goods_attr')->insert($goods_img);
            }


            //---------------------------------------------店铺分类(多)
            if(isset($cat_ids)){
                $goods_shopclassify=[
                    'createtime'=>date('Y-m-d H:i:s'),
                    'enabled'=>1,
                    'level'=>0
                ];
                if (isset($g_id)){
                    //编辑
                    $goods_shopclassify['good_id']=$g_id;
                    DB::table('goods_shopclassify')->where('good_id',$g_id)->delete();
                }else{
                    //新增
                    $goods_shopclassify['good_id']=$goods_id;
                }

                foreach ($cat_ids as $cat_id){
                    $goods_shopclassify['sc_id']=$cat_id;
                    DB::table('goods_shopclassify')->insert($goods_shopclassify);
                }
            }else{
                if (isset($g_id)){
                    // ‘未分类’的店铺分类 ID 为12 改记录不可删除、缺少、更改
                    DB::table('goods_shopclassify')->where('good_id', $g_id)->update(['enabled' => 0]);
                    DB::table('goods_shopclassify')->where('good_id', $g_id)->limit(1)->update(['sc_id' => 12, 'enabled' => 1]);
                } else {
                    DB::table('goods_shopclassify')->insert([
                        'sc_id' => 12,
                        'good_id' => $goods_id,
                        'createtime' => date('Y-m-d H:i:s'),
                        'enabled' => 1,
                        'level' => 0
                    ]);
                }
            }
            //---------------------------------------------品类
            $goods_category_rela=[
                'enabled'=>1,
            ];
            if(isset($g_id)){
                $goods_category_rela['good_id']=$g_id;
                DB::table('goods_category_rela')->where('good_id',$g_id)->delete();
            }else{
                $goods_category_rela['good_id']=$goods_id;
            }

            if(isset($cate1)){
                $goods_category_rela['cat_id']=$cate1;
                DB::table('goods_category_rela')->insert($goods_category_rela);
            }
            if(isset($cate2)){
                $goods_category_rela['cat_id']=$cate2;
                DB::table('goods_category_rela')->insert($goods_category_rela);
            }
            if(isset($cate3)){
                $goods_category_rela['cat_id']=$cate3;
                DB::table('goods_category_rela')->insert($goods_category_rela);
            }
            //---------------------------------------------商户和商品关联表
            if(!isset($g_id)){
                //
                $merchant_good_rela=[
                    'mid'=>session('uid'),
                    'enabled'=>1,
                    'create_time'=>date('Y-m-d H:i:s'),
                    'gid'=>$goods_id
                ];
                DB::table('merchant_good_rela')->insert($merchant_good_rela);
            }

            DB::commit();
            if(isset($g_id)){
                return response()->json(['status'=>200,'msg'=>'更新成功']);
            }else{
                return response()->json(['status'=>200,'msg'=>'添加成功']);
            }

        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
           DB::rollBack();
           if(isset($g_id)){
               return response()->json(['status'=>1,'msg'=>'更新失败']);
           }else{
               return response()->json(['status'=>1,'msg'=>'添加失败']);
           }

        }




    }

    function getCate(Request $request)
    {
        $id = $request->id;
        $data = DB::table('cfg_category')->select('cat_id', 'cat_name')->where(['parent_id' => $id, 'enabled' => 1])->get();
        return response()->json(['data' => $data]);
    }

    function edit($id){
        //品牌
        $brands = DB::table('cfg_brand')->get();
        //店铺分类
        $shopclassify = DB::table('merchant_shopclassify')->select('cat_id as id', 'parent_id as pid', 'sc_name', 'createtime')->where(['sr_id' => session('uid'), 'enabled' => 1])->orderBy('orderby','asc')->get()->toArray();
        if (!empty($shopclassify)) {
            //转换
            $shopclassify = objectToArray($shopclassify);
            $shopclassify = toLayer($shopclassify);
        }
        //规格
        $unitspec = DB::table('cfg_unitspec')->where(['enabled' => 1])->get();


        //商品主表
        $goods=DB::table('goods')->where('goods_id',$id)->first();
        //商品应用
        $goods_apply=DB::table('goods_apply')->where('good_id',$id)->first();
        //商品规格
        $goods_spec=DB::table('goods_spec')->where('good_id',$id)->get();
        //店铺分类
        $goods_shopclassify=DB::table('goods_shopclassify')->where(['good_id'=>$id,'enabled'=>1])->pluck('sc_id');
        if(!empty($goods_shopclassify)){
            $goods_shopclassify=json_decode(json_encode($goods_shopclassify), true);
        }
        //商品品类
        $goods_category_rela=DB::table('goods_category_rela')->where(['good_id'=>$id,'enabled'=>1])->pluck('cat_id');
        if(!empty($goods_category_rela)){
            $goods_category_rela=json_decode(json_encode($goods_category_rela), true);
        }
        //商品详情
        $goods_attr=DB::table('goods_attr')->select('attr_type','attr_value')->where(['good_id'=>$id,'enabled'=>1,'attr_name'=>'descrip'])->get();
        //商品图片
        $sql="SELECT * FROM `goods_attr`  WHERE good_id=$id and attr_name='banner'";
        $imgs=DB::select($sql);
        return view('goods_manage.create', compact('brands', 'shopclassify', 'unitspec','id','goods','goods_apply','goods_spec','goods_shopclassify','goods_category_rela','goods_attr','imgs'));


    }
    //批量上架
    function batchUp(Request $request){
        $ids=$request->ids;
        if(!isset($ids)||empty($ids)){
            return response()->json(['status'=>1,'msg'=>'请选择商品']);
        }
        DB::table('goods')->where(['sr_id'=>session('uid')])->whereIn('goods_id',$ids)->update(['state'=>1]);

        return response()->json(['status'=>200,'msg'=>'操作成功']);


    }
    //批量下架
    function batchDown(Request $request){
        $ids=$request->ids;
        if(!isset($ids)||empty($ids)){
            return response()->json(['status'=>1,'msg'=>'请选择商品']);
        }
        DB::table('goods')->where(['sr_id'=>session('uid')])->whereIn('goods_id',$ids)->update(['state'=>3]);

        return response()->json(['status'=>200,'msg'=>'操作成功']);
    }
    function op(Request $request){
        $op=$request->op;
        $id=$request->id;
        if(!isset($op)||empty($op)||!isset($id)||empty($id)){
            return response()->json(['status'=>1,'msg'=>'缺少参数']);
        }
        if($op==1){
            //不卖了
            DB::table('goods')->where(['sr_id'=>session('uid')])->where('goods_id',$id)->update(['state'=>3]);
            return response()->json(['status'=>200,'msg'=>'操作成功']);

        }
        if($op==2){
            //继续卖
            DB::table('goods')->where(['sr_id'=>session('uid')])->where('goods_id',$id)->update(['state'=>1]);
            return response()->json(['status'=>200,'msg'=>'操作成功']);

        }


    }
    //删除商品
    //todo
    function destroy(Request $request){
        $id=$request->id;
        if(!isset($id)||empty($id)){
            return response()->json(['status'=>1,'msg'=>'缺少参数']);
        }
        //商品主表
        DB::table('goods')->where('goods_id',$id)->update(['enabled'=>0]);
        //店铺分类
        DB::table('goods_shopclassify')->where('good_id',$id)->update(['enabled'=>0]);
        //商户和商品关联表
        DB::table('merchant_good_rela')->where(['gid'=>$id,'mid'=>session('uid')])->update(['enabled'=>0]);



        return response()->json(['status'=>200,'msg'=>'删除成功']);
    }
    //批量删除
    //todo
    function batchDestroy(Request $request){
        $ids=$request->ids;
        if(!isset($ids)||empty($ids)){
            return response()->json(['status'=>1,'msg'=>'缺少参数']);
        }
        DB::table('goods')->whereIn('goods_id',$ids)->update(['enabled'=>0]);
        //店铺分类
        DB::table('goods_shopclassify')->whereIn('good_id',$ids)->update(['enabled'=>0]);

        //商户和商品关联表
        DB::table('merchant_good_rela')->whereIn('gid',$ids)->where(['mid'=>session('uid')])->update(['enabled'=>0]);
        return response()->json(['status'=>200,'msg'=>'删除成功']);

    }

    function exportData(){
        $data=DB::table('goods')->where(['sr_id'=>session('uid'),'enabled'=>1])->select('goods_name as 商品标题','goods_smallname as 商品简称','price as 价格','sell_count as 销量','kc as 库存','img as 商品图片url')->get()->toArray();
        if(!empty($data)){
            $data=objectToArray($data);
            ExcelController::export('商品数据','商品',$data);
        }else{
            return redirect()->route('GoodsManage.index');
        }
    }

    function batchCate(Request $request){
        $cat_ids=$request->cat_ids;
        $ids=$request->ids;
        if(!isset($ids)||empty($ids)){
            return response()->json(['status'=>1,'msg'=>'缺少参数']);
        }
        DB::beginTransaction();
        try{
            if(isset($cat_ids)){
                $goods_shopclassify=[
                    'createtime'=>date('Y-m-d H:i:s'),
                    'enabled'=>1,
                    'level'=>0
                ];

                DB::table('goods_shopclassify')->whereIn('good_id', $ids)->delete();

                foreach ($ids as $g_id) {
                    $goods_shopclassify['good_id'] = $g_id;

                    foreach ($cat_ids as $cat_id){
                        $goods_shopclassify['good_id']=$g_id;
                        $goods_shopclassify['sc_id']=$cat_id;
                        DB::table('goods_shopclassify')->insert($goods_shopclassify);
                    }
                }
            }else{
                foreach ($ids as $g_id) {
                    // ‘未分类’的店铺分类 ID 为12 改记录不可删除、缺少、更改
                    DB::table('goods_shopclassify')->where('good_id', $g_id)->update(['enabled' => 0]);
                    DB::table('goods_shopclassify')->where('good_id', $g_id)->limit(1)->update(['sc_id' => 12, 'enabled' => 1]);
                }
            }

            DB::commit();
            return response()->json(['status'=>200,'msg'=>'添加成功']);
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
            DB::rollBack();
            return response()->json(['status'=>1,'msg'=>'添加失败']);
        }



    }


}
