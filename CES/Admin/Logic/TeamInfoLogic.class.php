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
}
?>