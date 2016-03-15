<?php
namespace Home\Controller;
use Think\Controller;
class ConstructController extends Controller{
	
	protected $username;
	protected $usertype;
	protected $userid;
	
	public function _initialize(){
		if($_SESSION['user']){
			$this->username=$_SESSION['user']['username'];
			$this->usertype=$_SESSION['user']['usertype'];
			$this->userid=$_SESSION['user']['userid'];
		}else{
			$this->usertype = $this->userid = 0;
			$this->username = '';
		}
	}
	

	
}
?>