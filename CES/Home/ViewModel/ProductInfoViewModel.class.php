<?php
namespace Home\ViewModel;
use Think\Model\ViewModel;
class ProductInfoViewModel extends ViewModel{
	
	protected $viewFields = array(
		'ProductInfo'=>array(),
		'UserInfo'=>array('UserName'=>'uname', '_on'=>'ProductInfo.UserId=UserInfo.UserId'),
	);
	public function _initialize(){
		$this->viewFields['ProductInfo'] = array_flip(D('Admin/ProductInfo')->_map);
	}
	function getMyProductsList($userid,$page=1,$count=10,$order='releasetime DESC'){
		$where['uid'] = $userid;
		return $this->where($where)->page($page,$count)->order($order)
					//->fetchSql()
					->select();
	}
	function getProductsList($page=1,$count=10,$order='releasetime DESC'){
		$where['state'] = array('in','1,2,3');
		return $this->where($where)->page($page,$count)->order($order)
					//->fetchSql()
					->select();
	}

	
	
	
	
	
	
	
}
?>