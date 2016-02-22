<?php
namespace Admin\Controller;
use Think\Controller;
class ConstructController extends Controller{
	
	protected $adminname='';
	protected $admintype;
	protected $tlist;
	
	public function _initialize(){
		if(!session('?admin') || session('admin.usertype')<2){
			$this->error('非法操作');
		}
		$this->assign('adminname',session('admin.username'));
		$this->assign('admintype',session('admin.usertype'));
		$this->adminname=session('admin.username');
		$this->admintype=session('admin.usertype');
		$this->adminid=session('admin.userid');
		$team=M('UserTeam');
		$this->tlist=$team->where('UserId='.$this->adminid.' AND AdminFlag=1')->getField('teamid',true);
		$this->tlist[]='0';
	}
	
	public function checkType($userid,$flag=false){
		$user=M('UserInfo');
		$type1=$user->where('UserId='.$userid)->getField('UserType');
		
		if($flag){
			$type1-=1;
		}		
		
		if($this->admintype>$type1){
			return true;
		}else{
			return false;
		}
	}
	
}
?>