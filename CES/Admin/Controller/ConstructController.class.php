<?php
namespace Admin\Controller;
use Think\Controller;
class ConstructController extends Controller{
	
	protected $adminname='';
	protected $admintype;
	
	public function _initialize(){
		if(!session('?admin') || session('admin.usertype')<2){
			$this->error('非法操作');
		}
		$this->assign('adminname',session('admin.username'));
		$this->assign('admintype',session('admin.usertype'));
		$this->adminname=session('admin.username');
		$this->admintype=session('admin.usertype');
		$this->adminid=session('admin.userid');
		
	}
	
	public function checkType($userid){
		$user=M('UserInfo');
		$type1=$user->where('UserId='.$userid)->getField('UserType');		
		if($this->admintype>$type1){
			return true;
		}else{
			return false;
		}
	}

}
?>