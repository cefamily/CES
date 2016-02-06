<?php
namespace Admin\Logic;
use Think\Model;
class ProductInfoLogic extends Model{
	private function getListByCondition($page=1,$limit=10,$where=false){
		$result=$this	->join('user_info on product_info.UserId = user_info.UserId')
						->where($where)
						->page($page,$limit)
						->order('ProId DESC')
							->select();
		$count =$this	->field('count(*) as count')
						->join('user_info on product_info.UserId = user_info.UserId')
						->where($where)
						->find();
		$count=$count['count'];
		if($result){
			return array($count,$result);
		}else{
			return array(0,array());;
		}
	}
	public function getList($page){
		return $this->getListByCondition($page,10,'product_info.ProState < 4');
	}
	public function getListByState($page,$state){
		return $this->getListByCondition($page,10,'product_info.ProState = '.floor($state));
	}
	public function getListByDeleted($page){
		return $this->getListByState($page,4);
	}
	public function update($proId,$data){
		return $this->updateByCondition(array('ProId'=>$proId),$data);
	}
	private function updateByCondition($where,$data){
		return $this->where($where)-save($data);
	}
	public function fakeDelete($proId){
		return $this->update($proId,array('ProState'=>4));
	}
	public function fakeDeleteByCondition($where){
		return $this->updateByCondition($where,array('ProState'=>4));
	}
	public function delete($proId){
		return $this->update($proId,array('ProState'=>5));
	}
	public function deleteByCondition($where){
		return $this->updateByCondition($where,array('ProState'=>5));
	}
}
?>