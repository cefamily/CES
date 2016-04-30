<?php
namespace Home\Event;
class TeamEvent extends OutEvent{
    
    protected function _get_user(){
        return A('User','Event');
    }
    
    function _safe_control($pid){
		$tid=$this->_safe_claim($pid);
        if($tid!=0){
			$user=M('UserTeam')->where(array('tid'=>$tid,'uid'=>$this->user->uid,'tadmin'=>'1'))->find();
			if($user){
				return true;
			}else{
				return false;
			}
		}else{
			return false;
		}
        
        
    }
    
    
    function _safe_claim($pid){
        $team=M('TeamUser');
		$prolist=M('Progress')->where(array('pid'=>$pid,'gtype'=>'team'))->getField('gtext');
		$list=$team->where('uid='.$this->user->uid)->getField('uid');
        $flag=0;
		foreach($list as $id){
			if(in_array($id,$prolist)){
				$flag=$id;
			}
		}
		return $flag;
        
    }
}
?>