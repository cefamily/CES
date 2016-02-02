<?php
namespace Home\Logic;
class UserInfoLogic{
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
		$user=M('UserInfo');
		$result=$user->where($data)->find();
		if($result && $result!=NULL)
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