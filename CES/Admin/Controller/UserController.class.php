<?php
namespace Admin\Controller;
use Think\Controller;

class UserController extends Controller{
	public function _initialize(){
		if(!IS_POST && !IS_AJAX){
			$this->error('要做个好孩子喵~');
		}
	}
	public function userlogin()
	{
		$data['UserName']=I('post.username','','string');
		$data['UserPwd']=md5(I('post.userpwd','',false).$data['UserName']);
		$user=D('UserInfo','Logic');
		$result=$user->login($data);
		if($result)
		{
			session('admin',$result);
			
		}
	}
	
	
	}
?>