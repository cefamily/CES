<?php
namespace Home\Event;
class UserEvent extends OutEvent{
   
    public function __construct(){
        
        //test
        //$this->admin = $this->uid = 1;
        //$this->type = 4;
    }
    function __get($name){
        $sname = "_get_".$name;
        if(method_exists($this,$sname)){
            $this->$name = $this->$sname();
            return $this->$name;
        }else{
            $this->$name = NULL;
            return NULL;
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
            return $this->userstat['utype'];
        return 0;
    }
    function _get_name(){
        if($this->uid)
            return $this->userstat['uname'];
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
    $pass 是否允许平级，true允许，false不允许，默认false
    如果低于返回true，高于返回false
    **/
    function _safe_user_type($uid,$strict=false){
        $user=M('UserInfo');
        $where['uid']=$uid;
        $type=$user->where($where)->getField('utype');
        if($strict){
        if($type>$this->type)$this->error('权限不足');
        }else{
            if($type>=$this->type)$this->error('权限不足');
        }
    }
}
?>