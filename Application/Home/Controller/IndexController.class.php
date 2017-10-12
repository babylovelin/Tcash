<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends Controller {
    public function index(){

        //*************8登陆注册******************
//        if(!session('adminUser')){
//            redirect('index.php?m=Home&c=Login');
//        }else{
//            $this->display();
//        }
        //*****************************************

        //**************************************展示数据库数据开始
        $time = date("Y-m-d", time()-86400);
        $User = M("assets"); // 实例化User对象
        $condition['date'] = array('like',$time);
// 把查询条件传入查询方法
        $data =$User->where($condition)->find();
        $this->assign('data',$data);


        //***************************************展示数据库数据结束


        //***************************************币安API数据开始
        //1 BTCUSDT
        $this->checkBTCUSDT();
        $this->checkETHUSDT();
        $this->checkBNBBTC();

//    dump($data);
        $this->display();

    }
    //数字货币兑换美元
    public function checkBTCUSDT(){
        $url="https://www.binance.com/api/v1/ticker/24hr?symbol=BTCUSDT";
        $data=file_get_contents($url);
        $mydata=json_decode($data,true);
        $BTCUSDT=$mydata["bidPrice"];
        $this->assign('BTCUSDT',$BTCUSDT);
    }
    public function checkETHUSDT(){
        $url="https://www.binance.com/api/v1/ticker/24hr?symbol=ETHUSDT";
        $data=file_get_contents($url);
        $mydata=json_decode($data,true);
        $ETHUSDT=$mydata["bidPrice"];
        $this->assign('ETHUSDT',$ETHUSDT);
    }
    public function checkBNBBTC(){
        $url="https://www.binance.com/api/v1/ticker/24hr?symbol=BNBBTC";
        $data=file_get_contents($url);
        $mydata=json_decode($data,true);
        $BNBBTC=$mydata["bidPrice"];
        $this->assign('BNBBTC',$BNBBTC);
    }
}