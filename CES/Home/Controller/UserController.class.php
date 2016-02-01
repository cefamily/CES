<?php
namespace Home\Controller;
use Think\Controller;
class UserController extends Controller{
	public function _initialize(){
		//if(!IS_POST && !IS_AJAX){
		//	$this->error('要做个好孩子喵~');
		//}
	}
	public function login($username,$password)
	{
			$user=M('Userinfo');
			$password=md5($password.$username);
			$data = $user->where("UserName='%s' AND UserPwd='%s'",$username,$password)->find();
			dump($data);
			if($data && $data!=NULL){
				//$this->success('登录成功');
				session('user',$data);
				$this->assign('user',session('user'));
				$this->display();
			}
			else
			{
				$this->error('登录失败'.$password.$username);
			}	
	}
	
	public function reg()
	{
		$user=D('UserInfo');
		$data['UserName']=I('post.username','','string');
		$data['UserPwd']=md5(I('post.userpwd','',false).$data['UserName']);
		$data['UserEmail']=I('post.useremail','','email');
		dump($data);
		//dump($user);
		if(I('post.userpwd','',false)==I('post.userpwd2','',false)){
			if($user->create($data))
			{
				echo 'test'.$user->uesrname;
				$result=$user->add();
				if($result)
				{
					$this->success('注册成功');
				}
				else
				{
					$this->error('注册失败');
				}
			}
			else
			{
				echo 'test'.$user->Username;
				//dump($user);
				$this->error($user->getError(),'javascript:history.back(-1);',50);
			}
		}
		else
		{
			$this -> error('两次密码不一致');
		}
		
	}
}
?>