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
            return NULL;
        }
    }
    
    function user_reg(){
        $rule=array(
            array('uname','require','用户名格式错误',1,'',1),
		    array('uname','4,16','用户名长度要在4-16字符',1,'length',1),
		    array('uname','unique','该用户已存在',1,'unique',1),
		    array('upassword','require','请输入密码',1,'',1),
		    array('uemail','email','Email格式不正确',1)          
        );
        
        if($this->validate($rule)->create($data)){
            if($this->add()){                
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
      $res=$this->validate($rules)->create($data);
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
   
   function add_admin(){
	   //TODO
   }
   
   private function user_type_change($uid,$type){
       //TODO
       $rule=array(
           array('uid','require','UID必须',1),
           array ('uid','number','UID格式不正确'),
           array('utype','number','权限格式不正确'),
           array('utype',array(1,4),'权限格式不正确',1,'between')           
       );
       $data['uid']=$uid;
       $data['utype']=$type;
       if($this->validate($rule)->create($data)){
           if($this->save()){
               return true;
           }else{
               return false;
           }
       }else{
           return false;
       }
       
   }
   
   function get_user_info($uid){
       $where['uid']=$uid;
       $result=$this->where($where)->find();
       if($result){
           return $result;
       }else{
           return NULL;
       }
   }
   
   function get_user_list($type,$data,$page){
       
   
   }
   
   
}
?>