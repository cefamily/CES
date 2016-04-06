<?php
namespace Home\Controller;
use Think\Controller;
class ClaimController extends Controller{
	public function _initialize(){
        //$this->user = A('User','Event');
        
    }
	public function claimProduct(){
		//$this->user->_safe_login();
        //$this->user->_safe_type(2);
        //如果product不是共有，则需要验证是否在组

        
	}
    public function finish_claim(){
		$this->user->_safe_admin();
        $this->user->_safe_type(3);
        //如果product不是共有，则需要验证是否在组
        
	}
    public function cancel_claim(){
		$this->user->_safe_admin();
        $this->user->_safe_type(3);
        //如果product不是共有，则需要验证是否在组 
	}
	

	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
}
?>