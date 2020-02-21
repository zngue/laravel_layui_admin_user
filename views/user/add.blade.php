@include('zng::common.header')
<body class="childrenBody">
    <form class="layui-form" action="">

        <div class="layui-form-item">
            <label class="layui-form-label">用户名</label>
            <div class="layui-input-block">
                <input type="text" name="name" required  lay-verify="required" placeholder="请输入用户名" autocomplete="off" class="layui-input">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">权限用户组</label>
            <div id="pid_arr">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">联系电话</label>
            <div class="layui-input-block">
                <input type="text" name="phome"    placeholder="请输入联系电话" autocomplete="off" class="layui-input">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">密码</label>
            <div class="layui-input-block">
                <input type="password" name="password" required  lay-verify="required" placeholder="请输入密码" autocomplete="off" class="layui-input">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">状态</label>
            <div class="layui-input-block">
                <input type="radio" name="status" value="1" title="正常" checked>
                <input type="radio" name="status" value="0" title="禁用" >
            </div>
        </div>
        <div class="layui-form-item">
            <div class="layui-input-block">
                <button class="layui-btn" lay-submit lay-filter="addUser">立即提交</button>
                <button type="reset" class="layui-btn layui-btn-primary">重置</button>
            </div>
        </div>
    </form>
</body>
@include('zng::common.footer')
<script>
    var roleEditUrl = "{{route('user.doAdd')}}"
        ajaxListUrl = "{{route('user.ajaxList')}}"
    layui.use(['form','jquery','layer','selectN'],function () {
        var form = layui.form,$ = layui.jquery,layer = parent.layer === undefined ? layui.layer : top.layer,selectN= layui.selectN,pid=0


        var cate =selectN({
            elem: '#pid_arr',
            name:'role_id'
            //候选数据【必填】
            ,data: ajaxListUrl,
            filter:'pid',
            search:true
        })
        form.on('submit(addUser)',function (d) {
            console.log(d)
            //return  false
            $.post(roleEditUrl,d.field,function (r) {
                if(r.statusCode===200){
                    top.layer.msg(r.message);
                    layer.closeAll("iframe");
                    parent.location.reload();
                }else{
                    top.layer.msg(r.message);
                }
                return false
            },'json')
            return false
        })

    })

</script>
