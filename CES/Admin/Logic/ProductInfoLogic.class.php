<?php
namespace Admin\Logic;
use Think\Model;
class ProductInfoLogic extends Model{
	private function getList($page=1,$where=false){
		$product=M('ProductInfo');
		$result=$product	->join('user_info on product_info.UserId = user_info.UserId')
							->where($where)
							->page($page,20)
							->order('ProId DESC')
							->select();
		$count = $product	->field('count(*) as count')
							->join('user_info on product_info.UserId = user_info.UserId')
							->where($where)
							->find();
		$count=$count['count'];
		if($result){
			return array($count,$result);
		}else{
			return false;
		}
	}
	private function update($proId,$data){
		return $this->updateByCondition(array('ProId'=>$proId),$data);
	}
	private function updateByCondition($where,$data){
		return M('ProductInfo')->where($where)-save($data);
	}
	private function fakeDelete($proId){
		return $this->update($proId,array('ProState'=>4));
	}
	private function fakeDeleteByCondition($where){
		return $this->updateByCondition($where,array('ProState'=>4));
	}
	private function delete($proId){
		return $this->update($proId,array('ProState'=>5));
	}
	private function deleteByCondition($where){
		return $this->updateByCondition($where,array('ProState'=>5));
	}
}
?>