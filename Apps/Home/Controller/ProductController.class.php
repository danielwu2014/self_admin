<?php

namespace Home\Controller;
use Think\Controller;
class ProductController extends CommonController {
	var $return_url;
	public function _initialize(){
		parent::_initialize();
		$this->return_url = U('Product/index');
	}
	public function index(){
		$get = $this->getI($_GET);
		$filter = "1=1"; 

		$filter .= !empty($get['product_code']) ? " AND product_code='".$get['product_code']."'" : '';
		$filter .= isset($get['product_status']) && $get['product_status']<>'' ? " AND product_status='".$get['product_status']."'" : '';

		$p = $_GET['p'] ? $_GET['p'] : 1;
		$pModel = M('Product');

		$voList = $pModel->where($filter)->order('create_time')->page($p.','.C('PAGE_SIZE'))->select();
		foreach ($voList as $key => &$val) {
			$val['product_status'] = $val['product_status'] == 1 ? '上架' : '下架';
			$val['product_name_s'] =  \Org\Util\String::msubstr($val['product_name'],0,30);
			$val['product_keywords_s'] =  \Org\Util\String::msubstr($val['product_keywords'],0,30);
			$val['product_desc_s'] =  \Org\Util\String::msubstr($val['product_desc'],0,30);
			$val['purchase_url_1_s'] =  \Org\Util\String::msubstr($val['purchase_url_1'],0,30);
			$val['product_title_s'] =  \Org\Util\String::msubstr($val['product_title'],0,15);
			if($val['product_image']){
				$val['product_image_url'] = $this->getListImage($val['product_image']);
				$val['product_image_url'] = '<img src="'.$val['product_image_url'].'" height="60">';
			}
		}

		$count = $pModel->where($filter)->count();		
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

	public function getListImage($product_image,$domain=''){
		if(empty($product_image)) return false;
		if(strpos($product_image, ',')){
			$imageArr = explode(',', $product_image);
			$image = $imageArr[0];
		}else{
			$image = $product_image;
		}
		return $domain.C('IMAGE_URL').$image;
	}

	public function getProductImages($product_image,$domain=''){
		if(empty($product_image)) return false;
		if(strpos($product_image, ',')){
			$imageArr = explode(',', $product_image);
		}else{
			$imageArr[] = $product_image;
		}
		$productImageUrl = array();
		foreach($imageArr as $image){
			$productImageUrl[] = $domain.C('IMAGE_URL').$image;
		}
		return $productImageUrl;
	}

	public function add(){
		$this->display();
	}

	public function insert(){
		$data = $this->getI($_POST);
		$data['create_time'] = date('Y-m-d H:i:s');
		$data['product_quantity'] = empty($data['product_quantity']) ? 100 : $data['product_quantity'];
		$pModel = M('Product');
		$pModel->create($data);
		$productId = $pModel->add();
		if($productId){
			//产品图片
			if(!empty($_FILES['pictures']['tmp_name'])){
		        $uploadInfo = $this->uploadImages($data['product_code'].'/v/');
		        if($uploadInfo){
			        foreach($uploadInfo as $info){
			        	$files[] = $info['savepath'].$info['savename'];
			        }
			        $updata = array('product_image'=>implode(',', $files));
			        $pModel->where('product_id='.(int)$productId)->save($updata);
		        }
			}
			$this->success('产品添加成功！',U('Product/add'));
		}else{
			$this->error('产品添加失败！',U('Product/add'));
		}
	}

	public function edit(){
		$product_id = $this->getI($_GET,'product_id');
		$pModel = M('Product');
		$product = $pModel->where("product_id=$product_id")->find();
		$product_image = $this->getProductImages($product['product_image']);
		$this->assign('p',$product);
		$this->assign('product_image',$product_image);
		$this->display();
	}

	public function update(){
		$data = $this->getI($_POST);
		//产品图片
		if(!empty($_FILES['pictures']['tmp_name'])){
	        $uploadInfo = $this->uploadImages($data['product_code'].'/v/');
	        if($uploadInfo){
		        foreach($uploadInfo as $info){
		        	$files[] = $info['savepath'].$info['savename'];
		        }
		        $data['product_image'] = implode(',', $files);
	        }
		}		
		M('Product')->where('product_id='.$data['product_id'])->data($data)->save(); 
		$this->success('编辑成功！',$this->return_url);
	}

	public function delete(){
		$product_id = $this->getI($_GET,'product_id');
		if(empty($product_id)){
			$this->error("请选择要删除的产品！");
		}
		M('Product')->where("product_id=$product_id")->delete();
		M('Product_attribute')->where("product_id=$product_id")->delete();
		$this->success('删除成功！');
	}

	public function detail(){
		$product_id = $this->getI($_GET,'product_id');
		$pModel = M('Product');
		$product = $pModel->find();
		foreach ($product as $key => &$val) {
			//$val['product_status'] = $val['product_status']==1 ? '上架' : '下架';
		}
		$this->assign('p',$product);
		//产品属性值
		$paModel = M();
		$filter_sql = "SELECT pa.product_attr_id,ao.option_name,av.value_name FROM product_attribute AS pa 
					   LEFT JOIN attribute_option AS ao ON pa.option_id=ao.option_id 
					   LEFT JOIN attribute_value AS av ON pa.value_id=av.value_id 
					   WHERE pa.product_id=".(int)$product_id." ORDER BY ao.option_sort,av.value_sort";
		$productAttrs = $paModel->query($filter_sql);
		$this->assign('productAttrs',$productAttrs);

		$breadArr = array(
			0=>array(
				'title'=>'产品管理',
				'link'=>''
			),			
			1=>array(
				'title'=>'产品编辑',
				'link'=> ''
			)
		);
		$breadcrumb = $this->getCurrentBread($breadArr);
		$this->assign('breadcrumb',$breadcrumb);

		$this->display();
	}

	public function attr(){
		$product_id = $this->getI($_GET,'product_id');
		//产品信息
		$product_code = M('Product')->where("product_id=$product_id")->getField('product_code');
		$product_url  = U("Product/detail","product_id=".$product_id);
		$product_url = '<a href="'.$product_url.'">'.$product_code.'</a>';
		$this->assign('product_url',$product_url);

		//属性名列表
 		$options = M('Attribute_option')->order('option_sort asc')->select();
		$this->assign('options',$options);

		//产品属性值
		$paModel = M();
		$filter_sql = "SELECT pa.product_attr_id,ao.option_name,av.value_name FROM product_attribute AS pa 
					   LEFT JOIN attribute_option AS ao ON pa.option_id=ao.option_id 
					   LEFT JOIN attribute_value AS av ON pa.value_id=av.value_id 
					   WHERE pa.product_id=".(int)$product_id." ORDER BY ao.option_sort,av.value_sort";
		$productAttrs = $paModel->query($filter_sql);
		$this->assign('productAttrs',$productAttrs);

		$breadArr = array(
			0=>array(
				'title'=>'产品管理',
				'link'=>''
			),
			1=>array(
				'title'=>'产品详情',
				'link'=> U('Product/detail','product_id='.$product_id)
			),			
			2=>array(
				'title'=>'产品属性',
				'link'=> ''
			)
		);
		$breadcrumb = $this->getCurrentBread($breadArr);
		$this->assign('breadcrumb',$breadcrumb);

		$this->display();
	}

	public function insertAttr(){
		$post = $this->getI($_POST);
		if(empty($post['option_id'])){
			$this->error("请选择要插入的属性");
		}
		$aModel = M('Product_attribute');
		foreach ($post['value_id'] as  $val) {
			$data['value_id']  = $val;
			$data['option_id'] = $post['option_id'];
			$data['product_id'] = $post['product_id'];
			$aModel->data($data)->add();
		}
		$this->success('添加属性成功！');
	}

	public function deleteAttr(){
		$product_attr_id = $this->getI($_GET,'product_attr_id');
		if(empty($product_attr_id)){
			$this->error("请选择要删除的属性");
		}
		M('Product_attribute')->where("product_attr_id=$product_attr_id")->delete();
		$this->success('删除属性成功！');
	}

	public function getAttrValue(){
		$option_id = $this->getI($_POST,'option_id');
		$Model = M();
		$filter_sql = "SELECT av.value_id,av.value_name FROM attribute_option AS ao 
					   LEFT JOIN attribute AS a ON ao.option_id=a.option_id 
					   LEFT JOIN attribute_value AS av ON a.value_id=av.value_id 
					   WHERE ao.option_id=".(int)$option_id;
		$opValue = $Model->query($filter_sql);
		$opValueStr = '';
		if($opValue)foreach($opValue as $k=>$v){
			$opValueStr .= '<option value="'.$v['value_id'].'">'.$v['value_name'].'</option>';
		}
		die(json_encode($opValueStr));
	}

	public function uploadImages($savePath){
		$uploadObj = new \Think\Upload();
        $uploadObj->maxSize = '120000000000';
        $uploadObj->rootPath= './images/';
        $uploadObj->savePath= $savePath;
        $uploadObj->autoSub = false;//自动创建子目录
        $uploadObj->exts=array('jpg','jpeg','png','gif');
        $uploadObj->mimes=array('image/png','image/jpeg','image/jpg','image/gif','image/pjpeg');
        $uploadInfo = $uploadObj->upload();
        return $uploadInfo;
	}
}