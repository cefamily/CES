<?php
namespace Home\Controller;
use Think\Controller;
class UserController extends Controller{
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
	
	public function userLogout(){
		
		
	}
	public function reg(){
		$user=D('UserInfo','Logic');
		$data['UserName']=I('post.username','','string');
		$data['UserPwd']=md5(I('post.userpwd','',false).$data['UserName']);
		$data['UserEmail']=I('post.useremail','','email');
		//dump($data);
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
	public function userCenter(){
		switch($this->getMyUserType()){
			case 0:
				break;
			case 1:
				break;
			case 2:
				break;
			case 3:
				break;
			case 4:
				break;
			default:
				break;
		}
	}
	public function changeEmail(){
		
		
	}
	public function changePassword(){
		
		
	}
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
}
?>