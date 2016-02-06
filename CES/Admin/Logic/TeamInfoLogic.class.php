<?php
namespace Admin\Logic;
use Think\Model;
class TeamInfoLogic extends Model{
	public function getTeamListByAdmin($id){
		$result = $this->join('user_team ON team_info.TeamId=user_team.TeamId')
			->where("UserId='%d' AND AdminFlag=1",$id)
			->select();		
		return $result;
	}
}
?>