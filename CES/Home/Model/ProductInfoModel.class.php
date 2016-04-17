<?php
namespace Home\Model;
use Think\Model;
class ProductInfoModel extends Model{
    protected $fields = array(
        'pid',      //任务编号，int，主键，自动
        'uid',      //用户编号，int,默认0
        'pname',    //任务标题，varchar(200)，默认''
        'pimg',     //缩略图，varchar(300),默认''
        'pstate',   //任务状态,tinyint,默认0
                    /*
                    -1:审核不通过
                    0：待审核
                    1：征集中
                    2：可以进行
                    3：进行中
                    4：可以完成
                    5：已完成
                    
                    98：伪删除
                    99：删除
                    */
        'premark',  //备注，text，默认''
        'pclick',   //点击数,int,默认0
        'pctime',   //创建时间，int，默认0
        'pup',      //被收藏数，int，默认0
        'ptype',    //图源类型,tinyint，默认0
                    //0:网源，1：图源
        'pftime',   //完成时间，int，默认0
        'pteam'     //是否限定组，tinyint，默认0
                    //0：共有，1：私有限定组
    );
    protected $pk = 'pid';
}
?>