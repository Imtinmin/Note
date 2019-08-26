<?php
    header("Content-Type: text/html;charset=utf-8");
    session_start();
    require_once('check.php');
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="renderer" content="webkit">

    <title>管理中心 - 博客</title>

    <meta name="keywords" content="">
    <meta name="description" content="">

    <!--[if lt IE 9]>
    <meta http-equiv="refresh" content="0;ie.html" />
    <![endif]-->

    <link href="css/bootstrap.min.css?v=3.3.6" rel="stylesheet">
    <link href="css/font-awesome.min.css?v=4.4.0" rel="stylesheet">
    <link href="css/animate.css" rel="stylesheet">
    <link href="css/style1.css?v=4.1.0" rel="stylesheet">
    <link href="css/plugins/toastr/toastr.min.css" rel="stylesheet">
</head>

<body class="fixed-sidebar full-height-layout gray-bg" style="overflow:hidden">
    <div id="wrapper">
        <!--左侧导航开始-->
        <nav class="navbar-default navbar-static-side" role="navigation">
            <div class="nav-close"><i class="fa fa-times-circle"></i>
            </div>
            <div class="sidebar-collapse">
                <ul class="nav" id="side-menu">
                    <li class="nav-header">
                        <div class="dropdown profile-element">
                            <a  href="/index" target="_blank">
                                <span class="clear">
                                    <span class="block m-t-xs" style="font-size:20px;">
                                        <strong class="font-bold">博客管理</strong>
                                    </span>
                                </span>
                            </a>
                        </div>
                    </li>
                    <li class="hidden-folded padder m-t m-b-sm text-muted text-xs">
                        <span class="ng-scope"></span>
                    </li>
                    <li>
                        <a class="J_menuItem" href="home.php">
                            <i class="fa fa-home"></i>
                            <span class="nav-label">主页</span>
                        </a>
                    </li>
                    <li class="line dk"></li>
                    <li class="hidden-folded padder m-t m-b-sm text-muted text-xs">
                        <span class="ng-scope">相册管理</span>
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-users"></i> <span class="nav-label">相册添加</span><span class="fa arrow pull-right"></span><span id='usertotal' class="label label-primary pull-right">null</span></a>
                        <ul class="nav nav-second-level">
                            <li><a class="J_menuItem" href="list.php">相册列表</a></li>
                            <li><a class="J_menuItem" href="Add_photo.php">添加照片</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </nav>
        <!--左侧导航结束-->
        <!--右侧部分开始-->
        <div id="page-wrapper" class="gray-bg dashbard-1">
            <div class="row border-bottom">
                <nav class="navbar navbar-static-top" role="navigation" style="margin-bottom: 0">
                    <div class="navbar-header"><a class="navbar-minimalize minimalize-styl-2 btn btn-info " href="#"><i class="fa fa-bars"></i> </a>
                    </div>
                    <ul class="nav navbar-top-links navbar-right">
                        <li><a href='/goout'><button class='btn btn-info'>退出</button></a></li>
                    </ul>
                </nav>
            </div>
            <div class="row J_mainContent" id="content-main" >
                <iframe id="J_iframe" width="100%" height="100%" src="home.php" frameborder="0" data-id="home.php" seamless></iframe>
            </div>
        </div>

        <!--右侧部分结束-->
    </div>

    <!-- 全局js -->
    <script src="js/jquery.min.js?v=2.1.4"></script>
    <script src="js/bootstrap.min.js?v=3.3.6"></script>
    <script src="js/plugins/metisMenu/jquery.metisMenu.js"></script>
    <script src="js/plugins/slimscroll/jquery.slimscroll.min.js"></script>
    <script src="js/plugins/layer/layer.min.js"></script>

    <!-- 自定义js -->
    <script src="js/hAdmin.js?v=4.1.0"></script>
    <script type="text/javascript" src="js/index.js"></script>

    <!--include js-->
    <script src="js/plugins/toastr/toastr.min.js"></script>

    <script type="text/javascript">
        $(function(){
            //参数设置，若用默认值可以省略以下面代
            toastr.options = {
              "closeButton": true,
              "debug": false,
              "progressBar": false,
              "positionClass": "toast-top-right",
              "onclick": null,
              "showDuration": "400",
              "hideDuration": "1000",
              "timeOut": "7000",
              "extendedTimeOut": "3000",
              "showEasing": "swing",
              "hideEasing": "swing",
              "showMethod": "show",
              "hideMethod": "hide"
            };
        })
        $(document).ready(function(){
            var $usertotal = $("#usertotal");
            var $nostate = $("#nostate");
            $usertotal.css("display",'none');
            $nostate.css("display",'none');

            //get nostate userlist total
            $.get("./../api/user/total.php?type=nostate",function(data,status){
                $data = $.trim(data)
                if($data>'0'){
                    $usertotal.css("display",'block');
                    $usertotal.html(data);

                    $nostate.css("display",'block');
                    $nostate.html(data);
                    toastr.info("当前共有"+data+"名用户等待处理","Message");
                }
            });
        });
    </script>
</body>

</html>
