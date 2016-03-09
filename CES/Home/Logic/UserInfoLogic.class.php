<?php
namespace Home\Logic;
use Think\Model;
class UserInfoLogic extends Model{
	//protected $tableName='userinfo';
	function reg($data){
		$user=D('Admin/UserInfo');
		if($user->create($data))
		{
			$result=$user->add();
			if($result){
				return true;
			}
			else
			{
				$this->error='注册失败';
				return false;
			}
		}
		else
		{
			$this->error=$user->getError();
			return false;
		}	
	}
	
	function login($data){
		//$user=M('UserInfo');
		$result=$this->where($data)->find();
		if($result)
		{
			$where['UserId']=$result['userid'];
			$d['LastTime']=date('Y-m-d H:i:s',time());
			$d['UserIp']=get_client_ip();
			$this->where($where)->data($d)->save();
			return $result;
		}
		else
		{
			return false;
		}
	}
	
	function changeEmail($uid,$email)
	{
		$where['UserId']=$uid;
		$data['UserEmail']=$email;
		$result=$this->where($where)->data($data)->save();
		return $result;
	}
	
	function changePassword($uid,$pass,$oldpass)
	{
		$where['UserId']=$uid;
		$where['UserPwd']=$oldpass;
		$data['UserPwd']=$pass;
		
		$temp=$this->where($where)->find();
		if($temp){
			$result=$this->where($where)->data($data)->save();
			if($result){
				return true;
			}else{
				$this->error='修改失败';
				return false;
			}
		}else{
			$this->error='原始密码不正确';
			return false;
		}
	}
}
?>