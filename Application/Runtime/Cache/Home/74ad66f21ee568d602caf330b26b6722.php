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
<div id="main" style="width:100%; height : 600px"></div>
<script src="/Public/js/echarts.js"></script>
<script>
    var width=parseInt(document.body.clientWidth);
    if(width<=320){
        $("#main").style.height=400+"px";
    }
    var myChart = echarts.init(document.getElementById('main'));
    option = {
        title : {
            text: 'Tcash基金',
            subtext: '总资产 1120000.00',
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
            bottom:0,
            data: ['BTC','CNY','BNB','USDT']
        },
        series : [
            {
                name: '资产情况',
                type: 'pie',
                radius : '55%',
                center: ['50%', '60%'],
                data:[
                    {value:335, name:'BTC'},
                    {value:310, name:'CNY'},
                    {value:234, name:'BNB'},
                    {value:135, name:'USDT'}
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