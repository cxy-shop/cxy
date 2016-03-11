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
            height: 45px;
            position: absolute;
            top: 0;
            right: 0;
            left: 0;
            background: #09C;
        }

        .side {
            width: 200px;
            position: absolute;
            top: 45px;
            bottom: 0;
            left: 0;
            background: #22282E;
        }

        .content {
            position: absolute;
            top: 45px;
            right: 0;
            bottom: 0;
            left: 200px;
            overflow: auto;
        }

        /*整体布局 end*/

        /*头部布局 start*/
        .logo {
            float: left;
            height: 45px;
            line-height: 45px;
            text-align: center;
            width: 200px;
            color: #fff;
        }

        .user-info {
            height: 45px;
            float: right;
            line-height: 45px;
            color: #fff;
        }

        .info {
            float: left;
            margin-right: 10px;
        }

        .info img {
            width: 30px;
            height: 30px;
            border-radius: 100%;
        }

        .logout {

            float: right;
        }

        #btnLogout {
            padding: 3px 10px;
            color: #ffffff;
        }

        /*头部布局 end*/

        /*左侧菜单布局 start*/
        .side a {
            color: #ffffff;
            font-size: 12px;
        }

        .side ul {
            margin: 0px;
            padding: 0px;
            list-style: none;
        }

        .side a, .side a:hover {
            text-decoration: none;
        }

        .side > ul > li > a {
            position: relative;
            display: block;
            width: 200px;
            height: 40px;
            line-height: 40px;
            background: rgba(9, 14, 15, 0.15);
        }

        .side > ul > li > ul {
            display: none;
        }

        .side-title {
            float: left;
        }

        .side-left {
            padding-right: 10px;
            padding-left: 15px;
        }

        .side-right {
            padding-right: 10px;
        }

        .side > ul > li > ul > li > a {
            padding-left: 45px;
            position: relative;
            display: block;
            width: 200px;
            height: 35px;
            line-height: 35px;
            background: rgba(6, 13, 15, 0.55);
        }

        .side > ul > li > ul > li > a:hover {
            background: rgba(17, 55, 117, 0.07);
        }

        .side > ul > li > ul > li > a.active {
            width: 197px;
            border-left: 3px solid #2aabd2;
        }

        /*左侧菜单布局 end*/
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
            <div class="logout"><a id="btnLogout" href="javascript:;" title="退出"><i class="glyphicon glyphicon-off"></i></a>
            </div>
        </div>
    </div>
    <div class="side">
        <ul>
            <li>
                <a href="javascript:;"><span class="pull-left side-left"><i class="glyphicon glyphicon-oil"></i></span>
                    <span class="side-title">基础数据</span> <span class="side-right pull-right"><i
                            class="glyphicon glyphicon-triangle-right"></i></span> </a>
                <ul>
                    <li><a href="/admin/index/test" class="state">数据1</a></li>
                    <li><a href="javascript:;">数据2</a></li>
                </ul>
            </li>
            <li>
                <a href="javascript:;"><span class="pull-left side-left"><i class="glyphicon glyphicon-modal-window"></i></span>
                    <span class="side-title">网站管理</span> <span class="side-right pull-right"><i
                            class="glyphicon glyphicon-triangle-right"></i></span> </a>
                <ul>
                    <li><a href="javascript:;">数据1</a></li>
                    <li><a href="javascript:;">数据2</a></li>
                </ul>
            </li>
            <li>
                <a href="javascript:;"><span class="pull-left side-left"><i class="glyphicon glyphicon-user"></i></span>
                    <span class="side-title">组织架构</span> <span class="side-right pull-right"><i
                            class="glyphicon glyphicon-triangle-right"></i></span> </a>
                <ul>
                    <li><a href="javascript:;">数据1</a></li>
                    <li><a href="javascript:;">数据2</a></li>
                </ul>
            </li>
            <li>
                <a href="javascript:;"><span class="pull-left side-left"><i class="glyphicon glyphicon-cog"></i></span>
                    <span class="side-title">系统设置</span> <span class="side-right pull-right"><i
                            class="glyphicon glyphicon-triangle-right"></i></span> </a>
                <ul>
                    <li><a href="javascript:;">数据1</a></li>
                    <li><a href="javascript:;">数据2</a></li>
                </ul>
            </li>
        </ul>
    </div>
    <div id="main" class="content"></div>
</div>
<script src="/Public/3rd/jquery/2.2.0/jquery.min.js"></script>
<script src="/Public/3rd/layer/1.9.3/layer.min.js"></script>
<script>
    $(function () {
        var $main = $('#main');

//        菜单效果 start
        $(".side >ul >li >a").on('click', function () {
            $(this).find('i').eq(1).toggleClass('glyphicon-triangle-bottom');
            $(this).next().toggle();
        });
        $(".side a").on('click', function () {
            $(".side a").removeClass('active');
            $(this).toggleClass('active');
        });
//        菜单效果 end
        $(".frame").on('click', 'a.state', function () {
            var that = $(this);
            var url = that.attr('href');
            $main.load(url);
            return false;
        });
    });
</script>
</body>
</html>