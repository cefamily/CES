<?php
namespace Admin\Logic;
use Think\Model;
class ProductInfoLogic extends Model{
	private function getListByCondition($page=1,$limit=10,$where=false){
		 //$r = $this->query("update product_info set protitle='test'");die($r?'1':'0');
		// var_dump($r);
		// die();
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
	public function searchProducts($page,$state=false,$userid=false,$search=false){
		$where['product_info.ProState']=array('LT',4);
		if($state)$where['product_info.ProState']=array('EQ',floor($state));
		if($userid)$where['product_info.UserId']=array('EQ',floor($userid));
		if($search)$where['product_info.ProTitle']=array('LIKE','%'.$search.'%');
		return $this->getListByCondition($page,10,$where);
	}
	public function getListByDeleted($page){
		return $this->searchProducts($page,4);
	}
	public function update($proId,$data){
		return $this->updateByCondition(array('ProId'=>$proId),$data);
	}
	private function updateByCondition($where,$data){
		return $this->where($where)->save($data);
	}
	public function fakeDelete($proId){
		return $this->update($proId,array('ProState'=>4));
	}
	public function fakeDeleteByCondition($where){
		return $this->updateByCondition($where,array('ProState'=>4));
	}
	public function deleteByProId($proid){
		return $this->update($proid,array('ProState'=>5));
	}
	public function deleteByCondition($where){
		return $this->updateByCondition($where,array('ProState'=>5));
	}
	public function deleteProOfAWeekAge(){
		return $this->deleteByCondition('UNIX_TIMESTAMP()-UNIX_TIMESTAMP(ProTime)>24*3600*7');
	}
	public function getInfoByProId($proid){
		$info = $this->getListByCondition(1,1,array('product_info.ProId'=>array('EQ',floor($proid))));
		return $info[0] ? $info[1][0] : false;
	}
}
?>