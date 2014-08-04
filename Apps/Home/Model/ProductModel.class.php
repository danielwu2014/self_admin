<?php

namespace Home\Model;
use Think\Model;

class ProductModel{

	public function getPtAtrrById($product_id){
		if(empty($product_id)) return false;
		$where = "pa.product_id='".$product_id."'";
		$paModel = M();
		$filter_sql = "SELECT pa.option_id,ao.option_name,pa.value_id,av.value_name FROM product_attribute AS pa 
					   LEFT JOIN attribute_option AS ao ON pa.option_id=ao.option_id 
					   LEFT JOIN attribute_value AS av ON pa.value_id=av.value_id 
					   WHERE ".$where." ORDER BY ao.option_sort,av.value_sort";		
		$productAttrs = $paModel->query($filter_sql);
		return $productAttrs;
	}

	public function getOption($option_id=''){
		$data = M('Option')->order('order option_sort')->select();
		if(empty($data)) return array();
		$optionList = array();
		foreach($data as $val){
			$optionList[$val['option_id']] = $val['name'];
		}
		if($option_id) return $optionList[$option_id];
		return $optionList;
	}	
}