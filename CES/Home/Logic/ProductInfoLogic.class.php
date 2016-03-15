<?php
namespace Home\Logic;
use Think\Model;
class ProductInfoLogic extends Model{
	function getMyProductsList($userid,$page=1,$count=10){
		$where['userid'] = $userid;
		return $this->where($where)->page($page,$count)->select($data);
	}
	function getMyProductsCount($userid){
		$where['userid'] = $userid;
		return $this->where($where)->getField('count(*)');
	}
	
	function addNewProduct($data){
		//var_dump($data);die();
		return $this->data($data)->add();
	}

	
	
	
	
	
	
	
}
?>