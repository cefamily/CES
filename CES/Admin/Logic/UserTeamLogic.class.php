<?php
namespace Admin\Logic;
use Think\Model;
class UserTeamLogic extends Model{
	
	public function addMember($data){
		
		if(!checkuser($data)) return false;
		
		//如果为普通用户自动添加汉化组权限
		if($uid['UserType']==0){
			$t=$user->updataByType($data['UserId'],1);
			if(!$t){
				$this->error=$user->getError();
				return false;
			}
		}
		
		$temp=$this->where($data)->find();
		if($temp){
			$this->error='组内已经存在此用户';
			return false;
		}
		
		$userteam=D('UserTeam');
		if($userteam->create($data)){
			$result=$userteam->add();
			if($result){
				return true;
			}else{
				$this->error='添加失败';
				return false;
			}
		}else{
			$this->error=$userteam->getError();
			return false;
		}
	}
	
	public function addTeamAdmin($data){
		if(!checkuser($data,true)) return false;
		
		$userteam=D('UserTeam');
		$data['AdminType']='1';
		if($userteam->create($data)){
			$result=$userteam->add();
			if($result){
				return true;
			}else{
				$this->error='添加失败';
				return false;
			}
		}else{
			$this->error=$userteam->getError();
			return false;
		}
		
	}
	
	public function getlist($where,$page=1,$view=10){
		$team=M('UserTeam');
		$result['data']=$team->join('user_info ON user_info.UserId=user_team.UserId')
								->join('team_info ON team_info.TeamId=user_team.TeamId')
								->where($where)
								->page($page,$view)
								->select();
		$result['count']=$team->join('user_info ON user_info.UserId=user_team.UserId')
								->join('team_info ON team_info.TeamId=user_team.TeamId')
								->where($where)
								->getField('count(*)');
		return $result;
	}
	
	private function checkuser($data,$flag=false){
		$user=D('UserInfo','Logic');
		$team=M('TeamInfo');
		
		//检测用户和群组状态
		$uid=$user->where($data['UserId'])->find();
		if(!$uid){
			$this->error='用户不存在';
			return false;
		}
		if($flag && !$uid['UserType']>1){
			$this->error='该用户权限不足';
			return false;
		}
		
		$tid=$team->where($data['TeamId'])->find();
		if(!$tid){
			$this->error='群组不存在';
			return false;
		}
	}
}
?>