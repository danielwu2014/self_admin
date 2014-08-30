<?php

namespace Home\Controller;
use Think\Controller;
class ProductController extends CommonController {
	var $return_url;
	public function _initialize(){
		parent::_initialize();
        if(!S("tableFileField")){
			$tableFileField = array(
				'product_code'=>'SKU',
				'product_batch'=>'批次',
				'product_quantity'=>'数量',
				'product_status' => '状态',
				'product_title'=>'标题',
				'product_name'=>'名称',
				'product_size'=>'尺寸',
				'product_color'=>'颜色',
				'product_desc'=>'描述',
				'product_price'=>'售价',
				'purchase_price'=>'采购价格',
				'purchase_url_1'=>'采购地址1',
				'purchase_url_2'=>'采购地址2',
			);
            S("tableFileField",$tableFileField);
        }		
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
			$val['product_keywords_s'] =  $val['product_keywords'] ?\Org\Util\String::msubstr($val['product_keywords'],0,30) : '';
			$val['product_desc_s'] =  $val['product_desc'] ?\Org\Util\String::msubstr($val['product_desc'],0,30) : '';
			$val['purchase_url_1_s'] =  $val['purchase_url_1'] ? \Org\Util\String::msubstr($val['purchase_url_1'],0,30) : '';
			$val['product_title_s'] =  $val['product_title'] ? \Org\Util\String::msubstr($val['product_title'],0,15) : '';
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
		return $domain.C('IMAGE_DIR').$image;
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
			$productImageUrl[] = $domain.C('IMAGE_DIR').$image;
		}
		return $productImageUrl;
	}

	public function add(){/*
		$paModel = M();
		$filter_sql = "SELECT pa.option_id,pa.value_id,av.value_name FROM product_attribute AS pa 
					   LEFT JOIN attribute_value AS av ON pa.value_id=av.value_id 
					   WHERE pa.option_id='".C('Default_COLOR_Option')."' ORDER BY av.value_sort";		
		$productAttrs = $paModel->query($filter_sql);
		st_dump($productAttrs,1);*/
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
		$filter_sql = "SELECT pa.product_attr_id,pa.option_id,ao.option_name,av.value_name FROM product_attribute AS pa 
					   LEFT JOIN attribute_option AS ao ON pa.option_id=ao.option_id 
					   LEFT JOIN attribute_value AS av ON pa.value_id=av.value_id 
					   WHERE pa.product_id=".(int)$product_id." ORDER BY ao.option_sort,av.value_sort";
		$tempAttrs = $paModel->query($filter_sql);
		$productAttrs = $tempArr = array();
		foreach($tempAttrs as $attr){
			$productAttrs[$attr['option_id']]['option_name'] = $attr['option_name'];
			$tempArr[$attr['option_id']][] = $attr['value_name'];
			$productAttrs[$attr['option_id']]['value_name'] = implode($tempArr[$attr['option_id']], ',');
		}
		unset($tempAttrs,$tempArr);
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

	public function import(){
		$step = isset($_GET['step']) ? $_GET['step'] : 1;

		if($step==2){
			$excelOption= new \Org\Util\ExcelOption();
			$exts = strtolower(substr($_FILES['product_file']['name'], strrpos($_FILES['product_file']['name'], '.')+1));
			$excelData = $excelOption->readExcel($_FILES['product_file']['tmp_name'],$exts);
			$headeLine = array_shift($excelData);
			$tableFileField = S("tableFileField");

			// 取得导入行对应的字段
			$tableField = array();
			foreach($headeLine as $val){
				foreach($tableFileField as $k=>$v){
					if($val==$v){
						$tableField[] = $k;
					}
				}
			}

			//简单的判断
			if(!in_array("product_code",$tableField)){
            	$this->error("不存在SKU列");
	        }
	        if(count($tableField)<2){
	            $this->error("数据少于2列");
	        }

	        $productData =$attrData = array();
	        foreach($excelData as $data){
	        	if(empty($data) || empty($data[0])) continue;
	        	foreach($tableField as $key=>$field){
	        		$temp = trim($data[$key]);
	                if($field == 'product_code'){ //检查SKU
	                    $temp = str_replace("\n","",str_replace("\n\r","\n",$temp));
	                    if(!preg_match('#^[a-zA-Z]+\d*\w*$#i',$temp)){
	                        $this->error("SKU：".$temp." 有误(必须是字母加数字形式)");
	                    }
	                }
	                if($field=='product_color' || $field=='product_size'){
	                	$temp = preg_replace('/&nbsp;/i',' ',$temp);
	                	$temp = preg_split("/[\s,]+/",$temp);
	                	$temp_data[$field] = $temp;
	                }else{
	                	$temp_data[$field] = $temp;   
	                }
	        	}
	        	$productData[] = $temp_data;
	        }
	        
	        //插入数据
	        $pModel  = M('Product');
	        $iqModel = M('Image_queue');
	        foreach($productData as $key=>$val){
	        	$color = $val['product_color'];
	        	$size  = $val['product_size'];
				unset($val['product_color'],$val['product_size']);
				$product_id = $pModel->where("product_code='".$val['product_code']."'")->getField('product_id');
				if(empty($product_id)){// 插入
					$date_time = date('Y-m-d H:i:s');
					$val['create_time'] = $date_time;
					$product_id = $pModel->add($val);	        	
		        	//插入图片队列表image_queue
		        	$iqModel->add(array('product_code'=>$val['product_code'],'add_time'=>$date_time));
				}else{// 更新
					$pModel->where("product_id='".$product_id."'")->save($val); //更新操作
					$pModel->where("product_id=".$product_id." AND option_id=".C('Default_COLOR_Option'))->delete();
					$pModel->where("product_id=".$product_id." AND option_id=".C('Default_SIZE_Option'))->delete();
				}
				//插入更新属性
				if($color){
	        		$this->batchHandleAttr($product_id,C('Default_COLOR_Option'),$color);
	        	}
	        	if($size){
	        		$this->batchHandleAttr($product_id,C('Default_SIZE_Option'),$size);
	        	}	
	        }
	        $this->success('上传成功！',U('Product/index'));
		}
		$this->assign('step',$step);
		$this->display();
	}

	/**
	 * @param integer $product_id 
	 * @param integer $option_id
	 * @param array $value_arr 属性值名称数组 array('red','white')
	 */
	private function batchHandleAttr($product_id,$option_id,$value_arr){
		$paModel  = M('Product_attribute');
		$valueStr = "'".implode("','", $value_arr)."'";
		$sql = "SELECT av.value_id FROM attribute_value av LEFT JOIN attribute a 
				ON av.value_id=a.value_id 
				WHERE av.value_name IN(".$valueStr.") AND a.option_id='".$option_id."'";
		$valueArr = $paModel->query($sql);
		foreach($valueArr as $v){
			$v['option_id']  = $option_id;
			$v['product_id'] = $product_id;
			$paModel->add($v);
		}
	}
}