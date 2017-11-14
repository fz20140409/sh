@extends('layout.index')
@section('title','网店设置')
@section('module','网店')
@section('op','显示')

@section('content')
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <!--box-header-->
                    <div class="box-header"> </div>
                    <!--box-header-->
                    <!--box-body-->
                    <div class="box-body">
                        <form id="upload_form" class="form-horizontal">
                            <!--网店设置-->
                            <section class="section">
                                <div class="form-group" style="margin-bottom: 0px;">
                                    <label class="col-sm-2 control-label">网店设置</label>
                                    <div class="col-sm-3" style="padding: 0px;">
                                        <button type="button" style="background-color: black;color: white;width: 100%;" class="btn btn-lg">我的店铺</button>
                                    </div>

                                    <div id="store_setting" class="col-sm-4" hidden style="background-color: #00a7d0;padding: 10px 16px; font-size: 18px; line-height: 1.3333333; margin-left:80px;">
                                        店铺模块设置
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-2 control-label"></label>
                                    <div class="col-sm-3" style="padding: 0px;">
                                        <div id="module" style="height: 750px;border: 1px solid #d2d6de;overflow-y: auto;">

                                            <div id="top" class="row text-center" style="background-image:url('{{!empty($merchant->background) ? $merchant->background : "/img/topBg.jpg"}}'); background-repeat: no-repeat; background-size: 100%; 100%;">
                                                <div class="col-xs-12" style="height: 50px;"></div>

                                                <div class="col-xs-3">
                                                    <img style="width: 48px;" src="{{$user->uicon}}">
                                                    <button type="button" class="btn btn-default btn-xs">{{ empty($favor) ? '未在乎' : '已在乎' }}</button>
                                                </div>
                                                <div class="col-xs-9 text-left" style="padding-left: 0px;">
                                                    <div class="col-xs-8" style="padding: 0px;">{{$user->company}}</div>
                                                    <div class="col-xs-4"><button type="button" style="float: right;" class="btn btn-default btn-xs">我要评价</button></div>
                                                    <div class="col-xs-12" style="padding: 0px;">{{$merchant_type_name}}</div>
                                                    <div class="col-xs-4" style="padding: 0px;">诚信值</div>
                                                    <div class="col-xs-8"><img style="height: 24px; float: right;" src="/img/evaluate.png"></div>
                                                </div>
                                            </div>
                                            {{--顶部遮罩--}}
                                            <div id="top_mask" class="text-center" hidden style="position: absolute;top: 1px; width: 100%;z-index:1100;background-color:#000;opacity: 0.5;filter:alpha(opacity=30);color: #fff;font-size: 20px;"><span id="top_edit">编辑</span></div>


                                            <div id="notice" class="row sort" style="border: 1px solid #eee" @if(empty($merchant->notice)) hidden @endif>
                                                <div class="col-xs-3">
                                                    <img class="img-responsive" style="width: 30px;" src="/img/broadcast.png">
                                                </div>
                                                <div class="col-xs-9" style="padding-left: 0px; line-height: 29px;">
                                                    {{$merchant_notice ? : '暂无公告'}}
                                                </div>
                                            </div>
                                            {{--公告遮罩--}}
                                            <div id="notice_mask" class="text-center" hidden style="position: absolute;width: 100%;z-index:1100;background-color:#000;opacity: 0.5;filter:alpha(opacity=30);color: #fff;font-size: 20px;"><span id="notice_edit">编辑</span></div>

                                            <div class="row text-center">
                                                <div class="col-xs-3" style="padding: 5px 0px;"><img src="/img/home.png"><span style="display: block;">首页</span></div>
                                                <div class="col-xs-3" style="padding: 5px 0px;"><img src="/img/goods.png"><span style="display: block;">全部商品</span></div>
                                                <div class="col-xs-3" style="padding: 5px 0px;"><img src="/img/dynamic.png"><span style="display: block;">动态</span></div>
                                                <div class="col-xs-3" style="padding: 5px 0px;"><img src="/img/company.png"><span style="display: block;">公司信息</span></div>
                                            </div>

                                            <div id="showcase" class="row sort" @if(empty($merchant->recoshowcase)) hidden @endif>
                                                <div class="col-xs-12">
                                                    @if ($merchant->recoshowcase_type == 2)
                                                        @if ($merchant->recoshowcaseInfo)
                                                        <img class="img-responsive" style="min-height: 150px;" src="{{$merchant->recoshowcaseInfo}}">
                                                        @else
                                                        暂未上传图片
                                                        @endif
                                                    @else
                                                        <textarea class="form-control" style="background-color: #fff; height: 150px;" readonly >{{$merchant->recoshowcaseInfo}}</textarea>
                                                    @endif
                                                </div>
                                            </div>
                                            {{--橱窗遮罩--}}
                                            <div id="showcase_mask" class="text-center" hidden style="position: absolute;width: 100%;z-index:1100;background-color:#000;opacity: 0.5;filter:alpha(opacity=30);color: #fff;font-size: 20px;"><span id="showcase_edit">编辑</span></div>

                                            <div class="row text-center sort" @if(empty($merchant->cxGood)) hidden @endif>
                                                <div class="col-xs-4" style="padding-right: 0px; padding-left: 30px;">
                                                    <hr class="menu_btn">
                                                </div>
                                                <div class="col-xs-4"  style="line-height: 3;">
                                                    促销商品
                                                </div>
                                                <div class="col-xs-4" style="padding-right: 30px; padding-left: 0px;">
                                                    <hr class="menu_btn">
                                                </div>

                                                @foreach($cx_goods as $key => $value)
                                                <div class="col-xs-6" style="@if($key == 0) padding-left: 30px; @else padding-right: 30px; @endif">
                                                    <img class="img-responsive" src="{{$value->img}}">
                                                </div>
                                                @endforeach

                                                @foreach($cx_goods as $value)
                                                <div class="col-xs-6" style="padding-left: 30px;">{{$value->goods_smallname}}</div>
                                                @endforeach
                                            </div>

                                            <div class="row text-center sort" @if(empty($merchant->newGood)) hidden @endif>
                                                <div class="col-xs-4" style="padding-right: 0px; padding-left: 30px;">
                                                    <hr class="menu_btn">
                                                </div>
                                                <div class="col-xs-4"  style="line-height: 3;">
                                                    新品推荐
                                                </div>
                                                <div class="col-xs-4" style="padding-right: 30px; padding-left: 0px;">
                                                    <hr class="menu_btn">
                                                </div>

                                                @foreach($new_goods as $key => $value)
                                                    <div class="col-xs-6" style="@if($key == 0) padding-left: 30px; @else padding-right: 30px; @endif">
                                                        <img class="img-responsive" src="{{$value->img}}">
                                                    </div>
                                                @endforeach

                                                @foreach($new_goods as $value)
                                                    <div class="col-xs-6" style="padding-left: 30px;">{{$value->goods_smallname}}</div>
                                                @endforeach
                                            </div>

                                            <div class="row text-center sort" @if(empty($merchant->hotGood)) hidden @endif>
                                                <div class="col-xs-4" style="padding-right: 0px; padding-left: 30px;">
                                                    <hr class="menu_btn">
                                                </div>
                                                <div class="col-xs-4" style="line-height: 3;">
                                                    热销商品
                                                </div>
                                                <div class="col-xs-4" style="padding-right: 30px; padding-left: 0px;">
                                                    <hr class="menu_btn">
                                                </div>

                                                @foreach($hot_goods as $key => $value)
                                                    <div class="col-xs-6" style="@if($key == 0) padding-left: 30px; @else padding-right: 30px; @endif">
                                                        <img class="img-responsive" src="{{$value->img}}">
                                                    </div>
                                                @endforeach

                                                @foreach($hot_goods as $value)
                                                    <div class="col-xs-6" style="padding-left: 30px;">{{$value->goods_smallname}}</div>
                                                @endforeach
                                            </div>

                                            <div id="bottom_list" class="navbar navbar-default navbar-fixed-bottom" style="position: absolute;min-height: 30px;border-width: 1px;">
                                                <div class="row text-center" style="margin:0px;">
                                                    <div class="@if(empty($merchant->disphone)) col-xs-6 @else col-xs-4 @endif sort" style="padding: 10px; border-right: 1px solid #d2d6de;">在线下单</div>
                                                    <div class="@if(empty($merchant->disphone)) col-xs-6 @else col-xs-4 @endif sort" style="padding: 10px;">有话说</div>
                                                    <div id="phone" class="col-xs-4 sort" @if(empty($merchant->disphone)) hidden @endif style="padding: 10px; border-left: 1px solid #d2d6de;">拨打电话</div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                    <div class="col-sm-4" id="top_carousel" hidden style="font-size: 18px;">
                                        <div class="row" >
                                            <div class="col-sm-12" style="background-color: #00a7d0;border: 1px solid #eee; padding: 10px 16px; font-size: 18px; line-height: 1.3333333; margin-left:80px;">
                                                编辑店铺招牌
                                            </div>

                                            {{--<div class="col-xs-12">--}}
                                                <div id="carousel-example-generic" class="col-sm-12 carousel slide" style="margin-left: 79px; margin-bottom: 30px; padding: 30px 10px; border: 1px solid #eee;" data-ride="carousel" >
                                                    <!-- Indicators -->
                                                    <ol class="carousel-indicators">
                                                        @foreach($background as $key => $value)
                                                        <li data-target="#carousel-example-generic" data-slide-to="{{$key}}" @if($key == 0) class="active" @endif></li>
                                                        @endforeach
                                                    </ol>

                                                    <!-- Wrapper for slides -->
                                                    <div class="carousel-inner" role="listbox">
                                                        @foreach($background as $key => $value)
                                                        <div class="item @if($key == 0) active @endif">
                                                            <img src="{{$value->bgurl}}" alt="...">
                                                        </div>
                                                        @endforeach
                                                    </div>

                                                    <!-- Controls -->
                                                    <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
                                                        <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                                                        <span class="sr-only">Previous</span>
                                                    </a>
                                                    <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
                                                        <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                                                        <span class="sr-only">Next</span>
                                                    </a>
                                                </div>
                                            {{--</div>--}}

                                            <div class="row" style="padding-left: 145px;">
                                                <div class="col-sm-6">
                                                    <button id="carousel_cancel" type="button" class="btn btn-default btn-block">取消</button>
                                                </div>
                                                <div class="col-sm-6">
                                                    <button id="carousel_confirm" type="button" class="btn btn-primary btn-block">确定</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-4" id="notice_content" hidden style="font-size: 18px;">
                                        <div class="row">
                                            <div class="col-sm-12" style="background-color: #00a7d0;border: 1px solid #eee; padding: 10px 16px; font-size: 18px; line-height: 1.3333333; margin-left:80px;">
                                                编辑店铺公告
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-sm-12" style="border: 1px solid #eee; padding: 30px 16px; font-size: 18px; line-height: 1.3333333; margin-left:80px;">
                                                <textarea class="form-control" rows="5" cols="5"></textarea>
                                            </div>
                                        </div>

                                        <div class="row" style="padding-left: 145px; margin-top: 30px;">
                                            <div class="col-sm-6">
                                                <button id="notice_cancel" type="button" class="btn btn-default btn-block">取消</button>
                                            </div>
                                            <div class="col-sm-6">
                                                <button id="notice_confirm" type="button" class="btn btn-primary btn-block">确定</button>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-4" id="showcase_content" hidden style="font-size: 18px;">
                                        <div class="row">
                                            <div class="col-sm-12" style="background-color: #00a7d0;border: 1px solid #eee; padding: 10px 16px; font-size: 18px; line-height: 1.3333333; margin-left:80px;">
                                                设置推荐模块
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-sm-12" style="border-left: 1px solid #eee; border-right: 1px solid #eee; padding: 30px 16px; font-size: 18px; line-height: 1.3333333; margin-left:80px;">
                                                <label style="margin-right: 30px;"><input type="radio" name="recoshowcase_type" value="2" @if($merchant->recoshowcase_type == 2) checked @endif>&nbsp;图片</label>
                                                <label><input type="radio" name="recoshowcase_type" value="1" @if($merchant->recoshowcase_type == 1) checked @endif>&nbsp;文字</label>
                                            </div>

                                            <div id="recoshowcase_type_2" @if($merchant->recoshowcase_type == 1) hidden @endif class="col-sm-12" style="border-left: 1px solid #eee; border-right: 1px solid #eee; border-bottom: 1px solid #eee; padding: 0px 16px 30px; font-size: 18px; line-height: 1.3333333; margin-left:80px;">
                                                <img class="img-responsive" src="@if($merchant->recoshowcase_type == 2){{$merchant->recoshowcaseInfo}}@endif" style="margin-bottom: 20px;">
                                                <div class="col-sm-6">
                                                    <input id="file" type="file" name="file" style="display: none;">
                                                    <button onclick="javascript:document.getElementById('file').click();" type="button" class="btn btn-default btn-block">上传图片</button>
                                                </div>
                                                <div class="col-sm-6" style="color: red;">
                                                    建议尺寸640 x 240
                                                </div>
                                            </div>

                                            <div id="recoshowcase_type_1" @if($merchant->recoshowcase_type == 2) hidden @endif class="col-sm-12" style="border-left: 1px solid #eee; border-right: 1px solid #eee; border-bottom: 1px solid #eee; padding: 30px 16px; font-size: 18px; line-height: 1.3333333; margin-left:80px;">
                                                <textarea class="form-control" rows="5" cols="5">@if($merchant->recoshowcase_type == 1){{$merchant->recoshowcaseInfo}}@endif</textarea>
                                            </div>
                                        </div>

                                        <div class="row" style="padding-left: 145px; margin-top: 30px;">
                                            <div class="col-sm-6">
                                                <button id="showcase_cancel" type="button" class="btn btn-default btn-block">取消</button>
                                            </div>
                                            <div class="col-sm-6">
                                                <button id="showcase_confirm" type="button" class="btn btn-primary btn-block">确定</button>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-4 text-center" id="setting" style="padding: 50px; font-size: 18px;">
                                        <div class="row">
                                            <div class="col-sm-12" style="padding-top: 10px; font-size: 28px;">
                                                打造个性店铺
                                            </div>
                                        </div>

                                        <div class="row" style="margin-top: 20px; margin-bottom: 150px;">
                                            <div class="col-xs-12">您可以自定义招牌背景设置店铺的展示模块内容</div>
                                        </div>

                                        <div class="row">
                                            <div class="col-xs-12">
                                                <button id="model_setting" type="button" class="btn btn-primary btn-block btn-lg" style="margin-top: 30px;margin-bottom: 30px;">模块设置</button>
                                                <button id="apply" type="button" class="btn btn-default btn-block btn-lg" style="margin-top: 30px;margin-bottom: 30px;">应用到店铺</button>
                                                <button type="button" class="btn btn-default btn-block btn-lg" style="margin-top: 30px;margin-bottom: 30px;">预览店铺</button>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-4" id="operation" hidden style="font-size: 18px;">
                                        <div class="row">
                                            <div class="col-sm-12" style="border: 1px solid #eee; padding: 10px 16px; font-size: 18px; line-height: 1.3333333; margin-left:80px;">
                                                店铺公告 <img style="float: right;width: 40px; height: 20px;" @if($merchant->notice) src="/img/open.png" @else src="/img/close.png" @endif>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-sm-12" style="border: 1px solid #eee; padding: 10px 16px; font-size: 18px; line-height: 1.3333333; margin-left:80px;">
                                                推荐橱窗 <img style="float: right;width: 40px; height: 20px;" @if($merchant->recoshowcase) src="/img/open.png" @else src="/img/close.png" @endif>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-sm-12" style="border: 1px solid #eee; padding: 10px 16px; font-size: 18px; line-height: 1.3333333; margin-left:80px;">
                                                促销商品 <img style="float: right;width: 40px; height: 20px;" @if($merchant->cxGood) src="/img/open.png" @else src="/img/close.png" @endif>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-sm-12" style="border: 1px solid #eee; padding: 10px 16px; font-size: 18px; line-height: 1.3333333; margin-left:80px;">
                                                新品推荐 <img style="float: right;width: 40px; height: 20px;" @if($merchant->newGood) src="/img/open.png" @else src="/img/close.png" @endif>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-sm-12" style="border: 1px solid #eee; padding: 10px 16px; font-size: 18px; line-height: 1.3333333; margin-left:80px;">
                                                热销推荐 <img style="float: right;width: 40px; height: 20px;" @if($merchant->hotGood) src="/img/open.png" @else src="/img/close.png" @endif>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-sm-12" style="border: 1px solid #eee; padding: 10px 16px; font-size: 18px; line-height: 1.3333333; margin-left:80px;">
                                                我要下单 <img style="float: right;width: 40px; height: 20px;" src="/img/open.png">
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-sm-12" style="border: 1px solid #eee; padding: 10px 16px; font-size: 18px; line-height: 1.3333333; margin-left:80px;">
                                                有话说 <img style="float: right;width: 40px; height: 20px;" src="/img/open.png">
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-sm-12" style="border: 1px solid #eee; padding: 10px 16px; font-size: 18px; line-height: 1.3333333; margin-left:80px;">
                                                客服电话 <img style="float: right;width: 40px; height: 20px;" @if($merchant->disphone) src="/img/open.png" @else src="/img/close.png" @endif>
                                            </div>
                                        </div>

                                        <div class="row" style="padding-left: 145px; margin-top: 100px;">
                                            <div class="col-sm-6">
                                                <button id="cancel" type="button" class="btn btn-default btn-block">取消</button>
                                            </div>
                                            <div class="col-sm-6">
                                                <button id="confirm" type="button" class="btn btn-primary btn-block">确定</button>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </section>

                            {{--<a href="{{route('os.index')}}" class="btn btn-default">取消</a>--}}
                            {{--<button id="form_add" type="button" class="btn btn-primary pull-right">保存</button>--}}

                        </form>

                        <div id="kefu" style="display: none" class="box-header form-horizontal">
                            {{csrf_field()}}
                            <div class="box-body">
                                @foreach($kefu_phone as $value)
                                <div class="form-group">
                                    <label for="area" class="col-sm-1 control-label"></label>

                                    <div class="col-sm-10">
                                        <input name="kefu_phone[]" type="text" class="form-control" value="{{$value->tel}}" placeholder="请输入电话号码">
                                    </div>
                                </div>
                                @endforeach

                                <div class="form-group">
                                    <div class="col-sm-11 text-right">
                                        <button id="add_phone" class="btn btn-primary">+添加新号码</button>
                                    </div>
                                </div>
                            </div>
                            <div class="box-footer">
                                <a id="add_cancel" class="btn btn-default">取消</a>
                                <a id="add_confirm" class="btn btn-primary pull-right">确认</a>
                            </div>
                        </div>


                    </div>
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
<script>
    $(function () {
        var data = {
            'kefu': 'none',
            'raw_background': '{{$merchant->background}}',
            'raw_merchant_notice': '{{$merchant_notice}}',
            'raw_recoshowcase_type': '{{$merchant->recoshowcase_type}}',
            'raw_recoshowcaseInfo': '{{$merchant->recoshowcaseInfo}}',
            'background': '{{$merchant->background}}',
            'merchant_notice': '{{$merchant_notice}}',
            'recoshowcase_type': '{{$merchant->recoshowcase_type}}',
            'recoshowcaseInfo': '{{$merchant->recoshowcaseInfo}}'
        };

        // 顶部遮罩层事件
        $("#top").mouseover(function(){
            var height = $("#top").height();
            $("#top_mask").css('height', height);
            $("#top_mask").css('padding-top', height/2 - 13);
            $("#top_mask").show();
        });
        // 顶部遮罩层取消事件
        $("#top_mask").mouseout(function(){
            $("#top_mask").hide();
        });
        // 顶部背景选择
        $("#top_edit").click(function () {
            $("#store_setting").hide();
            $("#setting").hide();
            $("#operation").hide();
            $("#notice_content").hide();
            $("#top_carousel").show();
            $("#showcase_content").hide();
        });
        // 选择轮播图
        $(".carousel-inner img").click(function () {
            var img = $(this).attr('src');
            data.background = img;
            $("#top").css('background-image', "url("+ img +")");
        });
        // 取消轮播图选择
        $("#carousel_cancel").click(function () {
            data.background = data.raw_background;
            // 还原成本来的背景图
            $("#top").css('background-image', "url("+ data.raw_background +")");

            $("#top_carousel").hide();
            $("#store_setting").hide();
            $("#setting").show();
            $("#operation").hide();
            $("#notice_content").hide();
            $("#showcase_content").hide();
        });
        // 确认轮播图选择
        $("#carousel_confirm").click(function () {
            $("#top_carousel").hide();
            $("#store_setting").hide();
            $("#setting").show();
            $("#operation").hide();
            $("#notice_content").hide();
            $("#showcase_content").hide();
        });



        // 公告遮罩层事件
        $("#notice").mouseover(function(){
            var height = $("#notice").height();
            $("#notice_mask").css('height', height);
            $("#notice_mask").css('padding-top', height/2 - 13);
            $("#notice_mask").css('top', $("#top").height());
            $("#notice_mask").show();
        });
        // 公告遮罩层取消事件
        $("#notice_mask").mouseout(function(){
            $("#notice_mask").hide();
        });
        // 公告内容
        $("#notice_edit").click(function () {
            $("#store_setting").hide();
            $("#setting").hide();
            $("#operation").hide();
            $("#top_carousel").hide();
            $("#notice_content").show();
            $("#showcase_content").hide();
        });
        // 取消公告
        $("#notice_cancel").click(function () {
            $("#notice").find("div:last").text(data.raw_merchant_notice);
            data.merchant_notice = data.raw_merchant_notice;
            $("#notice_content").hide();
            $("#top_carousel").hide();
            $("#store_setting").hide();
            $("#setting").show();
            $("#operation").hide();
            $("#showcase_content").hide();
        });
        // 确认公告
        $("#notice_confirm").click(function () {
            var textarea = $("#notice_content").find("textarea").val();
            $("#notice").find("div:last").text(textarea);
            data.merchant_notice = textarea;
            $("#notice_content").hide();
            $("#top_carousel").hide();
            $("#store_setting").hide();
            $("#setting").show();
            $("#operation").hide();
            $("#showcase_content").hide();
        });



        // 橱窗遮罩层事件
        $("#showcase").mouseover(function(){
            var height = $("#showcase").height();
            $("#showcase_mask").css('height', height);
            $("#showcase_mask").css('padding-top', height/2 - 13);
            $("#showcase_mask").css('top', $("#showcase").position().top);
            $("#showcase_mask").show();
        });
        // 橱窗遮罩层取消事件
        $("#showcase_mask").mouseout(function(){
            $("#showcase_mask").hide();
        });
        // 橱窗内容
        $("#showcase_edit").click(function () {
            $("#store_setting").hide();
            $("#setting").hide();
            $("#operation").hide();
            $("#top_carousel").hide();
            $("#notice_content").hide();
            $("#showcase_content").show();
        });
        // 选择橱窗类型
        $('input[type="radio"]').click(function () {
            var type = $(this).val();
            data.recoshowcase_type = type;
            if (type == 1) {
                $("#recoshowcase_type_1").show();
                $("#recoshowcase_type_2").hide();
            } else {
                $("#recoshowcase_type_1").hide();
                $("#recoshowcase_type_2").show();
            }
        });
        // 橱窗图片
        $('#file').fileupload({
            url: "{{route('Uploader.uploadImg')}}",
            dataType: 'json',
            acceptFileTypes: /(\.|\/)(gif|jpe?g|png)$/i,
            maxFileSize: 2000000,
            add: function(e, dataResult) {
                var uploadErrors = [];
                var acceptFileTypes = /^image\/(gif|jpe?g|png)$/i;
                if(dataResult.originalFiles[0]['type'].length && !acceptFileTypes.test(dataResult.originalFiles[0]['type'])) {
                    uploadErrors.push('非图片格式,无法上传');

                }
                if(dataResult.originalFiles[0]['size'].length && dataResult.originalFiles[0]['size'] > 2000000) {
                    uploadErrors.push('文件太大');
                }
                if(uploadErrors.length > 0) {
                    layer.msg(uploadErrors.join("\n"));
                } else {
                    dataResult.submit();
                }
            },
            done: function (e, dataResult) {
                if (dataResult.result.msg == '未授权，请登录！') {
                    location.href="{{route('Login.showLogin')}}";
                }
                if (dataResult.result.status == 200) {
                    $("#recoshowcase_type_2").find("img").attr('src', dataResult.result.url);
                }else {
                    layer.msg(dataResult.result.error);
                }
            }

        });
        // 取消橱窗
        $("#showcase_cancel").click(function () {
            if (data.raw_recoshowcase_type == 1) {
                $("input[type='radio'][value='1']").attr('checked', true);
                $("input[type='radio'][value='2']").attr('checked', false);
                $("#recoshowcase_type_1").find("textarea").val(data.raw_recoshowcaseInfo);

                $("#showcase").find("div").children().remove();
                var html = '<textarea class="form-control" style="background-color: #fff; height: 150px;" readonly >'+ data.raw_recoshowcaseInfo +'</textarea>';
                $("#showcase").find("div").append(html);
            } else {
                $("input[type='radio'][value='2']").attr('checked', true);
                $("input[type='radio'][value='1']").attr('checked', false);
                $("#recoshowcase_type_2").find("img").attr('src', data.raw_recoshowcaseInfo);

                $("#showcase").find("div").children().remove();
                var html = '<img class="img-responsive" src="'+ data.raw_recoshowcaseInfo +'">';
                $("#showcase").find("div").append(html);
            }

            data.recoshowcase_type = data.raw_recoshowcase_type;
            data.recoshowcaseInfo = data.raw_recoshowcaseInfo;
            $("#notice_content").hide();
            $("#top_carousel").hide();
            $("#store_setting").hide();
            $("#setting").show();
            $("#operation").hide();
            $("#showcase_content").hide();
        });
        // 确认橱窗
        $("#showcase_confirm").click(function () {
            var type = $("input[type='radio']:checked").val();
            if (type == 1) {
                data.recoshowcaseInfo = $("#recoshowcase_type_1").find("textarea").val();

                $("#showcase").find("div").children().remove();
                var html = '<textarea class="form-control" style="background-color: #fff; height: 150px;" readonly >'+ data.recoshowcaseInfo +'</textarea>';
                $("#showcase").find("div").append(html);
            } else {
                data.recoshowcaseInfo = $("#recoshowcase_type_2").find("img").attr('src');

                $("#showcase").find("div").children().remove();
                var html = '<img class="img-responsive" src="'+ data.recoshowcaseInfo +'">';
                $("#showcase").find("div").append(html);
            }

            $("#notice_content").hide();
            $("#top_carousel").hide();
            $("#store_setting").hide();
            $("#setting").show();
            $("#operation").hide();
            $("#showcase_content").hide();
        });



        // 拨打电话
        $("#phone").click(function () {
            layer.open({
                title:'编辑客服电话',
                type: 1,
                skin: 'layui-layer-rim', //加上边框
                area: ['450px',''], //宽高
                content:$('#kefu')
            });
        });

        // 添加新号码
        $("#add_phone").click(function () {
            var add_btn = $(this).parents(".form-group");
            var kefu_html = add_btn.prev().clone();
            kefu_html.addClass('add');
            kefu_html.find("input").val('');

            if (!kefu_html.html()) {
                console.log('');
                kefu_html = '<div class="form-group add">';
                kefu_html += '<label for="area" class="col-sm-1 control-label"></label>';
                kefu_html += '<div class="col-sm-10">';
                kefu_html += '<input name="kefu_phone[]" type="text" class="form-control" value="" placeholder="请输入电话号码">';
                kefu_html += '</div>';
                kefu_html += '</div>';
            }
            add_btn.before(kefu_html);
        });

        // 取消添加新号码
        $("#add_cancel").click(function () {
            data.kefu = 'none';
            $(".add").remove();
            layer.closeAll();
        });

        // 确认添加新号码
        $("#add_confirm").click(function () {
            var tmp_phone = new Array();
            $("input[name='kefu_phone[]']").each(function () {
                if ($(this).val() != '') {
                    tmp_phone.push($(this).val());
                }
            });

            var sort_phone = tmp_phone.sort();
            var close = true;
            for(var i=0;i<sort_phone.length;i++){
                if (sort_phone[i] == sort_phone[i+1]){
                    close = false;
                }
            }

            if (close == true) {
                data.kefu = (sort_phone.length >= 1) ? sort_phone : '';
                layer.closeAll();
            } else {
                layer.alert('电话名不可重复！');
            }

        });


        // 模块设置
        $("#model_setting").click(function () {
            $("#store_setting").show();
            $("#setting").hide();
            $("#operation").show();
        });

        // 应用店铺设置
        $("#apply").click(function () {
            layer.confirm('是否确定应用到店铺', {
                btn: ['确定','取消'] //按钮
            }, function(){
                // TODO 保存修改的内容
                data.notice = ($("#operation").find("img").eq(0).attr('src') == '/img/open.png') ? 1 : 0;
                data.recoshowcase = ($("#operation").find("img").eq(1).attr('src') == '/img/open.png') ? 1 : 0;
                data.cxGood = ($("#operation").find("img").eq(2).attr('src') == '/img/open.png') ? 1 : 0;
                data.newGood = ($("#operation").find("img").eq(3).attr('src') == '/img/open.png') ? 1 : 0;
                data.hotGood = ($("#operation").find("img").eq(4).attr('src') == '/img/open.png') ? 1 : 0;
                data.disphone = ($("#operation").find("img").eq(7).attr('src') == '/img/open.png') ? 1 : 0;

                $.ajax({
                    url: "{{route('os.store')}}",
                    type: "post",
                    data: data,
                    dataType: 'json',
                    success: function (data) {
                        if (data.code == 0) {
                            layer.alert(data.message);
                            location.reload();
                        } else {
                            layer.alert(data.message);
                        }
                    }
                });

                layer.close();
            }, function(){
                layer.close();
            });
        });

        // 开启关闭相应模块按钮
        $("#operation").find("img").click(function () {
            var index = $("#operation img").index($(this));
            $(".sort").eq(index).toggle();
            if (index >= 5) {
                if ($("#bottom_list").is(":hidden")) {
                    $("#bottom_list").show();
                }
                var length = $(".sort:gt(4):visible").length;
                var styleClass = "sort col-xs-" + 12/length;
                $(".sort:gt(4):visible").removeClass().addClass(styleClass);

                if (length == 0) {
                    $("#bottom_list").hide();
                }
            }

            var src = $(this).attr('src');
            if ( src == "/img/open.png" ) {
                $(this).attr('src', "/img/close.png");
            } else {
                $(this).attr('src', "/img/open.png");
            }
        });

        // 取消
        $("#cancel").click(function () {
            $("#store_setting").hide();
            $("#setting").show();
            $("#operation").hide();
        });

        // 确定
        $("#confirm").click(function () {
            $("#store_setting").hide();
            $("#setting").show();
            $("#operation").hide();
        });
    });
</script>
@endsection