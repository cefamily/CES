<?php
namespace Admin\Controller;
use Think\Controller;
class ProductController extends Controller{
	public function _initialize(){
		if(!session('?admin') || session('admin.usertype')<2){
			$this->error('非法操作');
		}
		$this->assign('adminname',session('admin.username'));
		$this->assign('admintype',session('admin.usertype'));
	}
	public function showlist($page=1){
		$product=D('ProductInfo','Logic');
		$productListInfo = $product->getList($page);
		$this->assign('maxrow',$productListInfo[0]);
		$this->assign('productlist',$productListInfo[1]);
		$this->assign('item_index',0);
		$this->display();
	}
}
?>