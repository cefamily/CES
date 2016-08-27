<?php
namespace Home\Api;
use Think\Model;
class ProductInfoApi extends Model{
    public function _initialize(){
        
    }
    function getByPid($pid){
        $model = D('ProductInfo','ViewModel');
        $where['pid'] = $pid;
        $where['pstate'] = array('LT',99);
        $m = $model->where($where)->find();
        if(!$m)return false;
        return $m;  
    }
    function getListByUid($uid,$page,$limit){
        $model = D('ProductInfo');
        $where['uid'] = $uid;
        $where['pstate'] = array('LT',90);
        $m = $model->field('pid,pname,pimg,pstate,premark,pclick,pctime,pup,ptype,pftime,pteam')
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
        $where['pstate'] = $state?$state:array('BETWEEN',array(1,5));
        $m = $model
        ->page($page,$limit)->where($where)->order('pid desc')->select();
        if(!$m)return array();
        return array_values($m);  
        
    }
    function getCountByState($state){
        $model = D('ProductInfo');
        $where['pstate'] = $state?$state:array('BETWEEN',array(1,5));
        return $model->where($where)->getField('count(1)');
    }
    
    function commandList($utype,$page,$limit){
        $model = D('ProductInfo','ViewModel');
        $where = array();
        $where['pstate'] = array('LT',90);
        $where['utype'] = array('LT',$utype);
        $m = $model->where($where)->page($page,$limit)->order(array('ProductInfo.pid'=>'DESC'))->select();
        if(!$m)return array();
        return array_values($m);  
    }
    
    function commandCount($utype){
        $model = D('ProductInfo','ViewModel');
        $where = array();
        $where['pstate'] = array('LT',90);
        $where['utype'] = array('LT',$utype);
        return $model->where($where)->getField('count(1)');
    }
    function commandListByName($value,$utype,$page,$limit){
        $model = D('ProductInfo','ViewModel');
        $where = array();
        $where['pname'] = array('LIKE','%'.$value.'%');
        $where['pstate'] = array('LT',90);
        $where['utype'] = array('LT',$utype);
        $m = $model->where($where)->page($page,$limit)->order(array('ProductInfo.pid'=>'DESC'))->select();
        if(!$m)return array();
        return array_values($m);  
    }
    
    function commandCountByName($value,$utype){
        $model = D('ProductInfo','ViewModel');
        $where = array();
        $where['pname'] = array('LIKE','%'.$value.'%');
        $where['pstate'] = array('LT',90);
        $where['utype'] = array('LT',$utype);
        return $model->where($where)->getField('count(1)');
    }
    function commandListByState($value,$utype,$page,$limit){
        $model = D('ProductInfo','ViewModel');
        $where  = array();
        $where['pstate'] = $value;
        $where['utype'] = array('LT',$utype);
        $m = $model->where($where)->page($page,$limit)->order(array('ProductInfo.pid'=>'DESC'))->select();
        if(!$m)return array();
        return array_values($m);
    }
    function commandCountByState($value,$utype,$page,$limit){
        $model = D('ProductInfo','ViewModel');
        $where  = array();
        $where['pstate'] = $value;
        $where['utype'] = array('LT',$utype);
        return $model->where($where)->getField('count(1)');
    }
    function changeProduct($pid,$data){
        $model = D('ProductInfo');
        return $model->where(array('pid'=>$pid))->data($data)->save();
    }
    function release($data){
        $model = D('ProductInfo');
        return $model->data($data)->add();
    }
    function getListByClaim($uid,$type,$page,$limit){
        $model = D('Claim','ViewModel');
        $where['uid'] = $uid;
        if($type)$where['ctype'] = $type;
        $where['pstate'] = array('LT',90);
        $m = $model->where($where)->page($page,$limit)->order(array('ProductInfo.pid'=>'DESC'))->group('Claim.pid')->select();
        //\Think\Log::write($m,'WARN');
        if(!$m)return array();
        return array_values($m);
        
    }
    function getCountByClaim($uid,$type){
        $model = D('Claim','ViewModel');
        $where['uid'] = $uid;
        if($type)$where['ctype'] = $type;
        $where['pstate'] = array('LT',90);
        return $model->where($where)->getField('count(1)');
        
    }

    function getMyCanClaim($uid,$page,$limit){
        $model = D('ProductInfo');
        $res= $model->query('SELECT DISTINCT pro . * FROM  `product_info` pro RIGHT JOIN  `progress` prg ON  `pro`.`pid` =  `prg`.`pid` WHERE  `pro`.`pteam` =0 
        OR  `prg`.`gtext` IN (SELECT  `tid` FROM  `team_user` WHERE  `uid` ='.$uid.') LIMIT '.($page-1)*$limit.','.$limit);
        return $res;
        }
    
    
    
}
?>