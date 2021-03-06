<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>Tcash</title>
    <link rel="stylesheet" href="/Public/layui/css/layui.css">
    <!--<script src="https://cdn.bootcss.com/jquery/3.2.0/jquery.js"></script>-->
    <script src="https://cdn.bootcss.com/jquery/1.8.0/jquery-1.8.0.js"></script>

</head>
<body>
<div style="margin-bottom: 5px;">
    <h1 style="font-size: 25px;text-align: center;padding: 20px">Tcash后台管理</h1>
    <!-- 示例-970 -->
    <!--<ins class="adsbygoogle" style="display:inline-block;width:970px;height:90px" data-ad-client="ca-pub-6111334333458862" data-ad-slot="3820120620"></ins>-->

</div>
<div style="width: 1000px;margin: 0 auto">
<form class="layui-form" action="">
    <div style="width: 900px;margin: 0 auto">
        <div style="width: 400px;display: inline-block">
            <div class="layui-form-item">
                <label class="layui-form-label">日期</label>
                <div class="layui-input-block">
                    <input type="text" name="Tdate" required  lay-verify="required" placeholder="请输入日期如2017-10-01" autocomplete="off" class="layui-input">
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">运行天数</label>
                <div class="layui-input-block">
                    <input type="text" name="runningTime" required  lay-verify="required" placeholder="请输入运行天数" autocomplete="off" class="layui-input">
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">本金</label>
                <div class="layui-input-block">
                    <input type="text" name="principal" required  lay-verify="required" placeholder="请输入本金数" autocomplete="off" class="layui-input">
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">总资产</label>
                <div class="layui-input-block">
                    <input type="text" name="total" required  lay-verify="required" placeholder="请输入本金数" autocomplete="off" class="layui-input">
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">BTC数量</label>
                <div class="layui-input-block">
                    <input type="text" name="btc_num" required  lay-verify="required" placeholder="请输入BTC数量" autocomplete="off" class="layui-input">
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">BTC价格</label>
                <div class="layui-input-block">
                    <input type="text" name="btc_price" required  lay-verify="required" placeholder="请输入BTC价格" autocomplete="off" class="layui-input">
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">BNB数量</label>
                <div class="layui-input-block">
                    <input type="text" name="bnb_num" required  lay-verify="required" placeholder="请输入BNB数量" autocomplete="off" class="layui-input">
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">BNB价格</label>
                <div class="layui-input-block">
                    <input type="text" name="bnb_price" required  lay-verify="required" placeholder="请输入BNB价格" autocomplete="off" class="layui-input">
                </div>
            </div>
        </div>
        <div style="width: 400px;display: inline-block">
            <div class="layui-form-item">
                <label class="layui-form-label">ETH数量</label>
                <div class="layui-input-block">
                    <input type="text" name="eth_num" required  lay-verify="required" placeholder="请输入ETH数量" autocomplete="off" class="layui-input">
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">ETH价格</label>
                <div class="layui-input-block">
                    <input type="text" name="eth_price" required  lay-verify="required" placeholder="请输入ETH价格" autocomplete="off" class="layui-input">
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">USDT数量</label>
                <div class="layui-input-block">
                    <input type="text" name="usdt_num" required  lay-verify="required" placeholder="请输入USDT数量" autocomplete="off" class="layui-input">
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">USDT价格</label>
                <div class="layui-input-block">
                    <input type="text" name="usdt_price" required  lay-verify="required" placeholder="请输入USDT价格" autocomplete="off" class="layui-input">
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">EOS数量</label>
                <div class="layui-input-block">
                    <input type="text" name="eos_num" required  lay-verify="required" placeholder="请输入EOS数量" autocomplete="off" class="layui-input">
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">EOS价格</label>
                <div class="layui-input-block">
                    <input type="text" name="eos_price" required  lay-verify="required" placeholder="请输入EOS价格" autocomplete="off" class="layui-input">
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">CNY数量</label>
                <div class="layui-input-block">
                    <input type="text" name="cny_num" required  lay-verify="required" placeholder="请输入CNY数量" autocomplete="off" class="layui-input">
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">CNY价格</label>
                <div class="layui-input-block">
                    <input type="text" name="cny_price" required  lay-verify="required" placeholder="请输入CNY价格" autocomplete="off" class="layui-input">
                </div>
            </div>
        </div>
    </div>

    <div style="width: 400px;margin: 0 auto">
        <div class="layui-form-item">
            <div class="layui-input-block">
                <button class="layui-btn" lay-submit lay-filter="formDemo">立即提交</button>
                <button type="reset" class="layui-btn layui-btn-primary">重置</button>
            </div>
        </div>
    </div>



</form>
</div>
<script src="/Public/layui/layui.all.js"></script>
<script src="/Public/js/dialog.js"></script>
<script>
    //Demo
    layui.use('form', function(){
        var form = layui.form;

        //监听提交
        form.on('submit(formDemo)', function(data){
//            layer.msg(JSON.stringify(data.field));
//            return false;
//            console.log(data.field.assets);
//            console.log(data);
            $.ajax( {
                url:'/index.php?m=Admin&c=Index&a=addData',// 跳转到 action
                data:{
                    'date':data.field.Tdate,
                    'principal':data.field.principal,
                    'runningTime':data.field.runningTime,
                    'BTC_price':data.field.btc_price,
                    'BTC_num':data.field.btc_num,
                    'BNB_price':data.field.bnb_price,
                    'BNB_num':data.field.bnb_num,
                    'EOS_price':data.field.eos_price,
                    'EOS_num':data.field.eos_num,
                    'ETH_price':data.field.eth_price,
                    'ETH_num':data.field.eth_num,
                    'USDT_price':data.field.usdt_price,
                    'USDT_num':data.field.usdt_num,
                    'CNY_num':data.field.cny_num,
                    'total':data.field.total
                },
                type:'POST',
                dataType:'json',
                success:function(result) {
//                    console.log(result);
                    if(result.status == 0) {
                        return dialog.error(result.message);
                    }
                    if(result.status == 1) {
//                        return dialog.success(result.message, '/index.php?m=admin&c=showData');
                        layer.open({
                            content : "添加成功",
                            icon : 1,
                            yes : function(){
                                window.location.href='/index.php?m=admin&c=showData';
                            },
                        });
                    }
                },
                error : function() {
                    alert("异常！");
                }
            });
            return false;
        });
    });
</script>
</body>
</html>