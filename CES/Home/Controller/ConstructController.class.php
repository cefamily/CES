<?php
namespace Home\Controller;
use Think\Controller;
class ConstructController extends Controller{
	
	protected $username;
	protected $usertype;
	protected $userid;
	
	public function _initialize(){
		$this->username=session('user.username','');
		$this->usertype=session('user.usertype',0);
		$this->userid=session('user.userid',0);
	}
	

	
}
?>