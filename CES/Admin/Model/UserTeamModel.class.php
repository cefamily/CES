<?php
namespace Admin\Model;
use Think\Model;

class UserTeamModel extends  Model{
	protected $_validate=array(
		array('UserId','require','用户ID必须',1),
		array('TeamId','require','群组ID必须',1)
	);
	protected  $_auto=array(
		//array('AdminFlag','0',)
	);
}
?>