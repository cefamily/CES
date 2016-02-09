<?php
namespace Admin\Controller;
class TeamInfoController extends ConstructController{
		public function _initialize(){
			parent::_initialize();
			$this->assign('item_index',3);
		}
		
		public function showlist(){
			$group=D('TeamInfo','Logic');
			$view=1;
			$nowpage=I('get.page','1','int');
				if($this->admintype=='3'){
					$grouplist=$group->page($nowpage,$view)->select();
					//$pagedata['count']
				}else{
					$grouplist=$group->getTeamListByAdmin($nowpage,$view,$this->adminid);
				}
				$pagedata['count']=count($grouplist);
				$pagedata['now']=$nowpage;
				$this->assign('grouplist',$grouplist);
				$this->assign('pagedata',$pagedata);
				$this->display();
		}
}
?>