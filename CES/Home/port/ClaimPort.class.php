<?php
namespace Home\Port;
interface ClaimPort{
    /*
    认领任务
    
    权限
    权限2以及以上
    任务的pteam不为0则需要验证是否有权限
    
    传入参数
    pid     必填   任务的编号
    ctype   必填   担任的职务  （图源，修图，翻译，嵌字分别为TY,XT,FY,QZ）  
    成功输出参数
    int 1
    
    API接口：domain/index.php/Home/Claim/claimProduct
    */
	public function claimProduct();
    
    
    
    
    /*
    完成认领
    
    权限
    登录后台
    权限3以及以上
    任务的pteam不为0则需要验证是否有权限
    
    传入参数
    pid     必填   任务的编号
    ctype   必填   担任的职务 （图源，修图，翻译，嵌字分别为TY,XT,FY,QZ）   
    成功输出参数
    int 1
    
    API接口：domain/index.php/Home/Claim/finishClaim
    */
    public function finishClaim();
    
    
    
    
    
    /*
    取消认领
    
    权限
    登录后台
    权限3以及以上
    任务的pteam不为0则需要验证是否有权限
    
    传入参数
    pid     必填   任务的编号
    ctype   必填   担任的职务（图源，修图，翻译，嵌字分别为TY,XT,FY,QZ）    
    成功输出参数
    int 1
    
    API接口：domain/index.php/Home/Claim/cancelClaim
    */
    public function cancelClaim();
	

	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
}
?>