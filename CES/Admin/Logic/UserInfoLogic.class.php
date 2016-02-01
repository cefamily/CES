<?php
namespace Admin\Logic;
use Think\Model;
class UserInfoLogic extends Model{

	function login()
	{
		//$data['UserType']=4;
		$result=$this->where($data)->find();
		if($result)
		{
			if($result['UserType']>2)
			{
				return $result;
			}
			else
			{
				return false;
			}
		}
		else
		{
			return false;
		}
	}
}
?>