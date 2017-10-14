<?php
namespace Admin\Controller;

use Think\Controller;

class ShowDataController extends Controller
{
    public function demo(){
//        $User = M('assets');
//        $list = $User->where()->order("createTime desc")->limit(8)->select();
//        $arr=['code'=>0,'msg'=>"",data=>$list];
//        $listJson=json_encode($arr);
////        dump($listJson);
//        $count = $User->where()->count();
//        dump($count);
        $this->display();
    }
    public function demoData(){
        $User = M('assets');
//        $list = $User->where()->order("createTime desc")->select();

        $list = $User->where()->order("createTime desc")->limit(($_GET['page']-1)*$_GET['limit'],$_GET['limit'])->select();
        $arr=['code'=>0,'msg'=>"",data=>$list];
        $listJson=json_encode($arr);
        echo $listJson;
    }
    public function index()
    {
        $User = M('assets');
        $list = $User->where()->order("createTime desc")->limit(8)->select();
        $count = $User->where()->count();
        $this->assign('list', $list);
        $this->assign('count', $count);
//       dump($count);
        $this->display();

    }

    public function pageData()
    {
        $User = M('assets');
        $list = $User->where()->order("createTime desc")->limit(($_POST['currentPage'] - 1) * $_POST['pageLimit'], $_POST['pageLimit'])->select();
        $this->ajaxReturn($list);
    }

    //后台管理出事数据查询
    public function manage()
    {
        if(!session('adminUser')){
            redirect('index.php?m=Home&c=Login');
        }
        $User = M('assets');
        $list = $User->where()->order("createTime desc")->limit(8)->select();
        $count = $User->where()->count();
        $this->assign('list', $list);
        $this->assign('count', $count);
        $this->display();
    }

    //删除后台数据
    public function deleteData()
    {
        if(!session('adminUser')){
            redirect('index.php?m=Home&c=Login');
        }
        if ($_POST) {
            $User = M('assets');
            $condition['date'] = array('like', $_POST['deleteData']);
            $User->where($condition)->delete();
            return show(1, '删除成功！');
        } else {
            return show(0, '删除失败！');
        }

    }

    //修改后台数据
    public function modify()
    {
        if(!session('adminUser')){
            redirect('index.php?m=Home&c=Login');
        }
        if ($_POST) {
            $User = M('assets');
            $modify['date'] = $_POST['date'];
            $data['date'] = $_POST['date'];
            $data['USDT_num'] = $_POST['USDT_num'];
            $data['USDT_price'] = $_POST['USDT_price'];
            $data['BTC_num'] = $_POST['BTC_num'];
            $data['BTC_price'] = $_POST['BTC_price'];
            $data['ETH_num'] = $_POST['ETH_num'];
            $data['ETH_price'] = $_POST['ETH_price'];
            $data['BNB_num'] = $_POST['BNB_num'];
            $data['BNB_price'] = $_POST['BNB_price'];
            $data['EOS_num'] = $_POST['EOS_num'];
            $data['EOS_price'] = $_POST['EOS_price'];
            $data['CNY_num'] = $_POST['CNY_num'];
            $result = $User->where($modify)->save($data);
            if ($result !== false) {
                if ($result == 0) {
                    return show(0, '未修改数据！');
                }else{
                    return show(1, '修改成功！');
                }

            }
        } else {
            return show(0, '修改失败！');
        }
    }
}

?>