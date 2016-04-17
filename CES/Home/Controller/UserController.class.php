<?php
namespace Home\Controller;
use Think\Controller;
class UserController extends Controller{
     private $userModel;
     private $userEvent;
     private $tool;
	 function _initialize(){
         $this->user=D('UserInfo','Api');
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
	public function changeUserType(){
        
        
    }
    
    
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
        if($this->tool->checkCaptcha($data['captcha']))
            $this->error('验证码错误');
        $result=$this->userModel->userLogin($data);
        if($result){
            session('userstat',$result);
            $this->success(1);
        }else{
            $this->error(0);
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
        
        
    }
    
    
     /*
    修改邮箱
    
    权限
    登录
    
    传入参数
    email       必填      修改后的邮箱
    password    必填      用户的密码（md5加密后的）
    captcha     必填      验证码
    成功输出参数
    int 1
    
    API接口：domain/index.php/Home/User/changeEmail
    */
	public function changeEmail(){
        $this->userEvent->_safe_login();
        if($this->tool->checkCaptcha($data['captcha']))
            $this->error('验证码错误');
         $result=$this->user->user_login(session('user')['uname'],$data['password']);
        if($result){
            $this->user->change_email(session('userstat')['uid'],$data['email']);
        }else{
            $this->error('密码错误');
        }
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
        if($this->tool->checkCaptcha($data['captcha']))
            $this->error('验证码错误');
        $uid=session('user')['uid'];
        $newpassword=$data['newpassword'];
        $password=$data['passwor'];
        if($this->user->change_password($uid,$newpassword,$password)){
            $this->success('1');
        }else{
            $this->error('0');
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
        $this->userEvent->_safe_login();
        $this->userEvent->_safe_admin();
        $this->userEvent->_safe_type(3);
        $this->userEvent->_safe_user_type($data['uid']);
        $res=$this->user->change_email($data['uid'],$data['uemail']);
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
        $this->userEvent->_safe_login();
        if($this->tool->checkCaptcha($data['captcha']))
            $this->error('验证码错误');
        $password=$data['password'];
        $this->userEvent->_safe_type(3);
        $result=$this->user->user_login(session('user')['uname'],$password);
        if($result){
            session('adminstat',$result);
            $this->success('1');
        }else{
            $this->error('0');
        }
    }
}
?>