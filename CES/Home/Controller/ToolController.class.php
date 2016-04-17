<?php
namespace Home\Controller;
use Think\Controller;
class ToolController extends Controller{
	public function captcha(){
		$Verify = new \Think\Verify();
		$Verify->entry();
	}
}
?>