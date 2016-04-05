<?php
namespace Home\Controller;
use Think\Controller;
class UserController extends Controller{
	public function _initialize(){
        //$this->user = A('User','Event');
        //$this->userModel = D('UserInfo','Api');
    }
    public function get_my_info(){
        $this->user->_safe_login();
		$this->success($this->userModel->get_user_info($this->uid));
	}
    public function get_user_info($uid=0){
        $this->user->_safe_admin();
        $this->user->_safe_utype($uid);
		$this->success($this->userModel->get_user_info($uid));
	}
    public function test(){
		echo $this->success('niconiconi~~~');
	}
    public function get_user_list($page=1){
        
        //根据uid
        //根据uname
        //根据type
		$this->user->_safe_admin();
        $page = floor($page);
        $page = $page<1?1:$page;
        $this->success($this->userModel->get_user_list($this->type,$data,$page));
        
	}
    public function get_admin_list($page=1){
		$this->user->_safe_admin();
        $this->user->_safe_type(4);
        $page = floor($page);
        $page = $page<1?1:$page;
        $this->success($this->userModel->get_admin_list($data,$page));
	}
	public function add_admin(){
        $uid = post('uid');
		$this->user->_safe_admin();
        $this->user->_safe_type(4);
        $this->success($this->userModel->add_admin($uid));
	}
    public function del_admin(){
        $uid = post('uid');
		$this->user->_safe_admin();
        $this->user->_safe_type(4);
        $this->user->_safe_utype($uid);
        $this->success($this->userModel->del_admin($uid));
	}
    public function user_login(){
        
        
        
        $uname = post('uname');
        $pwd = post('pwd');
        var_dump( $this->type );
        $uid = 1;
        $uname = 'c'; 
        $type = 2;
        $time = time();
        $login_secury = self::LOGIN_SALT[rand(0,4)].base64_encode(implode('|',array(
            $uid,
            $type,
            $uname,
            $time,
            md5($uid . $type . $uname . $time . self::LOGIN_SALT)
        )));
        cookie('login_secury',$login_secury,3600);
        cookie('admin_secury',$login_secury,-72000);
       
        
    }
    public function user_logout(){
	    $this->user->_safe_login();
    
	}
	public function reg(){
        
        
    }
	public function change_email(){
        $this->user->_safe_login();
        
    }
    public function change_password(){
        $this->user->_safe_login();
        
    }
    public function change_user_email(){
        $uid = post('uid');
        $this->user->_safe_admin();
        $this->user->_safe_utype($uid);
    }
    public function change_user_password(){
        $uid = post('uid');
        $this->user->_safe_admin();
        $this->user->_safe_utype($uid);
    }
    public function admin_login(){
        $this->user->_safe_login();
        
    }
}
?>