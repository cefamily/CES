<?php
namespace Admin\Controller;
use Think\Controller;
class UserInfoController extends Controller{
		public function _initialize(){
			if(!session('?admin') || session('admin.usertype')<2){
			$this->error('非法操作');
		}
		$this->assign('adminname',session('admin.username'));
		$this->assign('admintype',session('admin.usertype'));
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