<?php
namespace Admin\Model;
use Think\Model;

class TeamInfoModel extends  Model{
		protected	$_validate=array(
			array('teamname','require','组名必须',1)
		);
}
?>