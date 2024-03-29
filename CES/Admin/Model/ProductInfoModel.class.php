<?php
namespace Admin\Model;
use Think\Model;
class ProductInfoModel extends Model {
    protected $_validate=array(
   		 array('UserId','require','用户ID必须'),
   		 array('ProTitle','require','标题必须',1),
		 //array('ProImg','require','缩略图必须'),
		// array('ProRem','require','备注必须')
	 );
	public $_map = array(
		'pid'=>'ProId',
		'title'=>'ProTitle',
		'uid'=>'UserId',
		'img'=>'ProImg',
		'state'=>'ProState',
		'remark'=>'ProRem',
		'clicktimes'=>'ProClick',
		'releasetime'=>'ProTime',
		'up'=>'ProUP',
		'type'=>'ProImgType',
		'finishtime'=>'ProFinish',
		'team'=>'ProTeamId'
	);
}
?> 