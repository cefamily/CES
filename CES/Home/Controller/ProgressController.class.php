<?php
namespace Home\Controller;
use Think\Controller;
class ProgressController extends Controller{
	public function editProgress(){
		//编辑任务进度
			$progress=D('Progress','Logic');
			$progress->modProgress($data);
		
	}
	
	public function showProgress(){
		//显示任务进度
		$progress=D('Progress','Logic');
		$id=I('post.proid','','int');
		$resule=$progress->selectProgressByProId($id);
		if($resule){
			$this->success($resule);
		}else{
			$this->error($progress->getError());
		}
	}
	

	
	
	
	
	
	
}
?>