<?php
namespace Home\Logic;
use Think\Model;
class ClaimInfoLogic extends Model{
	
	public function getClaimByCid($cid){
		$where['cid'] = $cid;
		return D('Admin/Claim')->where($where)->find();
	}
	
	
	
	
	
	
	
	
	
	
}
?>