@include('zng::common.header')
<body class="childrenBody">
<form class="layui-form" action="">
    <div class="layui-form-item">
        <label class="layui-form-label">名称</label>
        <div class="layui-input-block">
            <input type="text" name="name" required  lay-verify="required" placeholder="请输入名称" autocomplete="off" value="{{$data['name']}}" class="layui-input">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">父级分类</label>
        <div id="pid_arr">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">路由地址</label>
        <div class="layui-input-block">
            <input type="text" name="uri" required  lay-verify="required" value="{{$data['uri']}}" placeholder="请输入路由地址" autocomplete="off" class="layui-input">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">权限地址</label>
        <div class="layui-input-block">
            <input type="text" name="route_name" required value="{{$data['route_name']}}"  lay-verify="required" placeholder="请输入权限地址" autocomplete="off" class="layui-input">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">菜单图标</label>
        <div class="layui-input-block">
            <input type="text" name="icon"  value="{{$data['icon']}}" placeholder="请输入菜单图标 icon" autocomplete="off" class="layui-input">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">是否正常</label>
        <div class="layui-input-block">
            <input type="radio" name="status" value="1" title="不禁用"  {{ $data['status']==1?'checked': '' }} >
            <input type="radio" name="status" value="0" title="禁用" {{ $data['status']==0?'checked': '' }} >
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">菜单显示</label>
        <div class="layui-input-block">
            <input type="radio" name="is_menu" value="1" title="显示" {{ $data['is_menu']==1?'checked': '' }}>
            <input type="radio" name="is_menu" value="0" title="不显示" {{ $data['is_menu']==0?'checked': '' }}>
        </div>
    </div>
    <div class="layui-form-item layui-form-text">
        <label class="layui-form-label">描述</label>
        <div class="layui-input-block">
            <textarea name="desc" placeholder="请输入内容" class="layui-textarea">{{$data['desc']}}</textarea>
        </div>
    </div>
    <div class="layui-form-item">
        <div class="layui-input-block">
            <input type="hidden" name="id" value="{{$data['id']}}">
            <input type="hidden" name="pid" value="{{$data['pid']}}">
            <button class="layui-btn" lay-submit lay-filter="savePermission">立即提交</button>
            <button type="reset" class="layui-btn layui-btn-primary">重置</button>
        </div>
    </div>
</form>
</body>
@include('zng::common.footer')
<script>
    var roleEditUrl = "{{route('permission.saveRole')}}"
        ajaxListUrl = "{{route('permission.ajaxList')}}"
    layui.use(['form','jquery','layer','selectN'],function () {
        var form = layui.form,$ = layui.jquery,layer = parent.layer === undefined ? layui.layer : top.layer,selectN = layui.selectN
        var selectedString="{{$data['cate_pid_arr']}}"
        selectedString=selectedString.split(",");
        var cate =selectN({
            elem: '#pid_arr',
            name:'cate_pid_arr'
            //候选数据【必填】
            ,data: ajaxListUrl,
            selected:selectedString
        })
        form.on('submit(savePermission)',function (d) {

            $.post(roleEditUrl,d.field,function (r) {
                if(r.statusCode==200){
                    top.layer.msg(r.message);
                    layer.closeAll("iframe");
                    //刷新父页面
                    parent.location.reload();
                }else{
                    top.layer.msg(r.message);
                }
                return false
            },'json')
            console.log(d)
            return false
        })

    })

</script>
