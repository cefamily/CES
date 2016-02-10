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
		
		public function addTeam_ajax(){
			
			if($this->admintype<3) $this->error('权限不足');
			
			$team=D('TeamInfo','Logic');
			$name=I('post.teamname','','string');
			
			$res=$team->createTeam($name);
			if($res){
				$result='OK';
			}else{
				$result=$team->getError();
			}
			$this->ajaxReturn($result);
		}
		
		public function deleteTeam_ajax(){
			if($this->admintype<3) $this->error('权限不足');
			
			$teamid=I('post.teamid','0','int');
			
			$userteam=M('UserTeam');
			$team=M('TeamInfo');
			$res=$userteam->where('TeamId='.$teamid)->delete();
			if($res>=0){
					$res=$team->where('TeamId='.$teamid)->delete();
					if($res!=false){
						$result='OK';
					}else{
						$result='删除出错'.$res;
					}
			}else{
				$result='删除成员出错'.$res;
			}
			$this->ajaxReturn($result);
		}
}
?>