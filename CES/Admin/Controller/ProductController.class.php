<?php
namespace Admin\Controller;
use Think\Controller;
class ProductController extends Controller{
	public function _initialize(){
		if(!session('?admin') && session('admin.usertype')<3){
			$this->error('非法操作');
		}
		$this->assign('adminname',session('admin.username'));
	}
	public function showlist(){
		$this->display();
	}
}
?>