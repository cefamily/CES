<?php
namespace Home\Port;
interface UserPort{
    
    
    /*
    获取我的用户信息
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
    */
    
    public function getMyInfo();
    
    /*
    获取我的用户信息
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
    */

    public function getUserInfo();
    
    
    
    
     /*
    获取用户信息
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
    */

    public function getUserList();
    
    
    
    
    
    
    
    
     /*
    获取管理员信息
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
    */
    
    public function getAdminList();
    /*
    修改用户权限
    传入参数
    uid     必填      用户的ID  
    type    必填      用户权限
    成功输出参数
    int 1
    */
	public function changeUserType();
    
    
    /*
    登录
    传入参数
    name        必填      用户的名字
    password    必填      用户的密码（md5加密后的）
    captcha     必填      验证码
    成功输出参数
    int 1
    */
    public function userLogin();
    
    
     /*
    登出
    无传入参数
    
    成功输出参数
    int 1
    */
    public function userLogout();
    
    
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
    */
	public function reg();
    
    
     /*
    修改邮箱
    传入参数
    email       必填      修改后的邮箱
    password    必填      用户的密码（md5加密后的）
    captcha     必填      验证码
    成功输出参数
    int 1
    */
	public function changeEmail();
    
    
     /*
    修改密码
    传入参数
    newpassword 必填      修改后的密码（md5加密后的）
    password    必填      用户的密码（md5加密后的）
    captcha     必填      验证码
    成功输出参数
    int 1
    */
    public function changePassword();
    
     /*
    后台管理员修改邮箱
    传入参数
    uid         必填      用户的ID
    email       必填      修改后的邮箱
    成功输出参数
    int 1
    */
    
    public function changeUserEmail();
    
    
     /*
    后台管理员修改密码
    传入参数
    uid         必填      用户的ID
    email       必填      修改后的密码（md5加密后的）
    成功输出参数
    int 1
    */
    public function changeUserPassword();
    
    
    /*
    后台登录
    传入参数
    password    必填      用户的密码（md5加密后的）
    captcha     必填      验证码
    成功输出参数
    int 1
    */
    
    public function admin_Login();
}
?>