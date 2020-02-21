@include('zng::common.header')
<body class="childrenBody">
<form class="layui-form" action="">
    <div class="layui-form-item">
        <label class="layui-form-label">名称</label>
        <div class="layui-input-block">
            <input type="text" name="name" required  lay-verify="required" placeholder="请输入名称" autocomplete="off" class="layui-input">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">是否禁用</label>
        <div class="layui-input-block">
            <input type="radio" name="status" value="0" title="是">
            <input type="radio" name="status" value="1" title="否" checked>
        </div>
    </div>
    <div class="layui-form-item">
        <div class="layui-input-block">
            <button class="layui-btn" lay-submit lay-filter="addRole">立即提交</button>
            <button type="reset" class="layui-btn layui-btn-primary">重置</button>
        </div>
    </div>
</form>
@include('zng::common.footer')
<script>
    var roleEditUrl = "{{route('role.editRole')}}"
    layui.use(['form','jquery','layer'],function () {
        var form = layui.form,$ = layui.jquery,layer = parent.layer === undefined ? layui.layer : top.layer
        form.on('submit(addRole)',function (d) {
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
