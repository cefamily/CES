<?php
namespace Home\ViewModel;
use Think\Model\ViewModel;
class ClaimViewModel extends ViewModel{
	
	protected $viewFields = array(
		'Claim'=>array(
			'cid','pid','uid','ctype','cfinish'
		),
		'UserInfo'=>array('uname','utype','_on'=>'Claim.uid=UserInfo.uid'),
		'ProductInfo'=>array('pname','pstate', '_on'=>'Claim.pid=ProductInfo.pid'),
	);
	public function _initialize(){
		
	}
	public function getClaimByCid($cid){
		$where['cid'] = $cid;
		return $this->where($where)->find();
	}

	
	
	
	
	
	
	
}
?>