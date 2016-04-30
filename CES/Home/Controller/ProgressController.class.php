<?php
namespace Home\Controller;
class ProgressController extends OutController{

    protected function _get_user(){
        return A('User','Event');
    }
    protected function _get_progress(){
        return A('Progress','Event');
    }
    protected function _get_claim(){
        return A('Claim','Event');
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
	public function changeProgress(){
        $this->user->_safe_login();
        $this->user->_safe_type(2);
        $pid = I('post.pid','');
        $type = I('post.type','');
        $text = I('post.text','');
        if(!$pid || $type || $text)$this->error('参数不符合');
        $this->claim->_safe_my_claim($pid,$type);
        if($this->progress->add($pid,$type,$text)){
            $this->success(1);
        }else $this->error('修改进度失败');
        
        
    }


	
	
	
	
	
	
}
?>