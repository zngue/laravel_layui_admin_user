@include('zng::common.header')
<body class="childrenBody">
<form class="layui-form" action="">
    <div class="layui-form-item">
        <label class="layui-form-label">名称</label>
        <div class="layui-input-block">
            <input type="text" name="name" required  lay-verify="required" placeholder="请输入标题" value="{{$data['name']}}" autocomplete="off" class="layui-input">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">是否正常</label>
        <div class="layui-input-block">
            <input type="radio" name="status" value="1" title="是"  {{ $data['status']==1?'checked': '' }}>
            <input type="radio" name="status" value="0" title="否"  {{ $data['status']==0?'checked': '' }}>
        </div>
    </div>
    <div class="layui-form-item">
        <div class="layui-input-block">
            <input type="hidden" name="id" value="{{$data['id']}}">
            <button class="layui-btn" lay-submit lay-filter="saveRole">立即提交</button>
            <button type="reset" class="layui-btn layui-btn-primary">重置</button>
        </div>
    </div>
</form>
</body>
@include('zng::common.footer')
<script>
    var roleEditUrl = "{{route('role.saveRole')}}"
    layui.use(['form','jquery','layer'],function () {
        var form = layui.form,$ = layui.jquery,layer = parent.layer === undefined ? layui.layer : top.layer
        form.on('submit(saveRole)',function (d) {

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
