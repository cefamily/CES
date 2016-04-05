<?php
namespace Home\Controller;
use Think\Controller;
class ProductController extends Controller{
	public function _initialize(){
        $this->user = A('User','Event');
        
    }
	public function get_product_info($pid=0){
		$this->user->_safe_login();
        $pinfo = model('product_info','api')->get_product($pid);
        $ginfo = model('progress','api')->_get_progress_by_pid($pid);
        
	}
    public function get_my_product_list(){
		$this->user->_safe_login();
        
	}
    public function get_product_list(){
		$this->user->_safe_login();
        
	}
    public function get_all_product_list(){
		$this->user->_safe_admin();
        
	}
    public function get_deleted_product_list(){
		
        
	}
	public function clean_product(){
		
        
	}
    public function change_product($pid=0){
		
        
	}
    public function release_product(){
        
        
    }
    public function get_my_claim_product(){
		
        
	}
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
}
?>