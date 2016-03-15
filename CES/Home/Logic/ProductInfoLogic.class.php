<?php
namespace Home\Logic;
use Think\Model;
class ProductInfoLogic extends Model{
	function getMyProductsList($userid,$page=1,$count=10,$order=''){
		$where['product_info.userid'] = $userid;
		return $this->field('product_info.*,user_info.username')
					->join('user_info on product_info.UserId = user_info.UserId')
					->where($where)->page($page,$count)->order($order)->select();
	}
	function getMyProductsCount($userid){
		$where['userid'] = $userid;
		return $this->where($where)->getField('count(*)');
	}
	function getProductsList($page=1,$count=10,$order=''){
		return $this->field('product_info.*,user_info.username')
					->join('user_info on product_info.UserId = user_info.UserId')
					->where('product_info.prostate in (1,2,3)')->page($page,$count)->order($order)->select();
	}
	function getProductsCount($where='product_info.prostate in (1,2,3)'){
		return $this->where($where)->getField('count(*)');
	}
	function addNewProduct($data){
		//var_dump($data);die();
		return $this->data($data)->add();
	}

	
	
	
	
	
	
	
}
?>