<?php
namespace Common\Model;
use Think\Model;
class AdminModel extends Model{
    private $_db='';
    public function __construct()
    {
        $this->_db=M('user');  //实例化user数据表
    }

    public function getAdminByUsername($username){ //通过同户名去数据库表中查找用户
       $ret= $this->_db->where('user_phone="'.$username.'"')->find();
        if(!$ret){
            $ret= $this->_db->where('user_email="'.$username.'"')->find();
        }
        return $ret;
    }
}
?>