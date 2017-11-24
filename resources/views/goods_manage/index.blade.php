@extends('layout.index')
@section('title','商品列表')
@section('module','商品')
@section('op','列表')

@section('content')
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <!--box-header-->
                    <div class="box-header">
                        <form class="form-inline" action="{{route('GoodsManage.index')}}">
                        <div class="row">
                            <div class="input-group col-lg-offset-9  col-lg-3  ">
                                <input value="{{$goods_name}}" name="goods_name" type="text" class="form-control" placeholder="商品名称">
                                <span class="input-group-btn">
                                    <button class="btn btn-default" type="submit"><i class="fa fa-search" aria-hidden="true"></i></button>
                                </span>
                            </div>
                        </div>
                        </form>
                        <div class="row">
                            <div class="col-lg-12">
                                <ul id="tab" class="nav nav-tabs">
                                    <li role="presentation" class="active"><a href="{{route('GoodsManage.index')}}?state=-1">全部</a></li>
                                    <li role="presentation"><a href="{{route('GoodsManage.index')}}?state=1">正在卖</a></li>
                                    <li role="presentation"><a href="{{route('GoodsManage.index')}}?state=3">不卖了</a></li>
                                </ul>
                            </div>

                        </div>



                    </div>
                    <!--box-header-->
                    <!--box-body-->
                    <form id="ids">
                        <div class="box-body table-responsive no-padding">
                            <div id="batch">
                                    <input id="all" class="minimal" type="checkbox" style="margin-left: 5px">全选
                                    <button onclick="show_create()" type="button" class="btn btn-default">批量分类</button>
                                    <button onclick="batch_op(2)" id="sj" type="button" class="btn btn-default">批量上架</button>
                                    <button onclick="batch_op(3)" id="xj" type="button" class="btn btn-default">批量下架</button>
                                    <button onclick="batch_op(4)" type="button" class="btn btn-default">批量删除</button>
                                    <a href="{{route('GoodsManage.exportData')}}" style="float: right;margin-right: 18%" type="button" class="btn btn-default">导出商品</a>

                            </div>

                            @if(count($info) > 0)
                                <table class="table table-hover">
                                    <tr>
                                        <th></th>
                                        <th>序号</th>
                                        <th>商品描述</th>
                                        <th>价格</th>
                                        <th>销量<span class="arrow"><a href="{{route('GoodsManage.index')}}?sell_count=1&state={{$state}}&goods_name={{$goods_name}}"><i class="fa fa-long-arrow-down" aria-hidden="true"></i></a><a href="{{route('GoodsManage.index')}}?sell_count=2&state={{$state}}&goods_name={{$goods_name}}"><i class="fa fa-long-arrow-up" aria-hidden="true"></i></a></span></th>
                                        <th>库存<span class="arrow"><a href="{{route('GoodsManage.index')}}?kc=1&state={{$state}}&goods_name={{$goods_name}}"><i class="fa fa-long-arrow-down" aria-hidden="true"></i></a><a href="{{route('GoodsManage.index')}}?kc=2&state={{$state}}&goods_name={{$goods_name}}"><i class="fa fa-long-arrow-up" aria-hidden="true"></i></a></span></th>
                                        <th width="13%">分类</th>
                                        <th>状态</th>
                                        <th>修改时间</th>
                                        <th width="10%">操作</th>
                                    </tr>
                                    @foreach($info as $k=>$v)
                                    <tr>

                                        <td><input name="ids[]" class="minimal" type="checkbox" value="{{$v->goods_id}}"></td>
                                        <td>{{$k+1+($info->currentPage() -1)*$info->perPage()}}</td>
                                        <td width="35%">
                                            <div class="media">
                                                <div class="media-left">
                                                    <a href="{{$v->img}}">
                                                        <img width="100px" class="media-object" src="{{$v->img}}" title="点我查看大图">
                                                    </a>
                                                </div>
                                                <div class="media-body">
                                                        @if($v->is_cuxiao)
                                                        <span style="color: red">【促销商品】</span>
                                                        @endif @if($v->is_new)
                                                                <span style="color: red"> 【新品推荐】</span>
                                                        @endif @if($v->is_hot)
                                                                <span style="color: red"> 【热销推荐】</span>
                                                        @endif
                                                   <p>{{$v->goods_name}}</p>
                                                    {{$v->goods_smallname}}
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <p style="color: red">{{$v->a_price}}</p>
                                            <p style="color: red">{{$v->a_changeprice}}</p>

                                        </td>
                                        <td>{{$v->sell_count}}</td>
                                        <td>
                                            <p style="color:#1f648b">{{$v->a_kc}}</p>
                                            <p style="color: #1f648b">{{$v->a_changekc}}</p>
                                        </td>
                                        <td>
                                            @if(!empty($v->cate))
                                                @foreach(explode(',',$v->cate) as $s)
                                                    <p>{{$s}}</p>
                                                @endforeach
                                            @endif
                                        </td>
                                        <td>@if($v->state==1) 上架 @elseif($v->state==3)下架 @else @endif</td>
                                        <td>{{$v->createtime}}</td>
                                        <td class="op">
                                            <p><a href="{{route('GoodsManage.edit',$v->goods_id)}}">编辑</a></p>
                                            <p><a>@if($v->state==1) <a href="javascript:op(1,'{{$v->goods_id}}')">不卖了</a> @elseif($v->state==3) <a href="javascript:op(2,'{{$v->goods_id}}')">继续卖</a> @else @endif</a></p>

                                            <p><a href="javascript:del({{$v->goods_id}})">删除</a></p>
                                            <div class="ff" style="position: relative;">
                                                <a class="" >分享</a>
                                                <div style="display: none;position: absolute;top: -80px; left: -110px" class="text-center fx">
                                                    <?php
                                                        $uid=session('uid');
                                                        $url="http://ks.fjmaimaimai.com:8588/shareNew/#/ProDetails?uid=$uid&good_id=$v->goods_id"
                                                    ?>
                                                    {!! QrCode::size(100)->color(255,0,255)->generate($url) !!}
                                                </div>

                                            </div>

                                        </td>
                                    </tr>
                                    @endforeach
                                </table>
                            @else
                                <div class="col-xs-12 text-center">
                                    <div>
                                        <img src="/img/no.jpg">
                                    </div>
                                    <h5>暂无查询记录</h5>
                                </div>
                            @endif

                        </div>
                    </form>
                    <!--box-body-->
                    <!--box-footer-->
                    <div class="box-footer ">
                        <div style="float: right">
                            {{$info->appends($where_link)->links()}}
                        </div>
                    </div>
                    <!--box-footer-->
                </div>
            </div>
        </div>
    </section>

    <section id="create" style="display: none;">
        <form id="form">
            <div class="box-body">
                {{--<div class="form-group">
                    <label>上级分类</label>
                    <select name="pid" class="form-control">
                        <option value="0">一级分类</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>分类名称</label>
                    <input name="catename" type="text" class="form-control" maxlength="10">
                </div>--}}
                <div class="form-group">
                    <div class="col-sm-12">
                        @if(count($shopclassify)>0)
                        <div style="border: 1px solid #e6e6e6;padding:0 10px;overflow-y:auto;max-height: 500px">
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

                        <div class="form-group" style="padding-top: 20px;">
                            <input id="fl" class="form-control" style="display: inline-block; width: 200px;" type="text" placeholder="输入新分类名称" autofocus />
                            <a class="btn btn-primary" style="margin-top: -3px;" href="javascript:add_fl();">新增</a>
                        </div>

                    </div>
                </div>
            </div>
            <!-- /.box-body -->

            <div class="box-footer">
                <button id="create_cancel" type="button" class="btn btn-default">取消</button>
                <button id="create_save" type="button" class="btn btn-primary pull-right">保存</button>
            </div>
        </form>
@endsection


@section('js')
    <script>
        //批量分类
        function show_create() {
            $cbs = $('table input[class="minimal"]:checked');
            if ($cbs.length <= 0) {
                layer.msg('请选中商品');
                return false;
            }


            var index = layer.open({
                area: ['700px', ''],
                type: 1 //Page层类型
                , title: '选择分类',
                closeBtn: 0
                , shade: 0.6 //遮罩透明度
                , maxmin: false //允许全屏最小化
                , anim: 1 //0-6的动画形式，-1不开启
                , content: $("#create")
            });

            $("#create_cancel").unbind('click');
            $("#create_cancel").click(function () {
                //清空表单
                $('#form input[class="minimal"]:checked').iCheck('uncheck');
                layer.close(index);
            });
            $("#create_save").unbind('click');
            $("#create_save").click(function () {
                var data=$("#create form").serialize()+'&'+$("#ids").serialize();
                $.ajax({
                    url: "{{route('GoodsManage.batchCate')}}",
                    data: data,
                    type: 'POST',
                    success: function (response) {
                        if (response.status == 200) {
                            layer.close(index);
                            location.reload();
                            layer.msg(response.msg);

                        } else {
                            layer.msg(response.msg);
                        }
                    }

                });
            });
        }

        function add_fl() {
            var cat_name = $.trim($("#fl").val());
            if (cat_name == '') {
                layer.msg('分类名称不可为空！');
                return false;
            }

            var exist_cat_name = new Array();
            $(".cat_p").each(function () {
                exist_cat_name.push($.trim($(this).text()));
            });

            for(var i=0;i<exist_cat_name.length;i++){
                if (exist_cat_name[i] == cat_name){
                    layer.msg('分类名称不可重复！');
                    return false
                }
            }

            var insert_id;
            $.ajax({
                url: "{{route('ShopCate.store')}}",
                data: {catename: cat_name},
                async: false,
                type: 'POST',
                success: function (response) {
                    if (response.status == 0) {
                        insert_id = response.insert_id;
                    } else {
                        insert_id = false;
                        layer.msg(response.msg);
                    }
                }

            });

            if (insert_id === false) {
                return false;
            }

            var html = '<hr />';
                html += '<div class="cat_p" style="padding: 10px 0px;margin-bottom: 10px">';
                html += '<input class="minimal" name="cat_ids[]" type="checkbox" value="'+ insert_id +'">' + cat_name;
                html += '</div>';

            $(".cat_p").parent().append(html);
            $('input[type="checkbox"].minimal').iCheck({
                checkboxClass: 'icheckbox_minimal-blue',
                radioClass: 'iradio_minimal-blue'
            });
        }

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
        @if($state==-1)
                //全部
        $('#tab li').removeClass('active');
        $('#tab li:eq(0)').addClass('active');
        $('#xj').show();
        $('#sj').show();


        @elseif($state==1)
                //正在卖
        $('#tab li').removeClass('active');
        $('#tab li:eq(1)').addClass('active');
        $('#xj').show();
        $('#sj').hide();

        @elseif($state==3)
                //不卖了
        $('#tab li').removeClass('active');
        $('#tab li:eq(2)').addClass('active');
        $('#xj').hide();
        $('#sj').show();

        @endif

        @if(isset($sell_count)&&$sell_count==1)
        //销量下
            $('.arrow a').removeClass('arrow_active')
            $('.arrow a:eq(0)').addClass('arrow_active');
        @endif
        @if(isset($sell_count)&&$sell_count==2)
        //销量上
            $('.arrow a').removeClass('arrow_active')
            $('.arrow a:eq(1)').addClass('arrow_active');
        @endif

        @if(isset($kc)&&$kc==1)
        //库存下
            $('.arrow a').removeClass('arrow_active')
            $('.arrow a:eq(2)').addClass('arrow_active');
        @endif

        @if(isset($kc)&&$kc==2)
            //库存上
            $('.arrow a').removeClass('arrow_active')
            $('.arrow a:eq(3)').addClass('arrow_active');
        @endif
    </script>
    <script src="/adminlte/plugins/iCheck/icheck.min.js"></script>
    <script>
        $('input[type="checkbox"].minimal').iCheck({
            checkboxClass: 'icheckbox_minimal-blue',
            radioClass: 'iradio_minimal-blue'
        });
        $('#all').on('ifChanged',function () {
            if($('#all').is(":checked")){
                $('table input[type="checkbox"].minimal').iCheck('check')
            }else {
                $('table input[type="checkbox"].minimal').iCheck('uncheck')
            }
        })

    </script>
    <script>
        $('.ff').each(function () {
            $(this).hover(function () {
                $(this).find('.fx').show();
            },function () {
                $(this).find('.fx').hide();
            })
        })
        function op(op,id) {
            $.ajax({
                url: '{{route('GoodsManage.op')}}',
                type: 'post',
                data: {'op':op,'id':id},
                success: function (response) {
                    if(response.status==200){
                        layer.msg(response.msg);
                        location.reload();
                    }else {
                        layer.msg(response.msg);
                    }
                }
            });

        }

        function del(id) {
            layer.confirm('商品删除后不能恢复，确认删除？', {
                btn: ['确认', '取消']
            },function () {
                $.ajax({
                    url: '{{route('GoodsManage.destroy')}}',
                    type: 'post',
                    data: {'id':id},
                    success: function (response) {
                        if(response.status==200){
                            layer.msg(response.msg);
                            location.reload();
                        }else {
                            layer.msg(response.msg);
                        }

                    }
                });
            });


        }
        function batch_op(id) {
            if(id==2){
                //批量上架
                $cbs = $('table input[class="minimal"]:checked');
                if ($cbs.length > 0) {
                    layer.confirm('上架后店铺将展示这些商品，确认上架？', {
                        btn: ['确认', '取消']
                    },function () {
                        $.ajax({
                            url: '{{route('GoodsManage.batchUp')}}',
                            type: 'post',
                            data: $("#ids").serialize(),
                            success: function (response) {
                                if(response.status==200){
                                    layer.msg(response.msg);
                                    location.reload();
                                }else {
                                    layer.msg(response.msg);
                                }

                            }
                        });
                    });

                } else {layer.msg('请选中商品');}};
            if(id==3){
                //批量下架
                $cbs = $('table input[class="minimal"]:checked');
                if ($cbs.length > 0) {
                    layer.confirm('下架后店铺将不再展示这些商品，确认下架？', {
                        btn: ['确认', '取消']
                    },function () {
                        $.ajax({
                            url: '{{route('GoodsManage.batchDown')}}',
                            type: 'post',
                            data: $("#ids").serialize(),
                            success: function (response) {
                                if(response.status==200){
                                    layer.msg(response.msg);
                                    location.reload();
                                }else {
                                    layer.msg(response.msg);
                                }

                            }
                        });
                    });

                } else {layer.msg('请选中商品');}};
            if(id==4){
                //批量删除
                $cbs = $('table input[class="minimal"]:checked');
                if ($cbs.length > 0) {
                    layer.confirm('商品批量删除后不能恢复，确认删除？', {
                        btn: ['确认', '取消']
                    },function () {
                        $.ajax({
                            url: '{{route('GoodsManage.batchDestroy')}}',
                            type: 'post',
                            data: $("#ids").serialize(),
                            success: function (response) {
                                if(response.status==200){
                                    layer.msg(response.msg);
                                    location.reload();
                                }else {
                                    layer.msg(response.msg);
                                }

                            }
                        });
                    });

                } else {layer.msg('请选中商品');}}
        }
    </script>
    <script>
        $('.sidebar-menu #goods_mg').addClass('active');
    </script>
@endsection
@section('css')
    <link rel="stylesheet" href="/adminlte/plugins/iCheck/all.css">
<style>
    #batch{
        margin: 10px 8px;
        padding: 10px 0px;
        background: #f4f5f9;
    }
    #batch button{
        margin-left: 20px;
    }
    /*.op a{
        margin-right: 6px;
    }*/
    .arrow{
        margin-left: 3px;
    }
    .arrow a{
        margin-right: 4px;
        color: #9BA2AB;
    }
    .arrow_active{
        color: #3c8dbc !important;
    }

</style>
@endsection()
