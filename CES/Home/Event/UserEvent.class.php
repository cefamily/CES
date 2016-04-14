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
            $this->error('未登录');
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
            $this->error('权限不足');
            return false;
        }
    }
    
    /***
    检查是否已经登录后台
    已经登录返回true，未登录返回false
    */
    function _safe_admin(){
        _safe_login();
        if(isset(session('adminstat')){
            return true;
        }else{
            $this->error('后台未登录');
            return false;
        }
    }
    
    /***
    检查该uid权限是否低于当前用户权限
    如果低于返回true，高于返回false
    **/
    function _safe_user_type($uid){
        $user=M('UserInfo');
        $where['uid']=$uid;
        $res=$user->where($where)->find();
        if($res['type']<session('userstat')['type']){
            return true;
        }else{
            $this->error('权限不足');
            return false;
        }
    }
}
?>