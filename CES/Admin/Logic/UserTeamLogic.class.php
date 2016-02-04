<?php
namespace Admin\Logic;
use Think\Model;
class UserTeamLogic extends Model{
	
	public function addMember($data){
		$user=D('UserInfo','Logic');
		$team=M('TeamInfo');
		
		//检测用户和群组状态
		$uid=$user->where($data['UserId'])->find();
		if(!$uid){
			$this->error='用户不存在';
			return false;
		}
		$tid=$team->where($data['TeamId'])->find();
		if(!$tid){
			$this->error='群组不存在';
			return false;
		}
		
		//如果为普通用户自动添加汉化组权限
		if($uid['UserType']==0){
			$user->updataByType($data['UserId'],1);
		}
		
		$temp=$this->where($data)->find();
		if($temp){
			$this->error('组内已经存在此用户');
			return false;
		}
		
		$userteam=D('UserTeam');
		
	}
}
?>