<?php
namespace Admin\Logic;
use Think\Model;
class TeamInfoLogic extends Model{
	public function getTeamListByAdmin($page,$view,$id){
		$result['data'] = $this->join('user_team ON team_info.TeamId=user_team.TeamId')
			->where("UserId='%d' AND AdminFlag=1",$id)
			->page($page,$view)
			->select();
		$result['count'] = $this->join('user_team ON team_info.TeamId=user_team.TeamId')
			->where("UserId='%d' AND AdminFlag=1",$id)
			->getField('count(*)');
		return $result;
	}
	
	public function createTeam($name){
		$team=D('TeamInfo');
		$data['TeamName']=$name;
		if($team->create($data)){
			$result=$team->add();
			if($result){
				return true;
			}else{
				$this->error='添加失败';
				return false;
			}
		}else{
			$this->error=$team->getError();
			return false;
		}
	}
}
?>