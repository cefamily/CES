<?php
namespace Home\Event;
use Think\Controller;
class ToolEvent{
    
   public function checkCaptcha($code,$id=''){
       $verify=new \Think\Verify();
       return $Verify->check($code,$id);
   }
}
?>