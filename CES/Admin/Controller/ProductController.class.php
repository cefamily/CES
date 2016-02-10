<?php
namespace Admin\Controller;
class ProductController extends ConstructController{
	public function showlist(){
		$pagedata['now'] = $page = I('param.page',1,'int');
		$product=D('ProductInfo','Logic');
		$state = I('param.state',false,'int');
		if($state > 3 && $this->admintype < 4)$this->error('无权限操作');
		$search = I('param.search',false);
		$userid = I('param.userid',false,'int');
		$productListInfo = $product->searchProducts($page,$state,$userid,$search);
		$pagedata['count']=floor(($result['count']-1)/10+1);
		$this->assign('pagedata',$pagedata);
		$this->assign('productlist',$productListInfo[1]);
		$this->assign('item_index',0);
		$this->display();
	}
	public function showlistOfDeleted(){
		if($this->admintype<4)$this->error('无权限操作');
		$pagedata['now'] = $page = I('param.page',1,'int');
		$product=D('ProductInfo','Logic');
		$productListInfo = $product->getListByDeleted($page);
		$pagedata['count']=floor(($result['count']-1)/10+1);
		$this->assign('pagedata',$pagedata);
		$this->assign('productlist',$productListInfo[1]);
		$this->assign('item_index',1);
		$this->display();
	}
	public function clearProduct(){
		D('ProductInfo','Logic')->deleteProOfAWeekAge();
		$this->success('清理成功');
	}
	public function getInfoByProId($proid){
		if(!IS_POST)$this->error('获取失败');
		$info = D('ProductInfo','Logic')->getInfoByProId($proid);
		if(!$info)$this->error('无法获取制定的任务信息');
		else $this->success($info);
	}
	public function changeProductInfo(){
		if(!IS_POST)$this->error('修改失败');
		$info = I('post.');
		$proid = I('post.ProId',0,'int');
		if(!$proid)$this->error('proId不存在');
		if(I('post.ProState',0,'int') > 3 && $this->admintype < 4)$this->error('无权限操作');
		$product = D('ProductInfo');
		$result = D('ProductInfo')->where('ProId='.$proid)->save($info);
		//$result = $product->where('proid=1')->save(array('Protitle'=>'test5'));
		if(!$result)$this->error($product->error);
		else $this->success('修改成功');
	}
}
?>