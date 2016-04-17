<?php
namespace Home\Controller;
use Think\Controller;
class ProductController extends Controller{
	public function _initialize(){
        $this->user = A('User','Event');
        
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
    public function getMyProductList(){
        $this->user->_safe_login();
        $p = D('ProductInfo','Api');
        $r = $p->getListByUid($this->user->uid);
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
    state       选填          资源状态可选征集，进行，完成
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
    public function getProductList();
    
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
    public function getAllProductList();
    
    
    
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
	public function cleanProduct();
    
    
    
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
    public function changeProduct();
    
    
    
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
    public function releaseProduct();
    
    
    
    
    
    
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
    public function getMyClaimProduct();	
}
?>