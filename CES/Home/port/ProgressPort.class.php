<?php
namespace Home\Port;
interface ProgressPort{

    /*
    修改进度
    传入参数
    pid         必填          任务的ID
    type        必填          职位
    text        必填          进度说明

    成功输出参数
    int 1

    */
	public function change_progress();

	
	
	
	
	
	
}
?>