<?php
namespace Admin\Controller;
class ProductController extends Construct{
	public function _initialize(){
		if(!session('?admin') || session('admin.usertype')<2){
			$this->error('非法操作');
		}
		$this->assign('adminname',session('admin.username'));
		$this->assign('admintype',session('admin.usertype'));
	}
	public function showlist(){
		$pagedata['now'] = $page = I('param.page',1,'int');
		$product=D('ProductInfo','Logic');
		$state = I('param.state',-2,'int');
		if($state > 3 && $this->admintype < 4)$this->error('无权限操作');
		$productListInfo = $state==-2 ? $product->getList($page) : $product->getListByState($page,$state);
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
		$this->assign('item_index',0);
		$this->display();
	}
	
	public function clearProduct(){
		
		
	}
}
?>