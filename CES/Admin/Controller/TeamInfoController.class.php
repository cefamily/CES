<?php
namespace Admin\Controller;
class TeamInfoController extends ConstructController{
		public function _initialize(){
			parent::_initialize();
			$this->assign('item_index',3);
		}
		
		public function showlist(){
			$group=D('TeamInfo','Logic');
			$view=10;
			$nowpage=I('get.page','1','int');
				if($this->admintype=='3'){
					$grouplist['data']=$group->page($nowpage,$view)->select();
					$grouplist['count']=$group->getField('count(*)');
				}else{
					$grouplist=$group->getTeamListByAdmin($nowpage,$view,$this->adminid);
				}
				$pagedata['count']=$grouplist['count']/$view;
				if($grouplist['count']%$view!=0)
				{
					$pagedata['count']+=1;
				}
				
				$pagedata['now']=$nowpage;
				$this->assign('grouplist',$grouplist['data']);
				$this->assign('pagedata',$pagedata);
				$this->display();
		}
}
?>