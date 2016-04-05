<?php
namespace Home\Port;
interface ToolPort{
    /*
    获取验证码（图片）
    无传入参数
    
    输出图片
    
    */
	public function captcha();
   
}
?>