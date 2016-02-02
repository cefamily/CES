<?php
namespace Admin\Logic;
use Think\Model;
class UserInfoLogic extends Model{

	function login($data)
	{
		//$data['UserType']=4;
		$result=$this->where($data)->find();
		if($result)
		{
			if($result['usertype']>2)
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