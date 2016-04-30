<?php
namespace Home\Event;
class ClaimEvent{
    
    
    /***
    检查是否认领指定任务的指定职位
    如type职位未传参，则检查是否认领过此任务
    */
    function _safe_my_claim($pid,$type=null){
        $c = M('Claim');
        $where['pid'] = $pid;
        if($type)$where['ctype'] = $type;
        if(!$c->where($where)->find()) $this->error('没有认领此');
        
    }
}
?>