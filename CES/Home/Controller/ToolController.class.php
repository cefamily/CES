<?php
namespace Home\Controller;
use Think\Controller;
class ToolController extends Controller{
	public function captcha(){
		$Verify = new \Think\Verify();
		$Verify->entry();
	}
   
   public function checkCaptcha($code,$id=''){
       $verify=new \Think\Verify();
       return $Verify->check($code,$id);
   }
}
?>