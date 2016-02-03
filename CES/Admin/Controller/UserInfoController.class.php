<?php
namespace Admin\Controller;
use Admin\Common\Controller\Construct;
class UserInfoController extends Construct{
		public function _initialize(){
			parent::_initialize();
		}
		
		public function showlist(){
			$user=D('UserInfo','Logic');
			$group=M('TeamInfo');
			$title='全部';
			
			$page=I('param.page','1','int');
			$groupid=I('param.group',NULL,'int');
			
			$where['UserType']=array('LT',session('admin.usertype'));
			if(!is_null($groupid)){
				$where['team_info.TeamId']=$groupid;
				$title=$group->where('TeamId=%d',$groupid)->getField('TeamName');
			}
			
			$result=$user->getuser($page,$where);
			$grouplist=$group->select();
			
			$this->assign('userlist',$result['result']);
			$this->assign('item_index',2);
			$this->assign('grouplist',$grouplist);
			$this->assign('list_title',$title);
			$this->display();
		}
	}
?>