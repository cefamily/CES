<?php
namespace Admin\Common\Controller;
use Think\Controller;
class Construct extends Controller{
	public function _initialize(){
		if(!session('?admin') || session('admin.usertype')<2){
			$this->error('非法操作');
		}
		$this->assign('adminname',session('admin.username'));
		$this->assign('admintype',session('admin.usertype'));
	}
}
?>