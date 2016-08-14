<?php
namespace Home\Controller;
class ClaimController extends OutController{
	public function _initialize(){
        //$this->user = A('User','Event');
        
    }
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
    认领任务
    
    权限
    权限2以及以上
    任务的pteam不为0则需要验证是否有权限
    
    传入参数
    pid     必填   任务的编号
    ctype   必填   担任的职务    
    成功输出参数
    int 1
    
    API接口：domain/index.php/Home/Claim/claimProduct
    */
	public function claimProduct(){
        $this->user->_safe_login();
        
        $pid = floor(I('post.pid',0));
        $ctype = I('post.ctype','');
        if(!$pid || !$ctype)$this->error('参数错误');
        if(!$p = M('ProductInfo')->find($pid))$this->error('没有找到任务');
        if($p['team'])$this->team->_safe_claim($pid);
        if($p['pteam']!=0){
            $this->user->_safe_type(2);
        }
        $data['uid'] = $this->user->uid;
        $data['pid'] = $pid;
        $data['ctype'] = $ctype;
        $typestr='';
        switch($ctype){
            case 'ty':
                $typestr='图源';
            break;
            case 'qz':
                $typestr='嵌字';
            break;
            case 'xt':
                $typestr='修图';
            break;
            case 'fy':
                $typestr='翻译';
            break;
            
        }
        M('Claim')->data($data)->add();
        $this->progress->add($pid,$ctype,$this->user->name.'认领了此任务的'.$typestr.'职务');
        $this->success(1);
        
    }
    
    
    
    
    /*
    完成认领
    
    权限
    登录后台
    权限3以及以上
    任务的pteam不为0则需要验证是否有权限
    
    传入参数
    uid     必填   用户ID
    pid     必填   任务的编号
    ctype   必填   担任的职务    
    成功输出参数
    int 1
    
    API接口：domain/index.php/Home/Claim/finishClaim
    */
    public function finishClaim(){
        $this->user->_safe_admin();
        $this->user->_safe_type(3);
        $pid = floor(I('post.pid',0));
        $ctype = I('post.ctype','');
        $uid = I('post.uid',0);
        if(!$pid || !$ctype || !$uid)$this->error('参数错误');
        if(!$p = M('ProductInfo').find($pid))$this->error('没有找到任务');
        if($p['team'])$this->team->_safe_control($pid);
        $where['pid'] = $pid;
        $where['uid'] = $uid;
        $where['ctype'] = $ctype;
        if(!M('Claim')->where($where)->find()){
            $this->error('没有担任过此任务');
        }
        $data['cfinish'] = time();
        M('Claim')->where($where)->data($data)->save();
        if(!$u = M('userInfo')->find($uid))$this->error('未找到用户');
        $this->progress->add($pid,$ctype,$this->user->name.'审核：'.$u['uname'].'完成了此任务的'.$ctype.'职务');
        $this->success(1);
    }
    
    
    
    
    
    /*
    取消认领
    
    权限
    登录后台
    权限3以及以上
    任务的pteam不为0则需要验证是否有权限
    
    传入参数
    uid     必填   用户ID
    pid     必填   任务的编号
    ctype   必填   担任的职务    
    成功输出参数
    int 1
    
    API接口：domain/index.php/Home/Claim/cancelClaim
    */
    public function cancelClaim(){
        $this->user->_safe_admin();
        $this->user->_safe_type(3);
        $pid = floor(I('post.pid',0));
        $ctype = I('post.ctype','');
        $uid = I('post.uid',0);
        if(!$pid || !$ctype || !$uid)$this->error('参数错误');
        if(!$p = M('ProductInfo').find($pid))$this->error('没有找到任务');
        if($p['team'])$this->team->_safe_control($pid);
        $where['pid'] = $pid;
        $where['uid'] = $uid;
        $where['ctype'] = $ctype;
        if(!M('Claim')->where($where)->delete()){
            $this->error('没有担任过此任务');
        }
        
        if(!$u = M('userInfo')->find($uid))$this->error('未找到用户');
        $this->progress->add($pid,$ctype,$this->user->name.'取消了'.$u['uname'].'的'.$ctype.'职务');
        $this->success(1);
    }
    
    /*
    获取该任务的认领用户列表
    
    */
    public function getClaimedUser(){
        $this->user->_safe_login();
        $model = D('Claim','ViewModel');
        $where['pid'] = I('post.pid',0);
        $where['pstate'] = array('LT',90);
        $m = $model->where($where)->select();
        if(!$m)$m = array();
        $n = count($m);
        $array = array('claims'=>$m,'row'=>$n);
        $this->success($array);
    }
		
}
?>