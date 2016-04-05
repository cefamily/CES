<?php
namespace Home\Port;
interface ClaimPort{
    /*
    认领任务
    传入参数
    pid     必填   任务的编号
    ctype   必填   担任的职务    
    成功输出参数
    int 1
    
    */
	public function claimProduct();
    
    
    
    
    /*
    完成认领
    传入参数
    pid     必填   任务的编号
    ctype   必填   担任的职务    
    成功输出参数
    int 1
    
    */
    public function finishClaim();
    
    
    
    
    
    /*
    取消认领
    传入参数
    pid     必填   任务的编号
    ctype   必填   担任的职务    
    成功输出参数
    int 1
    
    */
    public function cancelClaim();
	

	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
}
?>