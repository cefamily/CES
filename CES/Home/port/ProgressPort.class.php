<?php
namespace Home\Controller;
use Think\Controller;
class ProgressController extends Controller{

    public function _initialize(){
        $this->user = A('User','Event');
        $this->claim = A('Claim','Event');
        
    }
	public function change_progress(){
		$this->user->_safe_login();
        $this->user->_safe_type(2);
        $this->claim->_safe_my_claim($pid,$type);
        
	}

	
	
	
	
	
	
}
?>