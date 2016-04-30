<?php
namespace Home\Event;
use Think\Controller;
class ProgressEvent extends Controller{
    
    
    protected function _get_user(){
        return A('User','Event');
    }
    
    /***
    检查是否认领指定任务的指定职位
    如type职位未传参，则检查是否认领过此任务
    */
    function add($pid,$gtype,$v){
        $data['gctime'] = time();
        $data['uid'] = $this->user->uid;
        $data['pid'] = $pid;
        $data['gtype'] = $gtype;
        $data['gtext'] = $v;
        return M('progress')->data($data)->add();
    }
}
?>