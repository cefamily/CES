<?php
namespace Home\Controller;
use Think\Controller;
class UserController extends Controller{
	public function _initialize(){
		if(!IS_POST && !IS_AJAX){
			$this->error('要做个好孩子喵~');
		}
	}
	public function userlogin(){
			$user=D('UserInfo','Logic');
			$data['UserName']=I('post.username','','string');
			$data['UserPwd']=md5(I('post.userpwd','',false).$data['UserName']);
			$result= $user->login($data);
			if($result)
			{			
				session('user',$result);
				$this->assign('user',session('user'));
				$this->display();
			}
			else
			{
				$this->error('登录失败');
			}	
	}
	
	public function reg(){
		$user=D('UserInfo','Logic');
		$data['UserName']=I('post.username','','string');
		$data['UserPwd']=md5(I('post.userpwd','',false).$data['UserName']);
		$data['UserEmail']=I('post.useremail','','email');
		//dump($data);
		if(I('post.userpwd','',false)==I('post.userpwd2','',false))
		{
			$result=$user->reg($data);
			if($result)
			{
				$this->success('注册成功');
			}
			else
			{
				$this->error($user->getError());
			}		
		}
		else
		{
			$this -> error('两次密码不一致');
		}
		
	}
}
?>