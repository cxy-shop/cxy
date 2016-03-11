<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>电商系统后台</title>
    <link rel="shortcut icon" href="/Public/Admin/img/favicon.ico" type="image/vnd.microsoft.icon" />
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
        <?php if(is_array($menuStructure)): foreach($menuStructure as $key=>$menu): ?><li>
            <a href="javascript:;"><span class="pull-left side-left"><i class="<?php echo ($menu['iconClass']); ?>"></i></span>
                <span class="side-title"><?php echo ($menu['title']); ?></span> <span class="side-right pull-right"><i
                        class="glyphicon glyphicon-triangle-right"></i></span> </a>
            <ul>
                <?php if(is_array($menu['items'])): foreach($menu['items'] as $key=>$vo): ?><li><a href="<?php echo ($vo['url']); ?>" class="state"><?php echo ($vo['title']); ?></a></li><?php endforeach; endif; ?>
            </ul>
        </li><?php endforeach; endif; ?>
    </ul>
</div>


    <div id="main" class="content"></div>
</div>

    <script src="/Public/3rd/jquery/2.2.0/jquery.min.js"></script>
    <script src="/Public/3rd/layer/1.9.3/layer.min.js"></script>
    <script>
        $(function () {
//        主内容JQ对象
            var $main = $('#main');

//        菜单效果 start
            $(".side >ul >li >a").on('click', function () {
                var that = $(this);
                //修改兄弟节点的三角图标向右
                that.parent().siblings().find('.side-right i').removeClass('glyphicon-triangle-bottom').addClass('glyphicon-triangle-right')
                        .end().end().end()
                        //修改当前节点三角图标向下
                        .find('.side-right i').toggleClass('glyphicon-triangle-right').toggleClass('glyphicon-triangle-bottom');

                //让兄弟节点展开菜单收缩
                that.parent().siblings().find('ul').slideUp()
                        .end().end().end()
                        //让当前节点展开菜单下拉
                        .next('ul').slideToggle();
            });
            $(".side >ul >li > ul a").on('click', function () {
                $(".side >ul >li > ul a").removeClass('active');
                $(this).toggleClass('active');
            });
//        菜单效果 end

//        主内容路由 start
            $(".frame").on('click', 'a.state', function () {
                var that = $(this);
                var url = that.attr('href');
                $main.load(url);
                return false;
            });
//        主内容路由 end
        });
    </script>

</body>
</html>