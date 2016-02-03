<?php
namespace Admin\Controller;
use Think\Controller;
class UserInfoController extends Controller{
		public function _initialize(){
			if(!session('?admin') || session('admin.usertype')<2){
			$this->error('非法操作');
		}
		$this->assign('adminname',session('admin.username'));
		$this->assign('admintype',session('admin.usertype'));
		}
		
		public function showlist(){
			$user=D('UserInfo','Logic');
			$page=I('param.page','1','int');
			$where['UserType']=array('LT',session('admin.usertype'));
			$result=$user->getuser($page,$where);
			$this->assign('userlist',$result['result']);
			$this->assign('item_index',2);
			$this->display();
		}
	}
?>