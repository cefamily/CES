<?php
namespace Home\Port;
class ProductPort{
    
    /*
    获得我发布的任务列表
    传入参数
    page    默认0    显示页数
    limit   默认10   每页显示的数量
    成功输出参数
    {products:$array_products,row:$row}
    ___________________
    
    $row总数量
    
    $array_products
    没有则输出[]
    有的话输出[$array_product1,$array_product2,$array_product3,$array_product4....]
    ___________________
    
    array_product的参数
    {
        pid:'1',
        pname:'我的任务',
        pimg:'http://xxxxxx.oo/x.jpg',
        pstate:'1',
        premark:'备注',
        pclick:'2333',
        pctime:'1758000000',
        pup:'233',
        ptype:'1',
        pftime:'1760000000',
        pteam:'0'
    }
    
    */
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