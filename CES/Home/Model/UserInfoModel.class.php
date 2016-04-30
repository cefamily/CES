<?php
namespace Home\Model;
use Think\Model;
class UserInfoModel extends Model{
	protected $fields = array(
		'uid',			//用户编号，int,主键，自动
		'uname',		//用户名字，varchar（20）
		'upassword',	//用户加密后的密码，varchar(32)
		'uemail',		//用户邮箱,varchar(50)
		'utype',		//用户权限类型,tinyint,默认0
						/*
						0：无
						1：登陆用户权限
						2：汉化组权限
						3：管理员权限
						4：超级管理员权限
						*/
		'uavatar',		//用户头像，varchar（100）,默认''
		'uip',			//用户最后登陆ip，varchar(20),默认''
		'uctime',		//用户创建时间,int,默认0
		'ulltime',		//用户最后操作时间,int,默认0
	);
	protected $pk = 'uid';
	protected $_auto=array(
		array('UserType','0',1)
	);
	/*
  	protected	$_validate=array(
		array('UserName','require','用户名格式错误',1,'',1),
		array('UserName','4,16','用户名长度要在4-16字符',1,'length',1),
		array('UserName','unique','该用户已存在',1,'unique',1),
		array('UserPwd','require','请输入密码',1,'',1),
		array('UserEmail','email','Email格式不正确',1)
	);
	protected $_auto=array(
		array('UserType','0'),
	);
	
	*/
}
?>