<?php
namespace Admin\Controller;
class ProductController extends ConstructController{
	public function _initialize(){
		parent::_initialize();
		D('ProductInfo','Logic')->admintype = $this->admintype;
	}
	/*************************
	** 需要模板
	** 列表任务
	** 模板提供变量
	**     $pagedata	页面信息：最大页数count，当前页数now
	**     $productlist	任务信息列表【数组】
	** 支持search搜索，userid查询，state搜索（查询已删除需要管理员权限3）
	** 格式为 URL+/page/页数/search/测试名字/state/2/userid/9 (顺序无关)
	*************************/
	public function showlist(){
		$pagedata['now'] = $page = I('param.page',1,'int');
		$product=D('ProductInfo','Logic');
		$state = I('param.state',false,'int');
		if($state > 97 && $this->admintype < 3)$this->error('无权限操作');
		$search = I('param.search',false);
		$userid = I('param.userid',false,'int');
		$productListInfo = $product->searchProductsLimit($page,$state,$userid,$search,$this->admintype==3?0:$this->tlist);
		
		
		$pagedata['count']=floor(($result['count']-1)/10+1);
		$this->assign('pagedata',$pagedata);
		$this->assign('productlist',$productListInfo[1]);
		$this->assign('item_index',0);
		$this->display();
	}
	/*************************
	** 需要模板
	** 列表已删除任务（中途某些原因删除的任务）
	** 需要权限管理员等级3
	** 模板提供变量
	**     $pagedata	页面信息：最大页数count，当前页数now
	**     $productlist	任务信息列表【数组】
	** 格式为 URL+/page/页数
	*************************/
	public function showlistOfDeleted(){
		if($this->admintype<3)$this->error('无权限操作');
		$pagedata['now'] = $page = I('param.page',1,'int');
		$product=D('ProductInfo','Logic');
		$productListInfo = $product->getListByDeleted($page);
		$pagedata['count']=floor(($result['count']-1)/10+1);
		$this->assign('pagedata',$pagedata);
		$this->assign('productlist',$productListInfo[1]);
		$this->assign('item_index',1);
		$this->display();
	}
	/*************************
	** ajax and post
	** 清理1个星期前的任务
	** 需要管理员权限3
	*************************/
	public function clearProduct(){
		if($this->admintype < 3)$this->error('无权限操作');
		if(!IS_POST || !IS_AJAX)$this->error('清理失败');
		D('ProductInfo','Logic')->deleteProOfAWeekAge();
		$this->success('清理成功');
	}
	/*************************
	** ajax and post
	** 得到对应proid的任务信息
	** 获取已删除任务需要管理员权限3
	** 格式为 URL+/proid/任务ID
	*************************/
	public function getInfoByProId($proid){
		if(!IS_POST || !IS_AJAX)$this->error('获取失败');
		$info = D('ProductInfo','Logic')->getInfoByProId($proid);
		if(!$info)$this->error('无法获取制定的任务信息');
		elseif($info['state']>97 && $this->admintype < 3)$this->error('无权限操作');
		else $this->success($info);
	}
	/*************************
	** ajax and post
	** 修改任务的信息
	** 通过post发送任务修改内容，ProId必须
	** 格式为{ProId:1,ProTitle:'测试',......}
	*************************/
	public function changeProductInfo(){
		if(!IS_POST || !IS_AJAX)$this->error('修改失败');
		$info = I('post.');
		$proid = I('post.ProId',0,'int');
		if(!$proid)$this->error('proId不存在');
		if(I('post.ProState',0,'int') > 97 && $this->admintype < 3)$this->error('无权限操作');
		$result = D('ProductInfo','Logic')->update($proid,$info);
		if(!$result)$this->error($product->error);
		else $this->success('修改成功');
	}
	public function productInfo($proid){
		$info = D('ProductInfo','Logic')->getInfoByProId($proid);
		if(!$info)$this->error('无法获取制定的任务信息');
		elseif($info['state']>97 && $this->admintype < 3)$this->error('无权限操作');
		else{
			$this->assign('productinfo',$info);
			$this->assign('item_index',0);
			$this->display();
		}
	}
}
?>