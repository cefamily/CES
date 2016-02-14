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
			$result=$admin->getAdmin($page,$view);
			
			$pagedata['count']=$result['count']/$view;
			if($result['count']%$view!=0)
			{
				$pagedata['count']+=1;
			}
			
			$this->assign('pagedata',$pagedata);
			$this->assign('adminlist',$result['data']);
			$this->display();
		}
		
		public function addadmin_ajax(){
			$userid=I('post.userid','0','int');
			$user=D('UserInfo','Logic');

				$temp=$user->where('UserId='.$userid)->find();
				if($temp && $temp['usertype']<'2'){
				$t=$user->updataByType($userid,2);
				if($t){
					$res='OK';
				}else{
					$res='修改权限失败';
				}
			}else{
				$res='当前用户权限大于等于管理员权限，无法操作';
			}
			$this->ajaxReturn($res);
		}
}
?>