<?php
namespace Admin\Model;
use Think\Model;
class ClaimModel extends Model {
   public $_map = array(
		'cid'=>'ClaimId',
		'pid'=>'ProId',
		'uid'=>'UserId',
		'ctype'=>'ClaimType',
		'finishtime'=>'ClaimFinish',
	);
   
}
?> 