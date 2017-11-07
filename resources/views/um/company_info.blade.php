<table class=" table table-hover table-bordered">
    <tr>
        <td width="20%">企业名称</td>
        <td>{{$user->company}}</td>
    </tr>
    <tr>
        <td>经营地址</td>
        <td>{{$user->address}}</td>
    </tr>
    <tr>
        <td>所属行业</td>
        <td>{{$merchant->industry}}</td>
    </tr>
    <tr>
        <td>营业执照</td>
        <td>
            @foreach($merchant_file as $value)
                <a href="{{$value->fileurl}}"><img style="float: left" width="10%"  class="img-responsive center-block" src="{{$value->fileurl}}"></a>
            @endforeach
        </td>
    </tr>
    <tr>
        <td>业务区域</td>
        <td>{{$user->provice}}</td>
    </tr>
    <tr>
        <td>老板姓名</td>
        <td>{{$user->boss}}</td>
    </tr>
    <tr>
        <td>老板手机</td>
        <td>{{$user->bosstel}}</td>
    </tr>
    <tr>
        <td>年销售额</td>
        <td>{{$merchant->mountsales}}</td>
    </tr>
    <tr>
        <td>公司业务电话</td>
        <td>{{$merchant->company_tel}}</td>
    </tr>
    <tr>
        <td>公司地址（总店）</td>
        <td>{{$merchant->hq_addr}}</td>
    </tr>
</table>