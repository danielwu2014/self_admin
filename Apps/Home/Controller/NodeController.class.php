<?php

namespace Home\Controller;
use Think\Controller;
class NodeController extends CommonController {

	public function index(){

		$nodeList =  \Org\Util\AccessControl::getNodeList();
      	$nodeListHtml = '';
      	foreach($nodeList as $node1){
      		$cls  = !empty($node1['subnode']) ? ' class="'.$node1['class'].'"' : '';
      		$sign = !empty($node1['subnode']) ? '<span class="span closed"></span>' : '';
      		$nodeListHtml .= '<li'.$cls.'>'.$sign.$node1['name'];
      		$nodeListHtml .= '<a href="'.U('Node/add','pid='.$node1['nid']).'">[添加]</a><a class="opr-a" href="'.U('Node/edit','nid='.$node1['nid']).'">[修改]</a><a class="opr-a" href="'.U('Node/delete','nid='.$node1['nid']).'">[删除]</a></span>';
      		if(!empty($node1['subnode'])){
      			$nodeListHtml .= '<ul>';
      			foreach($node1['subnode'] as $node2){
      				$cls  = !empty($node2['class']) ? ' class="'.$node2['class'].'"' : '';
      				$sign = !empty($node2['class']) ? '<span class="span closed"></span>' : '';
	      			$nodeListHtml .= '<li'.$cls.'>'.$sign.$node2['name'];
	      			$nodeListHtml .= '<a href="'.U('Node/add','pid='.$node2['nid']).'">[添加]</a><a class="opr-a" href="'.U('Node/edit','nid='.$node2['nid']).'">[修改]</a><a class="opr-a" href="'.U('Node/delete','nid='.$node2['nid']).'">[删除]</a></span>';
	      			if(!empty($node2['subnode'])){
	      				$nodeListHtml .= '<ul>';
	      				foreach($node2['subnode'] as $menu3) {
	      					$nodeListHtml .= '<li><a href="#url">'.$menu3['name'].'</a>';
	      					$nodeListHtml .= '<a class="opr-a" href="'.U('Node/edit','nid='.$node2['nid']).'">[修改]</a><a class="opr-a" href="'.U('Node/delete','nid='.$node2['nid']).'">[删除]</a></span>';
	      					$nodeListHtml .= '</li>';
	      				}
	      				$nodeListHtml .= '</ul>';
	      			}
	      			$nodeListHtml .= '</li>';
      			}
      			$nodeListHtml .= '</ul>';
      		}
      		$nodeListHtml .= '</li>';
      	}
		$this->assign('nodeListHtml',$nodeListHtml);
		$this->display();
	}

	public function add(){
		$pid = isset($_GET['pid']) ? $_GET['pid'] : 0;
		$this->assign('pid',$pid);
		$this->display();
	}

	public function insert(){
		$data = $this->getI($_POST);
		$nModel = M('Node');
		if($data['pid']>0){
			$pNode = $nModel->where('nid='.$data['pid'])->find();
			$data['level'] = count(explode(',', $pNode['map']))+1;
		}else{
			$data['level'] = 1;
		}
		$data['create_time'] = date('Y-m-d H:i:s');
		$nModel->create($data);
		$nid = $nModel->add();
		if($data['pid'] && $pNode){
			$data = array('map'=>$pNode['map'].','.$nid);
		}else{
			$data = array('map'=>$nid);
		}
		$nModel->where('nid='.$nid)->save($data);
		$this->success("添加成功！",U('Node/index'));
	}

	public function edit(){

	}

	public function update(){

	}

	public function delete(){
		$nid = $this->getI($_GET,'nid');
	}
}