<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>首页--layui后台管理模板 2.0</title>
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="format-detection" content="telephone=no">
    <link rel="icon" href="{{asset('favicon.ico')}}">
    <link rel="stylesheet" href="{{asset('zng/assets/layui/css/layui.css')}}" media="all" />
    <link rel="stylesheet" href="{{asset('zng/assets/css/public.css')}}" media="all" />
    <script>
        var ueditor_service_url="{{ config('filesystems.disks.image.service') }}"
    </script>
    <script src="{{asset('zng/assets/ueditor/ueditor.config.js')}}"></script>
    <script src="{{asset('zng/assets/ueditor/ueditor.all.min.js')}}"></script>
    <script src="http://code.jquery.com/jquery-2.1.1.min.js"></script>
    <script>
        var img_upload,file_upload,upload_num;
    </script>


</head>

