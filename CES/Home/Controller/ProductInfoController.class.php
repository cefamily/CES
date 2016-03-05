<?php
namespace Home\Controller;
use Think\Controller;
class ProductInfoController extends Controller{
	public function releaseProduct(){
		//发布任务
			//添加ProductInfo
				/*
				UserId为发布的人
				ProTitle标题
				ProImg缩略图
				ProState为0（待审核）
				ProTime当前时间
				ProUP为0
				ProImgType为0（网源）1（图源）
				
				*/
			//添加Progress
				/*
				ProId 为以上新建的任务编号
				UserId为发布的人？
				ProgressTime当前时间
				__________________________________
				Type为team,ProgressText为0（开放）
				Type为team,ProgressText为认领的组1
				Type为team,ProgressText为认领的组2 ...
				也就是说如果有2个组参与就要创建2条
				
				*/
			
	}
	
	public function getMyProducts(){
		$userid = $this->userid;
		if(!$userid)$this->error('没有登录');
		$page = I('page',1,'int');
		$count = I('count',10,'int');
		$product=D('ProductInfo','Logic');
		$list = $product->getMyProductsList($userid,$page,$count);
		$count = $product->getMyProductsCount($userid);
		$this->success(array('list'=>$list,'count'=>$count));
	}
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
}
?>