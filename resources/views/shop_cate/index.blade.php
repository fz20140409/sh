@extends('layout.index')
@section('title','商铺分类')
@section('module','商铺分类')
@section('op','列表')
@section('content')
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <!--box-header-->
                    <div class="box-header">
                        <div class="row">
                            <div class=" col-lg-offset-10 col-lg-2 col-xs-2 col-xs-offset-8">
                                <button onclick="show_create()" class="btn btn-primary">新增</button>
                            </div>
                        </div>
                    </div>
                    <!--box-header-->
                    <!--box-body-->

                    <div class="box-body  no-padding">
                        <div class="table-header">
                            <div class="th1">分类名称</div>
                            <div class="th2">排序</div>
                            <div class="th3">创建时间</div>
                            <div class="th4">商品数量</div>
                            <div class="th5">操作</div>
                        </div>
                        @if(count($info) > 0)
                        @foreach($info as $item)
                            <div class="table-body">

                                <div class="table-tr" flag="1">
                                    <div class="th1"><a class="flex"><i class="fa  fa-caret-right"
                                                                                    aria-hidden="true"></i></a>{{$item['sc_name']}}
                                    </div>
                                    <div class="p_th2 th2">


                                        @if ($loop->first)
                                            <a class="p_down"><i class="fa fa-long-arrow-down" aria-hidden="true"></i></a>
                                            @elseif($loop->last)
                                            <a class="p_up"><i class="fa fa-long-arrow-up" aria-hidden="true"></i></a>
                                            @else
                                            <a class="p_down"><i class="fa fa-long-arrow-down" aria-hidden="true"></i></a>
                                            <a class="p_up"><i class="fa fa-long-arrow-up" aria-hidden="true"></i></a>
                                            @endif

                                    </div>
                                    <div class="th3">{{$item['createtime']}}</div>
                                    <div class="th4">11</div>
                                    <div class="th5">
                                        <a href="javascript:edit('{{route('ShopCate.edit',$item['id'])}}')">修改分类</a>
                                        <a href="javascript:destroy('{{route('ShopCate.destroy',$item['id'])}}')">删除分类</a>
                                        <a href="javascript:show_sub('{{route('ShopCate.createSub',$item['id'])}}','{{$item['id']}}')">添加子分类</a>
                                    </div>
                                </div>
                                @if(!empty($item['child']))
                                    @foreach($item['child'] as $item2)
                                        <div class="table-tr">
                                            <div class="th1 for-th1">{{$item2['sc_name']}}</div>
                                            <div class="c_th2 th2">
                                                @if ($loop->first)
                                                    <a class="c_down"><i class="fa fa-long-arrow-down" aria-hidden="true"></i></a>
                                                @elseif($loop->last)
                                                    <a class="c_up"><i class="fa fa-long-arrow-up" aria-hidden="true"></i></a>
                                                @else
                                                    <a class="c_down"><i class="fa fa-long-arrow-down" aria-hidden="true"></i></a>
                                                    <a class="c_up"><i class="fa fa-long-arrow-up" aria-hidden="true"></i></a>
                                                @endif
                                            </div>
                                            <div class="th3">{{$item2['createtime']}}</div>
                                            <div class="th4">11</div>
                                            <div class="th5">
                                                <a href="javascript:edit('{{route('ShopCate.edit',$item2['id'])}}')">修改分类</a>
                                                <a href="javascript:destroy('{{route('ShopCate.destroy',$item2['id'])}}')">删除分类</a>
                                                <a href="javascript:changeOne({{$item2['id']}})">变为一级</a>
                                                <a href="{{route('ShopCate.goodsManage',$item2['id'])}}">商品管理</a>
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                        @endforeach
                        @else
                            <div class="col-xs-12 text-center">
                                <div style="margin-top: 30px">
                                    <img src="/img/no.jpg">
                                </div>
                                <h5>暂无查询记录</h5>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--添加分类-->
    <section id="create" style="display: none;">
        <form id="form">
            <div class="box-body">
                <div class="form-group">
                    <label>上级分类</label>
                    <select name="pid" class="form-control">
                        <option value="0">一级分类</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>分类名称</label>
                    <input name="catename" type="text" class="form-control" maxlength="10">
                </div>
            </div>
            <!-- /.box-body -->

            <div class="box-footer">
                <button id="create_cancel" type="button" class="btn btn-default">取消</button>
                <button id="create_save" type="button" class="btn btn-primary pull-right">保存</button>
            </div>
        </form>
    </section>
@endsection
@section('js')
    <script>
        //添加子分类
        function show_sub(url,id) {
            $.ajax({
                url: url,
                type: 'GET',
                success: function (response) {
                    var data = response.data;
                    var str = "";
                    if (data.length != 0) {
                        $.each(data, function (k, v) {
                            str += '<option value="' + v.cat_id + '">' + v.sc_name + '</option>';

                        });
                        $("#form select[name='pid'] option:gt(0)").remove();
                        $("#form select[name='pid']").append(str);
                        $("#form select[name='pid'] option[value='"+id+"']").attr('selected','selected');
                    }
                    var index = layer.open({
                        area: ['400px', ''],
                        type: 1 //Page层类型
                        , title: false,
                        closeBtn: 0
                        , shade: 0.6 //遮罩透明度
                        , maxmin: false //允许全屏最小化
                        , anim: 1 //0-6的动画形式，-1不开启
                        , content: $("#create")
                    });
                    $("#create_cancel").unbind('click');
                    $("#create_cancel").click(function () {
                        //清空表单
                        document.getElementById('form').reset();
                        layer.close(index);
                    });
                    $("#create_save").unbind('click');
                    $("#create_save").click(function () {
                        $.ajax({
                            url: "{{route('ShopCate.store')}}",
                            data: $("#create form").serialize(),
                            type: 'POST',
                            success: function (response) {
                                if (response.status == 0) {
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
            })
        }
        //添加分类
        function show_create() {
            $.ajax({
                url: "{{route('ShopCate.create')}}",
                type: 'GET',
                success: function (response) {
                    var data = response.data;
                    var str = "";
                    if (data.length != 0) {
                        $.each(data, function (k, v) {
                            str += '<option value="' + v.cat_id + '">' + v.sc_name + '</option>';

                        });
                        $("#form select[name='pid'] option:gt(0)").remove();
                        $("#form select[name='pid']").append(str);
                    }
                    var index = layer.open({
                        area: ['400px', ''],
                        type: 1 //Page层类型
                        , title: false,
                        closeBtn: 0
                        , shade: 0.6 //遮罩透明度
                        , maxmin: false //允许全屏最小化
                        , anim: 1 //0-6的动画形式，-1不开启
                        , content: $("#create")
                    });
                    $("#create_cancel").unbind('click');
                    $("#create_cancel").click(function () {
                        //清空表单
                        document.getElementById('form').reset();
                        layer.close(index);
                    });
                    $("#create_save").unbind('click');
                    $("#create_save").click(function () {
                        $.ajax({
                            url: "{{route('ShopCate.store')}}",
                            data: $("#create form").serialize(),
                            type: 'POST',
                            success: function (response) {
                                if (response.status == 0) {
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
            });
        }
        //删除分类
        function destroy(url) {
            layer.confirm('确认删除?', {
                btn: ['确认', '取消'], closeBtn: 0
            }, function () {
                $.ajax({
                    url: url,
                    type: 'DELETE',
                    success: function (response) {
                        if (response.status == 1) {
                            //有子分类
                            layer.confirm(response.msg, {
                                btn: ['确认', '取消'], closeBtn: 0
                            }, function () {
                                $.ajax({
                                    url: url,
                                    type: 'DELETE',
                                    data: {'flag': response.flag},
                                    success: function (response) {
                                        if (response.status == 0) {
                                            location.reload();
                                            layer.msg(response.msg);
                                        } else {
                                            layer.msg(response.msg);
                                        }

                                    }

                                })

                            })
                        } else {
                            if (response.status == 0) {
                                location.reload();
                                layer.msg(response.msg);
                            } else {
                                layer.msg(response.msg);
                            }
                        }
                    }

                })
            })
        }
        //修改
        function edit(url) {

            $.ajax({
                url: url,
                type: 'GET',
                success: function (response) {
                    var data = response.data;
                    var shopclassify = response.shopclassify;
                    console.log(shopclassify);
                    var str = "";
                    if (data.length != 0) {
                        if(shopclassify.parent_id!=0){
                            $.each(data, function (k, v) {
                                str += '<option value="' + v.cat_id + '">' + v.sc_name + '</option>';

                            });
                            $("#form select[name='pid'] option:gt(0)").remove();
                            $("#form select[name='pid']").append(str);
                            //设置选中
                            $("#form select[name='pid'] option[value='"+shopclassify.parent_id+"']").attr('selected','selected');
                        }else {
                            $("#form select[name='pid'] option:gt(0)").remove();
                        }
                        $("#form input[name='catename']").val(shopclassify.sc_name);

                    }
                    var index = layer.open({
                        area: ['400px', ''],
                        type: 1 //Page层类型
                        , title: false,
                        closeBtn: 0
                        , shade: 0.6 //遮罩透明度
                        , maxmin: false //允许全屏最小化
                        , anim: 1 //0-6的动画形式，-1不开启
                        , content: $("#create")
                    });
                    $("#create_cancel").click(function () {
                        //清空表单
                        document.getElementById('form').reset();
                        layer.close(index);
                    });
                    $("#create_save").click(function () {
                        $.ajax({
                            url: "{{route('ShopCate.index')}}/"+shopclassify.cat_id,
                            data: $("#create form").serialize(),
                            type: 'PUT',
                            success: function (response) {
                                if (response.status == 0) {
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
            })
        }
        
        //变为一级分类
        function changeOne(id) {
            $.ajax({
                url:"{{route('ShopCate.changeOne')}}",
                data:{'id':id},
                type:"POST",
                success:function (response) {
                    if (response.status == 0) {

                        location.reload();
                        layer.msg(response.msg);

                    }
                }

            })
        }


        //伸缩
        /*function flex() {
         if ($('.table-body .table-tr').length > 1) {
         if ($('.table-body .table-tr:first').attr('flag') == 1) {
         //已经展开
         $('.table-body .table-tr:gt(0)').hide();
         $('.table-body .table-tr:first').attr('flag', 2)
         } else {
         $('.table-body .table-tr:gt(0)').show();
         $('.table-body .table-tr:first').attr('flag', 1)
         }

         }
         }*/
        $('.flex').each(function () {
           $(this).click(function () {
               var p=$(this).closest('.table-body');
              if(p.find('.table-tr').length>1){
                  //合拢
                  p.find('.table-tr:gt(0)').hide();

              }else {
                  //展开
                  p.find('.table-tr:gt(0)').show();

              }
           })
        })
        

    </script>
    <script>
        var down=$('.table-body:first .p_down');
        var up=$('.table-body:last .p_up');
        $('.p_th2').each(function () {
           $(this).on("click",".p_down",function () {
                //父级下沉
                var current=$(this).closest('.table-body');
                var next=current.next('.table-body');

                next.insertBefore(current);//当前元素下

                if(next.is($('.table-body:first'))){
                    //top
                    next.find('.p_up').remove();
                }else{
                    next.find('.p_up').remove();
                    next.find('.p_down').remove();
                    next.find('.p_th2').append(down.clone(true));
                    next.find('.p_th2').append(up.clone(true))

                }
                if(current.is($('.table-body:last'))){
                    //top
                    current.find('.p_down').remove();
                }else{

                    current.find('.p_up').remove();
                    current.find('.p_down').remove();
                    current.find('.p_th2').append(down.clone(true));
                    current.find('.p_th2').append(up.clone(true))

                }

            })
        });

        $('.p_th2').each(function () {
            $(this).on("click",".p_up",function () {
                //父级上沉
                var current=$(this).closest('.table-body');
                var prev=current.prev('.table-body');//前一个元素

                current.insertBefore(prev);//当前元素上
                //当前元素
                if(current.is($('.table-body:first'))){
                    //top
                    current.find('.p_up').remove();
                }else{
                    current.find('.p_up').remove();
                    current.find('.p_down').remove();
                    current.find('.p_th2').append(down.clone(true));
                    current.find('.p_th2').append(up.clone(true))

                }
                //前一个元素
                if(prev.is($('.table-body:last'))){
                    //top
                    prev.find('.p_down').remove();
                }else{
                    prev.find('.p_up').remove();
                    prev.find('.p_down').remove();
                    prev.find('.p_th2').append(down.clone(true));
                    prev.find('.p_th2').append(up.clone(true))

                }

            })
        });
    </script>
@endsection

@section('css')
    <link rel="stylesheet" href="/css/shop_cate.css">
@endsection