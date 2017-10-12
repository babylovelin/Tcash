<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>Tcash</title>
    <link rel="stylesheet" href="/Public/layui/css/layui.css">
    <!--<script src="https://cdn.bootcss.com/jquery/3.2.0/jquery.js"></script>-->
    <script src="https://cdn.bootcss.com/jquery/1.8.0/jquery-1.8.0.js"></script>
    <style>
        p{
            text-align: center;
            padding-bottom: 5px;
        }
    </style>

</head>
<body>
<div id="main" style="width:100%;"></div>
<p>Tcash基金运行第 <b><?php echo ($data["runningtime"]); ?></b> 天</p>
<p id="date">2017-10-12</p>
<p>总收益 <b id="rateOfReturn"></b>%</p>
<p><b id="cnyReturn">200000.00(CNY)</b>(CNY)</p>
<div style="width: 60px;margin: 0 auto"><button class="layui-btn layui-btn-radius layui-btn-small" style="margin-left: -5px" onclick="toHistory()">历史收益</button></div>

<script src="/Public/js/echarts.js"></script>
<script>
    function toHistory() {
        window.location="/index.php?m=admin&c=ShowData";
    }
    var width=parseInt(document.body.clientWidth);
    if(width<=320){
        document.getElementById("main").style.height=400+"px";
    }
    if(width>320&&width<=375){
        document.getElementById("main").style.height=450+"px";
    }
    if(width>375&&width<=414){
        document.getElementById("main").style.height=500+"px";
    }
    if(width>414){
        document.getElementById("main").style.height=600+"px";
    }
    var myChart = echarts.init(document.getElementById('main'));
    //定义美元兑换人民币
    var USDT=6.8;

    //将后台数据的字符串转对象
    var mydata=JSON.parse('<?php echo json_encode($data); ?>');
    var BTCUSDT=JSON.parse('<?php echo json_encode($BTCUSDT); ?>');
    var ETHUSDT=JSON.parse('<?php echo json_encode($ETHUSDT); ?>');
    var BNBBTC=JSON.parse('<?php echo json_encode($BNBBTC); ?>');
    var BNBUSDT=BTCUSDT*BNBBTC;
//    console.log(BNBUSDT)
    //货币的种类
    var currency=["BTC","BNB","ETH","USDT","CNY"];
    //API获取每一种货币的对换DSDT数
    var usdPrice=[BTCUSDT,BNBUSDT,ETHUSDT];
    //每一种货币的价格
    var price=[mydata.btc_price,mydata.bnb_price,mydata.eth_price,mydata.usdt_price,mydata.cny_price];
    //所有货币数量
    var number=[mydata.btc_num,mydata.bnb_num,mydata.eth_num,mydata.usdt_num,mydata.cny_num];
    //每一种数字货币的数量
    var number0=[mydata.btc_num,mydata.bnb_num,mydata.eth_num];
    //CNY和美$的数量
    var number1=[mydata.usdt_num,mydata.cny_num];
    //每一种数字货币折算为人民币
    var toCNY=[];
    for(var i=0;i<usdPrice.length;i++){
        toCNY[i]=usdPrice[i]*number0[i]*USDT;
    }
//    console.log(toCNY);
    //所有货币的总值
    var assets0=0;
    for(var i=0;i<toCNY.length;i++){
        assets0=assets0+toCNY[i];
    }
    assets0=parseFloat(assets0)+parseFloat(number1[1]);
    console.log(assets0);
    var assets ="总资产："+assets0;
    //所有货币兑换成人民币
    var arr=[number1[0]*USDT,number1[1]];
    var allToCNY=toCNY.concat(arr);

    //收益CNY  总资产-成本
    var cnyReturn=assets0-mydata.principal;
    //收益率  （总资产-本金）/本金
    var rateOfReturn=(assets0-mydata.principal)/mydata.principal*100;
    //获取今天的日期
    var today=new Date();
    var year=today.getFullYear();
    var month=today.getMonth()+1;
    var day=today.getDate();
    var date=year+"-"+month+"-"+day;
    //显示今天的日期
    document.getElementById("date").innerHTML=date;
    //显示收益
    document.getElementById("rateOfReturn").innerHTML=rateOfReturn;
    document.getElementById("cnyReturn").innerHTML=cnyReturn;

    option = {
        title : {
            text: 'Tcash基金',
            subtext:assets,
            textStyle:{
                fontSize:25,
            },
            padding:[5,10,5,10],
            top:'5%',
            x:'center'
        },
        tooltip : {
            trigger: 'item',
            formatter: "{a} <br/>{b} : {c} ({d}%)"
        },
        legend: {
//            orient: 'vertical',
            bottom:20,
            data: ['BTC','BNB','ETH','USDT','CNY'],
            formatter:function (name) {
                var index=0;
                currency.forEach(function (value,i) {
                    if(value == name){
                        index = i;
                    }
                });
                return name+"  "+number[index];

            }


        },
        series:[
            {
                name: '资产情况',
                type: 'pie',
                radius : '55%',
                center: ['50%', '47%'],
                data:[
                    {value:allToCNY[0], name:currency[0]},
                    {value:allToCNY[1], name:currency[1]},
                    {value:allToCNY[2], name:currency[2]},
                    {value:allToCNY[3], name:currency[3]},
                    {value:allToCNY[4], name:currency[4]}
                ],
                itemStyle: {
                    emphasis: {
                        shadowBlur: 10,
                        shadowOffsetX: 0,
                        shadowColor: 'rgba(0, 0, 0, 0.5)'
                    }
                }
            }
        ]
    };
    myChart.setOption(option);
    window.onresize = myChart.resize;
</script>
</body>
</html>