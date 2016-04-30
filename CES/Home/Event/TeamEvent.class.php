<?php
namespace Home\Event;
class TeamEvent extends OutEvent{
    
    protected function _get_user(){
        return A('User','Event');
    }
    
    function _safe_control($pid){
		$tid=$this->_safe_claim($pid);
        if($tid!=0){
			$userInfo=session('userstat');
			$user=M('UserTeam')->where(array('tid'=>$tid,'uid'=>$userInfo['uid'],'tadmin'=>'1'))->find();
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
		$userInfo=session('userstat');
		$prolist=M('Progress')->where(array('pid'=>$pid,'gtype'=>'team'))->getField('gtext');
		$list=$team->where('uid='.$userInfo['uid'])->getField('uid');
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