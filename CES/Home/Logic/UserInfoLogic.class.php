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
			return $result;
		}
		else
		{
			return false;
		}
	}
}
?>