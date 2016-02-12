<?php
namespace Admin\Logic;
use Think\Model;
class UserTeamLogic extends Model{
	
	public function addMember($data){
		
		if(!$this->checkuser($data)) return false;
		$userinfo=D('UserInfo','Logic');
		$uid=$userinfo->where('UserId='.$data['UserId'])->find();
		
		//如果为普通用户自动添加汉化组权限
		if($uid['usertype']=='0'){
			$t=$userinfo->updataByType($data['UserId'],1);
			if(!$t){
				$this->error='更改权限失败';
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
			$this->error='addm'.$userteam->getError();
			return false;
		}
	}
	
	public function delMember($data){	
		
		$result=$this->where($data)->delete();
		
		//如果该用户没有属于任何组且仅为汉化组成员则撤销其汉化组权限，降级为普通用户
		$m=$this->where('UserId='.$data['UserId'])->find();
		if(!$m){
			$userinfo=D('UserInfo','Logic');
			$uid=$userinfo->where('UserId='.$data['UserId'])->find();
			if($uid['usertype']=='1'){
				$t=$userinfo->updataByType($data['UserId'],0);
				if(!$t){
					$this->error='type:'.$userinfo->getError();
					return false;
				}
			}
		}
		
		if($result){
			return true;
		}else{
			return false;
		}
		
	}
	
	public function addTeamAdmin($data){
		if(!checkuser($data,true)) return false;
		
		$userteam=D('UserTeam');
		$data['AdminFlag']='1';
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
	
	public function delTeamAdmin($where){
		$data['AdminFlag']=0;
		$result=$this->where($where)->data($data)->save();
		if($result){
			return true;
		}else{
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
	
	
	public function checkadmin($userid,$teamid){
		$data['UserId']=$userid;
		$data['TeamId']=$teamid;
		$data['AdminFlag']=1;
		$result=$this->where($data)->find();
		if($result){
			return true;
		}else{
			return false;
		}
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
		
		return true;
	}
}
?>