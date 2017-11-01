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
                                        <div id="module" style="min-height: 700px;border: 1px solid #d2d6de;overflow-y: auto;max-height: 1000px">

                                            <div class="row text-center sort">
                                                <div class="col-xs-2" style="padding-right: 0px; font-size: 25px;">
                                                   <
                                                </div>
                                                <div class="col-xs-7" style="padding-left: 0px;">
                                                    <input type="text" readonly class="form-control">
                                                </div>
                                                <div class="col-xs-3" style="padding-left: 0px;">
                                                    <img style="display: inline-block;width: 48%; height: 33px;" src="http://www.baidu.com/img/wanshengdoodle_677234cad70a5974a64e4665c6485c71.gif">
                                                    <img style="display: inline-block;width: 47%; height: 33px;" src="http://www.baidu.com/img/wanshengdoodle_677234cad70a5974a64e4665c6485c71.gif">
                                                </div>
                                                <div class="col-xs-12" style="height: 50px;"></div>

                                                <div class="col-xs-3">
                                                    <img class="img-responsive" style="height: 50px" src="http://www.baidu.com/img/wanshengdoodle_677234cad70a5974a64e4665c6485c71.gif">
                                                </div>
                                                <div class="col-xs-9 text-left" style="padding-left: 0px;">
                                                    <div class="col-xs-8" style="padding: 0px;">福州素天下食品有限公司</div>
                                                    <div class="col-xs-4"><button type="button" class="btn btn-default btn-xs">已在乎</button></div>
                                                    <div class="col-xs-4" style="padding: 0px;">诚信值</div>
                                                    <div class="col-xs-8"><img style="width:100px; height: 24px" src="http://www.baidu.com/img/wanshengdoodle_677234cad70a5974a64e4665c6485c71.gif"></div>
                                                </div>
                                            </div>

                                            <div class="row sort" style="border: 1px solid #eee">
                                                <div class="col-xs-3">
                                                    <img class="img-responsive" style="height: 50px" src="http://www.baidu.com/img/wanshengdoodle_677234cad70a5974a64e4665c6485c71.gif">
                                                </div>
                                                <div class="col-xs-9" style="padding-left: 0px;">
                                                    魔芋食品，大豆蛋白制品
                                                </div>
                                            </div>

                                            <div class="row sort">
                                                <div class="col-xs-12">
                                                    <img class="img-responsive" src="http://www.baidu.com/img/wanshengdoodle_677234cad70a5974a64e4665c6485c71.gif">
                                                </div>
                                            </div>

                                            <div class="row text-center sort">
                                                <div class="col-xs-4" style="padding-right: 0px; padding-left: 30px;">
                                                    <hr class="menu_btn">
                                                </div>
                                                <div class="col-xs-4"  style="line-height: 3;">
                                                    新品推荐
                                                </div>
                                                <div class="col-xs-4" style="padding-right: 30px; padding-left: 0px;">
                                                    <hr class="menu_btn">
                                                </div>

                                                <div class="col-xs-6" style="padding-left: 30px;">
                                                    <img class="img-responsive" src="http://www.baidu.com/img/wanshengdoodle_677234cad70a5974a64e4665c6485c71.gif">
                                                </div>
                                                <div class="col-xs-6" style="padding-right: 30px;">
                                                    <img class="img-responsive" src="http://www.baidu.com/img/wanshengdoodle_677234cad70a5974a64e4665c6485c71.gif">
                                                </div>
                                                <div class="col-xs-6" style="padding-left: 30px;">素天下百叶豆腐200g</div>
                                                <div class="col-xs-6 " style="padding-right: 30px;">福林天下百叶豆腐400g</div>
                                            </div>

                                            <div class="row text-center sort">
                                                <div class="col-xs-4" style="padding-right: 0px; padding-left: 30px;">
                                                    <hr class="menu_btn">
                                                </div>
                                                <div class="col-xs-4" style="line-height: 3;">
                                                    热销商品
                                                </div>
                                                <div class="col-xs-4" style="padding-right: 30px; padding-left: 0px;">
                                                    <hr class="menu_btn">
                                                </div>

                                                <div class="col-xs-6" style="padding-left: 30px;">
                                                    <img class="img-responsive" src="http://www.baidu.com/img/wanshengdoodle_677234cad70a5974a64e4665c6485c71.gif">
                                                </div>
                                                <div class="col-xs-6 " style="padding-right: 30px;">
                                                    <img class="img-responsive" src="http://www.baidu.com/img/wanshengdoodle_677234cad70a5974a64e4665c6485c71.gif">
                                                </div>

                                                <div class="col-xs-6" style="padding-left: 30px;">素天下百叶豆腐200g</div>
                                                <div class="col-xs-6" style="padding-right: 30px;">福林天下百叶豆腐400g</div>
                                            </div>

                                            <div id="bottom_list" class="navbar navbar-default navbar-fixed-bottom" style="position: absolute;min-height: 30px;border-width: 1px;">
                                                <div class="row text-center" style="margin:0px;">
                                                    <div class="col-xs-4 sort" style="padding: 10px; border-right: 1px solid #d2d6de;">在线下单</div>
                                                    <div class="col-xs-4 sort" style="padding: 10px;">有话说</div>
                                                    <div class="col-xs-4 sort" style="padding: 10px; border-left: 1px solid #d2d6de;">拨打电话</div>
                                                </div>
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
                                                店铺公告 <img style="float: right;width: 40px; height: 20px;" src="http://www.baidu.com/img/wanshengdoodle_677234cad70a5974a64e4665c6485c71.gif">
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-sm-12" style="border: 1px solid #eee; padding: 10px 16px; font-size: 18px; line-height: 1.3333333; margin-left:80px;">
                                                推荐橱窗 <img style="float: right;width: 40px; height: 20px;" src="http://www.baidu.com/img/wanshengdoodle_677234cad70a5974a64e4665c6485c71.gif">
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-sm-12" style="border: 1px solid #eee; padding: 10px 16px; font-size: 18px; line-height: 1.3333333; margin-left:80px;">
                                                促销商品 <img style="float: right;width: 40px; height: 20px;" src="http://www.baidu.com/img/wanshengdoodle_677234cad70a5974a64e4665c6485c71.gif">
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-sm-12" style="border: 1px solid #eee; padding: 10px 16px; font-size: 18px; line-height: 1.3333333; margin-left:80px;">
                                                新品推荐 <img style="float: right;width: 40px; height: 20px;" src="http://www.baidu.com/img/wanshengdoodle_677234cad70a5974a64e4665c6485c71.gif">
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-sm-12" style="border: 1px solid #eee; padding: 10px 16px; font-size: 18px; line-height: 1.3333333; margin-left:80px;">
                                                热销推荐 <img style="float: right;width: 40px; height: 20px;" src="http://www.baidu.com/img/wanshengdoodle_677234cad70a5974a64e4665c6485c71.gif">
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-sm-12" style="border: 1px solid #eee; padding: 10px 16px; font-size: 18px; line-height: 1.3333333; margin-left:80px;">
                                                我要下单 <img style="float: right;width: 40px; height: 20px;" src="http://www.baidu.com/img/wanshengdoodle_677234cad70a5974a64e4665c6485c71.gif">
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-sm-12" style="border: 1px solid #eee; padding: 10px 16px; font-size: 18px; line-height: 1.3333333; margin-left:80px;">
                                                有话说 <img style="float: right;width: 40px; height: 20px;" src="http://www.baidu.com/img/wanshengdoodle_677234cad70a5974a64e4665c6485c71.gif">
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-sm-12" style="border: 1px solid #eee; padding: 10px 16px; font-size: 18px; line-height: 1.3333333; margin-left:80px;">
                                                客服电话 <img style="float: right;width: 40px; height: 20px;" src="http://www.baidu.com/img/wanshengdoodle_677234cad70a5974a64e4665c6485c71.gif">
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
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection

@section('js')
<script>
    $(function () {
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
            // TODO 切换图片
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