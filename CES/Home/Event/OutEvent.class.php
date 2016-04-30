<?php
namespace Home\Event;
class OutEvent{
    protected function success($object,$url='') {
		return $this->_out($object,$url,1);
	}
	protected function error($object,$url='') {
		return $this->_out($object,$url,0);
	}
	private function _out($object,$url='',$code=1) {
		$data['info'] = $object;
        $data['status'] = $code;
		$data['url'] = $url;
		echo json_encode($data);
		die();
	}
	function __get($name){
        $sname = "_get_".$name;
        if(method_exists($this,$sname)){
            $this->$name = $this->$sname();
            return $this->$name;
        }else{
            $this->$name = NULL;
            return NULL;
        }
        
    }
    
}
?>