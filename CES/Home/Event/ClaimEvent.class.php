<?php
namespace Home\Event;
use Think\Controller;
class ClaimEvent extends Controller{
    
    
    /***
    检查是否认领指定任务的指定职位
    如type职位未传参，则检查是否认领过此任务
    */
    function _safe_my_claim($pid,$type=null){
        
    }
}
?>