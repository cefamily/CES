<?php
namespace Home\Controller;
class ProgressController extends OutController{

    protected function _get_user(){
        return A('User','Event');
    }
    protected function _get_progress(){
        return A('Progress','Event');
    }
    protected function _get_claim(){
        return A('Claim','Event');
    }
   /*
    修改我认领的任务的职务的进度
    
    权限
    权限2以及以上
    
    
    传入参数
    pid         必填          任务的ID
    type        必填          职位
    text        必填          进度说明
    flag        必填          是否完成

    成功输出参数
    int 1

    API接口：domain/index.php/Home/Progress/changeProgress
    */
	public function changeProgress(){
        $this->user->_safe_login();
        $this->user->_safe_type(1);
        $pid = I('post.pid','');
        $type = I('post.type','');
        $text = I('post.text','');
        $flag=I('post.flag','');
        if(!$pid || !$type || !$text)$this->error('参数不符合');
        $this->claim->_safe_my_claim($pid,$type);
        if($flag=='true'){
            $where['pid']=$pid;
            $where['uid']=$this->user->uid;
            $where['ctype']=$type;
            $data['cfinish']=1;
            $claimMode=M('Claim');
            $claimMode->where($where)->save($data);
        }
        if($this->progress->add($pid,$type,$text)){
            $this->success(1);
        }else $this->error('修改进度失败');
    }
        
        /*
    根据Pid获取任务进度
    
    权限
    登录

    参数 
            pid    必填    任务ID
            type   可选    职位（不填则获取所有）

    返回值:

    API接口：domain/index.php/Home/Product/getProductByPid
    */

    public function getProgress(){
        $this->user->_safe_login();
        $pid=I('post.pid','','int');
        $type=I('post.type','');

        $claimMode=M('Progress');
        $where['pid']=$pid;
        if($type) $where['gtype']=$type;
        $res=$claimMode->where($where)->select();
        
        $this->success($res);
        
    }
	
}
?>