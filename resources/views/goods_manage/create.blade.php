@extends('layout.index')
@section('title','增加商品')
@section('module','商品')
@section('op','增加')

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
                        <form method="post" id="upload_form" class="form-horizontal" action="{{route('GoodsManage.store')}}">
                            <!--基本信息-->
                            <section  class="section">
                            <div class="form-group">
                                <label for="inputEmail3" class="col-sm-2 control-label">商品图片</label>
                                <div class="col-sm-8">
                                    <div class="dropzone" id="upload_dropzone">
                                        <div class="am-text-success dz-message">
                                            将文件拖拽到此处<br>或点此打开文件管理器选择文件
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputEmail3" class="col-sm-2 control-label">商品标题</label>
                                <div class="col-sm-8">
                                    <input type="email" class="form-control" id="inputEmail3" placeholder="请输入商品标题">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputEmail3" class="col-sm-2 control-label">商品简介</label>
                                <div class="col-sm-8">
                                    <input type="email" class="form-control" id="inputEmail3" placeholder="请输入商品简介">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputEmail3" class="col-sm-2 control-label">所属品牌</label>
                                <div class="col-sm-8">
                                    <select  class="form-control" id="inputEmail3">
                                        <option>xxx</option>
                                        <option>xxx</option>
                                        <option>xxx</option>
                                    </select>
                                </div>
                            </div>
                            </section>
                            <!--型号/价格-->
                            <section  class="section" style="display: none">
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-2 control-label">商品价格</label>
                                    <div class="col-sm-8">
                                        <input type="email" class="form-control" id="inputEmail3" placeholder="Email">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-2 control-label">商品库存</label>
                                    <div class="col-sm-8">
                                        <input type="email" class="form-control" id="inputEmail3" placeholder="Email">
                                    </div>
                                </div>

                            </section>
                            <!--标签/分类-->
                            <section  class=" section" style="display: none">
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-2 control-label">商品标签</label>
                                    <div class="col-sm-8">
                                        <input type="email" class="form-control" id="inputEmail3" placeholder="Email">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-2 control-label">店铺分类</label>
                                    <div class="col-sm-8">
                                        <input type="email" class="form-control" id="inputEmail3" placeholder="Email">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-2 control-label">所属品类</label>
                                    <div class="col-sm-2">
                                        <select  class="form-control" id="inputEmail3">
                                            <option>xxx</option>
                                            <option>xxx</option>
                                            <option>xxx</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-2">
                                        <select  class="form-control" id="inputEmail3">
                                            <option>xxx</option>
                                            <option>xxx</option>
                                            <option>xxx</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-2">
                                        <select  class="form-control" id="inputEmail3">
                                            <option>xxx</option>
                                            <option>xxx</option>
                                            <option>xxx</option>
                                        </select>
                                    </div>
                                </div>
                            </section>
                            <!--商品应用-->
                            <section  class=" section" style="display: none">
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-2 control-label">商品应用</label>
                                    <div class="col-sm-8">
                                        <input type="email" class="form-control" id="inputEmail3" placeholder="Email">
                                    </div>
                                </div>
                            </section>
                            <!--商品详情-->
                            <section  class=" section" style="display: none">
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-2 control-label">商品图片</label>
                                    <div class="col-sm-8">
                                        <input type="email" class="form-control" id="inputEmail3" placeholder="Email">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-2 control-label">商品标题</label>
                                    <div class="col-sm-8">
                                        <input type="email" class="form-control" id="inputEmail3" placeholder="Email">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-2 control-label">商品简介</label>
                                    <div class="col-sm-8">
                                        <input type="email" class="form-control" id="inputEmail3" placeholder="Email">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-2 control-label">所属品牌</label>
                                    <div class="col-sm-8">
                                        <select  class="form-control" id="inputEmail3">
                                            <option>xxx</option>
                                            <option>xxx</option>
                                            <option>xxx</option>
                                        </select>
                                    </div>
                                </div>
                            </section>
                            <button type="submit" class="btn btn-primary">保存</button>
                        </form>
                    </div>
                    {{--<div class="box-footer">
                        <button type="submit" class="btn btn-primary">保存</button>
                    </div>--}}


                </div>

            </div>

        </div>

    </section>
    @endsection
@section('js')
    <script src="/plugs/dropzone/min/dropzone.min.js"></script>
    <script src="/js/upload.js"></script>
    <script>
        $(function () {
            upload_img("{{route('Uploader.uploadImg')}}",'{{route("Uploader.deleteUploadImg")}}');
        })
    </script>
    <script>
        $(function () {
            //初始化显示基本信息
            $('.box-header ul li:eq(0)').addClass('active');
            $('.box-header ul li:not(:eq(0))').removeClass('active');
            $('.section:eq(0)').show();
            $('.section:not(:eq(0))').hide();
        })
        function show(id) {
            switch(id)
            {
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
    </script>
@endsection
@section('css')
    <link rel="stylesheet" href="/plugs/dropzone/min/dropzone.min.css">
    @endsection()
