<?php
namespace Home\Logic;
use Think\Model;
class ProgressLogic extends Model{
	
	function addNewProgress($data){
		
		return $this->data($data)->add();
	}
	
	
	
	
	
	
	
	
	
}
?>