<?php
namespace Home\Controller;
use Think\Controller;
class ProgressController extends Controller{

    public function _initialize(){
        $this->user = A('User','Event');
        $this->claim = A('Claim','Event');
        
    }
   /*
    修改我认领的任务的职务的进度
    
    权限
    权限2以及以上
    
    
    传入参数
    pid         必填          任务的ID
    type        必填          职位
    text        必填          进度说明

    成功输出参数
    int 1

    API接口：domain/index.php/Home/Progress/changeProgress
    */
	public function changeProgress();


	
	
	
	
	
	
}
?>