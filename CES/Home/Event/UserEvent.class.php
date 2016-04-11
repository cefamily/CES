<?php
namespace Home\Event;
use Think\Controller;
class UserEvent extends Controller{
    /***
    检查是否已经登录
    登录返回true，未登录返回false
    */
    function _safe_login(){
        if(isset(session('userstst')){
            return true;
        }else{
            return false;
        }
    }
    
    /***
    检查当前用户是否具有指定的type权限
    有返回true，无返回false
    */
    function _safe_type($type){
        $user=M('UserInfo');
        $where['uid']=session('userstst')['uid'];
        $re=$user->where($where)->find();
        if($re['type']>=$type){
            return true;
        }else{
            return false;
        }
    }
    
    /***
    检查是否已经登录后台
    已经登录返回true，未登录返回false
    */
    function _safe_admin(){
        
    }
}
?>