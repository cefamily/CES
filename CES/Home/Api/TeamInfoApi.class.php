<?php
namespace Home\Api;
use Think\Model;
class TeamInfoApi extends Model{
	function getTeamInfo($tid){
		$where['tid']=$tid;
		return $this->where($where)->find();
	}
	
	function addTeam($data){
		$rule=array(
			// array('tname','/^[A-Za-z0-9_]+$/','组名中只能含有字母、数字、_(下划线)',1,'regx',1),
		    // array('tname','4,30','组名长度要在4-30字符',1,'length',1),
		    array('tname','unique','该组名已存在',1,'unique',1),
		);
		if($this->validate($rule)->create($data)){
            if($id=$this->add()){                
                return true;
            }else{
				$this->error='未知错误';
                return false;
            }
        }else{
            return false;
        }			
	}
	
	function delTeam($tid){
		$where['tid']=$tid;
		D('TeamUser','api')->where($where)->delete();
		$z = $this->where($where)->delete();
		return $z;
	}
	
	function getTeamList($page,$limit){
		return $this->page($page,$limit)->select();
	}

	function changeTeamName($tid,$name){
		$where['tid']=$tid;
		$data['tname']=$name;
		return $this->where($where)->save($data);
	}
	
}
?>