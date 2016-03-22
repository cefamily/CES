<?php
namespace Home\Logic;
use Think\Model;
class ProductInfoLogic extends Model{
	
	function getMyProductsCount($userid){
		$where['UserId'] = $userid;
		return $this->getProductsCount($where);
	}
	function getProductsCount($where=array('ProState'=>(array('in','1,2,3')))){
		return $this->where($where)
					//->fetchSql()  //
					->getField('count(1)');
	}
	function addNewProduct($data){
		//验证 + 转换 data数据
		D('Admin/ProductInfo')->create($data);
		//添加数据库
		return D('Admin/ProductInfo')->add();
	}
	function updateMyProduct($data){
		//验证 + 转换 data数据
		D('Admin/ProductInfo')->create($data);
		//修改数据库
		return D('Admin/ProductInfo')->save();
	}
	
	
	
	
	
	
}
?>