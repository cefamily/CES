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
	
	public function getuser($page,$where=false){
		
		$data['result']=$this->field('user_info.*,TeamName')
						->join('LEFT JOIN user_team ON user_info.UserId=user_team.UserId')
						->join('LEFT JOIN team_info ON user_team.TeamId=team_info.TeamId')
						->where($where)
						->order('user_info.UserId DESC')
						->page($page,'30')
						->select();
		$data['count']=$this->join('LEFT JOIN user_team ON user_info.UserId=user_team.UserId')
						->join('LEFT JOIN team_info ON user_team.TeamId=team_info.TeamId')
						->field('count(*) as count')
						->where($where)
						->find();
						
		return $data;
	}
	
	private function updata($where,$data){
		$user=D('UserInfo');
		if($user->create($data)){
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
	
	public function updataByType($id,$type){
		$where['UserId']=$id;
		$data['UserType']=$type;
		$result=$this->updata($where,$data);
		return $result;
	}
}
?>