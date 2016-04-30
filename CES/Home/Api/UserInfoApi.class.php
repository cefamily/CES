<?php
namespace Home\Api;
use Think\Model;
class UserInfoApi extends Model{
 	
	private $USER_FIELD_LIST='uid,uname,uemail,utype,uavatar,uctime,uip,ulltime';
	/***
		用户登录API
		参数
		user 用户名
		password 密码（MD5加密后)
	*/
    function userLogin($data){
        $where['uname']=$data['user'];
        $where['upassword']=md5($data['password'].$data['user']);
        $result=$this->where($where)->find();
        if($this){
            return $result; 
        }else{
            return NULL;
        }
    }
    
	/***
		用户注册
		参数
		data 用户注册信息
			uname 用户名
			upassword 密码
			uemail 邮箱
	*/
    function user_reg($data){
        $rule=array(
			array('uname','/^[A-Za-z0-9_]+$/','用户名中只能含有字母、数字、_(下划线)',1,'regx',1),
		    array('uname','4,16','用户名长度要在4-16字符',1,'length',1),
		    array('uname','unique','该用户已存在',1,'unique',1),
		    array('upassword','require','请输入密码',1,'',1),
		    array('uemail','email','Email格式不正确',1),          
        );
        $data['password']=md5($data['password'].$data['uname']);
        if($this->validate($rule)->create($data)){
            if($id=$this->add()){                
                return $id;
            }else{
				$this->error='未知错误';
                return false;
            }
        }else{
            return false;
        }
    }
    
	/***
		修改用户邮箱
		参数
		user 用户ID
		email 修改后的邮箱
	*/
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
   
   
   /***
   		修改用户密码
		参数
		user 用户ID
		password 要修改的密码
		oldpassword 旧密码
		（密码均为MD5加密后的)
   */
   function change_password($user,$password,$oldpassword){
	   
       $temp=$this->_getUserInfo($user);
       $data['upassword']='';
       $data['uid']=$user;
       if($temp){
            $where['upassword']=md5($oldpassword.$temp['uname']); 
            $data['upassword']=md5($password.$temp['uname']);
       }else{
           return false;
       }
       
       $rule=array(
           array('uid','require','UID必须'),
           array('uid','number','UID格式不正确'),
           array('upassword','require','密码必须')
       );
       $result=$this->where($where)->find();
       if($result){
           $res=$this-validate($rule)->create($data);
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
   
   /***
   		添加管理员（权限3）
   */
   
   function add_admin(){
	   //TODO
   }
      
   /***
   		获取用户列表
   */
   function get_user_list($type,$data,$page){
       
   
   }
   
   /***
   		修改用户权限（私有方法)
		参数
		uid 用户ID
		type 要修改的权限
   */
   private function _userTypeChange($uid,$type){
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
   
   
   /***
   		获取用户所有信息(私有方法)
		参数
		uid 用户ID
   */
   private function _getUserInfo($uid){
       $where['uid']=$uid;
       $result=$this->where($where)->find();
       if($result){
           return $result;
       }else{
           return NULL;
       }
   }
   

   
   
}
?>