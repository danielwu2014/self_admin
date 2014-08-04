<?php

namespace Home\Controller;
use Think\Controller;
class CommonController extends Controller {
    
	protected $post;
	protected $get;
	public function _initialize() {
		$filter = C('DEFAULT_FILTER');
		if(!get_magic_quotes_gpc()){
			//$filter .= ",addslashes";
		}
		$filter .= ',trim'; 
		$_POST = & I('post.','',$filter);
		$_GET  = & I('get.','',$filter);
		$this->post = $_POST;
		$this->get  = $_GET;

		/*if(!isset($_SESSION['admin_pwd']) && CONTROLLER_NAME !="Public"){
	       $this->redirect('Public/login');exit;
	    }*/

		$breadcrumb = getBreadcrumb();
	    $this->assign('breadcrumb',$breadcrumb);
	}

	public function getI(&$arr, $key=null){
		return isset($arr[$key]) ? $arr[$key] : $arr;
	}

	public function getCurrentBread($arr){
		$bc = new \Org\Util\Breadcrumb();
		foreach($arr as $val){
			$bc->add($val['title'],$val['link']);
		}
		return $bc->trail();
	}
}