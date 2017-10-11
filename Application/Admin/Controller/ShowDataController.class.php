<?php
namespace Admin\Controller;
use Think\Controller;
class ShowDataController extends Controller
{
    public function index()
    {
        $User = M('assets');
        $list = $User->where()->order("createTime desc")->limit(8)->select();
        $count=$User->where()->count();
        $this->assign('list',$list);
        $this->assign('count',$count);
//       dump($count);
        $this->display();

    }
    public function pageData(){
        $User = M('assets');
        $list = $User->where()->order("createTime desc")->limit(($_POST['currentPage']-1)*$_POST['pageLimit'],$_POST['pageLimit'])->select();
        $this->ajaxReturn($list);
    }
}
?>