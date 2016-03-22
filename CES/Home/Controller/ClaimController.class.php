<?php
namespace Home\Controller;
use Think\Controller;
class ClaimController extends Controller{
	
	/* 
	认领一个任务
	必须登录，post，ajax
	post参数
		pid		任务编号
		ctype	职位编号
	接口
		http://serverName/index.php/Home/Claim/claimProduct
	 */
	
	public function claimProduct(){
		//认领任务
		
		
		
	}
	
	/* 
	获取我认领的任务列表
	必须登录，get，ajax
	参数
		page	页数
		count	每页的数量
		order	排列规则
	接口
		http://serverName/index.php/Home/Claim/getMyProductsOfClaim
	 */

	public function getMyProductsOfClaim(){
		//获取我认领的任务列表
		
		
		
	}
	
	
	
	/* 
	通过cid获取一个的任务的信息
	get，ajax
	参数
		cid			认领编号
		complete	是否需要完整的信息
	接口
		http://serverName/index.php/Home/Claim/getClaimByCid
	 */

	public function getClaimByCid($cid,$complete = false){
		
		$claim = D('Claim',$complete ? 'ViewModel' : 'Logic');
		$info = $claim ->getClaimByCid($cid);
		$this -> success($claim);
		
	}
	
	
	/* 
	完成某个任务认领的职务
	必须登录，post，ajax
	参数
		cid			认领编号
		
	接口
		http://serverName/index.php/Home/Claim/finishClaim
	 */
	public function finishClaim($cid){
		
		//完成职务内容
		
	}
	
	
	/* 
	取消某个任务的认领的职务
	必须登录，post，ajax
	参数
		cid			认领编号
		
	接口
		http://serverName/index.php/Home/Claim/cancelClaim
	 */
	public function cancelClaim($cid){
		
		//取消职务
		
	}
	

	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
}
?>