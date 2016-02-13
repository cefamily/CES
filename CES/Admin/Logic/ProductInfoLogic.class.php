<?php
namespace Admin\Logic;
use Think\Model;
class ProductInfoLogic extends Model{
	public $admintype =0;
	private function getListByCondition($page=1,$limit=10,$tlist=array(),$where=false){
		 //$r = $this->query("update product_info set protitle='test'");die($r?'1':'0');
		// var_dump($r);
		// die();

		if($tlist){
			$anotherWhere['progress.Type']=array('EQ','team');
			$anotherWhere['progress.ProgressText']=array('IN',$tlist);
		}
		$result = M('Progress')	->field('product_info.*,user_info.*')
								->join('product_info on progress.ProId = product_info.ProId')
								->join('user_info on product_info.UserId = user_info.UserId')
								->where($anotherWhere)
								->where($where)
								->page($page,$limit)
								->order('progress.ProId DESC')
								//->fetchSql(true)
								->select();
								//var_dump($result);die();
		$count = M('Progress')	->field('product_info.*,user_info.*')
								->join('product_info on progress.ProId = product_info.ProId')
								->join('user_info on product_info.UserId = user_info.UserId')
								->where($anotherWhere)
								->where($where)
								->find();
		$count=$count['count'];
		if($result){
			return array($count,$result);
		}else{
			return array(0,array());;
		}
	}
	public function searchProducts($page,$state=false,$userid=false,$search=false,$tlist=false){
		$where['product_info.ProState']=array('LT',98);
		if($state)$where['product_info.ProState']=array('EQ',floor($state));
		if($userid)$where['product_info.UserId']=array('EQ',floor($userid));
		if($search)$where['product_info.ProTitle']=array('LIKE','%'.$search.'%');
		return $this->getListByCondition($page,10,$tlist?$tlist:0,$where);
	}
	public function getListByDeleted($page){
		return $this->searchProducts($page,98);
	}
	public function update($proId,$data){
		return $this->updateByCondition(array('ProId'=>$proId),$data);
	}
	private function updateByCondition($where,$data){
		return $this->where($where)->save($data);
	}
	public function fakeDelete($proId){
		return $this->update($proId,array('ProState'=>98));
	}
	public function fakeDeleteByCondition($where){
		return $this->updateByCondition($where,array('ProState'=>98));
	}
	public function deleteByProId($proid){
		return $this->update($proid,array('ProState'=>99));
	}
	public function deleteByCondition($where){
		return $this->updateByCondition($where,array('ProState'=>99));
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