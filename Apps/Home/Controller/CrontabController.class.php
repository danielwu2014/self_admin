<?php

namespace Home\Controller;
use Think\Controller;
class CrontabController extends Controller {

	public function __construct(){

	}

	/**
	 * 批量切图
	 * 
	 */
	public function batchCropImage(){
		set_time_limit(0);
		$temp = M('image_queue')->field('product_code')->order('add_time,modify_time')->select();
		foreach($temp as $val){
			$image_queue[$val['product_code']] = str_replace('/',DIRECTORY_SEPARATOR,C('IMAGE_DIR')).$val['product_code'].DIRECTORY_SEPARATOR;
		}
		if(empty($image_queue)) exit('no image data to crap');

		$image_crop_param = C('IMAGE_CROP_PARAM');
		foreach($image_queue as $product_code=>$tmp_path){
			$image_arr = get_dir_file($tmp_path,'is_file');
			if(empty($image_arr))  continue;

			$original_image_dir = $tmp_path.C('ORIGINAL_IMAGE_DIR').DIRECTORY_SEPARATOR; //原图目录
			mk_dir($original_image_dir);

			$temp_dir_arr = array();
			foreach($image_crop_param as $key=>$val){
				$temp_dir_arr[$key] = $tmp_path.$key.DIRECTORY_SEPARATOR;
				mk_dir($temp_dir_arr[$key]);
			}

			$product_image = '';
			foreach($image_arr as $image){
				$source_image = $tmp_path.$image;

				if(is_file($source_image)){
					$image_suffix = strtolower(substr($source_image, strrpos($source_image, '.')));//图片后缀
					$basename = uniqid().$image_suffix; //图片的名称
					// original 原图
					copy($source_image, $original_image_dir.$basename);
					// large 大图,medium 中图,grid 网格图,small 小图
					foreach($temp_dir_arr as $dir=>$dest_dir){
						list($width,$height) = explode(':', $image_crop_param[$dir]);
						$dest_image = $dest_dir.$basename;
						$this->thumb($source_image,$dest_image,$width,$height);
					}
					unlink($source_image);
					$product_image .= $product_code.'/'.C('ORIGINAL_IMAGE_DIR').'/'.$basename.',';
				}
			}
			if(!empty($product_image)){
				$product_image = rtrim($product_image,',');
				M('product')->where("product_code='".$product_code."'")->save(array('product_image'=>$product_image));
				M('image_queue')->where("product_code='".$product_code."'")->delete();
			}else{
				M('image_queue')->where("product_code='".$product_code."'")->save(array('modify_time'=>date('Y-m-d H:i:s')));
			}
		}

		exit('ok');
	}

	public function thumb($source_image,$dest_image,$width,$height){
		$img_class = new \Think\Image();
		copy($source_image, $dest_image);
		$img_class->open($dest_image);
		$img_class->thumb($width,$height,\Think\Image::IMAGE_THUMB_FILLED)->save($dest_image);
	}
}