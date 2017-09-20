@extends('layout.index')
@if(isset($id))
    @section('title','编辑商品')
@section('op','编辑')
    @else
    @section('title','增加商品')
@section('op','增加')
    @endif

@section('module','商品')


@section('content')
    <section class="content">
        <div class="row">
            <!-- left column -->
            <div class="col-md-12">

                <div class="box box-primary">

                    <div class="box-header with-border">
                        <ul class="nav nav-tabs ">
                            <li role="presentation" class="active"><a href="javascript:show(1)">基本信息</a></li>
                            <li role="presentation"><a href="javascript:show(2)">型号/价格</a></li>
                            <li role="presentation"><a href="javascript:show(3)">标签/分类</a></li>
                            <li role="presentation"><a href="javascript:show(4)">商品应用</a></li>
                            <li role="presentation"><a href="javascript:show(5)">商品详情</a></li>
                        </ul>
                    </div>


                    <div class="box-body">
                        <form id="upload_form" class="form-horizontal">
                            @if(isset($id))
                                <input type="hidden" name="goods_id" value="{{$id}}">
                                @endif
                            <!--基本信息-->
                            <section class="section">
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-2 control-label">商品图片</label>
                                    <div class="col-sm-8">
                                       {{-- <div style="border:1px solid #d2d6de" class="dropzone" id="upload_dropzone">
                                            <div class="am-text-success dz-message">
                                                <img src="/img/image.png">
                                            </div>
                                        </div>--}}

                                        <div id="container">
                                            @if(isset($id))
                                                @foreach($imgs as $img)
                                                    <?php
                                                    $arr=explode('/',$img->attr_value);
                                                    $arr=$arr[count($arr)-1];
                                                    $arr=explode('.',$arr)[0];
                                                    ?>
                                                    <div id="img_{{$arr}}" class="col-xs-6 col-md-2 img_c"><a href="{{$img->attr_value}}"><img height="120px" width="100%" src="{{$img->attr_value}}" title="点我查看大图"></a> <a href="javascript:img_del('{{$arr}}')"><p class="img_p" style="text-align: center">删除</p></a></div>
                                                    <input name="file[]" id="file_{{$arr}}" type="hidden" value="{{$img->attr_value}}">
                                                @endforeach

                                                @endif
                                           {{-- <div class="for-img col-sm-2">
                                                <img width="100%" src="/img/img.png">
                                            </div>

                                            <div class="img_add col-sm-2">
                                                <input type="file" name="file" id="img">
                                                <img width="100%" src="/img/add.png">
                                            </div>--}}
                                            {{--<div class="col-xs-6 col-md-2">
                                                <a href=""><img width="100%" src="/img/11.jpg" title="点我查看大图"></a>
                                                <a href="javascript:img_del(1)"><p style="text-align: center">删除</p></a>
                                            </div>--}}
                                            {{--<div class="col-xs-6 col-md-2">
                                                <img width="100%" src="/img/33.jpg" alt="...">
                                                <a><p style="text-align: center">删除</p></a>
                                            </div>
                                            <div class="col-xs-6 col-md-2">
                                                <img width="100%" src="/img/22.jpg" alt="...">
                                                <a><p style="text-align: center">删除</p></a>
                                            </div>
                                            <div class="col-xs-6 col-md-2">
                                                <img width="100%" src="/img/22.jpg" alt="...">
                                                <a><p style="text-align: center">删除</p></a>
                                            </div>--}}
                                            <div class="col-xs-6 col-md-2" id="btn_add">
                                                <div style="padding: 15px;" class="thumbnail">
                                                    <input type="file" name="file" id="img" multiple>
                                                    <img  width="100%" src="/img/add.png" alt="...">
                                                </div>
                                            </div>


                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label"><span style="color: red">*</span>商品标题</label>
                                    <div class="col-sm-8">
                                        <input @if(isset($id)) value="{{$goods->goods_name}}"  @endif  name="goods_name" type="text" class="form-control" placeholder="请输入商品标题">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">商品简称</label>
                                    <div class="col-sm-8">
                                        <input @if(isset($id)) value="{{$goods->goods_smallname}}"  @endif name="goods_smallname" class="form-control" placeholder="请输入商品简称">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">所属品牌</label>
                                    <div class="col-sm-8">
                                        <select name="bid" class="form-control select2">
                                            @foreach($brands as $item)
                                                <option @if(isset($id)&&$goods->bid==$item->bid) selected  @endif  value="{{$item->bid}}">{{$item->zybrand}}</option>
                                            @endforeach

                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label"><span style="color: red">*</span>上架/下架</label>
                                    <div class="col-sm-8">
                                        <div style="margin-top: 5px">
                                            <span>
                                                 <input value="1" type="radio" name="state" class="minimal" @if(isset($id))  @if($goods->state==1) checked @endif  @else checked @endif >上架
                                            </span>

                                            <span style="margin-left: 10px">
                                                <input @if(isset($id)&&$goods->state==3)  checked  @endif value="3" type="radio" name="state" class="minimal">下架
                                            </span>
                                        </div>

                                    </div>
                                </div>


                            </section>
                            <!--型号/价格-->
                            <section id="oott" class="section" style="display: none">
                                <div class="gg">
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label"><span
                                                    style="color: red">*</span>商品规格</label>
                                        <div class="col-sm-8 row">
                                            <div class="col-xs-1">
                                                <input readonly class="form-control" type="text" value="1">
                                            </div>
                                            <div class="col-xs-2">
                                                <select   name="spec[]" class="spec_id form-control">
                                                    @foreach($unitspec as $item)
                                                        @if(isset($id))
                                                            <option @if($goods_spec[0]->spec_id==$item->spec_id) selected  @endif    value="{{$item->spec_id}}">{{$item->spec_name}}</option>
                                                            @else
                                                            <option @if($item->spec_id==2) selected @endif  value="{{$item->spec_id}}">{{$item->spec_name}}</option>
                                                            @endif

                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-xs-1">
                                                <input readonly class="form-control" type="text" value="=">
                                            </div>
                                            <div class="col-xs-2">
                                                <input @if(isset($id)) value="{{$goods_spec[0]->changespec_value}}" @endif name="spec[]" type="number" class="form-control changespec_value">
                                            </div>
                                            <div class="col-xs-2">
                                                <select  name="spec[]" class="form-control changespec_id">
                                                    @foreach($unitspec as $item)
                                                       @if(isset($id))
                                                            <option  @if($goods_spec[0]->changespec_id==$item->spec_id) selected  @endif   value="{{$item->spec_id}}">{{$item->spec_name}}</option>
                                                           @else
                                                            <option  @if($item->spec_id==5) selected @endif    value="{{$item->spec_id}}">{{$item->spec_name}}</option>
                                                           @endif

                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-xs-2">
                                                <div class="input-group">
                                                    <button onclick="add_more()" type="button"
                                                            class="btn btn-primary  btn-sm form-control">
                                                        添加更多规格
                                                    </button>
                                                    <button onclick="rm_more()" style="margin-top: 5px" type="button"
                                                            class="btn  btn-sm btn-danger form-control">删除规格
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputEmail3" class="col-sm-2 control-label"><span
                                                    style="color: red">*</span>商品价格</label>
                                        <div class="col-sm-8 row">
                                            <div class="col-xs-3">
                                                <div class="input-group">
                                                    <input @if(isset($id)) value="{{$goods_spec[0]->price}}" @endif name="spec[]" required type="number"
                                                           class="price form-control">
                                                    <span class="input-group-addon">元/<span class="for-unit_one"></span></span>
                                                </div>
                                            </div>
                                            <div class="col-xs-offset-1 col-xs-3">
                                                <div class="input-group">
                                                    <input @if(isset($id)) value="{{$goods_spec[0]->changespec_price}}" @endif name="spec[]" type="number" class="changespec_price form-control">
                                                    <span class="input-group-addon">元/<span class="for-unit_two"></span></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputEmail3" class="col-sm-2 control-label"><span
                                                    style="color: red">*</span>商品库存</label>
                                        <div class="col-sm-8 row">
                                            <div class="col-xs-3">
                                                <div class="input-group">
                                                    <input @if(isset($id)) value="{{$goods_spec[0]->kc}}" @endif name="spec[]" required type="number"
                                                           class="kc form-control">
                                                    <span class="input-group-addon"><span class="for-unit_one"></span></span>
                                                </div>
                                            </div>
                                            <div class="col-xs-1">
                                                <span>加</span>
                                            </div>
                                            <div class="col-xs-3">
                                                <div class="input-group">
                                                    <input @if(isset($id)) value="{{$goods_spec[0]->changespec_kc}}" @endif  name="spec[]" type="number" class="changespec_kc form-control">
                                                    <span class="input-group-addon"><span class="for-unit_two"></span></span>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>






                            </section >
                            <!--标签/分类-->
                            <section class=" section" style="display: none">
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">商品标签</label>
                                    <div class="col-sm-8 form-inline" id="goods_label">
                                        <button type="button" class="form-control">促销商品</button>
                                        <button type="button" class="form-control">新品推荐</button>
                                        <button type="button" class="form-control">热销推荐</button>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-2 control-label">店铺分类</label>
                                    <div class="col-sm-8">
                                        @if(count($shopclassify)>0)
                                        <div style="border: 1px solid #e6e6e6;padding: 0 10px;overflow-y:auto;max-height: 500px">
                                            @foreach($shopclassify as $one)
                                                <div class="cat_p" style="padding: 10px 0px;margin-bottom: 10px">
                                                    <input @if(isset($id)&&!empty($goods_shopclassify)&&in_array($one['id'],$goods_shopclassify)) checked @endif class="minimal" name="cat_ids[]" type="checkbox"
                                                           value="{{$one['id']}}">{{$one['sc_name']}}
                                                </div>
                                                @if(!empty($one['child']))
                                                    <div class="cat_s" style="margin: 10px 20px">
                                                        @foreach($one['child'] as $item)
                                                            <input @if(isset($id)&&!empty($goods_shopclassify)&&in_array($item['id'],$goods_shopclassify)) checked @endif class="minimal" name="cat_ids[]" type="checkbox"
                                                                   value="{{$item['id']}}">{{$item['sc_name']}}
                                                        @endforeach
                                                    </div>
                                                @endif
                                                @if (!$loop->last)
                                                    <hr>
                                                @endif
                                            @endforeach

                                        </div>
                                        @else
                                            暂无分类
                                        @endif


                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">所属品类</label>
                                    <div class="col-sm-2">
                                        <select id="cate1" name="cate1" class="form-control">

                                        </select>
                                    </div>
                                    <div class="col-sm-2">
                                        <select id="cate2" name="cate2" class="form-control">

                                        </select>
                                    </div>
                                    <div class="col-sm-2">
                                        <select id="cate3" name="cate3" class="form-control">

                                        </select>
                                    </div>
                                </div>
                            </section>
                            <!--商品应用-->
                            <section class=" section" style="display: none">
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">应用标题</label>
                                    <div class="col-sm-8">
                                        <input @if(isset($id)&&!empty($goods_apply)) value="{{$goods_apply->title}}" @endif name="yy_title" type="text" class="form-control" placeholder="请输入应用标题">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-2 control-label">商品应用</label>
                                    <div class="col-sm-8">


                                        <span class="btn btn-default fileinput-button"><i
                                                    class="glyphicon glyphicon-plus"></i><span>上传视频</span><input
                                                    id="fileupload" type="file" name="file"></span>
                                        <button type="button" id="vd_del" class="btn btn-default">删除视频</button>

                                        <div id="progress" class="progress" style="margin-top: 10px;display: none">
                                            <div class="progress-bar progress-bar-success"></div>
                                        </div>
                                        <div class="alert alert-danger" id="error"
                                             style="margin-top: 10px;display: none;">

                                        </div>


                                        <div class="preview"></div>
                                    </div>
                                </div>
                            </section>
                            <!--商品详情-->
                            <section class=" section" style="display: none">
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">根据商品标题和图片</label>
                                    <div class="col-sm-4">
                                        <button onclick="auto_gen()" type="button" class="btn btn-default form-control">自动生成商品详情</button>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-2 control-label"></label>
                                    <div class="col-sm-4">
                                        <div id="module" style="min-height: 500px;border: 1px solid #d2d6de;overflow-y: auto;max-height: 700px">
                                            @if(isset($id)&&!empty($goods_attr))

                                                @foreach($goods_attr as $k=>$item)

                                                        @if($item->attr_type==1)
                                                            <!--文本-->
                                                                 <div class="for-menu">
                                                                    <textarea  order="{{$k}}" class="menu_text menu_btn">{{$item->attr_value}}</textarea>
                                                                    <div class="toolBar">
                                                                        <span class="menu-add"></span>
                                                                        <span class="menu-up"></span>
                                                                        <span class="menu-down"></span>
                                                                        <span class="menu-del"></span>
                                                                        </div>
                                                                    </div>

                                                        @elseif($item->attr_type==2)
                                                            <!--图片-->
                                                                <div class="for-menu"><img class="menu_btn" order="{{$k}}" width="100%" src="{{$item->attr_value}}"><div class="toolBar"><span  class="menu-add"></span><span class="menu-up"></span><span class="menu-down"></span><span class="menu-del" ></span></div></div>

                                                        @elseif($item->attr_type==3)
                                                            <!--视频-->
                                                                <div class="for-menu"><video controls="controls" class="menu_btn" order="{{$k}}" width="100%" src="{{$item->attr_value}}"></video><div class="toolBar"><span  class="menu-add"></span><span class="menu-up"></span><span class="menu-down"></span><span class="menu-del" ></span></div></div>
                                                        @else
                                                            <!--虚线-->
                                                                <div class="for-menu"><hr class="menu_btn" order="{{$k}}"><div class="toolBar"><span  class="menu-add"></span><span class="menu-up"></span><span class="menu-down"></span><span class="menu-del" ></span></div></div>
                                                        @endif

                                                    @endforeach

                                                @endif
                                        </div>
                                        <button onclick="show_menu()" type="button"
                                                class="btn btn-default form-control">添加模块
                                        </button>

                                    </div>
                                </div>


                            </section>

                            <a href="{{route('GoodsManage.index')}}" class="btn btn-default">取消</a>
                            <button id="form_add" type="button" class="btn btn-primary pull-right">保存</button>

                        </form>

                        <div class="oppp gg" style="display: none">
                            <hr style=" height:2px;" />
                            <div class="form-group">
                                <label class="col-sm-2 control-label"><span
                                            style="color: red">*</span>商品规格</label>
                                <div class="col-sm-8 row">
                                    <div class="col-xs-1">
                                        <input readonly class="form-control" type="text" value="1">
                                    </div>
                                    <div class="col-xs-2">

                                        <input readonly class="form-control spec_id" type="text" value="">
                                    </div>
                                    <div class="col-xs-1">
                                        <input readonly class="form-control" type="text" value="=">
                                    </div>
                                    <div class="col-xs-2">
                                        <input    @if(isset($id)&&count($goods_spec)>1) value="{{$goods_spec[1]->changespec_value}}" @endif name="spec[]" type="number" class="form-control changespec_value">
                                    </div>
                                    <div class="col-xs-2">
                                        <select  name="spec[]" class="form-control changespec_id">
                                            @foreach($unitspec as $item)
                                                @if(isset($id)&&count($goods_spec)>1)
                                                    <option @if($item->spec_id==$goods_spec[1]->changespec_id) selected @endif value="{{$item->spec_id}}">{{$item->spec_name}}</option>
                                                    @else
                                                    <option @if($item->spec_id==5) selected @endif value="{{$item->spec_id}}">{{$item->spec_name}}</option>
                                                    @endif

                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputEmail3" class="col-sm-2 control-label">商品价格</label>
                                <div class="col-sm-8 row">
                                    <div class="col-xs-3">
                                        <div class="input-group">
                                            <input   readonly  required type="number"
                                                   class="price form-control">
                                            <span class="input-group-addon">元/<span class="for-unit_one"></span></span>
                                        </div>
                                    </div>
                                    <div class="col-xs-offset-1 col-xs-3">
                                        <div class="input-group">
                                            <input  @if(isset($id)&&count($goods_spec)>1) value="{{$goods_spec[1]->changespec_price}}" @endif name="spec[]" type="number" class="changespec_price form-control">
                                            <span class="input-group-addon">元/<span class="for-unit_two"></span></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputEmail3" class="col-sm-2 control-label">商品库存</label>
                                <div class="col-sm-8 row">
                                    <div class="col-xs-3">
                                        <div class="input-group">
                                            <input readonly  required type="number"
                                                   class="kc form-control">
                                            <span class="input-group-addon"><span class="for-unit_one"></span></span>
                                        </div>
                                    </div>
                                    <div class="col-xs-1">
                                        <span>加</span>
                                    </div>
                                    <div class="col-xs-3">
                                        <div class="input-group">
                                            <input @if(isset($id)&&count($goods_spec)>1) value="{{$goods_spec[1]->changespec_kc}}" @endif  name="spec[]" type="number" class="changespec_kc form-control">
                                            <span class="input-group-addon"><span class="for-unit_two"></span></span>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    {{--<div class="box-footer">
                        <button type="submit" class="btn btn-primary">保存</button>
                    </div>--}}


                </div>

            </div>

        </div>

    </section>
    <section id="menu" style="display: none" class="popBox">
        <div class="row">
            <div class="col-xs-6 col-md-3">
                <div class="thumbnail">
                    <a href="javascript:add_wz()" >
                        <img src="/img/wz.png">
                    </a>
                    <div style="text-align:center" class="caption">文字</div>
                </div>

            </div>
            <div class="col-xs-6 col-md-3">
                <div class="thumbnail">
                    <a href="javascript:void(0)" >
                        <input name="file" type="file" id="menu_file">
                        <img src="/img/menu2.png">
                    </a>
                    <div style="text-align:center" class="caption">图片</div>
                </div>

            </div>
            <div class="col-xs-6 col-md-3">
                <div class="thumbnail">
                    <a href="javascript:void(0)" >
                        <input name="file" type="file" id="menu_vd">
                        <img src="/img/vedio.png">
                    </a>
                    <div style="text-align:center" class="caption">视频</div>
                </div>

            </div>
            <div class="col-xs-6 col-md-3">
                <div class="thumbnail">
                    <a href="javascript:add_hr()" >
                        <img src="/img/hr.png">
                    </a>
                    <div style="text-align:center" class="caption">分割线</div>
                </div>

            </div>



        </div>
    </section>



@endsection
@section('js')
    <script src="/plugs/jQuery-File-Upload/js/vendor/jquery.ui.widget.js"></script>
    <!-- The Iframe Transport is required for browsers without support for XHR file uploads -->
    <script src="/plugs/jQuery-File-Upload/js/jquery.iframe-transport.js"></script>
    <!-- The basic File Upload plugin -->
    <script src="/plugs/jQuery-File-Upload/js/jquery.fileupload.js"></script>

    <script src="/plugs/dropzone/min/dropzone.min.js"></script>
    <script src="/js/upload.js"></script>
    <!-- Select2 -->
    <script src="/adminlte/plugins/select2/select2.full.min.js"></script>
    <script src="/adminlte/plugins/iCheck/icheck.min.js"></script>

    <script>
        var count=0;
        var arr= [];
        @if(isset($id)&&!empty($goods_attr))
                @foreach($goods_attr as $k=>$item)
                 @if($item->attr_type!=1)
                    var value="{{$item->attr_value}}";
                    arr.push({'type':{{$item->attr_type}},'value':value,"count":{{$k}}});
                    count=count+1;
                 @else
                     arr.push({'type':1,'value':'',"count":count});
                 @endif
                @endforeach
                console.log(arr);

        @endif


       $(document).on("mouseover",".for-menu",function(){
           $(this).find(".toolBar").show()
       })
        $(document).on("mouseout",".for-menu",function(){
            $(this).find(".toolBar").hide()
        });



        function auto_gen() {
                var test=$('#module .for-menu').length;
               if(test){
                   var index=layer.confirm('该操作会清空当前的商品详情，并用最新的商品图标和标题生成新的商品详情。确定自动生成商品详情？', {
                       btn: ['确认','取消']
                   }, function(){
                       $('#module .menu_btn').each(function () {

                           var o=$(this).attr('order');
                           arr=arr.filter(function(item){
                               return item.count!=o
                           });
                       })
                       $('#module').empty();
                       console.log(arr);
                       layer.close(index);
                       tttt();
                   });
               }

            tttt();




        }

        function tttt() {
            var goods_name=$('input[name="goods_name"]').val();
            if(goods_name!=""){
                $('#module').append(' <div class="for-menu">' +
                    '<textarea  order='+count+' class="menu_text menu_btn">'+goods_name+'</textarea>' +
                    '<div class="toolBar">' +
                    '<span class="menu-add"></span>'+
                    '<span class="menu-up"></span>'+
                    '<span class="menu-down"></span>'+
                    '<span class="menu-del"></span>'+
                    '</div>'+
                    '</div>');
                arr.push({'type':1,'value':goods_name,"count":count});
                console.log(arr);
                count=count+1;
            };
            var files=$('input[name="file[]"]');
            if(files.length>0){
                for(var i=0;i<files.length;i++){
                    var url=files[i].value;
                    $('#module').append(' <div class="for-menu"><img class="menu_btn" order="'+count+'" width="100%" src="'+url+'"><div class="toolBar"><span  class="menu-add"></span><span class="menu-up"></span><span class="menu-down"></span><span class="menu-del" ></span></div></div>');
                    arr.push({'type':2,'value':url,"count":count});
                    console.log(arr);
                    count=count+1;

                }

            }


        }




        //商品详情
        function add_wz() {
            $('#module').append(' <div class="for-menu">' +
                    '<textarea  order='+count+' class="menu_text menu_btn"></textarea>' +
                    '<div class="toolBar">' +
                       '<span class="menu-add"></span>'+
                       '<span class="menu-up"></span>'+
                       '<span class="menu-down"></span>'+
                       '<span class="menu-del"></span>'+
                     '</div>'+
                '</div>');
            arr.push({'type':1,'value':'',"count":count});
            console.log(arr);
            count=count+1;
        }
        function add_hr() {
            $('#module').append(' <div class="for-menu"><hr class="menu_btn" order="'+count+'"><div class="toolBar"><span  class="menu-add"></span><span class="menu-up"></span><span class="menu-down"></span><span class="menu-del" ></span></div></div>');
          /*  arr[count]={'type':4,'value':''};*/
            arr.push({'type':4,'value':'',"count":count});
            console.log(arr);
            count=count+1;
        }


        $(document).on("click",".menu-del",function(){

                var p=$(this).closest('.for-menu');
                var o=p.find('.menu_btn').attr('order');
                arr=arr.filter(function(item){
                    return item.count!=o
                })
                console.log(arr);
                p.remove();
        });
        $(document).on("click",".menu-add",function(){
            show_menu();

        });
        $(document).on("click",".menu-up",function(){
            var p=$(this).closest('.for-menu');
            if(p.is($('.for-menu:first'))){

                layer.msg('无法上移');
            }else {
                var prev=p.prev();
                var aa=p.find('.menu_btn').attr('order');
                var bb=prev.find('.menu_btn').attr('order');
                var f_aa='';
                var f_bb='';
                var index_a='';
                var index_b='';
                for(var i=0;i<arr.length;i++){
                    if(arr[i].count==aa){
                       f_aa=arr[i];
                        index_a=i;
                    }

                    if(arr[i].count==bb){
                        f_bb=arr[i];
                        index_b=i;
                    }

                }
                arr[index_a]=f_bb;
                arr[index_b]=f_aa;
                p.insertBefore(prev);

            }

        });
        $(document).on("click",".menu-down",function(){
            var p=$(this).closest('.for-menu');
            if(p.is($('.for-menu:last'))){

                layer.msg('无法下移');
            }else {
                var next=p.next();
                var aa=p.find('.menu_btn').attr('order');
                var bb=next.find('.menu_btn').attr('order');
                var f_aa='';
                var f_bb='';
                var index_a='';
                var index_b='';
                for(var i=0;i<arr.length;i++){
                    if(arr[i].count==aa){
                        f_aa=arr[i];
                        index_a=i;
                    }

                    if(arr[i].count==bb){
                        f_bb=arr[i];
                        index_b=i;
                    }

                }
                arr[index_a]=f_bb;
                arr[index_b]=f_aa;
                next.insertBefore(p);
            }

        });




        
        //展示菜单
        function show_menu() {

            layer.open({
                type: 1,
                area: ['420px', ''], //宽高
                shade: false,
                title: false, //不显示标题
                content: $('#menu'), //捕获的元素，注意：最好该指定的元素要存放在body最外层，否则可能被其它的相对元素所影响
                cancel: function(){
                  /*  layer.msg('捕获就是从页面已经存在的元素上，包裹layer的结构', {time: 5000, icon:6});*/
                }
            });
        }


    </script>
    <script>
        @if(isset($id)&&count($goods_spec)>1)

        var v1 = $("#oott .changespec_value:last").val();
        var v2 = $("#oott .changespec_price:last").val();
        var v3 = $("#oott .changespec_kc:last").val();
        var v4 = $("#oott .changespec_id:last option:selected").text();
        var tt=  $('#upload_form ').next('.oppp');
        tt.find('.spec_id').val(v4);
        tt.find('.price ').val(v2);
        tt.find('.kc ').val(v3);
        tt.find('.for-unit_one').text(v4);



        $('#oott').append(tt.clone(true));
        $('#oott .gg:last').show();

        @endif

        $('#form_add').click(function () {
            //商品标题
            var goods_name=$('input[name="goods_name"]').val();
            if($('input[name="file[]"]').length==0){
                layer.msg("请至少上传一张商品图片");
                return false;
            }
            if(goods_name==""){
                layer.msg("请输入商品标题");
                return false;
            }
            if($('#oott .gg:first .price').val()==""){
                layer.msg("请输入商品价格");
                return false;
            }
            if($('#oott .gg:first .kc').val()==""){
                layer.msg("请输入商品库存");
                return false;
            }

            if($('.menu_text').length>0){
                $('.menu_text').each(function () {
                   var order= $(this).attr('order');
                   var v= $(this).val();
                   for(var  i=0;i<arr.length;i++){
                       if(arr[i].count==order){
                           arr[i].value=v;
                       }
                   }
                })
            }
            $.ajax({
                url:"{{route('GoodsManage.store')}}",
                type:"post",
                data:$("#upload_form").serialize()+'&key='+JSON.stringify(arr),
                success:function (response) {
                  if(response.status==200){
                      layer.msg(response.msg);
                      location.reload();
                  }else {
                      layer.msg(response.msg);
                  }

                }
            })
        })
    </script>
    <script>
        @if(isset($id)&&isset($goods_apply)&&!empty($goods_apply->videourl))

        $(".preview").html("<embed id='vd' src='{{$goods_apply->videourl}}' allowscriptaccess='always' allowfullscreen='true' wmode='opaque'" +
            " width='480' height='400' ></embed>");

        //form表单，添加隐藏
        $("#upload_form").append('<input id="vd_url" name="vd_url" type="hidden" value="{{$goods_apply->videourl}}">');
        //删除按钮设置事件
        $("#vd_del").click(function () {
            $("#progress").hide();
            $('#vd').remove();
            $('#vd_url').remove();
            layer.msg('删除成功');
            $("#vd_del").unbind('click');
            }
        );

        @endif
        $('#menu_file').fileupload({
            url: "{{route('Uploader.uploadImg')}}",
            dataType: 'json',
            done: function (e, data) {
                if (data.result.status == 200) {

                    $('#module').append(' <div class="for-menu"><img class="menu_btn" order="'+count+'" width="100%" src="'+data.result.url+'"><div class="toolBar"><span  class="menu-add"></span><span class="menu-up"></span><span class="menu-down"></span><span class="menu-del" ></span></div></div>');
                    /*  arr[count]={'type':4,'value':''};*/
                    arr.push({'type':2,'value':data.result.url,"count":count});
                    console.log(arr);
                    count=count+1;


                }else {
                    layer.msg(data.result.error);
                }
            }

        });
        $('#menu_vd').fileupload({
            url: "{{route('Uploader.uploadVideo')}}",
            dataType: 'json',
            done: function (e, data) {
                if (data.result.status == 200) {

                    $('#module').append(' <div class="for-menu"><video controls="controls" class="menu_btn" order="'+count+'" width="100%" src="'+data.result.url+'"></video><div class="toolBar"><span  class="menu-add"></span><span class="menu-up"></span><span class="menu-down"></span><span class="menu-del" ></span></div></div>');
                    /*  arr[count]={'type':4,'value':''};*/
                    arr.push({'type':3,'value':data.result.url,"count":count});
                    console.log(arr);
                    count=count+1;


                }else {
                    layer.msg(data.result.error);
                }
            }

        });

        //商品图片
        $('#img').fileupload({
            url: "{{route('Uploader.uploadImg')}}",
            dataType: 'json',
            done: function (e, data) {
                if (data.result.status == 200) {
                    var a=purl(data.result.url);
                    var b="'"+a+"'";
                    $('#btn_add').before('<div id="img_'+a+'" class="col-xs-6 col-md-2 img_c"><a href="'+data.result.url+'"><img height="120px" width="100%" src="'+data.result.url+'" title="点我查看大图"></a> <a  onclick=img_del('+b+')><p class="img_p" style="text-align: center">删除</p></a></div>')
                    $('#upload_form').append('<input name="file[]" id="file_'+a+'" type="hidden" value="'+data.result.url+'">')
                }else {
                    layer.msg(data.result.error);
                }
            }

        });
        
        function img_del(id) {
            $("#img_"+id).remove();
            $("#file_"+id).remove();
            layer.msg('删除成功');
            
        }

        $('#fileupload').fileupload({
            url: "{{route('Uploader.uploadVideo')}}",
            dataType: 'json',
            done: function (e, data) {
                if (data.result.status == 200) {
                    //隐藏错误
                    $('#error').hide();
                    //显示视频预览
                    if($('#vd').length==1){
                        //编辑
                        $('#vd').attr('src',data.result.url);
                    }else {
                        $(".preview").html("<embed id='vd' src=" + data.result.url +
                            " allowscriptaccess='always'  allowfullscreen='true' wmode='opaque'" +
                            " width='480' height='400'></embed>");
                    }
                    //form表单，添加隐藏
                    $("#upload_form").append('<input id="vd_url" name="vd_url" type="hidden" value="'+ data.result.url + '">');
                    //删除按钮设置事件
                    $("#vd_del").click(function () {
                        $("#progress").hide();
                        $('#vd').remove();
                        $('#vd_url').remove();
                        layer.msg('删除成功');
                        $("#vd_del").unbind('click');
                        }
                    );

                } else {
                    $('#error').show();
                    $('#error').text(data.result.error);
                    $("#progress").hide();
                }
            },

            progress: function (e, data) {
                var progress = parseInt(data.loaded / data.total * 100, 10);
                $('#progress .progress-bar').css(
                    'width',
                    progress + '%'
                );
            }
        }).bind('fileuploadadd', function (e, data) {
            $("#progress").show();
        }).prop('disabled', !$.support.fileInput)
            .parent().addClass($.support.fileInput ? undefined : 'disabled');


        //spec_id的文本
        var a=$('.spec_id:first option:selected').text();
        $('.for-unit_one:lt(2)').text(a);
        //changespec_id的文本
        var b=$('.changespec_id:first option:selected').text();
        $('.for-unit_two').text(b);



        //spec_id  select
        $('.spec_id').each(function () {
            $(this).change(function () {
                var c=$(this).find("option:selected").text();
                $(this).parent().parent().parent().parent().find('.for-unit_one').text(c);

            })
        });
        //changespec_id  select
        $('.changespec_id').each(function () {
            $(this).change(function () {
                var d=$(this).find("option:selected").text();
                var p=$(this).parent().parent().parent().parent();
                p.find('.for-unit_two').text(d);
                var nt=p.next();
                if(nt.length==1){
                    nt.find('.spec_id').val(d);
                    nt.find('.for-unit_one').text(d);
                }

            })
        });

        $('.changespec_price').each(function () {
            $(this).change(function () {
                var d=$(this).val();

                var p=$(this).parent().parent().parent().parent().parent();
                var nt=p.next();

                if(nt.length==1){
                    nt.find('.price').val(d);
                }

            })
        });
        $('.changespec_kc').each(function () {
            $(this).change(function () {
                var d=$(this).val();
                var p=$(this).parent().parent().parent().parent().parent();
                var nt=p.next();

                if(nt.length==1){
                    nt.find('.kc').val(d);
                }

            })
        });

        //
        /*$("select[name='unit_one_1']").change(function () {
            var va = $("select[name='unit_one_1'] option:selected").text();
            $('.for-unit_one').text(va);
        });
        $("select[name='unit_two_2']").change(function () {
            var va = $("select[name='unit_two_2'] option:selected").text();
            $('input[name="unit_one_4"]').val(va);


            $('.for-unit_two').text(va);
        });
        $("select[name='unit_two_6']").change(function () {
            var va = $("select[name='unit_two_6'] option:selected").text();
            $('.unit_two_6').text(va);
        });
        $("input[name='unit_two_3']").change(
           function () {
               var a=$("input[name='unit_two_3']").val();
               $("input[name='unit_one_5']").val(a);
           }

        )
        $("input[name='unit_two_4']").change(
            function () {
                var a=$("input[name='unit_two_4']").val();
                $("input[name='unit_one_6']").val(a);
            }

        )*/

        function rm_more() {
           $('#oott .oppp:last').remove();
        }

        function add_more() {
            //检测规格转换是否填写
            if( $('#oott .gg').length<2){
                var v1 = $("#oott .changespec_value:last").val();
                var v2 = $("#oott .changespec_price:last").val();
                var v3 = $("#oott .changespec_kc:last").val();
                var v4 = $("#oott .changespec_id:last option:selected").text();
                if (v1 == "" || v2 == "" | v3 == "") {
                    layer.msg('请填完整规格');
                    return false;

                }
                var tt=  $('#upload_form ').next('.oppp');
                //前4
                tt.find('.spec_id').val(v4);
                tt.find('.price ').val(v2);
                tt.find('.kc ').val(v3);
                tt.find('.for-unit_one').text(v4);
                //后4,置空
                tt.find('.changespec_value').val('');
                tt.find('.changespec_id ').val('');
                tt.find('.changespec_price ').val('');
                tt.find('.changespec_kc').val('');



                $('#oott').append(tt.clone(true));
                $('#oott .gg:last').show();

            }else {
                layer.msg('最多2级');
            }


        }
    </script>
    <script>
        $.ajax({
            type: 'POST',
            url: '{{route('GoodsManage.getCate')}}',
            data: {'id': 0},
            dataType: 'json',
            success: function (result) {

                if (result.data.length > 0) {
                    var e = '';
                    for (var i = 0; i < result.data.length; i++) {
                        e += '<option value="' + result.data[i].cat_id + '">' + result.data[i].cat_name + '</option>';
                    }
                    ;
                    $("#cate1").append(e);

                    @if(isset($id))
                    $("#cate1 option[value='{{$goods_category_rela[0]}}']").attr('selected','selected');
                    @endif


                    $.ajax({
                        type: 'POST',
                        url: '{{route('GoodsManage.getCate')}}',
                        @if(isset($id))
                        data: {'id': '{{$goods_category_rela[0]}}'},
                        @else
                        data: {'id': result.data[0].cat_id},
                        @endif
                        dataType: 'json',
                        success: function (result2) {

                            if (result2.data.length > 0) {

                                var e2 = '';
                                for (var i = 0; i < result2.data.length; i++) {
                                    e2 += '<option value="' + result2.data[i].cat_id + '">' + result2.data[i].cat_name + '</option>';
                                }
                                ;
                                $("#cate2").append(e2);
                                @if(isset($id)&&count($goods_category_rela)>=2)
                                    $("#cate2 option[value='{{$goods_category_rela[1]}}']").attr('selected','selected');
                                    @endif

                                $.ajax({
                                    type: 'POST',
                                    url: '{{route('GoodsManage.getCate')}}',
                                    @if(isset($id)&&count($goods_category_rela)>=2)
                                    data: {'id': '{{$goods_category_rela[1]}}'},
                                    @else
                                    data: {'id': result2.data[0].cat_id},
                                    @endif
                                    dataType: 'json',
                                    success: function (result3) {
                                        if (result3.data.length > 0) {

                                            var e3 = '';
                                            for (var i = 0; i < result3.data.length; i++) {
                                                e3 += '<option value="' + result3.data[i].cat_id + '">' + result3.data[i].cat_name + '</option>';
                                            }
                                            ;
                                            $("#cate3").append(e3);
                                            @if(isset($id)&&count($goods_category_rela)>=3)
                                                  $("#cate3 option[value='{{$goods_category_rela[2]}}']").attr('selected','selected');
                                            @endif

                                        }

                                    }
                                })

                            }

                        }
                    })

                }
            }
        })
        $("#cate1").change(function () {
            var id = $("#cate1 option:selected").val();
            $.ajax({
                type: 'POST',
                url: '{{route('GoodsManage.getCate')}}',
                data: {'id': id},
                dataType: 'json',
                success: function (result2) {

                    if (result2.data.length > 0) {

                        var e2 = '';
                        for (var i = 0; i < result2.data.length; i++) {
                            e2 += '<option value="' + result2.data[i].cat_id + '">' + result2.data[i].cat_name + '</option>';
                        }
                        ;
                        $("#cate2 option").remove();
                        $("#cate3 option").remove();
                        $("#cate2").append(e2);

                        $.ajax({
                            type: 'POST',
                            url: '{{route('GoodsManage.getCate')}}',
                            data: {'id': result2.data[0].cat_id},
                            dataType: 'json',
                            success: function (result3) {
                                if (result3.data.length > 0) {

                                    var e3 = '';
                                    for (var i = 0; i < result3.data.length; i++) {
                                        e3 += '<option value="' + result3.data[i].cat_id + '">' + result3.data[i].cat_name + '</option>';
                                    }
                                    ;
                                    $("#cate3 option").remove();
                                    $("#cate3").append(e3);

                                }

                            }
                        })

                    } else {
                        $("#cate2 option").remove();
                        $("#cate3 option").remove();
                    }

                }
            })

        })
        $("#cate2").change(function () {
            var id = $("#cate2 option:selected").val();
            $.ajax({
                type: 'POST',
                url: '{{route('GoodsManage.getCate')}}',
                data: {'id': id},
                dataType: 'json',
                success: function (result) {
                    if (result.data.length > 0) {
                        var e = '';
                        for (var i = 0; i < result.data.length; i++) {
                            e += '<option value="' + result.data[i].cat_id + '">' + result.data[i].cat_name + '</option>';
                        }
                        ;
                        $("#cate3 option").remove();
                        $("#cate3").append(e);
                    } else {
                        $("#cate3 option").remove();
                    }

                }
            })

        })
    </script>
    {{--<script>
        $(function () {
            var myDropzone=upload_img("{{route('Uploader.uploadImg')}}", '{{route("Uploader.deleteUploadImg")}}', $("#upload_dropzone"), $('#upload_form'), ".jpg,.jpeg,.png,.gif", 1, 10);
        });
    </script>--}}
    <script>
        $(function () {
            //初始化显示基本信息
            $('.box-header ul li:eq(0)').addClass('active');
            $('.box-header ul li:not(:eq(0))').removeClass('active');
            $('.section:eq(0)').show();
            $('.section:not(:eq(0))').hide();
        })
        function show(id) {
            switch (id) {
                case 1:
                    //基本信息
                    $('.box-header ul li:eq(0)').addClass('active');
                    $('.box-header ul li:not(:eq(0))').removeClass('active');
                    $('.section:eq(0)').show();
                    $('.section:not(:eq(0))').hide();

                    break;
                case 2:
                    //型号/价格
                    $('.box-header ul li:eq(1)').addClass('active');
                    $('.box-header ul li:not(:eq(1))').removeClass('active');
                    $('.section:eq(1)').show();
                    $('.section:not(:eq(1))').hide();
                    break;
                case 3:
                    //标签/分类
                    $('.box-header ul li:eq(2)').addClass('active');
                    $('.box-header ul li:not(:eq(2))').removeClass('active');
                    $('.section:eq(2)').show();
                    $('.section:not(:eq(2))').hide();
                    break;
                case 4:
                    //商品应用
                    $('.box-header ul li:eq(3)').addClass('active');
                    $('.box-header ul li:not(:eq(3))').removeClass('active');
                    $('.section:eq(3)').show();
                    $('.section:not(:eq(3))').hide();
                    break;
                case 5:
                    //商品详情
                    $('.box-header ul li:eq(4)').addClass('active');
                    $('.box-header ul li:not(:eq(4))').removeClass('active');
                    $('.section:eq(4)').show();
                    $('.section:not(:eq(4))').hide();
                    break;

            }
        }
        @if(isset($id))

            @if(!empty($goods->is_hot))
                $('#goods_label button:eq(2)').addClass('goods_lable');
                $('#upload_form').append('<input type="hidden" id="hot" name="hot" value="3">');
            @endif
            @if(!empty($goods->is_new))
                $('#goods_label button:eq(1)').addClass('goods_lable');
                 $('#upload_form').append('<input type="hidden" id="new" name="new" value="2">');
            @endif
            @if(!empty($goods->is_cuxiao))
                $('#goods_label button:eq(0)').addClass('goods_lable');
                 $('#upload_form').append('<input type="hidden" id="cu_xiao" name="cu_xiao" value="1">');
             @endif

        @endif
$(".select2").select2();
        $('#goods_label button').each(function (index) {
            $(this).click(function () {

                if ($(this).hasClass('goods_lable')) {

                    switch (index) {
                        case 0:
                            $('#cu_xiao').remove();
                            break;
                        case 1:
                            $('#new').remove();
                            break;
                        case 2:
                            $('#hot').remove();
                            break;

                    }
                    $(this).removeClass('goods_lable');
                } else {
                    switch (index) {
                        //促销商品
                        case 0:
                            $('#upload_form').append('<input type="hidden" id="cu_xiao" name="cu_xiao" value="1">');
                            break;
                        //新品推荐
                        case 1:
                            $('#upload_form').append('<input type="hidden" id="new" name="new" value="2">');
                            break;
                        //热销推荐
                        case 2:
                            $('#upload_form').append('<input type="hidden" id="hot" name="hot" value="3">');
                            break;

                    }

                    $(this).addClass('goods_lable')
                }


            });
        });
        $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
            checkboxClass: 'icheckbox_minimal-blue',
            radioClass: 'iradio_minimal-blue',
        });
        $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
            checkboxClass: 'icheckbox_minimal-blue',
            radioClass: 'iradio_minimal-blue',
        });
       /* $('.cat_p').each(function () {
           $(this).on('ifChecked', function () {
               $(this).next('.cat_s').find('input[type="checkbox"]').iCheck('check');
            });
            $(this).on('ifUnchecked', function () {

                $(this).next('.cat_s').find('input[type="checkbox"]').iCheck('uncheck');
            });
        });
        $('.cat_s').each(function () {
            $(this).on('ifChecked', function () {
                console.log(  $(this).prev());
                $(this).prev().unbind('ifChecked')
                $(this).prev().iCheck('check');
                $(this).prev().on('ifChecked', function () {
                    $(this).next('.cat_s').find('input[type="checkbox"]').iCheck('check');
                });

            })

        })*/

        $('.cat_p').each(function () {
            $(this).on('ifChecked', function () {
                if ($(this).next('.cat_s').find('input[type="checkbox"]:checked').length <= 0) {
                    $(this).next('.cat_s').find('input[type="checkbox"]').iCheck('check');
                }
            });
            $(this).on('ifUnchecked', function () {

                $(this).next('.cat_s').find('input[type="checkbox"]').iCheck('uncheck');
            });
        });

        $(".cat_s").find('input[type="checkbox"]').on('ifChecked', function () {
            $(this).parents('.cat_s').prev().find('input[type="checkbox"]').iCheck('check');
        });





    </script>
    <script>
        $('.sidebar-menu #add_goods').addClass('active');
    </script>
@endsection
@section('css')
    <link rel="stylesheet" href="/plugs/jQuery-File-Upload/css/jquery.fileupload.css">
    <link rel="stylesheet" href="/plugs/dropzone/min/dropzone.min.css">
    <!-- Select2 -->
    <link rel="stylesheet" href="/adminlte/plugins/select2/select2.min.css">
    <link rel="stylesheet" href="/adminlte/plugins/iCheck/all.css">
    <style>
        .goods_lable {
            background: #367fa9;
            color: #fff;

        }

        .for-module {
            border: 1px solid;
            padding: 10px;
        }
        #module{
            padding: 15px;
        }

        .menu ul li {
            cursor: pointer;
            text-align: center;
            font-size: 14px;
            color: #737373;
            line-height: 30px;
            padding: 0 10px;
            float: left;
            list-style: none
        }

        .menu ul li div {
            border: 1px solid #ddd;
            width: 40px;
            height: 40px;
            margin: 0 auto;
        }
        .for-menu{
            border: 1px solid #ddd;
            padding: 0 5px;
            margin-bottom: 10px;
            position: relative;


        }
        .for-menu .toolBar{
            position: absolute;
            bottom: 0;
            right:0;
            height: 38px;
            display: none;
        }
        .for-menu .toolBar span{
            float:left;  
            width:26px;
            height:26px;
            margin-right:10px;
        }
        .for-menu .toolBar span:nth-of-type(1){
            background:url("/img/menu/add.png") center;
            background-size: 26px 26px;

        }
        .for-menu .toolBar span:nth-of-type(2){
            width: 20px;
            background:url("/img/menu/up.png") center;
            background-size: 20px 26px;

        }
        .for-menu .toolBar span:nth-of-type(3){
            width: 20px;
            background:url("/img/menu/down.png") center;
            background-size: 20px 26px;

        }
        .for-menu .toolBar span:nth-of-type(4){
            background:url("/img/menu/del.png") center;
            background-size: 26px 26px;
            margin-right: 0;

        }

        .menu_text{
            width: 100%;height: 200px;background:transparent;border-style:none;outline: none;resize: none;
        }
        #menu_file,#menu_vd{
            z-index: 99;
            width: 100%;
            height: 100%;
            border: 1px solid red;
            position: absolute;
            top: 0;
            left: 0;
            opacity: 0;
            cursor: pointer;
        }
        .img_add{
            border: 1px dashed #d2d6de;width: 64px;height:64px;padding: 5px;
            position: relative;
            margin-right: 5px;
        }
        .for-img{
            border: 1px dashed #d2d6de;width: 64px;height:64px;
            position: relative;
            margin-right: 5px;
            padding: 5px;
        }
        #img{
            width: 100%;
            height: 100%;position: absolute;left: 0;top: 0;opacity: 0;
        }
      .popBox{
          padding:20px;
      }
        .img_c{
            width: 150px;
            height: 150px;
            position: relative;

        }
        .img_p{
            position: absolute;
            width: 100%;
            text-align: center;
            height: 18px;
            bottom:0;
            left: 0;
        }

    </style>
@endsection()
