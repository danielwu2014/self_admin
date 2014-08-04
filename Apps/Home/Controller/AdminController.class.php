<?php
namespace Home\Controller;
class AdminController extends CommonController{
	public function index(){
		$filter = "1=1"; 
		$p = $_GET['p'] ? $_GET['p'] : 1;
		$oModel = M('Admin');
		$voList = $oModel->where($filter)->order('create_time')->page($p.','.C('PAGE_SIZE'))->select();
		foreach($voList as $key => &$val) {
			$val['status'] = $val['status']==1 ? '启用' : '禁止';
		}
		$count = $oModel->where($filter)->count();		
		$page  = new \Think\Page($count,C('PAGE_SIZE'));
		foreach($filter as $key=>$val) {  
		  $page->parameter   .=   "$key=".urlencode($val).'&';
		}
		$page->setConfig('theme','%HEADER% %FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END%');
		$show       = $page->show();
		$this->assign('voList',$voList);
		$this->assign('page',$show);
		$this->display();
	}

	public function add(){
		$this->display();
	}

	public function insert(){
		$data = $this->getI($_POST);
		$data['admin_pwd'] = md5($data['admin_pwd']);
		$data['create_time'] = date('Y-m-d H:i:s');
		$aModel = M('Admin');
		$aModel->create($data);
		if($aModel->add()){
			$this->success('添加成功！');
		}else{
			$this->error('添加失败！');
		}
	}
}