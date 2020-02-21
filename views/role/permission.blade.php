@include('zng::common.header')
<link rel="stylesheet" href="{{asset('zng/assets/zTree/css/zTreeStyle.css')}}" type="text/css">
<script src="http://libs.baidu.com/jquery/2.0.0/jquery.min.js"></script>
<body class="childrenBody">
<style>
    ul.ztree li span.button.switch{margin-right:5px}
    ul.ztree>li{background: #dae6f0;padding: 8px;}
    ul.ztree>li ul li{background: #eef5fa;margin-top: 8px;padding: 5px;}
    ul.ztree>li ul li ul li{background: #f6fbff;padding: 5px;}
    ul.ztree>li ul li ul li ul li{background: #fff;padding: 5px;}
    ul.ztree ul ul ul li{display:inline-block;}
    ul.ztree>ul li>ul>li{padding:5px}
    ul.ztree>ul li>ul{margin-top:12px}
    ul.ztree>ul li{padding:15px;padding-right:25px}
    ul.ztree>ul li{white-space:normal!important;background: #01AAED}
    ul.ztree li{white-space:inherit;}
    ul.ztree>li>a>span{font-size:15px;font-weight:700}
</style>
<div class="admin-main layui-anim layui-anim-upbit">
    <fieldset class="layui-elem-field">
        <legend>配置权限</legend>
        <div class="layui-field-box">
            <form class="layui-form layui-form-pane">
                <ul id="treeDemo" class="ztree"></ul>
                <div class="layui-form-item text-center">
                    <button type="button" class="layui-btn" lay-submit="" lay-filter="submit">提交</button>
                    <button class="layui-btn layui-btn-danger" type="button" onclick="window.history.back()">返回</button>
                </div>
            </form>
        </div>
    </fieldset>
</div>

</body>

@include('zng::common.footer')
<script type="text/javascript" src="{{asset('zng/assets/zTree/js/jquery.ztree.core.min.js')}}"></script>
<script type="text/javascript" src="{{asset('zng/assets/zTree/js/jquery.ztree.excheck.min.js')}}"></script>

<script type="text/javascript">
    var saveRolePermissionUrl ="{{route('role.saveRolePermission')}}"
    var setting = {
        check:{enable: true},
        view: {showLine: false, showIcon: false, dblClickExpand: false},
        data: {
            simpleData: {enable: true, pIdKey:'pid', idKey:'id'},
            key:{name:'title'}
        }
    };
    var zNodes = {!! json_encode($role) !!};
    var  test=[{"id":1,"pid":0,"title":"\u7cfb\u7edf\u8bbe\u7f6e","checked":true,"open":true},{"id":2,"pid":1,"title":"\u7cfb\u7edf\u8bbe\u7f6e","checked":true,"open":true},{"id":270,"pid":1,"title":"\u90ae\u7bb1\u914d\u7f6e","checked":true,"open":true},{"id":15,"pid":0,"title":"\u6743\u9650\u7ba1\u7406","checked":true,"open":true},{"id":16,"pid":15,"title":"\u7ba1\u7406\u5458\u5217\u8868","checked":true,"open":true},{"id":119,"pid":16,"title":"\u64cd\u4f5c-\u6dfb\u52a0","checked":true,"open":true},{"id":120,"pid":16,"title":"\u64cd\u4f5c-\u4fee\u6539","checked":true,"open":true},{"id":121,"pid":16,"title":"\u64cd\u4f5c-\u5220\u9664","checked":true,"open":true},{"id":145,"pid":16,"title":"\u64cd\u4f5c-\u72b6\u6001","checked":true,"open":true},{"id":17,"pid":15,"title":"\u7528\u6237\u7ec4\u5217\u8868","checked":true,"open":true},{"id":149,"pid":17,"title":"\u64cd\u4f5c-\u6dfb\u52a0","checked":true,"open":true},{"id":116,"pid":17,"title":"\u64cd\u4f5c-\u4fee\u6539","checked":true,"open":true},{"id":117,"pid":17,"title":"\u64cd\u4f5c-\u5220\u9664","checked":true,"open":true},{"id":118,"pid":17,"title":"\u64cd\u4f5c-\u6743\u9650","checked":true,"open":true},{"id":151,"pid":17,"title":"\u64cd\u4f5c-\u6743\u5b58","checked":true,"open":true},{"id":181,"pid":17,"title":"\u64cd\u4f5c-\u72b6\u6001","checked":true,"open":true},{"id":18,"pid":15,"title":"\u6743\u9650\u7ba1\u7406","checked":true,"open":true},{"id":108,"pid":18,"title":"\u64cd\u4f5c-\u6dfb\u52a0","checked":true,"open":true},{"id":114,"pid":18,"title":"\u64cd\u4f5c-\u4fee\u6539","checked":true,"open":true},{"id":112,"pid":18,"title":"\u64cd\u4f5c-\u5220\u9664","checked":true,"open":true},{"id":109,"pid":18,"title":"\u64cd\u4f5c-\u72b6\u6001","checked":true,"open":true},{"id":110,"pid":18,"title":"\u64cd\u4f5c-\u9a8c\u8bc1","checked":true,"open":true},{"id":111,"pid":18,"title":"\u64cd\u4f5c-\u6392\u5e8f","checked":true,"open":true},{"id":3,"pid":0,"title":"\u6570\u636e\u5e93\u7ba1\u7406","checked":true,"open":true},{"id":5,"pid":3,"title":"\u6570\u636e\u5e93\u5907\u4efd","checked":true,"open":true},{"id":126,"pid":5,"title":"\u64cd\u4f5c-\u5907\u4efd","checked":true,"open":true},{"id":127,"pid":5,"title":"\u64cd\u4f5c-\u4f18\u5316","checked":true,"open":true},{"id":128,"pid":5,"title":"\u64cd\u4f5c-\u4fee\u590d","checked":true,"open":true},{"id":4,"pid":3,"title":"\u8fd8\u539f\u6570\u636e\u5e93","checked":true,"open":true},{"id":230,"pid":4,"title":"\u64cd\u4f5c-\u8fd8\u539f","checked":true,"open":true},{"id":232,"pid":4,"title":"\u64cd\u4f5c-\u4e0b\u8f7d","checked":true,"open":true},{"id":129,"pid":4,"title":"\u64cd\u4f5c-\u5220\u9664","checked":true,"open":true},{"id":189,"pid":0,"title":"\u6a21\u578b\u7ba1\u7406","checked":true,"open":true},{"id":190,"pid":189,"title":"\u6a21\u578b\u5217\u8868","checked":true,"open":true},{"id":193,"pid":190,"title":"\u64cd\u4f5c-\u6dfb\u52a0","checked":true,"open":true},{"id":192,"pid":190,"title":"\u64cd\u4f5c-\u4fee\u6539","checked":true,"open":true},{"id":240,"pid":190,"title":"\u64cd\u4f5c-\u5220\u9664","checked":true,"open":true},{"id":239,"pid":190,"title":"\u64cd\u4f5c-\u72b6\u6001","checked":true,"open":true},{"id":241,"pid":190,"title":"\u6a21\u578b\u5b57\u6bb5","checked":true,"open":true},{"id":243,"pid":241,"title":"\u64cd\u4f5c-\u6dfb\u52a0","checked":true,"open":true},{"id":244,"pid":241,"title":"\u64cd\u4f5c-\u4fee\u6539","checked":true,"open":true},{"id":245,"pid":241,"title":"\u64cd\u4f5c-\u6392\u5e8f","checked":true,"open":true},{"id":242,"pid":241,"title":"\u64cd\u4f5c-\u72b6\u6001","checked":true,"open":true},{"id":246,"pid":241,"title":"\u64cd\u4f5c-\u5220\u9664","checked":true,"open":true},{"id":7,"pid":0,"title":"\u680f\u76ee\u7ba1\u7406","checked":true,"open":true},{"id":9,"pid":7,"title":"\u680f\u76ee\u5217\u8868","checked":true,"open":true},{"id":14,"pid":9,"title":"\u64cd\u4f5c-\u6dfb\u52a0","checked":true,"open":true},{"id":234,"pid":9,"title":"\u64cd\u4f5c-\u6dfb\u5b58","checked":true,"open":true},{"id":13,"pid":9,"title":"\u64cd\u4f5c-\u4fee\u6539","checked":true,"open":true},{"id":235,"pid":9,"title":"\u64cd\u4f5c-\u8be5\u5b58","checked":true,"open":true},{"id":236,"pid":9,"title":"\u64cd\u4f5c-\u5220\u9664","checked":true,"open":true},{"id":237,"pid":9,"title":"\u64cd\u4f5c-\u6392\u5e8f","checked":true,"open":true},{"id":238,"pid":7,"title":"\u5355\u9875\u7f16\u8f91","checked":true,"open":true},{"id":27,"pid":0,"title":"\u4f1a\u5458\u7ba1\u7406","checked":true,"open":true},{"id":29,"pid":27,"title":"\u4f1a\u5458\u5217\u8868","checked":true,"open":true},{"id":161,"pid":29,"title":"\u64cd\u4f5c-\u72b6\u6001","checked":true,"open":true},{"id":163,"pid":29,"title":"\u64cd\u4f5c-\u7f16\u8f91","checked":true,"open":true},{"id":164,"pid":29,"title":"\u64cd\u4f5c-\u5220\u9664","checked":true,"open":true},{"id":162,"pid":29,"title":"\u64cd\u4f5c-\u5168\u90e8\u5220\u9664","checked":true,"open":true},{"id":38,"pid":27,"title":"\u4f1a\u5458\u7ec4","checked":true,"open":true},{"id":167,"pid":38,"title":"\u64cd\u4f5c-\u6dfb\u52a0","checked":true,"open":true},{"id":182,"pid":38,"title":"\u64cd\u4f5c-\u4fee\u6539","checked":true,"open":true},{"id":169,"pid":38,"title":"\u64cd\u4f5c-\u5220\u9664","checked":true,"open":true},{"id":166,"pid":38,"title":"\u64cd\u4f5c-\u6392\u5e8f","checked":true,"open":true},{"id":28,"pid":0,"title":"\u7f51\u7ad9\u529f\u80fd","checked":true,"open":true},{"id":48,"pid":28,"title":"\u7559\u8a00\u7ba1\u7406","checked":true,"open":true},{"id":247,"pid":48,"title":"\u64cd\u4f5c-\u5220\u9664","checked":true,"open":true},{"id":248,"pid":48,"title":"\u64cd\u4f5c-\u5220\u9664\u5168\u90e8","checked":true,"open":true},{"id":31,"pid":28,"title":"\u53cb\u60c5\u94fe\u63a5","checked":true,"open":true},{"id":32,"pid":31,"title":"\u64cd\u4f5c-\u6dfb\u52a0","checked":true,"open":true},{"id":249,"pid":31,"title":"\u64cd\u4f5c-\u7f16\u8f91","checked":true,"open":true},{"id":250,"pid":31,"title":"\u64cd\u4f5c-\u72b6\u6001","checked":true,"open":true},{"id":251,"pid":31,"title":"\u64cd\u4f5c-\u5220\u9664","checked":true,"open":true},{"id":45,"pid":28,"title":"\u5e7f\u544a\u7ba1\u7406","checked":true,"open":true},{"id":170,"pid":45,"title":"\u64cd\u4f5c-\u6dfb\u52a0","checked":true,"open":true},{"id":171,"pid":45,"title":"\u64cd\u4f5c-\u4fee\u6539","checked":true,"open":true},{"id":175,"pid":45,"title":"\u64cd\u4f5c-\u72b6\u6001","checked":true,"open":true},{"id":174,"pid":45,"title":"\u64cd\u4f5c-\u6392\u5e8f","checked":true,"open":true},{"id":173,"pid":45,"title":"\u64cd\u4f5c-\u5220\u9664","checked":true,"open":true},{"id":46,"pid":28,"title":"\u5e7f\u544a\u4f4d\u7ba1\u7406","checked":true,"open":true},{"id":176,"pid":46,"title":"\u64cd\u4f5c-\u6dfb\u52a0","checked":true,"open":true},{"id":183,"pid":46,"title":"\u64cd\u4f5c-\u4fee\u6539","checked":true,"open":true},{"id":179,"pid":46,"title":"\u64cd\u4f5c-\u6392\u5e8f","checked":true,"open":true},{"id":178,"pid":46,"title":"\u64cd\u4f5c-\u5220\u9664","checked":true,"open":true},{"id":265,"pid":28,"title":"\u6350\u8d60\u7ba1\u7406","checked":true,"open":true},{"id":196,"pid":0,"title":"\u6a21\u7248\u7ba1\u7406","checked":true,"open":true},{"id":197,"pid":196,"title":"\u6a21\u7248\u7ba1\u7406","checked":true,"open":true},{"id":202,"pid":197,"title":"\u64cd\u4f5c-\u6dfb\u52a0","checked":true,"open":true},{"id":198,"pid":197,"title":"\u64cd\u4f5c-\u6dfb\u5b58","checked":true,"open":true},{"id":252,"pid":197,"title":"\u64cd\u4f5c-\u7f16\u8f91","checked":true,"open":true},{"id":253,"pid":197,"title":"\u64cd\u4f5c-\u6539\u5b58","checked":true,"open":true},{"id":254,"pid":197,"title":"\u64cd\u4f5c-\u5220\u9664","checked":true,"open":true},{"id":255,"pid":197,"title":"\u5a92\u4f53\u6587\u4ef6\u7ba1\u7406","checked":true,"open":true},{"id":256,"pid":255,"title":"\u64cd\u4f5c-\u6587\u4ef6\u5220\u9664","checked":true,"open":true},{"id":203,"pid":196,"title":"\u788e\u7247\u7ba1\u7406","checked":true,"open":true},{"id":205,"pid":203,"title":"\u64cd\u4f5c-\u6dfb\u52a0","checked":true,"open":true},{"id":204,"pid":203,"title":"\u64cd\u4f5c-\u7f16\u8f91","checked":true,"open":true},{"id":257,"pid":203,"title":"\u64cd\u4f5c-\u5220\u9664","checked":true,"open":true},{"id":272,"pid":196,"title":"\u788e\u7247\u5206\u7c7b","checked":true,"open":true},{"id":206,"pid":0,"title":"\u5fae\u4fe1\u7ba1\u7406","checked":true,"open":true},{"id":207,"pid":206,"title":"\u516c\u4f17\u53f7\u7ba1\u7406","checked":true,"open":true},{"id":212,"pid":207,"title":"\u64cd\u4f5c-\u8bbe\u7f6e","checked":true,"open":true},{"id":208,"pid":206,"title":"\u83dc\u5355\u7ba1\u7406","checked":true,"open":true},{"id":213,"pid":208,"title":"\u64cd\u4f5c-\u6dfb\u52a0","checked":true,"open":true},{"id":258,"pid":208,"title":"\u64cd\u4f5c-\u7f16\u8f91","checked":true,"open":true},{"id":259,"pid":208,"title":"\u64cd\u4f5c-\u6392\u5e8f","checked":true,"open":true},{"id":260,"pid":208,"title":"\u64cd\u4f5c-\u72b6\u6001","checked":true,"open":true},{"id":261,"pid":208,"title":"\u64cd\u4f5c-\u5220\u9664","checked":true,"open":true},{"id":262,"pid":208,"title":"\u64cd\u4f5c-\u751f\u6210\u83dc\u5355","checked":true,"open":true},{"id":209,"pid":206,"title":"\u6d88\u606f\u7d20\u6750","checked":true,"open":true},{"id":215,"pid":209,"title":"\u64cd\u4f5c-\u6dfb\u52a0","checked":true,"open":true},{"id":214,"pid":209,"title":"\u64cd\u4f5c-\u7f16\u8f91","checked":true,"open":true},{"id":263,"pid":209,"title":"\u64cd\u4f5c-\u5220\u9664","checked":true,"open":true},{"id":273,"pid":206,"title":"\u56de\u590d\u8bbe\u7f6e","checked":true,"open":true},{"id":267,"pid":0,"title":"\u63d2\u4ef6\u7ba1\u7406","checked":true,"open":true},{"id":269,"pid":267,"title":"\u7b2c\u4e09\u65b9","checked":true,"open":true},{"id":0,"pid":0,"title":"\u5168\u90e8","open":true}];
    function setCheck() {
        var zTree = $.fn.zTree.getZTreeObj("treeDemo");
        zTree.setting.check.chkboxType = { "Y":"ps", "N":"ps"};

    }
    $.fn.zTree.init($("#treeDemo"), setting, zNodes);
    setCheck();
    layui.use(['form', 'layer'], function () {
        var form = layui.form, layer = layui.layer;
        form.on('submit(submit)', function () {
           // loading =layer.load(1, {shade: [0.1,'#fff']});
            // 提交到方法 默认为本身
            var treeObj=$.fn.zTree.getZTreeObj("treeDemo"),
                nodes=treeObj.getCheckedNodes(true),
                v=[]
            for(var i=0;i<nodes.length;i++){
                v.push( nodes[i].id )
            }
            var id = "{{$id}}";
            $.post(saveRolePermissionUrl, {ids:v,'role_id':id}, function (res) {
               // layer.close(loading);
                if (res.statusCode ==200) {
                    layer.msg(res.message, {time: 1800, icon: 1}, function () {
                        window.location.reload();
                    });
                } else {
                    layer.msg(res.message, {time: 1800, icon: 2});
                }
            });
        })
    });
</script>
