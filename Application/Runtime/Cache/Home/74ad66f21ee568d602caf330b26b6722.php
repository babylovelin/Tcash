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
<script src="/Public/js/echarts.js"></script>
<script>
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
    //将后台数据的字符串转对象
    var mydata=JSON.parse('<?php echo json_encode($data); ?>');
    //货币的种类
    var currency=["BTC","BNB","USDT","CNY","ETH"];
    //每一种货币的价格
    var price=[mydata.btc_price,mydata.bnb_price,mydata.usdt_price,mydata.cny_price,mydata.eth_price];
    //每一种货币的数量
    var number=[mydata.btc_num,mydata.bnb_num,mydata.usdt_num,mydata.cny_num,mydata.eth_num];
    //每一种货币折算为人民币
    var toCNY=[];
    for(var i=0;i<price.length;i++){
        toCNY[i]=price[i]*number[i];
    }
    //所有货币的总值
    var assets0=price[0]*number[0]+price[1]*number[1]+price[2]*number[2]+price[3]*number[3]+price[4]*number[4];
    var assets="总资产："+assets0;
    //收益CNY  总资产-成本
    var cnyReturn=assets0-mydata.principal;
    //收益率  （总资产-本金）/本金
    var rateOfReturn=(assets0-mydata.principal)/mydata.principal;
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
            bottom:10,
            data: ['BTC','CNY','BNB','USDT'],
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
                center: ['50%', '50%'],
                data:[
                    {value:toCNY[0], name:currency[0]},
                    {value:toCNY[1], name:currency[1]},
                    {value:toCNY[2], name:currency[2]},
                    {value:toCNY[3], name:currency[3]},
                    {value:toCNY[4], name:currency[4]}
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