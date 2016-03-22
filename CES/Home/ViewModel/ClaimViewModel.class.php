<?php
namespace Home\ViewModel;
use Think\Model\ViewModel;
class ClaimViewModel extends ViewModel{
	
	protected $viewFields = array(
		'Claim'=>array(),
		'UserInfo'=>array('UserName'=>'uname', '_on'=>'Claim.UserId=UserInfo.UserId'),
		'ProductInfo'=>array('ProTitle'=>'title', '_on'=>'Claim.ProId=ProductInfo.ProId'),
	);
	public function _initialize(){
		$this->viewFields['Claim'] = array_flip(D('Admin/Claim')->_map);
	}
	public function getClaimByCid($cid){
		$where['cid'] = $cid;
		return $this->where($where)->find();
	}

	
	
	
	
	
	
	
}
?>