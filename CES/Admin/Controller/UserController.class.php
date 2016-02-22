<?php
namespace Admin\Controller;
use Think\Controller;

class UserController extends Controller{
	public function _initialize(){
		/*if(!IS_POST && !IS_AJAX){
			$this->error('要做个好孩子喵~');
		}
		*/
	}
	public function adminlogin()
	{
		$data['UserName']=I('post.username','','string');
		$data['UserPwd']=md5(I('post.userpwd','',false).$data['UserName']);
		$rand=I('post.rand','',false);
		$verify = new \Think\Verify();
		if($verify->check($rand)){
			$user=D('UserInfo','Logic');
			$result=$user->login($data);
			if($result)
			{
				session('admin',$result);
				$this->success('OK');
				//$this->success('欢迎'.$result['username'],__MODULE__.'/Product/showlist');
			}else{
				$this->error('登录失败');
			}
		}else{
			$this->error('验证码错误');
		}
	}
	public function randimg()
	{
		$Verify= new \Think\Verify();
		$Verify->entry();
	}
	public function logout(){
		session('admin',NULL);
		$this->success('OK');
		//$this->success('已经退出登录','login');
	}
}
?>