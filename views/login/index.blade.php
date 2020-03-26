
<!DOCTYPE html>
<html class="loginHtml">
<head>
    <meta charset="utf-8">
    <title>{{config("zng.system_name",'后台管理系统')}}</title>
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="format-detection" content="telephone=no">
    <link rel="icon" href="/favicon.ico">
    <link rel="stylesheet" href="{{asset('zng/assets/layui/css/layui.css')}}" media="all" />
    <link rel="stylesheet" href="{{asset('zng/assets/css/public.css')}}" media="all" />
    <link rel="stylesheet" href="{{asset('zng/assets/css/login.css')}}" media="all" />

</head>
<body class="loginBody">
<style>
    .layui-form{

    }
</style>
<div class="main-title">
    <div class="beg-login-box">
        <header>
            <h1>{{config('zng.system_name','后台管理系统')}}</h1>
        </header>
        <div class="beg-login-main">
            <form class="layui-form layui-form-pane ">

                <div class="layui-form-item">
                    <label class="beg-login-icon fs1">
                        用户名：
                        <span class="icon icon-user"></span>
                    </label>
                    <input type="text" name="name" placeholder="请输入用户名"  id="userName" class="layui-input" lay-verify="required">
                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                </div>

                <div class="layui-form-item">
                    <label class="beg-login-icon fs1">
                        密&nbsp;&nbsp;&nbsp;码：
                        <i class="icon icon-key"></i>
                    </label>
                    <input type="password" name="password" placeholder="请输入密码" autocomplete="off" id="password" class="layui-input" lay-verify="required">
                </div>
                <div class="layui-form-item">
                    <button class="layui-btn layui-block" lay-filter="login" lay-submit>登录</button>
                </div>
            </form>
        </div>
        <footer>
            <p>{{config('zng.system_user','zngue')}} © </p>
        </footer>
    </div>
</div>






<script>
    var doLoginUrl = "{{route('login.doLogin')}}"
    var IndexUrl = "{{route('main.index')}}"
</script>
<script type="text/javascript" src="{{asset('zng/assets/layui/layui.js')}}"></script>
<script type="text/javascript" src="{{asset('zng/assets/js/login.js')}}"></script>
<script type="text/javascript" src="{{asset('zng/assets/js/cache.js')}}"></script>

<script>

    @if( !\Illuminate\Support\Facades\Auth::user()  )
        if (window.frames.length != parent.frames.length) {
            parent.location.reload();
        }
    @endif

</script>
</body>
</html>
