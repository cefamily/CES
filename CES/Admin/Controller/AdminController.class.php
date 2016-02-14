<?php
namespace Admin\Controller;
class AdminController extends ConstructController{
		public function _initialize(){
			parent::_initialize();
			if($this->admintype!='3') $this->error('权限不足');
		}
		
		public function index(){			
			$admin=D('UserInfo','Logic');
			$view=10;
			$pagedata['now']=I('get.page','1','int');			
			$result=$admin->getAdmin($page,$view);
			
			$pagedata['count']=$result['count']/$view;
			if($result['count']%$view!=0)
			{
				$pagedata['count']+=1;
			}
			
			$this->assign('pagedata',$pagedata);
			$this->assign('adminlist',$result['data']);
		}
}
?>