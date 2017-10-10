<?php
namespace Home\Controller;
use Think\Controller;
class RegisterController extends Controller{
    public function index(){
    }
    //**********邮箱验证开始*******************
    function sendEmailTo($to,$username,$emailtitle,$content){
        $emaildate=date('Y-m-d h:i:s',time());
        $emailcontent='<html><head></head><body><div style="font-family:黑体;min-height:300px; background:#57bfaa;min-width:300px;max-width: 1000px;border: 0px solid #ccc; margin: auto;">';
        $emailcontent.='<div style="width: 100%;font-size:20px;text-align: center;background: #4484c5; height: 50px;color: #FFF;line-height: 50px">邮件提醒</div>';
        $emailcontent.='<div style="padding: 20px;color: #fff">';
        $emailcontent.='<h3>尊敬的【'.$username.'】你好：</h3>';
        $emailcontent.='<p style="line-height: 30px">'.$content.'</p>';
        $emailcontent.='<p style="line-height: 30px">点击链接完成验证</p>';
        $emailcontent.='<p style="text-align: right;">Tcash团队</p>';
        $emailcontent.='<p style="text-align: right;">'.$emaildate.'</p>';
        $emailcontent.='</div>';
        $emailcontent.='</div></body></html>';
        $to=$to;
        $username=$username;
        $emailtitle=$emailtitle;
//        if(SendMail($to,$emailtitle,$emailcontent)){
        if(SendMail($to,$username,$emailtitle,$emailcontent)){
            return true;
        }else{
            return false;
        }
    }
    public function sendCheckEmail(){
        $user=M('user');
        $account=session('adminUser');
        if(session('adminUser')==""){
            return show(0,'还未登录！请登录');
        }
        $usersta=$user->where(array('user_email'=>$account['user_email'],'user_status'=>0))->select(); //已经存储了邮箱地址，但是激活状态为0
        if(!$usersta){
            $this->success('你的账号已经激活，不需要再次激活!','/');
        }else{ //没有激活过的话
            if(IS_POST){
                $user=M('user');
                $emailID=base64_encode($account['user_email']);  //加密
                $emailkey=md5($this->randStr(6,3));
                $keydate=time();
                //如果只是更新个别字段的值，可以使用setField方法。
                //setField方法支持同时更新多个字段，只需要传入数组即可
                $result=$user->where(array('user_email'=>$account['user_email']))->setField(array('email_key'=>$emailkey,'datatime'=>$keydate));
                $content="注册成功，你在本站注册的邮箱需要验证！<a href='tcash.gcan.top/index.php?m=home&c=Register&a=checkid&emailkey="
                    .base64_encode($emailkey)."&email=".$emailID."'>tcash.gcan.top/index.php?m=home&c=Register&a=checkid&emailkey="
                    .base64_encode($emailkey)."&email=".$emailID."/a>复制此链接到浏览器打开激活";
                $ema=$this->sendEmailTo($account['user_email'], $account['user_name'], '来自Tcash的邮箱验证', $content);
                if($ema){
                    $data['code']="1101";
                    $data['status']="OK";
                }else{
                    $data['code']="1102";
                    $data['status']="false";
                }
                $this->ajaxReturn($data);
            }else{
                $this->assign('email',$account['user_email']);
                $this->display();
            }
        }
    }
    public function checkid(){
        $get=$_GET;
        $user=M('user');
        $result=$user->where( array('email'=>base64_decode($get['email']),'email_key'=>base64_decode($get['emailkey'])))->select();
        if ($result){
            $keytime=$result[0]['datatime'];
            $presenttime=time();
            $agotime=($presenttime-$keytime);
            if($agotime>3600){
                echo "超过10分钟,链接失效";
            }else{
                $result=$user->where( array('email'=>base64_decode($get['email']),'email_key'=>base64_decode($get['emailkey'])))->setField('user_status','1');
                $this->success('激活成功','/Index/index');
            }
        }
        else{
            $this->success('激活失败重新激活','/Index/sendCheckEmail');
        }
    }
    function randStr($length=4,$type="1"){
        $array = array(
            '1' => '0123456789',
            '2' => 'ABCDEFGHIJKLMNOPQRSTUVWXYZ',
            '3' => '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz',
        );
        $string = $array[$type];
        $count = strlen($string)-1;
        $rand = '';
        for ($i = 0; $i < $length; $i++) {
            $rand .= $string[mt_rand(0, $count)];
        }
        return $rand;
    }
//****************邮箱验证结束*******************


//***********************短信注册开始********************

    function http_request($url,$data = null){

        if(function_exists('curl_init')){
            $curl = curl_init();
            curl_setopt($curl, CURLOPT_URL, $url);

            if (!empty($data)){
                curl_setopt($curl, CURLOPT_POST, 1);
                curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
            }
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
            $output = curl_exec($curl);
            curl_close($curl);


            $result=preg_split("/[,\r\n]/",$output);

            if($result[1]==0){
                return "curl success";
            }else{
                return "curl error".$result[1];
            }
        }elseif(function_exists('file_get_contents')){

            $output=file_get_contents($url.$data);
            $result=preg_split("/[,\r\n]/",$output);

            if($result[1]==0){
                return "success";
            }else{
                return "error".$result[1];
            }


        }else{
            return false;
        }

    }
    function  send(){
        $code = rand(100000,999999);
        $data ="【Tcash】 您好，您的验证码是" . $code ."如非本人操作，请忽略";
        $_SESSION['code'] = $code;
        $post_data = array();
        $post_data['account'] ="N4243086";
        $post_data['pswd'] = "FmM4RVl3La3966";
        $post_data['msg']="$data";$post_data['mobile'] ="15533545886";

        $post_data['needstatus']='true';
        $url='https://zapi.253.com/msg/HttpBatchSendSM';
        $res=$this->http_request($url,http_build_query($post_data));
        var_dump($res);
    }

//***********************短信注册结束********************



}