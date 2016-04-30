<?php
namespace Home\Model;
use Think\Model;
class ProductInfoModel extends Model{
    protected $fields = array(
        'cid','pid','uid','ctype','cfinish'
    );
    protected $pk = 'cid';
}
?>