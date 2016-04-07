<?php
namespace Home\Api;
use Think\Model;
class UserInfoApi extends Model{
    function user_login($user,$password){
        $where['uname']=$user;
        $where['upassword']=$passowrd;
        $result=$this->where($where)->find();
        if($this){
            return $result; 
        }else{
            return null;
        }
    }
    
    function user_reg(){
        if($this->create($data)){
            if($this->save()){                
                return true;                
            }else{
                return false;
            }
        }else{
            return false;
        }
    }
    
   function change_email($user,$email){
       $rules=array(
           array('uid','require','用户编号必须'),
           array('uemail','require','邮箱必须'),
           array('uid','number','UID格式不符'),
           array('uemail','email','邮箱格式不符')          
       );
      $res=$this->validate($rules)->create($data)
      if($res){
          if($this->save()){
              return true;
          }else{
              return false;
          }
      }else{
          return false;
      }
   }
   
   function change_password($user,$password,$oldpassword){
       $where['uid']=$user;
       $where['upassword']=$oldpassword;
       $rule=array(
           array('uid','require','UID必须'),
           array('uid','number','UID格式不正确'),
           array('upassword','require','密码必须')
       );
       $result=$this->where($where)->find();
       if($result){
           $res=$this-validate($rule)->create();
           if($res){
               if($this->save()){
                   return true;
               }else{
                   return false;
               }
           }else{
               return false;
           }
       }else{
           $this->error='旧密码不正确';
           return false;
       }
   }
   
}
?>