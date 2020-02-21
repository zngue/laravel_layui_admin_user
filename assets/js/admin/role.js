layui.use(['form','layer','laydate','table','laytpl'],function () {
    var kyewords=''
    var form = layui.form,
        layer = parent.layer === undefined ? layui.layer : top.layer,
        $ = layui.jquery,
        laydate = layui.laydate,
        laytpl = layui.laytpl,
        table = layui.table;
    var roleTable = table.render({
        elem: '#RoleList',
        url : roleIndexUrl,
        method:'get',
        where:{
            keywords:kyewords
        },
        title:'角色列表',
        toolbar:'#RoleTableBar',
        cellMinWidth : 95,
        page : true,
        loading:true,
        height : "full-125",
        limit : 20,
        limits : [2,10,15,20,25,50,75,100],
        id : "RoleList",
        text:{
            none:'暂无数据'
        },
        cols : [[
            {type: "checkbox", fixed:"left", width:50},
            {field: 'id', title: 'ID', width:60, align:"center",sort:true},
            {field: 'name', title: '名称', width:200},
            {field: 'status', title: '是否正常', align:'center',width:100, templet:function(d){
                    var checked='';
                    if (d.status==1){checked='checked'}
                    return '<input type="checkbox" name="status" value="'+d.id+'" lay-filter="status" lay-skin="switch" lay-text="是|否" '+checked+'>'
                }},
            {field: 'created_at', title: '创建时间', width:200,sort: true},
            {field: 'updated_at', title: '更新时间', width:200,sort:true},
           /* {field: 'newsTime', title: '发布时间', align:'center', minWidth:110, templet:function(d){
                    return d.newsTime.substring(0,10);
                }},*/
            {title: '操作', width:300, templet:'#newsListBar',fixed:"right",align:"center"}
        ]]
    });
    table.on('sort',function (d) {
        console.log(d)
        table.reload('RoleList',{
            initSort:d,
            where:{
                field: d.field, //排序字段
                order: d.type, //排序方式,
                keywords: kyewords
            }
        })
    })
    table.on('tool(RoleList)',function (d) {
        var tye=d.event;
        switch(tye){
            case 'del':
                del(d)
                break;
            case 'add':
                addRole()
                break;
            case 'edit':
                edit(d)
                break;
            case 'rolePermission':
                rolePermission(d)
                break;

        }
    })
    function rolePermission(d) {

        console.log(d)

            var id = d.data.id
            if (!id){
                layer.msg('参数错误')
            }

            var index = layui.layer.open({
                title : "分配权限",
                type : 2,
                content : rolePermissionUrl+'?id='+id,
                success : function(layero, index){
                    var body = layui.layer.getChildFrame('body', index);
                    setTimeout(function(){
                        layui.layer.tips('点击此处返回列表', '.layui-layer-setwin .layui-layer-close', {
                            tips: 3
                        });
                    },500)
                }
            })
            layui.layer.full(index);
            //改变窗口大小时，重置弹窗的宽高，防止超出可视区域（如F12调出debug的操作）
            $(window).on("resize",function(){
                layui.layer.full(index);
            })
            //return false


    }
    function edit(d) {
        var id = d.data.id
        if (!id){
            layer.msg('参数错误')
        }

        var index = layui.layer.open({
            title : "修改角色",
            type : 2,
            content : roleSaveUrl+'?id='+id,
            success : function(layero, index){
                var body = layui.layer.getChildFrame('body', index);
                setTimeout(function(){
                    layui.layer.tips('点击此处返回列表', '.layui-layer-setwin .layui-layer-close', {
                        tips: 3
                    });
                },500)
            }
        })
        layui.layer.full(index);
        //改变窗口大小时，重置弹窗的宽高，防止超出可视区域（如F12调出debug的操作）
        $(window).on("resize",function(){
            layui.layer.full(index);
        })
        //return false
    }

    //添加文章
    function addRole(){
        var index = layui.layer.open({
            title : "添加角色",
            type : 2,
            content : roleAddUrl,
            success : function(layero, index){
                var body = layui.layer.getChildFrame('body', index);
                setTimeout(function(){
                    layui.layer.tips('点击此处返章列表', '.layui-layer-setwin .layui-layer-close', {
                        tips: 3
                    });
                },500)
            }
        })
        layui.layer.full(index);
        //改变窗口大小时，重置弹窗的宽高，防止超出可视区域（如F12调出debug的操作）
        $(window).on("resize",function(){
            layui.layer.full(index);
        })
    }
    function del(d){
        layer.confirm('你确定要删除吗？', function(index){
            $.post(roleDelUrl,{id:d.data.id},function(res){
                if(res.statusCode==200){
                    layer.msg(res.message,{time:1000,icon:1});
                    d.del();
                }else{
                    layer.msg(res.message,{time:1000,icon:2});
                }
            });
            layer.close(index);
        });
    }
    table.on('toolbar(RoleList)',function (d) {
        var type =d.event
        switch (type) {
            case 'search':
                kyewords=$('.searchVal').val().trim()
                table.reload('RoleList',{
                    where:{
                        keywords: kyewords
                    }
                })
                $('.searchVal').val(kyewords)
                break;
            case 'clearSeach':
                kyewords=''
                table.reload('RoleList',{
                    where:{
                        keywords: kyewords
                    }
                })
                $('.searchVal').val(kyewords)
                break;
            case 'add':
                addRole()
                break;
            case 'rolePermission':
                rolePermission(d);
                break;
        }
        console.log(d)
    })
    form.on('switch(status)', function(obj){
        loading =layer.load(1, {shade: [0.1,'#fff']});
        var id = this.value;
        var authopen = obj.elem.checked===true?1:0;
        $.post(roleChangeStatusUrl,{'id':id,'status':authopen},function (res) {
            layer.close(loading);
            if (res.statusCode==200) {
                //roleTable.reload();
               // layer.msg('成功')
            }else{
                layer.msg(res.message,{time:1000,icon:2});
            }
            $('.searchVal').val(kyewords)
            return false
        })
    })



})
