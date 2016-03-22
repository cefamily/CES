<?php
namespace Home\Controller;
use Think\Controller;
class ProductInfoController extends ConstructController{
	public function _initialize(){
		parent::_initialize();
		if(!IS_AJAX)$this->error('not ajax');
	}
	
	/*
	发布任务
	
	必须post方式发布
	必须登录
	
	参数	title	标题
			img		封面图
			remark	说明？
			up		up数量（这是什么）
			type	图片类型
			teams	限定的组（管理员权限）
	
	*/
	
	
	public function releaseProduct(){
		if(!IS_POST)$this->error('not post');
		if(!$this->userid)$this->error('没有登录');
		$product=D('ProductInfo','Logic');
		$data['uid'] = $this->userid;
		$data['title'] = I('post.title','');
		$data['img'] = I('post.img','');
		$data['state'] = $this->usertype ? 1 : 0;
		$data['remark'] = I('post.remark','');
		//$data['ProUP'] = I('post.up',0);
		$data['ProImgType'] = I('post.type',0);
		$proId = $product -> addNewProduct($data);
		//$this->success($productInfo );
		if($proId && floor($proId)){
			$progress=D('Progress','Logic');
			$data = array();
			$data['UserId'] = $this->userid;
			$data['ProId'] = $proId;
			$data['Type'] = 'team';
			if(!$this->usertype){
				$data['ProgressText'] = 0;
				$progress->addNewProgress($data);
			}else{
				$teams = I('post.teams',array(0));$real_teams=array();
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
	
	
	/*
	
	获取我发表的任务
	
	建议get获取（post没有参数可能会有异常抛出）
	
	例：	
	
	获取第20页(默认每页10个任务)
	127.0.0.1/index.php/Home/ProductInfo/getMyProducts/page/20
	
	获取每页20个任务的第2页
	127.0.0.1/index.php/Home/ProductInfo/getMyProducts/page/2/count/20
	
	
	
	*/
	public function getMyProducts(){
		$userid = $this->userid;
		//var_dump($this->userid);die();
		if(!$userid)$this->error('没有登录');
		$page = I('page',1,'int');
		$count = I('count',10,'int');
		$list = D('ProductInfo','ViewModel')->getMyProductsList($userid,$page,$count);
		$count =  D('ProductInfo','Logic')->getMyProductsCount($userid);
		$this->success(array('list'=>$list,'count'=>$count));
	}
	/*
	
	获取前台展示的任务（征集中，进行中，完成）
	
	建议get获取（post没有参数可能会有异常抛出）
	
	例：	
	
	获取第20页(默认每页10个任务)
	127.0.0.1/index.php/Home/ProductInfo/getProducts/page/20
	
	获取每页20个任务的第2页
	127.0.0.1/index.php/Home/ProductInfo/getProducts/page/2/count/20
	
	之后会增加排序方式
	
	*/
	public function getProducts(){
		$page = I('page',1,'int');
		$count = I('count',10,'int');
		$list = D('ProductInfo','ViewModel')->getProductsList($page,$count);
		$count = D('ProductInfo','Logic')->getProductsCount();
		$this->success(array('list'=>$list,'count'=>$count));
	}
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
}
?>