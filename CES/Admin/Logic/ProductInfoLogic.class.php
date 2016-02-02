<?php
namespace Admin\Logic;
use Think\Model;
class ProductInfoLogic extends Model{
	public function getList($where){
		$product=M('ProductInfo');
		$result=$product->where($where)->select();
		if($result){
			return $result;
		}else{
			return false;
		}
	}
}
?>