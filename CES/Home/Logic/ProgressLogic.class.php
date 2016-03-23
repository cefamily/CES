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
	
	function selectProgressByProId($id){
		$where['Proid']=$id;
		$crim=M('Claim');
		$crimdata['Proid']=$id;
		$crimdata['UserId']=session('uid');
		$claimsta=$crim->where($crimdata)->find();
		if($claimsta){
			return $res=$this->selectProgress($where);
		}else{
			$this->error='没有认领此任务';
			return false;
	}
	
	
	
	
	
	
	
	
	
	
	
	
	
	
}
?>