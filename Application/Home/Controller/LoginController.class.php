<?php
namespace Home\Controller;
use Think\Controller;
class LoginController extends Controller {
    public function index(){
        if(session('adminUser')){
            redirect('index.php?m=Admin&c=ShowData&a=manage');
        }
        $this->display();
    }
    public function check(){
        $username=$_POST['username'];
        $password=$_POST['password'];
        if(!trim($username)){
           return show(0,'用户名为空！');
        }
        if(!trim($password)){
            return show(0,'密码为空！');
        }
       $ret= D('Admin')->getAdminByUsername($username);
        if(!$ret){
            return show(0,"该用户不存在");
        }
        if($ret['user_password']!=getMd5Password($password)){
            return show(0,"密码不正确！");
        }
        session('adminUser',$ret);
//        dump(session('adminUser'));
        return show(1,'登录成功！');
    }
    public function logout(){
        session('adminUser',null);
        redirect('index.php?m=home&c=login');
    }
}