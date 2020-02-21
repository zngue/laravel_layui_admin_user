<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>layui后台管理模板 2.0</title>
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta http-equiv="Access-Control-Allow-Origin" content="*">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="format-detection" content="telephone=no">
    <link rel="icon" href="{{asset('favicon.ico')}}">
    <link rel="stylesheet" href="{{asset('zng/assets/layui/css/layui.css')}}" media="all" />
    <link rel="stylesheet" href="{{asset('zng/assets/css/index.css')}}" media="all" />
</head>
@php
    use Illuminate\Support\Facades\Auth;
    $user = Auth::user();
@endphp
<body class="main_body">
<div class="layui-layout layui-layout-admin">
    <!-- 顶部 -->
    <div class="layui-header header">
        <div class="layui-main mag0">
            <a href="#" class="logo">layuiCMS 2.0</a>
            <!-- 显示/隐藏菜单 -->
            <a href="javascript:;" class="seraph hideMenu icon-caidan">
                <i class="layui-icon layui-icon-shrink-right"></i>
            </a>
            <!-- 顶级菜单 -->
            <!-- 顶部右侧菜单 -->
            <ul class="layui-nav top_menu">
                <li class="layui-nav-item" pc>
                    <a href="javascript:;" class="clearCache"><i class="layui-icon" data-icon="&#xe640;">&#xe640;</i><cite>清除缓存</cite><span class="layui-badge-dot"></span></a>
                </li>
                <!--
                <li class="layui-nav-item lockcms" pc>
                    <a href="javascript:;"><i class="seraph icon-lock"></i><cite>锁屏</cite></a>
                </li>-->
                <li class="layui-nav-item" id="userInfo">
                    <a href="javascript:;">
                        <!--<img src="{{asset('zng/assets/images/face.jpg')}}" class="layui-nav-img userAvatar" width="35" height="35">-->
                        <cite class="adminName">{{$user->name}}</cite></a>
                    <dl class="layui-nav-child">
                      <!--  <dd><a href="javascript:;" data-url="page/user/userInfo.html"><i class="seraph icon-ziliao" data-icon="icon-ziliao"></i><cite>个人资料</cite></a></dd>
                        <dd><a href="javascript:;" data-url="page/user/changePwd.html"><i class="seraph icon-xiugai" data-icon="icon-xiugai"></i><cite>修改密码</cite></a></dd>
                        <dd><a href="javascript:;" class="showNotice"><i class="layui-icon">&#xe645;</i><cite>系统公告</cite><span class="layui-badge-dot"></span></a></dd>-->
                        <dd pc><a href="javascript:;" class="functionSetting"><i class="layui-icon">&#xe620;</i><cite>功能设定</cite><span class="layui-badge-dot"></span></a></dd>
                        <dd pc><a href="javascript:;" class="changeSkin"><i class="layui-icon">&#xe61b;</i><cite>更换皮肤</cite></a></dd>
                        <dd onclick="loginOut()"><a href="javascript:;" class="signOut"><i class="seraph icon-tuichu"></i><cite>退出</cite></a></dd>
                    </dl>
                </li>
            </ul>
        </div>
    </div>
    <!-- 左侧导航 -->
    <div class="layui-side layui-bg-black">

        <div class="navBar layui-side-scroll" id="navBar">
            <ul class="layui-nav layui-nav-tree">
                <!--
                <li class="layui-nav-item layui-this">
                    <a href="javascript:;" data-url="page/main.html"><i class="layui-icon" data-icon=""></i><cite>后台首页</cite></a>
                </li>-->
            </ul>
        </div>
    </div>
    <!-- 右侧内容 -->
    <div class="layui-body layui-form">
        <div class="layui-tab mag0" lay-filter="bodyTab" id="top_tabs_box">
            <ul class="layui-tab-title top_tab" id="top_tabs">
                <li class="layui-this" lay-id=""><i class="layui-icon">&#xe68e;</i> <cite>后台首页</cite></li>
            </ul>
            <ul class="layui-nav closeBox">
                <li class="layui-nav-item">
                    <a href="javascript:;"><i class="layui-icon caozuo">&#xe643;</i> 页面操作</a>
                    <dl class="layui-nav-child">
                        <dd><a href="javascript:;" class="refresh refreshThis"><i class="layui-icon">&#x1002;</i> 刷新当前</a></dd>
                        <dd><a href="javascript:;" class="closePageOther"><i class="seraph icon-prohibit"></i> 关闭其他</a></dd>
                        <dd><a href="javascript:;" class="closePageAll"><i class="seraph icon-guanbi"></i> 关闭全部</a></dd>
                    </dl>
                </li>
            </ul>
            <div class="layui-tab-content clildFrame">
                <div class="layui-tab-item layui-show">
                    <iframe style="margin-top: 0px" src="{{route('main.home')}}"></iframe>
                </div>
            </div>
        </div>
    </div>
    <!-- 底部 -->
    <div class="layui-footer footer">
        <p><span>copyright @2018 驊驊龔頾</span>　　<a onclick="donation()" class="layui-btn layui-btn-danger layui-btn-sm">捐赠作者</a></p>
    </div>
</div>

<!-- 移动导航 -->
<div class="site-tree-mobile"><i class="layui-icon">&#xe602;</i></div>
<div class="site-mobile-shade"></div>
<script>
    var baseLayuiUrl ="{{asset("zng/assets/js/")}}/"
    var loginOutUrl ="{{route('login.loginOut')}}"
</script>
<script type="text/javascript" src="{{asset('zng/assets/layui/layui.js')}}"></script>
<script type="text/javascript" src="{{asset('zng/assets/js/index.js')}}"></script>
<script type="text/javascript" src="{{asset('zng/assets/js/cache.js')}}"></script>
<script>
    function loginOut(){
    layui.use(['jquery','layer'],function ($,layer) {
            $.post(loginOutUrl,{},function (r) {
                if(r.statusCode==200){
                    layer.msg(r.message)
                    setTimeout(function () {
                        window.location.href="{{route('login.index')}}";
                    },2000)
                }else{
                    layer.msg(r.message)
                }
            },'json')





    })

    }


</script>
</body>
</html>