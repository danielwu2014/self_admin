<?php

namespace Home\Controller;
class AjaxController extends CommonController {

	private $allowAction = array(
		'getProduct', //根据sku获取产品信息
		'delProductImg'
	);

	public function index(){
		$target = $_POST['target'];
		if(!in_array($target, $this->allowAction)){
			die();
		}
		unset($_POST['target']);
		$this->$target($_POST);
	}

	private function getProduct($post){
		$product = M('Product')
				->field('product_id,product_name,product_title,product_price,purchase_price,purchase_url_1')->where("product_code='".$post['product_code']."'")->find();
		$productAttrs = D('product')->getPtAtrrById($product['product_id']);
		$colorValues = $sizeValues = array();
		foreach($productAttrs as $val){
			if($val['option_id']==C('Default_COLOR_Option')){
				$colorValues[] = array(
					'value_id'=>$val['value_id'],
					'value_name'=>$val['value_name']
				);
			}
			if($val['option_id']==C('Default_SIZE_Option')){
				$sizeValues[] = array(
					'value_id'=>$val['value_id'],
					'value_name'=>$val['value_name']
				);
			}			
		}
		$colorStr = $sizeStr = '';
		if($colorValues){
			$colorStr .= '<select name="product_color"><option value="">请选择</option>';
			foreach($colorValues as $val){
				$colorStr .= '<option value="'.$val['value_name'].'">'.$val['value_name'].'</option>';
			}
			$colorStr .= '</select>';
		}
		if($sizeValues){
			$sizeStr .= '<select name="product_size"><option value="">请选择</option>';
			foreach($sizeValues as $val){
				$sizeStr .= '<option value="'.$val['value_name'].'">'.$val['value_name'].'</option>';
			}
			$sizeStr .= '</select>';
		}

		$product['colorValues'] = $colorStr;
		$product['sizeValues'] = $sizeStr;
		$data = array(
			'status'=> !empty($product) ? 1 : 0,
			'datas' => $product
		);
		die(json_encode($data));
	}

	private function delProductImg($post){
		$delImage = basename($post['product_image']);
		$product = M('Product')->field('product_image')->where("product_id='".$post['product_id']."'")->find();
		$productImageArr = explode(',', $product['product_image']);
		foreach($productImageArr as $key=>$val){
			if(preg_match("/".$delImage."/", $val)){
				unset($productImageArr[$key]);
			}
		}
		$updata = array('product_image'=>implode(',',$productImageArr));
		$rs = M('Product')->where("product_id='".$post['product_id']."'")->save($updata);
		if($rs) unlink('.'.$post['product_image']);
		$data = array(
			'status'=> $rs ? 1 : 0,
			'message' => '删除图片成功！'
		);
		die(json_encode($data));		
	}
}