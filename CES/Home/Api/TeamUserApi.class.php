<?php
namespace Home\Api;
use Think\Model;
class TeamUserApi extends Model{
	
	function addMenmber($data){		
		if($this->create($data)){
			$result=$this->add();
			if($result){
				return true;
			}else{
				$this->error='添加失败';
				return false;
			}
		}else{
			return false;
		}
	}
	function delMenmber($uid){
		$where=$uid;
		return $this->where($where)->delete();
	}
	
	function addMaster($data,$in){
		if($in){
			$t=$this->where($data)->setField('tadmin','1');
			return $t;
		}else{
		$data['tadmin']='1';
			if($userteam->create($data)){
				$result=$userteam->add();
				if($result){
					return true;
				}else{
					$this->error='添加失败';
					return false;
				}
			}else{
				return false;
			}
		}
	}
	
	function delMaster($data){
		return $this->where($data)->setField('tadmin','0');
	}

	function getTeamUserList($tid,$type=0){
		$where['tid']=$tid;
		$where['tadmin']=$type;
		$z = $this->field('user_info.uid,user_info.uname,user_info.nickname')->where($where)->join('user_info ON user_info.uid=team_user.uid')->select();
		if($z)foreach($z as &$v)if(!$v['nickname'])$v['nickname'] = $v['uname'];
		return $z;

	}
	
	/***
		检查uid用户是否还存在其他组
	*/
	function userTeamCheck($uid){
		$where['uid']=$uid;
		$rs=$this->where($where)->getField('count(*)');
		if($rs>0){
			return true;
		}else{
			return false;
		}
	}
	
	/***
		检查uid用户是否属于tid组
	*/
	function userInTempCheck($uid,$tid){
		$where['uid']=$uid;
		$where['tid']=$tid;
		$rs=$this->where($where)->find();
		if($rs){
			return true;
		}else{
			return false;
		}
	}
}
?>