<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <link rel="stylesheet" href="/Public/3rd/bootstrap/3.3.5/css/bootstrap.min.css">
    <style>
        form{
            width:400px;
            margin:100px auto;
        }
        body{
            background: url('/Public/Admin/img/bg.jpg') 0 0 no-repeat;
        }
    </style>
</head>
<body>
<form id="loginForm" action="/admin/system/loginValidate" method="post">
    <div class="form-group">
        <label for="exampleInputEmail1">用户名</label>
        <input type="text" class="form-control" id="username" name="username" placeholder="用户名">
    </div>
    <div class="form-group">
        <label for="exampleInputPassword1">密码</label>
        <input type="password" class="form-control" id="password" name="password" placeholder="密码">
    </div>

    <button type="submit" class="btn btn-default">登录</button>
</form>
<script src="/Public/3rd/jquery/2.2.0/jquery.min.js"></script>
<script src="/Public/3rd/bootstrap/3.3.5/js/bootstrap.min.js"></script>
<script src="/Public/3rd/layer/1.9.3/layer.min.js"></script>
<script>
    $(function () {
        /**
         * 验证登录
         */
        $("#loginForm").submit(function () {
            var that = $(this);
            var action = that.attr('action');
            var method = that.attr('method');
            $.ajax({
                type: method,
                url: action,
                data: that.serialize(),
            }).done(function (obj) {
                if(obj.success == 1){
                    layer.msg(obj.msg,{
                        icon: 6,
                        time: 2000 //2秒关闭（如果不配置，默认是3秒）
                    }, function(){
                       location.href = obj.data.url;
                    });
                }else{
                    layer.msg(obj.msg,{icon : 5});
                }
            });
            return false;
        });
    });
</script>
</body>
</html>