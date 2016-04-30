<?php
namespace Home\Controller;
class ProductController extends OutController{
	protected function _get_user(){
        return A('User','Event');
    }
    
    protected function _get_product(){
        return D('ProductInfo','Api');
    }
 /*
    获得我发布的任务列表
    
    权限
    登录
    
    传入参数
    page    默认1    显示页数
    limit   默认10   每页显示的数量
    成功输出参数
    {products:$array_products,row:$row}
    ___________________
    
    $row总数量
    
    $array_products
    没有则输出[]
    有的话输出[$array_product1,$array_product2,$array_product3,$array_product4....]
    ___________________
    
    array_product的参数
    {
        pid:'1',
        pname:'我的任务',
        pimg:'http://xxxxxx.oo/x.jpg',
        pstate:'1',
        premark:'备注',
        pclick:'2333',
        pctime:'1758000000',
        pup:'233',
        ptype:'1',
        pftime:'1760000000',
        pteam:'0'
    }
    
    API接口：domain/index.php/Home/Product/getMyProductList
    
    */
    //ok!!!
    public function getMyProductList(){
        $this->user->_safe_login();
        $p = $this->product;
        $page = I('post.page',1);
        $limit = I('post.limit',10);
        $r = $p->getListByUid($this->user->uid,$page,$limit);
        $n = $p->getCountByUid($this->user->uid);
        $array = array('products'=>$r,'row'=>$n);
        $this->success($array);
    }
    
   
    
    
    
    /*
    前台获得任务列表
    
    权限
    登录
    
    传入参数
    page        默认1         显示页数
    limit       默认10        每页显示的数量
    state       选填          资源状态可选1征集，3进行，5完成
    成功输出参数
    {products:$array_products,row:$row}
    ___________________
    
    $row总数量
    
    $array_products
    没有则输出[]
    有的话输出[$array_product1,$array_product2,$array_product3,$array_product4....]
    ___________________
    
    array_product的参数
    {
        pid:'1',
        uid:'1',
        uname:'发布者',
        utype:'3',
        pname:'我的任务',
        pimg:'http://xxxxxx.oo/x.jpg',
        pstate:'1',
        premark:'备注',
        pclick:'2333',
        pctime:'1758000000',
        pup:'233',
        ptype:'1',
        pftime:'1760000000',
        pteam:'0'
    }
    
    API接口：domain/index.php/Home/Product/getProductList
    */
    
    
    public function getProductList(){
        $this->user->_safe_login();
        $p = $this->product;
        $page = I('post.page',1);
        $limit = I('post.limit',10);
        $state = I('post.state',0);
        if(!in_array($state,array(1,2,3,4,5)))$state = 0;
        $r = $p->getListByState($state,$page,$limit);
        $n = $p->getCountByState($state);
        $array = array('products'=>$r,'row'=>$n);
        $this->success($array);
    }
    
    /*
    后台获得任务列表(仅可获得有权限管理的任务列表)
    
    权限
    后台
    权限3以及以上
    仅可获得有权限管理的任务
    
    传入参数
    page        默认1         显示页数
    limit       默认10        每页显示的数量
    type        默认'pid'     任务筛选类型
    value       选填          筛选的值
    
    成功输出参数
    {products:$array_products,row:$row}
    ___________________
    
    $row总数量
    
    $array_products
    没有则输出[]
    有的话输出[$array_product1,$array_product2,$array_product3,$array_product4....]
    ___________________
    
    array_product的参数
    {
        pid:'1',
        uid:'1',
        uname:'发布者',
        utype:'3',
        pname:'我的任务',
        pimg:'http://xxxxxx.oo/x.jpg',
        pstate:'1',
        premark:'备注',
        pclick:'2333',
        pctime:'1758000000',
        pup:'233',
        ptype:'1',
        pftime:'1760000000',
        pteam:'0'
    }
    
    API接口：domain/index.php/Home/Product/getAllProductList
    */
    public function getAllProductList(){
        $this->user->_safe_admin();
        $this->user->_safe_type(3);
        $p = $this->product;
        $page = I('post.page',1);
        $limit = I('post.limit',10);
        $type = I('post.type','pid');
        $value = I('post.value','');
        if(!in_array($type,array('pid','name','state','uid')))$type = 'pid';
        if(!strlen($value)){
            $r = $p->commandList($this->user->type,$page,$limit);
            $n = $p->commandCount($this->user->type);
        }else{
            if($type == 'pid'){
                $r = $p->getByPid($value);
                if($r && $this->type>$r['utype']){
                    $r = array($r);
                    $n = 1;
                }else{
                    $r = array();
                    $n = 0;
                }
            }elseif($type == 'name'){
                $r = $p->commandListByName($value,$this->user->type,$page,$limit);
                $n = $p->commandCountByName($value,$this->user->type);
            }elseif($type == 'state'){
                $value = floor($value);
                if($value>98)$this->error('w');
                if($this->user->type!=4 && $value==98)$this->error('w');
                $r = $p->commandListByState($value,$this->user->type,$page,$limit);
                $n = $p->commandCountByState($value,$this->user->type);
            }elseif($type == 'uid'){
                $this->user->_safe_user_type($value);
                $r = $p->getListByUid($value,$page,$limit);
                $n = $p->getCountByUid($value);
            }
        }
        $array = array('products'=>$r,'row'=>$n);
        $this->success($array);
    }
    
    
    
    /*
    后台清理任务
    
    权限
    后台
    权限4
    
    没有传入参数

    成功输出参数
    int 1
    
    API接口：domain/index.php/Home/Product/cleanProduct
    */
	public function cleanProduct(){
        $this->user->_safe_admin();
        $this->user->_safe_type(4);
        $p = D('ProductInfo');
        $where['pftime'] = array('LT',time()-3600*24*7);
        $where2['pftime'] = array('NEQ',0);
        $data['pstate'] = 99;
        $d = $p->where($where)->where($where2)->data($data)->save();
        $this->success($d);
    }
    
    
    
    /*
    后台修改任务(仅可修改有权限管理的任务)
    
    权限
    后台
    3以及以上
    仅可获得有权限管理的任务
    
    传入参数
    pid         必填          任务的ID
    pname       选填          任务名字
    pimg        选填          任务封面
    pstate      选填          任务状态
    premark     选填          备注


    成功输出参数
    int 1

    API接口：domain/index.php/Home/Product/changeProduct
    */
    public function changeProduct(){
        
        
        
        
    }
    
    
    
    /*
    新建任务
    
    权限
    登录
    权限2以及以上才能填team参数
    
    传入参数
    pid         必填          任务的ID
    pname       必填          任务名字
    pimg        必填          任务封面
    premark     选填          备注
    team        选填          有认领权限的组的ID的数组


    成功输出参数
    {pid:$pid}
    
    $pid新建后的任务的ID
    
    API接口：domain/index.php/Home/Product/releaseProduct
    */
    public function releaseProduct(){
        
        
        
        
        
        
        
        
        
        
        
    }
    
    
    
    
    
    
    /*
    获得我认领的任务列表
    
    权限
    权限2以及以上
    
    传入参数
    page    默认1     显示页数
    limit   默认10    每页显示的数量
    type    选填      担任的职务
    成功输出参数
    {products:$array_products,row:$row}
    ___________________
    
    $row总数量
    
    $array_products
    没有则输出[]
    有的话输出[$array_product1,$array_product2,$array_product3,$array_product4....]
    ___________________
    
    array_product的参数
    {
        pid:'1',
        pname:'我的任务',
        pimg:'http://xxxxxx.oo/x.jpg',
        pstate:'1',
        premark:'备注',
        pclick:'2333',
        pctime:'1758000000',
        pup:'233',
        ptype:'1',
        pftime:'1760000000',
        pteam:'0',
        ctype:'qianzi'
        
    }
    
    API接口：domain/index.php/Home/Product/getMyClaimProduct
    */
    public function getMyClaimProduct(){
        
        
        
        
    }
}
?>