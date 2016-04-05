<?php
namespace Home\Controller;
use Think\Controller;
class TeamController extends Controller{
	public function _initialize(){
        $this->user = A('User','Event');
        //$this->claim = A('Claim','Event');
        
    }
	public function get_team_info($tid=0){
        $this->user->_safe_type(4);
	}
    public function add_team(){
        $this->_safe_type(4);
        
	}
    public function delete_team(){
        $this->_safe_type(4);
        $tid = post('tid',0);
	}
    public function get_team_list(){
        global $_G;
        $page = $_G['page'];
        $this->user-> _safe_type(4);
        //获取列表，tid逆序排列，每页
	}
    public function add_member(){
        $this->user->_safe_type(3);
        $uid = post('uid',0);
        $this->user->_safe_utype($uid);
        
	}
    public function del_member(){
        $this->user-> _safe_type(3);
        $uid = post('uid',0);
        $this->user->_safe_utype($uid);
        
	}
	public function add_master(){
        $this->user->_safe_type(4);
        
	}
    public function del_master(){
        $this->user->_safe_type(4);
        
	}
	

	
	
	
	
	
	
}
?>