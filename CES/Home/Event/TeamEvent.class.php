<?php
namespace Home\Event;
class TeamEvent extends OutEvent{
    
    protected function _get_user(){
        return A('User','Event');
    }
    
    function _safe_control($pid){
        $this->user->uid;
        
        
    }
    
    
    function _safe_claim($pid){
        
        
        
    }
}
?>