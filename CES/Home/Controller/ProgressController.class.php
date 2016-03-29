<?php
namespace Home\Controller;
use Think\Controller;
class ProgressController extends Controller{
	public function editProgress(){
		//编辑任务进度
			$progress=D('Progress','Logic');
			$proid=I('post.proid','','int');
			$userid=session('uid');
			$protxt=I('post.protxt','','string');
			$protype=I('post.type','','string');
		
			
			$result= $progress->modProgress($proid,$userid,$protxt,$protype);
		
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