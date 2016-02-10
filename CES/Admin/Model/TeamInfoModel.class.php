<?php
namespace Admin\Model;
use Think\Model;

class TeamInfoModel extends  Model{
		protected	$_validate=array(
			array('TeamName','require','组名必须',1),
			array('TeamName','unique','已存在该组',1,'unique',1)
		);
}
?>