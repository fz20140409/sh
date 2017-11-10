<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="renderer" content="webkit|ie-comp|ie-stand">
    <title>{{env('APP_NAME')}}-登录</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="shortcut icon" href="/img/sh.png" type="image/x-icon"/>
    <!-- Bootstrap 3.3.6 -->
    <link rel="stylesheet" href="/adminlte/bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="/plugs/font-awesome-4.7.0/css/font-awesome.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="/adminlte/dist/css/AdminLTE.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="/adminlte/plugins/iCheck/square/blue.css">
    <!--bootstrapvalidator-->
    <link rel="stylesheet" href="/plugs/bootstrapvalidator/css/bootstrapValidator.min.css">


    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body class="hold-transition login-page">
<div class="login-box">
    <div class="login-logo">
        {{env('APP_NAME')}}
    </div>
    <!-- /.login-logo -->
    <div class="login-box-body">
        <p class="login-box-msg">
      @include('common._alert')
        </p>

        <form id="form" action="{{route('Login.doLogin')}}" method="post">
            {{ csrf_field() }}
            <div  class="form-group has-feedback">
                <input id="phone" name="phone" type="text" class="form-control" placeholder="手机号码">
                <span class="glyphicon glyphicon-phone form-control-feedback"></span>
            </div>
            <div class="form-group form-inline">
                <input  name="code" type="text" class="form-control" placeholder="短信验证码" style="width: 60%">
                <span>
                  <button id="for-code" onclick="getCode()" class=" btn btn-default pull-right" type="button">获取验证码</button>
                </span>
            </div>

            <div class=" form-group" style="margin-top: 30px">
                <button type="submit" class="btn btn-primary btn-block btn-flat">登录</button>
            </div>
        </form>

    </div>
    <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

<!-- jQuery 2.2.3 -->
<script src="/adminlte/plugins/jQuery/jquery-2.2.3.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="/adminlte/bootstrap/js/bootstrap.min.js"></script>
<!-- iCheck -->
<script src="/adminlte/plugins/iCheck/icheck.min.js"></script>
<!--bootstrapvalidator-->
<script src="/plugs/bootstrapvalidator/js/bootstrapValidator.js"></script>
<!--layer-->
<script src="/plugs/layer/layer.js"></script>
<script>
    $(function () {
        $('input').iCheck({
            checkboxClass: 'icheckbox_square-blue',
            radioClass: 'iradio_square-blue',
            increaseArea: '20%' // optional
        });
    });
</script>
<script>
    //获取验证码
    function getCode() {
        var phone=$('#phone').val();
        //todo
        if(phone==""){
            layer.msg('请输入手机号码');
            return false;
        }
        $.ajax({
            url:"{{route('VerificationCode.sendCode')}}",
            type:"post",
            data:{'phone':phone},
            success:function (response) {
                if(response.status==0){
                    //发送成功
                    $('#for-code').text('');
                    $('#for-code').append('重新发送<span id="code" style="color: red">120</span>秒');
                    var loginTime=$('#code').text();
                    var time = setInterval(function(){
                        loginTime = loginTime-1;
                        $('#code').text(loginTime);
                        if(loginTime==0){
                            clearInterval(time);
                            $('#for-code').text('获取验证码');
                        }
                    },1000);
                }else{
                    //发送失败
                    layer.msg(response.msg);
                }

            }
        })

    };
        //表单校验
        $(document).ready(function() {
            $('#form')
                .bootstrapValidator({
                    message: 'This value is not valid',
                    feedbackIcons: {
                        valid: 'glyphicon glyphicon-ok',
                        validating: 'glyphicon glyphicon-refresh'
                    },
                    fields: {
                        phone: {
                            validators: {
                                notEmpty: {
                                    message: '手机号码不能为空'
                                },
                                regexp: {
                                    regexp: /^1[34578]\d{9}$/,
                                    message: '请输入正确的手机号码'
                                },
                            }
                        },
                        code: {
                            validators: {
                                notEmpty: {
                                    message: '验证码不能为空'
                                }
                            }
                        },

                    }
                });
        });

</script>

</body>
</html>
