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
                        <form id="form">
                            <div style="border: 1px solid #e4e4e4; margin-top: 5px;background: #f7f7f7;">

                                <div class="table-tr">
                                    <div class="th1">
                                        <a class="flex">
                                            <i class="fa fa-caret-down" aria-hidden="true"></i>
                                            <i style="display: none"  class="fa  fa-caret-right" aria-hidden="true"></i>
                                        </a>未分类
                                    </div>
                                    <div class="p_th2 th2">

                                    </div>
                                    <div class="th3"></div>
                                    <div class="th4">{{$data}}</div>
                                    <div class="th5">
                                        <a href="{{route('ShopCate.goodsManage', 12)}}">商品管理</a>
                                        {{--  <a href="javascript:show_sub('{{route('ShopCate.createSub',$it    em['cat_id'])}}','{{$item['cat_id']}}')">添加子分类</a>--}}
                                    </div>
                                </div>

                            </div>


                        @if(count($info) > 0)
                        @foreach($info as $item)
                            <div class="table-body">

                                <div class="table-tr pid" flag="1">
                                    <input type="hidden" value="{{$item['id']}}" name="ids[]">
                                    <div class="th1">
                                        <a class="flex">
                                            <i class="fa fa-caret-down" aria-hidden="true"></i>
                                            <i style="display: none"  class="fa  fa-caret-right" aria-hidden="true"></i>
                                        </a>{{$item['sc_name']}}
                                    </div>
                                    <div class="p_th2 th2">
                                        {{--@if ($loop->first)
                                            <a class="p_down"><i class="fa fa-long-arrow-down" aria-hidden="true"></i></a>
                                            @elseif($loop->last)
                                            <a class="p_up"><i class="fa fa-long-arrow-up" aria-hidden="true"></i></a>
                                            @else
                                            <a class="p_down"><i class="fa fa-long-arrow-down" aria-hidden="true"></i></a>
                                            <a class="p_up"><i class="fa fa-long-arrow-up" aria-hidden="true"></i></a>
                                            @endif--}}
                                        <a class="p_down"><i class="fa fa-long-arrow-down" aria-hidden="true"></i></a>
                                        <a class="p_up"><i class="fa fa-long-arrow-up" aria-hidden="true"></i></a>

                                    </div>
                                    <div class="th3">{{$item['createtime']}}</div>
                                    <div class="th4">@if(empty($item['child'])) {{$item['count']}} @endif</div>
                                    <div class="th5">
                                        <a class="edit_name">修改名称</a>
                                        @if(empty($item['child']))
                                        <a href="javascript:destroy('{{route('ShopCate.destroy',$item['id'])}}')">删除分类</a>
                                        @endif
                                        @if(empty($item['child']))
                                            <a href="{{route('ShopCate.goodsManage',$item['id'])}}">商品管理</a>
                                        @endif
                                      {{--  <a href="javascript:show_sub('{{route('ShopCate.createSub',$item['cat_id'])}}','{{$item['cat_id']}}')">添加子分类</a>--}}
                                    </div>
                                </div>

                                    @foreach($item['child'] as $item2)
                                        <div class="table-tr">
                                            <input type="hidden" value="{{$item2['id']}}" name="ids[]">
                                            <div class="th1 for-th1">{{$item2['sc_name']}}</div>
                                            <div class="c_th2 th2">
                                                {{--@if ($loop->first)
                                                    <a class="c_down"><i class="fa fa-long-arrow-down" aria-hidden="true"></i></a>
                                                @elseif($loop->last)
                                                    <a class="c_up"><i class="fa fa-long-arrow-up" aria-hidden="true"></i></a>
                                                @else
                                                    <a class="c_down"><i class="fa fa-long-arrow-down" aria-hidden="true"></i></a>
                                                    <a class="c_up"><i class="fa fa-long-arrow-up" aria-hidden="true"></i></a>
                                                @endif--}}
                                                <a class="c_down"><i class="fa fa-long-arrow-down" aria-hidden="true"></i></a>
                                                <a class="c_up"><i class="fa fa-long-arrow-up" aria-hidden="true"></i></a>
                                            </div>
                                            <div class="th3">{{$item2['createtime']}}</div>
                                            <div class="th4">{{$item2['count']}}</div>
                                            <div class="th5">
                                                <a  class="edit_name">修改名称</a>
                                                <a href="javascript:destroy('{{route('ShopCate.destroy',$item2['id'])}}')">删除分类</a>
                                                <a href="{{route('ShopCate.goodsManage',$item2['id'])}}">商品管理</a>
                                                <a href="javascript:changeOne({{$item2['id']}})">变为一级</a>
                                            </div>
                                        </div>
                                    @endforeach
                                    <div class="table-tr">
                                        <div class="th1 for-th1">
                                            <a  class="btn btn-default add_sub">添加子分类</a>
                                        </div>
                                        <div class="c_th2 th2">
                                        </div>
                                        <div class="th3"></div>
                                        <div class="th4"></div>
                                        <div class="th5"></div>
                                    </div>

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
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--添加分类-->
    <section id="create" style="display: none;">
        <form id="form2">
            <div class="box-body">
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
        $('.add_sub').each(function () {
            $(this).click(function () {
                var pid=$(this).closest('.table-body').find('.pid input[name="ids[]"]').val();

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
                    document.getElementById('form2').reset();
                    layer.close(index);
                });
                $("#create_save").unbind('click');
                $("#create_save").click(function () {
                    $.ajax({
                        url: "{{route('ShopCate.store')}}",
                        data: $("#form2").serialize()+"&pid="+pid,
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


            })
        });

        //添加分类
        function show_create() {
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
                document.getElementById('form2').reset();
                layer.close(index);
            });
            $("#create_save").unbind('click');
            $("#create_save").click(function () {
                $.ajax({
                    url: "{{route('ShopCate.store')}}",
                    data: $("#form2").serialize(),
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
        //修改名称
        $('.edit_name').each(function () {
            $(this).click(function () {
               var pid=$(this).closest('.table-tr').find('input[name="ids[]"]').val();
              $.ajax({
                  url:"{{route('ShopCate.index')}}/"+pid+"/edit",
                  type:'get',
                  success:function (response) {
                      if(response.status==0){

                          $('input[name="catename"]').val(response.data.sc_name);
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
                              document.getElementById('form2').reset();
                              layer.close(index);
                          });
                          $("#create_save").unbind('click');
                          $("#create_save").click(function () {
                              $.ajax({
                                  url: "{{route('ShopCate.index')}}/"+pid,
                                  data: $("#form2").serialize(),
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
                  }

              });



            })
        })

        
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
        //合拢,展开
        $('.flex').each(function () {
           $(this).click(function () {
               var p=$(this).closest('.table-body');
              if(p.find('.table-tr:visible').length>1){
                  //合拢
                  p.find('.table-tr:gt(0)').hide();
                  $(this).find('i:first').hide();
                  $(this).find('i:last').show();

              }else {
                  //展开
                  p.find('.table-tr:gt(0)').show();
                  $(this).find('i:first').show();
                  $(this).find('i:last').hide();

              }
           })
        })
        

    </script>
    <script>
        //向下
        $('.p_down').each(function () {
            $(this).click(function () {
                var a=$(this).closest('.table-body');
                //最后位置
                if(a.is($('.table-body:last'))){
                    layer.msg('无法下移');
                }else {
                   /* alert('下移动');*/
                    var next=a.next();
                    next.insertBefore(a);
                    order();



                }
            })
        })
        $('.c_down').each(function () {
            $(this).click(function () {
                var a=$(this).closest('.table-tr');
                //最后位置
                var last=a.closest('.table-body').find('.table-tr:last').prev();
                if(a.is(last)){
                    layer.msg('无法下移');
                }else {
                  /*  alert('下移动');*/
                    var next=a.next();
                    next.insertBefore(a);
                    order();


                }
            })
        });

        $('.c_up').each(function () {
            $(this).click(function () {
                var a=$(this).closest('.table-tr');
                //第一位置
                var first=a.closest('.table-body').find('.table-tr:first').next();
                if(a.is(first)){

                    layer.msg('无法上移');
                }else {
                  /*  alert('上移动');*/
                    var prev=a.prev();
                    a.insertBefore(prev);
                     order();


                }
            })
        });


        //向上
        function order() {
            $.ajax({
                url:'{{route('ShopCate.order')}}',
                data:$('#form').serialize(),
                type:'POST',
                success:function (response) {
                    if(response.status==200){
                        layer.msg(response.msg);
                    }else{
                        layer.msg(response.msg);
                    }

                }
            })

        }
        $('.p_up').each(function () {
            $(this).click(function () {
                var a=$(this).closest('.table-body');
                //第一位置
                if(a.is($('.table-body:first'))){
                    layer.msg('无法上移');
                }else {
                  /*  alert('上移动');*/
                    var prev=a.prev();
                    a.insertBefore(prev);
                    order();
                }
            })
        })



    </script>
    <script>
        $('.sidebar-menu #shop_cate').addClass('active');
    </script>
@endsection

@section('css')
    <link rel="stylesheet" href="/css/shop_cate.css">
@endsection