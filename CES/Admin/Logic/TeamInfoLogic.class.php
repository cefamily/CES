<?php
namespace Admin\Logic;
use Think\Model;
class TeamInfoLogic extends Model{
	public function getTeamListByAdmin($page,$view,$id){
		$result = $this->join('user_team ON team_info.TeamId=user_team.TeamId')
			->where("UserId='%d' AND AdminFlag=1",$id)
			->page($page,$view)
			->select();
		return $result;
	}
}
?>