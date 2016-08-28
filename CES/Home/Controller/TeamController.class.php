<?php
namespace Home\Controller;
use Think\Controller;
class TeamController extends OutController{
	private $teamApi;
	private $teamUserApi;
	private $teamEvent;
	private $userEvent;
	private $userApi;
	 function _initialize(){
		 $this->teamApi=D('TeamInfo','Api');
		 $this->teamUserApi=D('TeamUser','Api');
		 $this->teamEvent=A('TeamInfo','Event');
		 $this->userEvent=A('User','Event');
		 $this->userApi=D('UserInfo','Api');
	 }
	
	    /*
    获取组的信息
    
    权限
    后台
    权限3以及以上
    
    
    传入参数
    tid         必填          组的ID

    成功输出参数
    {
        team:{
                tid:'1',                   组ID
                tname:'我的组',             组名
                tctime:'1758000000'        创建时间（时间截）
        },
        master:{
            '2':'测试用户2',                用户的id：用户的名字
            '3':'测试用户3',
        },
        member:{
            '2':'测试用户2',
            '3':'测试用户3',
            '4':'测试用户4',
            '5':'测试用户5',
            '6':'测试用户6',
        }
    }
    如果没有组error
    如果没有组长或组员 master:[],member:[]
    
    API接口：domain/index.php/Home/Team/getTeamInfo
    */
	public function getTeamInfo(){
		$tid=I('post.tid',0,'int');
		$this->userEvent->_safe_login();
        $this->userEvent->_safe_admin();
        $this->userEvent->_safe_type(3);
		$result=$this->teamApi->getTeamInfo($tid);
		$this->success($result);
	}
    
    
    
    
    
    
    
    
    /*
    增加一个组
    
    权限
    后台
    权限4
    
    
    传入参数
    tname         必填          组的名字

    成功输出参数
    int 1
    
    API接口：domain/index.php/Home/Team/addTeam
    */
    public function addTeam(){
		$data['tname']=I('post.tname','',false);
		$this->userEvent->_safe_login();
        $this->userEvent->_safe_admin();
        $this->userEvent->_safe_type(4);
		if($this->teamApi->addTeam($data))
		{
			$this->success(1);
		}else{
			$this->error(0);
		}
	}
    
    
    
    
     /*
    删除一个组
    
    权限
    后台
    权限4
    
    传入参数
    tid         必填          组的ID

    成功输出参数
    int 1
    
    API接口：domain/index.php/Home/Team/deleteTeam
    */
    public function deleteTeam(){
		$tid=I('post.tid',0,'int');
		$this->userEvent->_safe_login();
        $this->userEvent->_safe_admin();
        $this->userEvent->_safe_type(4);
		if($this->teamApi->delTeam($data))
		{
			$this->success(1);
		}else{
			$this->error(0);
		}	
	}
    
    
    
    
    
    
    /*
    获取组的列表（金可获得有权限管理的组）
    
    权限
    后台
    权限3以及以上
    
    传入参数
    page        默认1         页数
    limit       默认10        每页的数量
    成功输出参数
    {
        teams:[
            {
                tid:'1',
                tname:'我的组',
                tctime:'1758000000'
            },
            {
                tid:'2',
                tname:'我的组2',
                tctime:'1759000000'
            }
            ...
            ...
            ...
        ],
        row:7
    }
    如果没有则输出{teams:[],row:0}
    
    API接口：domain/index.php/Home/Team/getTeamList
    */
    public function getTeamList(){
		$page=I('post.page',1,'int');
		$limit=I('post.limit',10,'int');
		$this->userEvent->_safe_login();
        $this->userEvent->_safe_admin();
        $this->userEvent->_safe_type(3);
		
		$result['teams']=$this->teamApi->getTeamList($page,$limit);
		$this->success($result);	
	}
    
    
    
    
    
    /*
    将一名成员添加进组
    
    权限
    后台
    权限3以及以上
    权限3需要验证是否是该组的组长
    仅可操作比自己权限低的用户
    
    传入参数
    type        默认uid       用户筛选形式
    value       必填          筛选的值
    team        必填          组的ID
    成功输出参数
    int 1
    
    API接口：domain/index.php/Home/Team/addMember
    */
    public function addMember(){
		$type=I('post.type','',false);
		$data['tid']=I('post.tid',0,'int');
		$this->userEvent->_safe_login();
        $this->userEvent->_safe_admin();
        $this->userEvent->_safe_type(3);
		$myInfo=session('adminstat');
		if($type=='uid'){
			$data['uid']=I('post.value',0,'int');
			$res=$this->userApi->where('uid='.$data['uid'])->find();			
		}else{
			$value=I('post.value','','/^[A-Za-z0-9_]{4,16}$/');			
			$res=$this->userApi->where('uname='.$value)->find();
		}
        if($res){
                $data['uid']=$res['uid'];
            }else{
                $this->error('用户不存在');
            }

		if($myInfo['utype']!=4){
			$this->userEvent->_safe_user_type($data['uid'],true);
		}
		if($this->teamUserApi->userInTempCheck($data['uid'],$data['tid'])){
			$this->error('该用户已经存在');
		}
		
		if($res['utype']==0){
			$this->userApi->addMenmber($data['uid']);
		}
		
		$this->teamUserApi->addMenmber($data);
		$this->success(1);
	}
    
    
    
    
    
    /*
    将一名成员从组删除
    
    权限
    后台
    权限3以及以上
    权限3需要验证是否是该组的组长
    仅可操作比自己权限低的用户
    
    传入参数
    type        默认uid       用户筛选形式
    value       必填          筛选的值
    team        必填          组的ID
    成功输出参数
    int 1
    
    API接口：domain/index.php/Home/Team/delMember
    */
    public function delMember(){
		$type=I('post.type','',false);
		$data['team']=I('post.tid',0,'int');
		$this->userEvent->_safe_login();
        $this->userEvent->_safe_admin();
        $this->userEvent->_safe_type(3);
		$myInfo=session('adminstat');
		if($type=='uid'){
			$data['uid']=I('post.value',0,'int');
			$res=$this->userApi->where('uid='.$value)->find();			
		}else{
			$value=I('post.value','','/^[A-Za-z0-9_]{4,16}$/');			
			$res=$this->userApi->where('uname='.$value)->find();
			if($res){
				$data['uid']=$res['uid'];
			}else{
				$this->error('用户不存在');
			}
		}

		if($myInfo['utype']!=4){
			$this->userEvent->_safe_user_type($data['uid'],true);
		}
		
		if(!$this->teamApi->userInTempCheck($data['uid'],$data['tid'])){
			$this->error('该用户不存在');
		}
		$this->teamUserApi->delMenmber($data);
		if($res['utype']==1){
			//$this->userApi->addMenmber($data['uid']);
			if(!$this->teamUserApi->userTeamCheck($data['uid'])){
				$this->userApi->delMenmber($data['uid']);
			}
		}
		
		$this->success(1);
	}
    
    
    
    
    /*
    将一名成员设置为组的组长
    
    权限
    后台
    权限4
    仅可操作比自己权限低的用户
    
    传入参数
    type        默认uid       用户筛选形式
    value       必填          筛选的值
    team        必填          组的ID
    成功输出参数
    int 1
    
    API接口：domain/index.php/Home/Team/addMaster
    */
	public function addMaster(){
		$type=I('post.type','',false);
		$data['team']=I('post.tid',0,'int');
		$this->userEvent->_safe_login();
        $this->userEvent->_safe_admin();
        $this->userEvent->_safe_type(4);
		$myInfo=session('adminstat');
		if($type=='uid'){
			$data['uid']=I('post.value',0,'int');
			$res=$this->userApi->where('uid='.$value)->find();			
		}else{
			$value=I('post.value','','/^[A-Za-z0-9_]{4,16}$/');			
			$res=$this->userApi->where('uname='.$value)->find();
			if($res){
				$data['uid']=$res['uid'];
			}else{
				$this->error('用户不存在');
			}
		}
		
		if($res['utype']<2){
			$this->error('该用户至少需要汉化组权限');
		}
		if($myInfo['utype']!=4){
			$this->userEvent->_safe_user_type($data['uid']);
		}
		
		if($this->teamApi->userInTempCheck($data['uid'],$data['tid'])){
			$this->teamUserApi->addMaster($data,true);
		}else{
			$this->teamUserApi->addMaster($data,true);
		}
		
		$this->success(1);
	}
    
    
    
    
    /*
    取消一名成员的组长职位
    
    权限
    后台
    权限4
    仅可操作比自己权限低的用户
    
    传入参数
    type        默认uid       用户筛选形式
    value       必填          筛选的值
    team        必填          组的ID
    成功输出参数
    int 1
    
    API接口：domain/index.php/Home/Team/delMaster
    */
    public function delMaster(){
		
		$type=I('post.type','',false);
		$data['team']=I('post.tid',0,'int');
		$this->userEvent->_safe_login();
        $this->userEvent->_safe_admin();
        $this->userEvent->_safe_type(4);
		$myInfo=session('adminstat');
		if($type=='uid'){
			$data['uid']=I('post.value',0,'int');
			$res=$this->userApi->where('uid='.$value)->find();			
		}else{
			$value=I('post.value','','/^[A-Za-z0-9_]{4,16}$/');			
			$res=$this->userApi->where('uname='.$value)->find();
			if($res){
				$data['uid']=$res['uid'];
			}else{
				$this->error('用户不存在');
			}
		}
		
		if($myInfo['utype']!=4){
			$this->userEvent->_safe_user_type($data['uid']);
		}
		$this->teamUserApi-delMaster($data);	
		}


    /*
    获取所有组的信息
    
    权限
    登录
    
    传入参数
    无
    成功输出参数
    [{"tid":"ID","tname":"组名称","tctime":创建时间}]
    
    API接口：domain/index.php/Home/Team/getAllTeamList
    */
	public function getAllTeamList(){
        $this->userEvent->_safe_login();
        $list=$this->teamApi->getTeamList(1,9999);
        $this->success($list);
    }


    public function changeTeamName(){
        $this->userEvent->_safe_login();
        $this->userEvent->_safe_admin();
        $this->userEvent->_safe_type(4);
        $tid=I('post.tid','',false);
        $tname=I('post.tname','','string');
        $res=$this->teamApi->changeTeamName($tid,$tname);
        if($res){
            $this->success(1);
        }else{
            $this->error(0);
        }
    }
}
?>