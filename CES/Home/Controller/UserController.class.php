<?php
namespace Home\Controller;
use Think\Controller;
class UserController extends OutController{
     private $userApi;
     private $userEvent;
     private $tool;
	 function _initialize(){
         $this->userApi=D('UserInfo','Api');
         $this->userEvent=A('User','Event');
         $this->tool=A('Tool','Event');
     }
    /*
    获取我的用户信息
    
    权限
    登录
    
    无传入参数
 
    成功输出参数
    {info:$info,team:[1,2,3,4],master:[2,4]}
    
    
    $info
    {
        uid:1,                               //用户ID    
        uname:'我的名字',                    //用户名
        uemail:'233@c.baka',                //邮箱
        utype:'4',                          //权限等级
        uavatar:'http://c.baka/avatar.jpg', //头像
        uctime:'1700000000',                //创建时间
    }
    
    API接口：domain/index.php/Home/User/getMyInfo
    */
    
    public function getMyInfo(){
		$this->userEvent->_safe_login();
		$userInfo=session('userstat');
		$result=$this->userApi->getUserInfoById($userInfo['uid']);
		if($result){
			$this->success(array_values($result));
		}else{
			$this->error(0);
		}
	}

    
    /*
    获取用户信息
    
    权限
    后台
    权限3以及以上
    仅可获得权限比自己低的用户
    
    传入参数
    uid         必填          用户ID
 
    成功输出参数
    {info:$info,team:[1,2,5],master:[]}
    
    
    $info
    {
        uid:2,                               //用户ID    
        uname:'我的名字',                    //用户名
        uemail:'233@c.baka',                //邮箱
        utype:'1',                          //权限等级
        uavatar:'http://c.baka/avatar.jpg', //头像
        uctime:'1700000000',                //创建时间
        uip:'192.168.0.102',                //上次更新时的IP
        ulltime:'1800000000'                //上次更新时间
    }
    
    API接口：domain/index.php/Home/User/getUserInfo
    */

    public function getUserInfo(){
		$uid=I('post.uid','0','int');
        $this->userEvent->_safe_login();
        $this->userEvent->_safe_admin();
        $this->userEvent->_safe_type(3);
        $this->userEvent->_safe_user_type($uid);
		$result=$this->userApi->getUserInfoById($uid);
		if($result){
			$this->success($result);
		}else{
			$this->error(0);
		}
    }
    
    
    
    
     /*
    获取用户信息
    
    权限
    后台
    权限3以及以上
    仅可获得权限比自己低的用户
    
    传入参数
    page    默认1    显示页数
    limit   默认10   每页显示的数量
    uid     选填
    name    选填     
    type    选填
    
    成功输出参数
    {users:[$info1,$info2,$info3....],row:177}
    没有搜到任何用户则输出{users:[],row:0}
    
    $info
    {
        uid:2,                               //用户ID    
        uname:'我的名字',                    //用户名
        uemail:'233@c.baka',                //邮箱
        utype:'1',                          //权限等级
        uavatar:'http://c.baka/avatar.jpg', //头像
        uctime:'1700000000',                //创建时间
        uip:'192.168.0.102',                //上次更新时的IP
        ulltime:'1800000000'                //上次更新时间
    }
    
    API接口：domain/index.php/Home/User/getUserList
    */

    public function getUserList(){
		$page=I('param.page','1','int');
		$limit=I('param.limit','10','int');
        $this->userEvent->_safe_login();
        $this->userEvent->_safe_admin();
        $this->userEvent->_safe_type(3);
		$myInfo=session('adminstat');
		$where['utype']=array('lt',$myInfo['utype']);
		$result['users'] = D('UserInfo','Api')->getUserList($where,$page,$limit);
		
        $this->success($result);
    }
    
    
    
    
    
    
    
    
     /*
    获取管理员列表
    
    权限
    后台
    权限4
    获得权限3的用户
    
    传入参数
    page    默认1    显示页数
    limit   默认10   每页显示的数量
 
    成功输出参数
    {users:[$info1,$info2,$info3....],row:177}
    没有搜到任何用户则输出{users:[],row:0}
    
    $info
    {
        uid:2,                               //用户ID    
        uname:'我的名字',                    //用户名
        uemail:'233@c.baka',                //邮箱
        utype:'1',                          //权限等级
        uavatar:'http://c.baka/avatar.jpg', //头像
        uctime:'1700000000',                //创建时间
        uip:'192.168.0.102',                //上次更新时的IP
        ulltime:'1800000000'                //上次更新时间
    }
    
    API接口：domain/index.php/Home/User/getAdminList
    */
    
    public function getAdminList(){
        $page=I('param.page','1','int');
		$limit=I('param.limit','10','int');
        $this->userEvent->_safe_login();
        $this->userEvent->_safe_admin();
        $this->userEvent->_safe_type(4);
		$myInfo=session('adminstat');
		$where['uid']=array('eq',3);
		$result=$this->userApi->getUserList($where,$page,$limit);
		$this->success($result);     
    }
    
    
    /*
    修改用户权限
    
    权限
    后台
    权限4
    仅可修改权限比自己低的用户
    
    传入参数
    uid     必填      用户的ID  
    type    必填      用户权限
    成功输出参数
    int 1
    
    API接口：domain/index.php/Home/User/changeUserType
    */
//	public function changeUserType(){
//        $uid=I('post.uid')=
//        
//    }




    
    
    /*
    登录

    传入参数
    name        必填      用户的名字
    password    必填      用户的密码（md5加密后的）
    captcha     必填      验证码
    成功输出参数
    int 1
    
    API接口：domain/index.php/Home/User/userLogin
    */
    public function userLogin(){
		$data['captcha']=I('post.captcha','',false);
		$data['user']=I('post.name','','/^[A-Za-z0-9_]{4,16}$/');
		$data['password']=I('post.password','',false);

          if(!$this->tool->checkCaptcha($data['captcha']))
        {
            $this->error('验证码错误:'.$data['captcha']);
            return;
        }
        $result=$this->userApi->userLogin($data);
        if($result){
            session('userstat',$result);
            if($result['utype']>2)session('adminstat',$result);
            $this->success(1);
        }else{
            $this->error("用户名或密码错误".$data['password']);
        }
        
    }
    
    
     /*
    登出
    
    权限
    登录
    
    无传入参数
    
    成功输出参数
    int 1
    
    API接口：domain/index.php/Home/User/userLogout
    */
    public function userLogout(){
        session('userstat',NULL);
		session('adminstat',NULL);
		$this->success(1);        
    }
    
    
     /*
    注册
    
    
    传入参数
    email       必填      修改后的邮箱
    password    必填      用户的密码（md5加密后的）
    name        必填      用户的名字
    captcha     必填      验证码
    成功输出参数
    {uid:$uid}
    
    $uid  注册到的用户ID
    
    API接口：domain/index.php/Home/User/reg
    */
	public function reg(){
        $data['uemail']=I('post.email','','email');
		$data['upassword']=I('post.password','',false);
		$data['uname']=I('post.name','',false);
		$data['captcha']=I('post.captcha','',false);
        $data['uctime']=time();
        $data['utype']=1;
        if(!$this->tool->checkCaptcha($data['captcha']))
        {
            $this->error('验证码错误:'.$data['captcha']);
            return;
        }
		$result['uid']=$this->userApi->user_reg($data);
		if($result['uid']){
			$this->success($result);
		}else{
			$this->error($this->userApi->getError());
		}
    }
    
    
     /*
    修改邮箱
    
    权限
    登录
    
    传入参数
    email       必填      修改后的邮箱
    //password    必填      用户的密码（md5加密后的）
    captcha     必填      验证码
    成功输出参数
    int 1
    
    API接口：domain/index.php/Home/User/changeEmail
    */
	public function changeEmail(){
		$data['uemail']=I('post.email','','email');
		$data['upassword']=I('post.password','',false);
        $data['nickname']=I('post.nickname','',false);
		$data['captcha']=I('post.captcha','',false);
		
        $this->userEvent->_safe_login();
        if(!$this->tool->checkCaptcha($data['captcha']))
            $this->error('验证码错误');
		//  $userInfo=session('userstat');
        //  $result=$this->userApi->user_login($userInfo['uname'],$data['password']);
        // if($result){
        $res=$this->userApi->change_email($this->userEvent->uid,$data['uemail'],$data['nickname']);
        if($res){
            $this->success(1);
        }else{
            $this->error($this->userApi->getError());
        }
        // }else{
        //     $this->error('密码错误');
        // }
    }
    
    
     /*
    修改密码
    
    权限
    登录
    
    传入参数
    newpassword 必填      修改后的密码（md5加密后的）
    password    必填      用户的密码（md5加密后的）
    captcha     必填      验证码
    成功输出参数
    int 1
    
    API接口：domain/index.php/Home/User/changePassword
    */
    public function changePassword(){
        $this->userEvent->_safe_login();
        $captcha=I('post.captcha','',false);
        if(!$this->tool->checkCaptcha($captcha))
            $this->error('验证码错误');
		// $userInfo=session('userstat');
        $uid=$this->userEvent->uid;
        $newpassword=I('post.newpassword','',false);
        $password=I('post.password','',false);

        $data['user']=$this->userEvent->name;
        $data['password']=$password;
        
        $result=$this->userApi->userLogin($data);
		if(!$result){
			  $this->error('旧密码不正确');
			  return;
			 }
        if($this->userApi->change_password($uid,$data['user'],$newpassword)){
            $this->success(1);
        }else{
            $this->error($this->userApi->getError());
        }
    }
     /*
    后台管理员修改邮箱
    
    权限
    后台
    权限3以及以上
    仅可修改比自己权限低的用户
    
    传入参数
    uid         必填      用户的ID
    email       必填      修改后的邮箱
    成功输出参数
    int 1
    
    API接口：domain/index.php/Home/User/changeUserEmail
    */
    
    public function changeUserEmail(){
		$data['uid']=I('post.uid',0,'int');
		$data['uemail']=I('post.email','','email');
        $this->userEvent->_safe_login();
        $this->userEvent->_safe_admin();
        $this->userEvent->_safe_type(3);
        $this->userEvent->_safe_user_type($data['uid']);
        $res=$this->userApi->change_email($data['uid'],$data['uemail']);
        if($res){
            $this->success('1');
        }else{
            $this->error('0');
        }
     }
    
    
     /*
    后台管理员修改密码
    
    权限
    后台
    权限3以及以上
    仅可修改比自己权限低的用户
    
    传入参数
    uid         必填      用户的ID
    email       必填      修改后的密码（md5加密后的）
    成功输出参数
    int 1
    
    API接口：domain/index.php/Home/User/changeUserPassword
    */
    public function changeUserPassword(){
        $newpassword=I('post.newpassword','',false);
        $password=I('post.password','',false);
        if($this->userApi->change_password($uid,$password)){
            $this->success('1');
        }else{
            $this->error('0');
        }
        
    }
    
    
    /*
    后台登录
    
    权限
    权限3以及以上
    
    传入参数
    password    必填      用户的密码（md5加密后的）
    captcha     必填      验证码
    成功输出参数
    int 1
    
    API接口：domain/index.php/Home/User/adminLogin
    */
    
    public function adminLogin(){
		$data['captcha']=I('post.captcha','',false);
		$password=I('post.password','',false);
        $this->userEvent->_safe_login();
        if($this->tool->checkCaptcha($data['captcha']))
            $this->error('验证码错误');        
        $this->userEvent->_safe_type(3);
		$userInfo=session('userstat');
        $result=$this->userApi->user_login($userInfo['uname'],$password);
        if($result){
            session('adminstat',$result);
            $this->success('1');
        }else{
            $this->error('0');
        }
    }
}
?>