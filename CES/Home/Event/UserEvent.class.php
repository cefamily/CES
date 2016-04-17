<?php
namespace Home\Event;
use Think\Controller;
class UserEvent extends Controller{
    
    function __get($name){
        $sname = "_get_".$name;
        if(method_exists($this,$sname)){
            $this->$name = $this->$sname();
            return $this->$name;
        }else{
            $this->$name = null;
            return null;
        }
        
    }
    function _get_userstat(){
        $u = session('userstat');
        return $u ? $u : array();        
    }
   
    function _get_uid(){
        if($this->userstat)
            return $this->userstat['uid'];
        return 0;
    }
    function _get_type(){
        if($this->uid)
            return $this->userstat['type'];
        return 0;
    }
    function _get_name(){
        if($this->uid)
            return $this->userstat['name'];
        return '';
    }
   
    function _get_admin(){
         if(session('adminstat'))return 1;return 0;
    }
    
    
    /***
    检查是否已经登录
    登录返回true，未登录返回false
    */
    function _safe_login(){
        if(!$this->uid)$this->error('未登录');
    }
    
    /***
    检查当前用户是否具有指定的type权限
    有返回true，无返回false
    */
    function _safe_type($type){
        if($this->type<$type)$this->error('权限不足');
    }
    
    /***
    检查是否已经登录后台
    已经登录返回true，未登录返回false
    */
    function _safe_admin(){
        if(!$this->admin) $this->error('后台未登录');
    }
    
    /***
    检查该uid权限是否低于当前用户权限
    如果低于返回true，高于返回false
    **/
    function _safe_user_type($uid){
        $user=M('UserInfo');
        $where['uid']=$uid;
        $type=$user->where($where)->getField('utype');
        if($type>=$this->type)$this->error('权限不足');
    }
}
?>