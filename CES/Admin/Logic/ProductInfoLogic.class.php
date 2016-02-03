<?php
namespace Admin\Logic;
use Think\Model;
class ProductInfoLogic extends Model{
	public UserType;
	public function _initialize(){
		$userInfo = I('session.admin',false);
		$this->UserType = $userInfo===false ? $userInfo['UserType'] : -1;
	}
	private function getListByCondition($page=1,$where=false){
		$result=$this	->join('user_info on product_info.UserId = user_info.UserId')
						->where($where)
						->page($page,20)
						->rder('ProId DESC')
							->select();
		$count =$this	->field('count(*) as count')
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
	public function getList($page){
		if($this->UserType<2)return false;
		return $this->getListByCondition($page,'product_info.ProState < 4');
	}
	public function getListByDeleted($page){
		if($this->UserType<2)return false;
		return $this->getListByCondition($page,'product_info.ProState > 3');
	}
	public function update($proId,$data){
		if($this->UserType<2)return false;
		if($data['ProState'] && $this->UserType<3)return false;
		return $this->updateByCondition(array('ProId'=>$proId),$data);
	}
	private function updateByCondition($where,$data){
		return $this->where($where)-save($data);
	}
	public function fakeDelete($proId){
		if($this->UserType<3)return false;
		return $this->update($proId,array('ProState'=>4));
	}
	public function fakeDeleteByCondition($where){
		if($this->UserType<3)return false;
		return $this->updateByCondition($where,array('ProState'=>4));
	}
	public function delete($proId){
		if($this->UserType<3)return false;
		return $this->update($proId,array('ProState'=>5));
	}
	public function deleteByCondition($where){
		if($this->UserType<3)return false;
		return $this->updateByCondition($where,array('ProState'=>5));
	}
}
?>