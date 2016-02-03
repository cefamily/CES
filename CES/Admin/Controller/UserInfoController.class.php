<?php
namespace Admin\Controller;
use Think\Controller;
class UserInfoController extends Controller{
		public function _initialize(){
			if(!session('?admin') || session('admin.usertype')<3){
			$this->error('非法操作');
		}
		$this->assign('adminname',session('admin.username'));
		}
		
		public function showlist(){
			$user=D('UserInfo','Logic');
			$page=I('param.page','1','int');
			$where['UserType']=array('LT',session('admin.usertype'));
			$result=$user->getuser($page);
			$this->assign('userlist',$result['result']);
			$this->display();
		}
	}
?>