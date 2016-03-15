<?php
namespace Home\Controller;
use Think\Controller;
class ProductInfoController extends ConstructController{
	public function _initialize(){
		parent::_initialize();
		if(!IS_AJAX)$this->error('not ajax','http://a.baka/index.php/Home');
	}
	public function releaseProduct(){
		if(!IS_POST)$this->error('not post','http://a.baka/index.php/Home');
		if(!$this->userid)$this->error('没有登录');
		$product=D('ProductInfo','Logic');
		$data['UserId'] = $this->userid;
		$data['ProTitle'] = I('post.title','');
		$data['ProImg'] = I('post.img','');
		$data['ProState'] = $this->usertype ? 1 : 0;
		$data['ProRem'] = I('post.remark','');
		$data['ProUP'] = I('post.up',0);
		$data['ProImgType'] = I('post.type',0);
		$proId = $product -> addNewProduct($data);
		//$this->success($productInfo );
		if($proId){
			$progress=D('Progress','Logic');
			$data = array();
			$data['UserId'] = $this->userid;
			$data['ProId'] = $proId;
			$data['Type'] = 'team';
			if(!$this->usertype){
				$data['ProgressText'] = 0;
				$progress->addNewProgress($data);
			}else{
				$teams = I('teams',array(0));$real_teams=array();
				if(!is_array($teams)) $teams = array($teams);
				foreach($teams as $v)if(preg_match('/\d+/',(string)$v))$real_teams[$v]=$v;
				if($real_teams)foreach($real_teams as $v){
					$data['ProgressText'] = $v;
					$progress->addNewProgress($data);
				}else{
					$data['ProgressText'] = 0;
					$progress->addNewProgress($data);
				}
			}
			$data =array();
			$data['ProId'] = $proId;
			$this->success($data);
		}
		else $this->error('发布失败');
		
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
		//var_dump($this->userid);die();
		if(!$userid)$this->error('没有登录');
		$page = I('page',1,'int');
		$count = I('count',10,'int');
		$product=D('ProductInfo','Logic');
		$list = $product->getMyProductsList($userid,$page,$count);
		$count = $product->getMyProductsCount($userid);
		$this->success(array('list'=>$list,'count'=>$count));
	}
	public function getProducts(){
		$page = I('page',1,'int');
		$count = I('count',10,'int');
		$product=D('ProductInfo','Logic');
		$list = $product->getProductsList($page,$count);
		$count = $product->getProductsCount();
		$this->success(array('list'=>$list,'count'=>$count));
	}
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
}
?>