<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>Tcash</title>
    <link rel="stylesheet" href="/Public/layui/css/layui.css">
    <style>
        .layui-tab-title{
            border-bottom: 2px solid #5FB878;
        }
        .layui-tab-brief>.layui-tab-more li.layui-this:after, .layui-tab-brief>.layui-tab-title .layui-this:after{
            border: none;
        }
    </style>
    <script src="https://cdn.bootcss.com/jquery/3.2.1/jquery.js"></script>

</head>
<body>
<div class="layui-container">
    <div class="layui-row">
        <div class="layui-col-xs12 layui-col-sm10 layui-col-sm-offset1 layui-col-md10 layui-col-md-offset1">
            <div class="layui-tab layui-tab-brief">
                <ul class="layui-tab-title">
                    <li class="layui-this" style="width: 90%;border-bottom: none">Tcash基金每日收益记录</li>
                    <button>123</button>
                </ul>
                <div class="layui-tab-content">
                    <div class="layui-tab-item layui-show">
                        <table class="layui-table">
                            <colgroup>
                                <col width="45%">
                                <col width="40%">
                                <col>
                            </colgroup>
                            <thead>
                            <tr>
                                <th>日期</th>
                                <th>资产总额</th>
                                <th>详情</th>
                            </tr>
                            </thead>
                            <tbody id="table_showdata">
                            <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$ivo): $mod = ($i % 2 );++$i;?><tr>
                                <td><?php echo ($ivo["date"]); ?></td>
                                <td><?php echo ($ivo["principal"]); ?></td>
                                <td><button class="layui-btn layui-btn-radius layui-btn-mini xqbtn">点击查看详情</button></td>
                            </tr><?php endforeach; endif; else: echo "" ;endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div style="width: 300px;margin: 0 auto"><div id="test1" ></div></div>


<script src="/Public/layui/layui.all.js"></script>
<script>
    //获取数据
    var count=<?php echo $count; ?>;

    //注意：选项卡 依赖 element 模块，否则无法进行功能性操作
    layui.use('element', function(){
        var element = layui.element;
    });
    //详情按钮
    $(".xqbtn").click(function () {
        var data_date=$(this).parent().parent().children("td").first().html();

        layui.use('layer', function(){
            var layer = layui.layer;
            $.post('index.php?m=admin&c=index&a=check', {data_date:data_date}, function(str){
                console.log(str);
                var assets=str.cny_num*str.cny_price+
                        str.usdt_num*str.usdt_price+
                        str.bnb_num*str.eth_price+
                        str.eth_num*str.eth_price+
                        str.btc_num*str.btc_price;
                layer.open({
                    skin: 'demo-class',
                    type: 1,
                    content: "<table class=\"layui-table\">\n" +
                    "                                <colgroup>\n" +
                    "                                    <col width=\"130\">\n" +
                    "                                    <col width=\"130\">\n" +
                    "                                    <col width=\"130\">\n" +
                    "                                    <col width=\"130\">\n" +
                    "                                </colgroup>\n" +
                    "                                <thead>\n" +
                    "                                <tr>\n" +
                    "                                    <th>币种</th>\n" +
                    "                                    <th>数量</th>\n" +
                    "                                    <th>价格</th>\n" +
                    "                                    <th>汇总</th>\n" +
                    "                                </tr>\n" +
                    "                                </thead>\n" +
                    "                                <tbody>\n" +
                    "                                <tr>\n" +
                    "                                    <td>BTC</td>\n" +
                    "                                    <td>"+str.btc_num+"</td>\n" +
                    "                                    <td>"+str.btc_price+"</td>\n" +
                    "                                    <td>"+str.btc_num*str.btc_price+"</td>\n" +
                    "                                </tr>\n" +
                    "                                <tr>\n" +
                    "                                    <td>ETH</td>\n" +
                    "                                    <td>"+str.eth_num+"</td>\n" +
                    "                                    <td>"+str.eth_price+"</td>\n" +
                    "                                    <td>"+str.eth_num*str.eth_price+"</td>\n" +
                    "                                </tr>\n" +
                    "                                <tr>\n" +
                    "                                    <td>BNB</td>\n" +
                    "                                    <td>"+str.bnb_num+"</td>\n" +
                    "                                    <td>"+str.bnb_price+"</td>\n" +
                    "                                    <td>"+str.bnb_num*str.eth_price+"</td>\n" +
                    "                                </tr>\n" +
                    "                                <tr>\n" +
                    "                                    <td>USDT</td>\n" +
                    "                                    <td>"+str.usdt_num+"</td>\n" +
                    "                                    <td>"+str.usdt_price+"</td>\n" +
                    "                                    <td>"+str.usdt_num*str.usdt_price+"</td>\n" +
                    "                                </tr>\n" +
                    "                                <tr>\n" +
                    "                                    <td>CNY</td>\n" +
                    "                                    <td>"+str.cny_num+"</td>\n" +
                    "                                    <td>"+str.cny_price+"</td>\n" +
                    "                                    <td>"+str.cny_num*str.cny_price+"</td>\n" +
                    "                                </tr>\n" +
                    "                                <tr>\n" +
                    "                                    <td>总资产</td>\n" +
                    "                                    <td></td>\n" +
                    "                                    <td></td>\n" +
                    "                                    <td>"+assets+
                                                        "</td>\n" +
                    "                                </tr>\n" +
                    "                                </tbody>\n" +
                    "                            </table>" //注意，如果str是object，那么需要字符拼接。
                });
            });
        });
    });

</script>
<script type="text/javascript">
    layui.use('laypage', function(){
        var laypage = layui.laypage;

        //执行一个laypage实例
        laypage.render({
            elem: 'test1' //注意，这里的 test1 是 ID，不用加 # 号
            ,count: count //数据总数，从服务端得到
            ,limit:8  //每页显示数据条数
            ,groups:1 //连续显示页数
            ,jump: function(obj, first){
                //obj包含了当前分页的所有参数，比如：
//                console.log(obj.curr); //得到当前页，以便向服务端请求对应页的数据。

//                console.log(obj.limit); //得到每页显示的条数

                //首次不执行
                if(!first){
                    $.post("/index.php?m=Admin&c=ShowData&a=pageData",{currentPage:obj.curr,pageLimit:obj.limit},function(result){
                        var str="";
//                        var data=JSON.parse(result);
                        console.log(result.length);
                        console.log(result);
                        var assets=[];
                        for(var j=0;j<result.length;j++){
                            assets[j]=result[j].bnb_num*result[j].bnb_price+result[j].btc_num*result[j].btc_price+result[j].cny_price*result[j].cny_num+result[j].eth_num*result[j].eth_price+result[j].usdt_price*result[j].usdt_num;
                        }
                        for(var i=0;i<result.length;i++){
                            str+="<tr><td>"+result[i].date+"</td><td>"+assets[i]+"</td><td><button class='layui-btn layui-btn-radius layui-btn-mini xqbtn'>点击查看详情</button></td></tr>"
                        }
                        document.getElementById("table_showdata").innerHTML=str;
                        $(".xqbtn").click(function () {
                            var data_date=$(this).parent().parent().children("td").first().html();

                            layui.use('layer', function(){
                                var layer = layui.layer;
                                $.post('index.php?m=admin&c=index&a=check', {data_date:data_date}, function(str){
                                    console.log(str);
                                    var assets=str.cny_num*str.cny_price+
                                            str.usdt_num*str.usdt_price+
                                            str.bnb_num*str.eth_price+
                                            str.eth_num*str.eth_price+
                                            str.btc_num*str.btc_price;
                                    layer.open({
                                        skin: 'demo-class',
                                        type: 1,
                                        content: "<table class=\"layui-table\">\n" +
                                        "                                <colgroup>\n" +
                                        "                                    <col width=\"130\">\n" +
                                        "                                    <col width=\"130\">\n" +
                                        "                                    <col width=\"130\">\n" +
                                        "                                    <col width=\"130\">\n" +
                                        "                                </colgroup>\n" +
                                        "                                <thead>\n" +
                                        "                                <tr>\n" +
                                        "                                    <th>币种</th>\n" +
                                        "                                    <th>数量</th>\n" +
                                        "                                    <th>价格</th>\n" +
                                        "                                    <th>汇总</th>\n" +
                                        "                                </tr>\n" +
                                        "                                </thead>\n" +
                                        "                                <tbody>\n" +
                                        "                                <tr>\n" +
                                        "                                    <td>BTC</td>\n" +
                                        "                                    <td>"+str.btc_num+"</td>\n" +
                                        "                                    <td>"+str.btc_price+"</td>\n" +
                                        "                                    <td>"+str.btc_num*str.btc_price+"</td>\n" +
                                        "                                </tr>\n" +
                                        "                                <tr>\n" +
                                        "                                    <td>ETH</td>\n" +
                                        "                                    <td>"+str.eth_num+"</td>\n" +
                                        "                                    <td>"+str.eth_price+"</td>\n" +
                                        "                                    <td>"+str.eth_num*str.eth_price+"</td>\n" +
                                        "                                </tr>\n" +
                                        "                                <tr>\n" +
                                        "                                    <td>BNB</td>\n" +
                                        "                                    <td>"+str.bnb_num+"</td>\n" +
                                        "                                    <td>"+str.bnb_price+"</td>\n" +
                                        "                                    <td>"+str.bnb_num*str.eth_price+"</td>\n" +
                                        "                                </tr>\n" +
                                        "                                <tr>\n" +
                                        "                                    <td>USDT</td>\n" +
                                        "                                    <td>"+str.usdt_num+"</td>\n" +
                                        "                                    <td>"+str.usdt_price+"</td>\n" +
                                        "                                    <td>"+str.usdt_num*str.usdt_price+"</td>\n" +
                                        "                                </tr>\n" +
                                        "                                <tr>\n" +
                                        "                                    <td>CNY</td>\n" +
                                        "                                    <td>"+str.cny_num+"</td>\n" +
                                        "                                    <td>"+str.cny_price+"</td>\n" +
                                        "                                    <td>"+str.cny_num*str.cny_price+"</td>\n" +
                                        "                                </tr>\n" +
                                        "                                <tr>\n" +
                                        "                                    <td>总资产</td>\n" +
                                        "                                    <td></td>\n" +
                                        "                                    <td></td>\n" +
                                        "                                    <td>"+assets+
                                        "</td>\n" +
                                        "                                </tr>\n" +
                                        "                                </tbody>\n" +
                                        "                            </table>" //注意，如果str是object，那么需要字符拼接。
                                    });
                                });
                            });
                        });
                    });
                }
            }
        });
    });
</script>
</body>
</html>