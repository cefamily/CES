<?php
namespace Admin\Controller;
class AdminController extends ConstructController{
		public function _initialize(){
			parent::_initialize();
			if($this->admintype!='3') $this->error('权限不足');
			$this->assign('item_index',4);
		}
		
		public function index(){			
			$admin=D('UserInfo','Logic');
			$view=10;
			$pagedata['now']=I('get.page','1','int');	
			$result=$admin->getAdmin($pagedata['now'],$view);
			
			$pagedata['count']=$result['count']/$view;
			if($result['count']%$view!=0)
			{
				$pagedata['count']+=1;
			}
			
			$ajaxdata=array(
				'pagedata'=>$pagedata,
				'adminlist'=>$result['data']
			);
			$this->success($ajaxdata);
			//$this->assign('pagedata',$pagedata);
			//$this->assign('adminlist',$result['data']);
			//$this->display();
		}
		
		public function addadmin_ajax(){
			$userid=I('post.userid','0','int');
			$user=D('UserInfo','Logic');
			$t=$user->addAdmin($userid);
			if($t){
				//$res='OK';
				$this->success('OK');
			}else{
				$this->error($user->getError());
				//$res=$user->getError();
			}
			//$this->ajaxReturn($res);
		}
		
		public function deladmin_ajax(){
		
			$userid=I('post.userid','0','int');
			$user=D('UserInfo','Logic');
			$t=$user->delAdmin($userid);
			if($t){
				//$res='OK';
				$this->success('OK');
			}else{
				$this->error($user->getError());
				//$res=$user->getError();
			}
			//$this->ajaxReturn($res);
		}
		
}
?>