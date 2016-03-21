<?php
namespace Home\Logic;
use Think\Model;
class ProgressLogic extends Model{
	
	function addNewProgress($data){
		
		return $this->data($data)->add();
	}
	
	function selectProgress(){
		return $this->where($data)->select();
	}
	
	
	
	
	
	
	
	
}
?>