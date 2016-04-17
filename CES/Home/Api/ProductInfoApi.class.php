<?php
namespace Home\Api;
use Think\Model;
class ProductInfoApi{
    public function _initialize(){
        
    }
    function getListByUid($uid){
        $model = D('UserInfo');
        $where['uid'] = $uid;
        $where['pstate'] = array('LT',90);
        return $model->field('pid,panme,pimg,pstate,premark,pclick,pctime,pup,ptype,pftime,pteam')->where($where)->select();
    }
    function getCountByUid($uid){
        $model = D('UserInfo');
        $where['uid'] = $uid;
        $where['pstate'] = array('LT',90);
        return $model->where($where)->getField('count(1)');
    }
}
?>