<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends Controller {
    public function index(){
        if(!session('adminUser')){
            redirect('index.php?m=Home&c=Login');
        }else{
            $this->display();
        }

    }
}