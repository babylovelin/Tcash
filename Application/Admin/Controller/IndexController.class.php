<?php
namespace Admin\Controller;
use Think\Controller;
class IndexController extends Controller {
    public function index(){
        $this->display();

    }
    public function check(){
        $User=M("assets");
        $condition['date'] = array('like',$_POST['data_date']);
        $data =$User->where($condition)->find();
        $this->ajaxReturn($data);
    }
    public function add(){
        $this->display();
    }
    public function addData(){
//        if($_POST['date']!=null&&$_POST['principal']!=null&&$_POST['runningTime']!=null&&
//            $_POST['BTC_num']!=null&&$_POST['BTC_price']!=null&&$_POST['BNB_price']&&
//            $_POST['BNB_num']!=null&&$_POST['ETH_price']!=null&&$_POST['ETH_num']!=null
//            &&$_POST['USDT_price']!=null&&$_POST['USDT_num']!=null&&$_POST['CNY_num']!=null
//        ){
            $User=M("assets");
            $data['date']=$_POST['date'];
            $data['createTime']=time();
            $data['principal']=$_POST['principal'];
            $data['runningTime']=$_POST['runningTime'];
            $data['BTC_num']=$_POST['BTC_num'];
            $data['BTC_price']=$_POST['BTC_price'];
            $data['BNB_price']=$_POST['BNB_price'];
            $data['BNB_num']=$_POST['BNB_num'];
            $data['ETH_price']=$_POST['ETH_price'];
            $data['ETH_num']=$_POST['ETH_num'];
            $data['EOS_price']=$_POST['EOS_price'];
            $data['EOS_num']=$_POST['EOS_num'];
            $data['USDT_price']=$_POST['USDT_price'];
            $data['USDT_num']=$_POST['USDT_num'];
            $data['CNY_num']=$_POST['CNY_num'];
            $data['total']=$_POST['total'];
            $User->add($data);
            return show(1,"添加成功");
//        }
//        else{
//            return show(0,"添加失败");
//        }
        
    }
}