<?php
namespace Home\Api;
use Think\Model;
class ProductInfoApi{
    public function _initialize(){
        
    }
    function getListByUid($uid,$page,$limit){
        $model = D('ProductInfo');
        $where['uid'] = $uid;
        $where['pstate'] = array('LT',90);
        $m = $model->field('pid,panme,pimg,pstate,premark,pclick,pctime,pup,ptype,pftime,pteam')
        ->page($page,$limit)->where($where)->order('pid desc')->select();
        if(!$m)return array();
        return array_values($m);  
    }
    function getCountByUid($uid){
        $model = D('ProductInfo');
        $where['uid'] = $uid;
        $where['pstate'] = array('LT',90);
        return $model->where($where)->getField('count(1)');
    }
    function getListByState($state,$page,$limit){
        $model = D('ProductInfo','ViewModel');
        $where['pstate'] = $state?$state:array('IN','1,3,5');
        $m = $model
        ->page($page,$limit)->where($where)->order('pid desc')->select();
        if(!$m)return array();
        return array_values($m);  
        
    }
    function getCountByState($state){
        $model = D('ProductInfo');
        $where['pstate'] = $state?$state:array('IN','1,3,5');
        return $model->where($where)->getField('count(1)');
    }
    
    
    
    
}
?>