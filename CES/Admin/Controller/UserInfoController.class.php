<?php
namespace Admin\Controller;
class UserInfoController extends ConstructController{
		public function _initialize(){
			parent::_initialize();
		}
		
		public function showlist(){
			$user=D('UserInfo','Logic');
			$group=M('TeamInfo');
			$title='全部';
			
			$page=I('param.page',1,'int');
			$groupid=I('param.group',NULL,'int');
			$uname=I('param.uname',NULL,'string');
			
			$where['UserType']=array('LT',session('admin.usertype'));
			if(!is_null($groupid)){
				$where['team_info.TeamId']=$groupid;
				$title=$group->where('TeamId=%d',$groupid)->getField('TeamName');
			}
			if(!is_null($uname) && $uname!=''){
				$where['user_info.UserName']=array('like','%'.$uname.'%');
				$title='搜索'.$uname;
			}
			
			$result=$user->getuser($page,10,$where);
			$grouplist=$group->select();
			
			//----------生成分页信息---------
			$pagedata['count']=$result['count']/10;
			if($result['count']%10!=0)
			{
				$pagedata['count']+=1;
			}
			//----------------------------
			
			$pagedata['count']=(int)$pagedata['count'];
			$pagedata['now']=$page;
			
			//$this->assign('pagedata',$pagedata);
//			$this->assign('userlist',$result['result']);
//			$this->assign('item_index',2);
//			$this->assign('grouplist',$grouplist);
//			$this->assign('list_title',$title);
//			$this->display();
			$ajaxdata=array(
				'pagedata'=>$pagedata,
				'userlist'=>$result['result'],
				'grouplist'=>$grouplist,
				'list_title'=>$title
			);
			$this->success($ajaxdata);
		}
		public function showuser(){
			$userid=I('get.userid','','int');
			$user=D('UserInfo','Logic');
			if(!$this->checkType($userid)) $this->error('权限不足');
			
			if($userid!=''){
				$result=$user->getuserById($userid);
				
				if($result){
//					$this->assign('userinfo',$result);
//					$this->assign('item_index',2);
//					$this->display();
					$ajaxdata=array(
						'userinfo'=>$result,
					);
					$this->success($ajaxdata);
				}else{
					$this->error($user->getError());
				}
			}
		}
		
		public function updateuser(){
			$data['UserEmail']=I('post.useremail','','email');
			$userid=I('post.userid','','int');
			if(!$this->checkType($userid)) $this->error('权限不足');
			$user=D('UserInfo','Logic');
			$result=$user->updataByInfo($userid,$data);
			if($result){
				$this->success('修改成功');
			}else{
				$this->error($user->getError());
			}
		}
		
		public function resetpwd_ajax(){
			if(!IS_AJAX) $this->error('非法操作');
			
			$pwd=I('post.pwd','',false);
			$userid=I('post.userid','','int');
			
			if(!$this->checkType($userid)){
				$request='TYPE_ERR';
				//$this->ajaxReturn($request);
				$this->error($request);
				return;
				}
			
			$user=M('UserInfo');
			$name=$user->where('UserId='.$userid)->getField('UserName');
			$data['UserPwd']=md5($pwd.$name);
			$result= $user->where('UserId='.$userid)->save($data);
			if($result){
				$request='OK';
				$this->success($request);
				return;
			}else{
				$request='ERR';
				$this -> error($request);
				return;
			}
			//$this->ajaxReturn($request);
		}
	}
?>