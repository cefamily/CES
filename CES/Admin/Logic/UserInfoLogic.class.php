<?php
namespace Admin\Logic;
use Think\Model;
class UserInfoLogic extends Model{

	public function login($data)
	{
		//$data['UserType']=4;
		$result=$this->where($data)->find();
		if($result)
		{
			if($result['usertype']>1)
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
		else
		{
			return false;
		}
	}
	
	public function getuser($page,$view=10,$where=false){
		
		$data['result']=$this->field("user_info.*,GROUP_CONCAT(`TeamName` separator ' | ') as TeamName")
						->join('LEFT JOIN user_team ON user_info.UserId=user_team.UserId')
						->join('LEFT JOIN team_info ON user_team.TeamId=team_info.TeamId')
						->where($where)
						->group('user_info.UserId')
						->order('user_info.UserId DESC')
						->page($page,$view)
						->select();
		$data['count']=$this->join('LEFT JOIN user_team ON user_info.UserId=user_team.UserId')
						->join('LEFT JOIN team_info ON user_team.TeamId=team_info.TeamId')
						->group('user_info.UserId')
						->where($where)
						->getField('count(*)');					
		return $data;
	}
	
	public function getuserById($id=0){
		$where['user_info.UserId']=$id;
		$where['UserType']=array('LT',session('admin.usertype'));
		$result=$this->field("user_info.*,GROUP_CONCAT(`TeamName` separator ' | ') as TeamName")
						->join('LEFT JOIN user_team ON user_info.UserId=user_team.UserId')
						->join('LEFT JOIN team_info ON user_team.TeamId=team_info.TeamId')
						->where($where)
						->group('user_info.UserId')
						->find();
		if($result){
			return $result;
		}else{
			$this->error='未查找到此用户';
			return false;
		}
	}
	
	public function getAdmin($page,$view=10){
		$result['data']=$this->where('UserType=2')->page($page,$view)->select();
		$result['count']=$this->where('UserType=2')->getField('count(*)');
		return $result;
	}
	
	private function updata($where,$data){
		$user=D('UserInfo');
		if($user->create($data,2)){
			$result=$user->where($where)->save();
			if($result){
				return true;
			}else{
				$this->error='修改失败';
				return false;
			}
					
		}else{
			$this->error=$user->getError();
			return false;
		}
	}
	public function updataByInfo($id,$info){		
		$where['UserId']=$id;
		$result=$this->updata($where,$info);
		return $result;
	}
	public function updataByType($id,$type){
		$where['UserId']=$id;
		$data['UserType']=$type;
		$result=$this->where($where)->data($data)->save();
		return $result;
	}
	
	public function addAdmin($userid){
			$temp=$this->where('UserId='.$userid)->find();
			if(!$temp){
				$this->error='此用户不存在';
				return false;
			}
			if($temp['usertype']>='2'){
				$this->error='当前用户权限大于等于管理员权限，无法操作';
				return false;
			}
			$t=$this->updataByType($userid,2);
			if($t){
				return true;
			}else{
				$this->error='修改权限失败';
				return false;
			}
	}
	
	public function delAdmin($userid){
		$team=M('UserTeam');
		$data['AdminFlag']=0;
		$where['UserId']=$userid;
		$where['AdminFlag']=1;
		if($team->where($where)->find()){		
			$temp=$team->where($where)->data($data)->save();
			if(!$temp){
				$this->error='撤销群组管理失败，请重新尝试';
				return false;
			}
		}
		
		$t=$this->updataByType($userid,1);
		if($t){
			return true;
		}else{
			$this->error='修改权限失败';
			return false;
		}
	}
}
?>