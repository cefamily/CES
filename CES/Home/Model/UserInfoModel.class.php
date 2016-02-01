<?php
namespace Home\Model;
use Think\Model;

class UserInfoModel extends Model{
	protected $tableName = 'userinfo';
  	protected	$_validate=array(
		array('UserName','require','用户名格式错误',1),
		array('UserName','4,16','用户名长度要在4-16字符',1,'length',1),
		array('UserName','unique','该用户已存在',1,'unique',1),
		array('UserPwd','require','请输入密码',1),
		array('UserEmail','email','Email格式不正确',1)
	);
	protected $_auto=array(
		array('UserType','0'),
		array('LastTime','time',2,'function'),
		array('Userip','get_client_ip',2,'function')
	);
}
?>