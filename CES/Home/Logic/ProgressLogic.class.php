<?php
namespace Home\Logic;
use Think\Model;
class ProgressLogic extends Model{
	
	function addNewProgress($data){
		
		return $this->data($data)->add();
	}
	
	function selectProgress($where){
		return $this->where($where)->select();
	}
	
	function selectProgressByProId($id,$userid=null){
		$where['Proid']=$id;
		$crim=M('Claim');
		$crimdata['Proid']=$id;
		if($userid){
			$crimdata['UserId']=$userid;
		}else{
			$crimdata['Userid']=session('uid');
		}
		
		$claimsta=$crim->where($crimdata)->find();
		if($claimsta){
			return $res=$this->selectProgress($where);
		}else{
			$this->error='没有认领此任务';
			return false;
			}
	}
	
	function modProgress($proud,$uid,$txt,$type){
		//修改任务逻辑
		$data['ProId']=$proud;
		$data['Userid']=$uid;
		$data['ProgressText']=$txt;
		$data['Type']=$type;
		if($this->create($data)){
			if($this->add()){
				return true;
			}else{
				return false;
			}
		}else{
			return false;
		}
	}
	
	
	
	
	
	
	
	
	
	
}
?>