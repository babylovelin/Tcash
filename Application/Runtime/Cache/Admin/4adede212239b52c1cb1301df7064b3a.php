<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <title>Tcash后台管理</title>
    <link rel="stylesheet" href="/Public/layui/css/layui.css">
    <style>
        body{margin: 10px;}
        .demo-carousel{height: 200px; line-height: 200px; text-align: center;}
    </style>
</head>
<body>
<div style="font-size: 25px;width: 300px;margin: 0 auto;text-align: center">Tcash资产后台数据管理</div>
<table class="layui-table" lay-data="{height:600, page:true, id:'idTest'}" lay-filter="demo">
    <thead>
    <tr>
        <th lay-data="{field:'date', width:110, sort: true, fixed: true,edit: 'text'}">日期</th>
        <th lay-data="{field:'assets',fixed: true, width:80,edit: 'text'}">总资产</th>
        <th lay-data="{field:'principal',fixed: true, width:80,edit: 'text'}">本金</th>
        <!--<th lay-data="{field:'rateOfReturn',fixed: true, width:80,edit: 'text'}">盈亏</th>-->
        <th lay-data="{field:'btc_num', width:80,fixed: true,edit: 'text'}">BTC_N</th>
        <th lay-data="{field:'btc_price', width:80,fixed: true,edit: 'text'}">BTC_P</th>
        <th lay-data="{field:'eth_num', width:80,fixed: true,edit: 'text'}">ETH_N</th>
        <th lay-data="{field:'eth_price', width:80,fixed: true,edit: 'text'}">ETH_P</th>
        <th lay-data="{field:'bnb_num', width:80,fixed: true,edit: 'text'}">BNB_N</th>
        <th lay-data="{field:'bnb_price', width:80, fixed: true,edit: 'text'}">BNB_P</th>
        <th lay-data="{field:'eos_num', width:80, fixed: true,edit: 'text'}">EOS_N</th>
        <th lay-data="{field:'eos_price', width:80, fixed: true,edit: 'text'}">EOS_P</th>
        <th lay-data="{field:'usdt_num', width:90, fixed: true,edit: 'text'}">USDT_N</th>
        <th lay-data="{field:'usdt_price', width:90, fixed: true,edit: 'text'}">USDT_P</th>
        <th lay-data="{field:'cny_num', width:80, fixed: true,edit: 'text'}">CNY_N</th>
        <th lay-data="{fixed:true,width:120, align:'center', toolbar: '#barDemo'}"></th>
    </tr>
    </thead>
    <tbody>
    <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$ivo): $mod = ($i % 2 );++$i;?><tr>
            <td><?php echo ($ivo["date"]); ?></td>
            <td><?php echo ($ivo["total"]); ?></td>
            <td><?php echo ($ivo["principal"]); ?></td>
            <!--<td><?php echo ($ivo["total-$ivo"]["principal"]); ?></td>-->
            <td><?php echo ($ivo["btc_num"]); ?></td>
            <td><?php echo ($ivo["btc_price"]); ?></td>
            <td><?php echo ($ivo["eth_num"]); ?></td>
            <td><?php echo ($ivo["eth_price"]); ?></td>
            <td><?php echo ($ivo["bnb_num"]); ?></td>
            <td><?php echo ($ivo["bnb_price"]); ?></td>
            <td><?php echo ($ivo["eos_num"]); ?></td>
            <td><?php echo ($ivo["eos_price"]); ?></td>
            <td><?php echo ($ivo["usdt_num"]); ?></td>
            <td><?php echo ($ivo["usdt_price"]); ?></td>
            <td><?php echo ($ivo["cny_num"]); ?></td>
        </tr><?php endforeach; endif; else: echo "" ;endif; ?>
    </tbody>
</table>

<script type="text/html" id="barDemo">
    <a class="layui-btn layui-btn-mini" lay-event="edit">修改</a>
    <a class="layui-btn layui-btn-danger layui-btn-mini" lay-event="del">删除</a>
</script>
<script src="https://cdn.bootcss.com/jquery/1.8.0/jquery-1.8.0.js"></script>
<script src="/Public/layui/layui.all.js"></script>
<script src="/Public/js/dialog.js"></script>
<script>
    layui.use(['laydate', 'laypage', 'layer', 'table', 'carousel', 'upload', 'element'], function(){
        var laydate = layui.laydate //日期
                ,laypage = layui.laypage //分页
        layer = layui.layer //弹层
                ,table = layui.table //表格
                ,carousel = layui.carousel //轮播
                ,upload = layui.upload //上传
                ,element = layui.element; //元素操作


        //监听工具条
        table.on('tool(demo)', function(obj){ //注：tool是工具条事件名，test是table原始容器的属性 lay-filter="对应的值"
            var data = obj.data //获得当前行数据
                    ,layEvent = obj.event; //获得 lay-event 对应的值
            if(layEvent === 'detail'){
                layer.msg('查看操作');
            } else if(layEvent === 'del'){
                layer.confirm('真的删除行么', function(index){
                    obj.del(); //删除对应行（tr）的DOM结构
                    layer.close(index);
                    //向服务端发送删除指令
//                    console.log(obj.data.date);
//                    console.log(obj);
                    $.ajax({
                        type: "post",
                        dataType: "json",
                        url: '/index.php?m=Admin&c=ShowData&a=deleteData',
                        data: {deleteData:obj.data.date},
                        success: function (res) {
                            if(res.status==1){
                                layer.open({
                                    content : "删除成功！",
                                    icon : 1,
                                    yes : function(){
                                        window.location.href='/index.php?m=admin&c=showData&a=manage';
                                    },
                                });
                            }
                            else if(res.status==0){
                                return dialog.error(result.message);
                            }
                            else {
                                return dialog.error("未知错误！");
                            }

                        }
                    });

                });
            } else if(layEvent === 'edit'){
                $.ajax({
                    type: "post",
                    dataType: "json",
                    url: '/index.php?m=Admin&c=ShowData&a=modify',
                    data: {
                        date:obj.data.date,
                        USDT_num:obj.data.usdt_num,
                        USDT_price:obj.data.usdt_price,
                        BTC_num:obj.data.btc_num,
                        BTC_price:obj.data.btc_price,
                        ETH_num:obj.data.eth_num,
                        ETH_price:obj.data.eth_price,
                        BNB_num:obj.data.bnb_num,
                        BNB_price:obj.data.bnb_price,
                        EOS_num:obj.data.eos_num,
                        EOS_price:obj.data.eos_price,
                        CNY_num:obj.data.cny_num

                    },
                    success: function (res) {
                        if(res.status==1){
                            layer.open({
                                content : "修改成功！",
                                icon : 1,
                                yes : function(){
                                    window.location.href='/index.php?m=admin&c=showData&a=manage';
                                },
                            });
                        }
                        else if(res.status==0){
                            return dialog.error(res.message);
                        }
                        else {
                            return dialog.error(res.message);
                        }

                    }
                });
            }
        });

        //分页
        laypage.render({
            elem: 'pageDemo' //分页容器的id
            ,count: 100 //总页数
            ,skin: '#1E9FFF' //自定义选中色值
            //,skip: true //开启跳页
            ,jump: function(obj, first){
                if(!first){
                    layer.msg('第'+ obj.curr +'页');

                }
            }
        });

    });
</script>
</body>
</html>