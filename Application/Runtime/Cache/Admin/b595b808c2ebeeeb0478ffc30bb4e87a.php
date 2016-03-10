<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <link rel="stylesheet" href="/Public/3rd/bootstrap/3.3.5/css/bootstrap.min.css">
    <style>
        /*整体布局 start*/
        .frame {
            position: absolute;
            top: 0;
            right: 0;
            bottom: 0;
            left: 0;
        }

        .header {
            height: 40px;
            position: absolute;
            top: 0;
            right: 0;
            left: 0;
            background: #09C;
        }

        .side {
            width: 200px;
            position: absolute;
            top: 40px;
            bottom: 0;
            left: 0;
            background: #22282E;
        }

        .content {
            position: absolute;
            top: 40px;
            right: 0;
            bottom: 0;
            left: 200px;
            overflow: auto;
        }
        /*整体布局 end*/

        /*头部布局 start*/
        .logo{
            float: left;
            height:40px;
            line-height: 40px;
            text-align: center;
            width: 200px;
            color: #fff;
        }
        .user-info{
            width: 200px;
            height:40px;
            float: right;
            line-height: 40px;
            color: #fff;
        }
        .info{
            float: left;
        }
        .info img{
            width: 30px;
            height:30px;
            border-radius: 100%;
        }
        .logout{
            float: right;

        }
        /*头部布局 end*/
    </style>
</head>
<body>
<div class="frame">
    <div class="header">
        <div class="logo"><i class="glyphicon glyphicon-home"></i>电商管理系统</div>
        <div class="user-info">
            <div class="info">
                <img src="/public/admin/img/user.jpg" alt=""> <span>cxy</span>
            </div>
            <div class="logout"><i class="glyphicon glyphicon-off"></i></div>
        </div>
    </div>
    <div class="side"></div>
    <div id="main" class="content"></div>
</div>
<script src="/Public/3rd/jquery/2.2.0/jquery.min.js"></script>
<script src="/Public/3rd/layer/1.9.3/layer.min.js"></script>
<script>
    $(function () {
       var $main = $('#main');
    });
</script>
</body>
</html>