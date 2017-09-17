@extends('layout.index')
@section('title','商品列表')
@section('module',"($merchant_shopclassify->sc_name)分类下商品")
@section('op','列表')

@section('content')
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <!--box-header-->
                    <div class="box-header">

                    </div>
                    <!--box-header-->
                    <!--box-body-->
                    <form id="ids">
                        <div class="box-body table-responsive no-padding">
                            @if(count($info) > 0)
                                <table class="table table-hover">
                                    <tr>
                                        <th></th>
                                        <th>序号</th>
                                        <th>商品描述</th>
                                        <th>价格</th>
                                        <th>销量<span class="arrow"><a href="{{route('ShopCate.goodsManage',$id)}}?sell_count=1"><i class="fa fa-long-arrow-down" aria-hidden="true"></i></a><a href="{{route('ShopCate.goodsManage',$id)}}?sell_count=2"><i class="fa fa-long-arrow-up" aria-hidden="true"></i></a></span></th>
                                        <th>库存<span class="arrow"><a href="{{route('ShopCate.goodsManage',$id)}}?kc=1"><i class="fa fa-long-arrow-down" aria-hidden="true"></i></a><a href="{{route('ShopCate.goodsManage',$id)}}?kc=2"><i class="fa fa-long-arrow-up" aria-hidden="true"></i></a></span></th>
                                        <th width="13%">分类</th>
                                        <th>状态</th>
                                        <th>创建时间</th>
                                        <th>操作</th>
                                    </tr>
                                    @foreach($info as $k=>$v)
                                    <tr>

                                        <td></td>
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
                                                        【促销商品】
                                                        @endif @if($v->is_new)
                                                                【新品推荐】
                                                        @endif @if($v->is_hot)
                                                            【热销推荐】
                                                        @endif
                                                   <p>{{$v->goods_name}}</p>
                                                    {{$v->goods_smallname}}
                                                </div>
                                            </div>
                                        </td>
                                        <td>{{$v->price}}</td>
                                        <td>{{$v->sell_count}}</td>
                                        <td>{{$v->kc}}</td>
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
                                            <a href="javascript:cancel_cate('{{$v->goods_id}}')">取消分类</a>

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

    @endsection()
@section('js')
    <script>
        function cancel_cate(id) {
            $.ajax({
                url:'{{route('ShopCate.cancelCate')}}',
                data:{'goods_id':id,'cate_id':'{{$id}}'},
                type:'post',
                success:function (response) {
                    if(response.status==200){
                        layer.msg(response.msg);
                        location.reload();
                    }else {
                        layer.msg(response.msg);
                    }
                }
            })
            
        }
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
    @endsection
@section('css')
    <style>

        .op a{
            margin-right: 6px;
        }
        .arrow{
            margin-left: 3px;
        }
        .arrow a{
            margin-right: 4px;
            color: #9BA2AB;
        }
        .arrow_active{
            color:#1778cc !important;
        }

    </style>
@endsection()
