<?php
namespace Home\Controller;
class AttributeController extends CommonController {

	var $return_url;
	public function _initialize(){
		parent::_initialize();
		$this->return_url = U('Attribute/index');
	}
	public function index(){

		$Model = M();
		$filter_sql = "SELECT ao.option_name,av.value_name FROM attribute AS a 
					LEFT JOIN attribute_option AS ao ON a.option_id=ao.option_id 
					LEFT JOIN attribute_value AS av ON a.value_id=av.value_id 
					ORDER BY ao.option_id, av.value_id";
		$result = $Model->query($filter_sql);
		
		foreach ($result as $key => $val) {
			$voList[$val['option_name']]['option_name'] = $val['option_name'];
			$voList[$val['option_name']]['value_name'][] = $val['value_name'];
		}
		
		$this->assign('voList',$voList);
		$this->display();
	}

	//属性名列表
	public function optionList(){
		$attrOptionModel = M('Attribute_option');
		$attrOptions = $attrOptionModel->select();
		$this->assign('attrOptions',$attrOptions);
		$this->display();
	}

	public function optionAdd(){
		$breadArr = array(
			0=>array(
				'title'=>'属性管理',
				'link'=>''
			),
			1=>array(
				'title'=>'新增属性名',
				'link'=> U('Attribute/optionAdd')
			)
		);
		$breadcrumb = $this->getCurrentBread($breadArr);
		$this->assign('breadcrumb',$breadcrumb);
		$this->display();
	}

	public function optionInsert(){
		$data = $this->getI($_POST);
		if(empty($data['option_name'])){
			$this->error('请填写名称！',$this->return_url);
		}
		$data['option_sort'] = intval($data['option_sort']);
		$attrOptionModel = M('Attribute_option');
		$attrOptionModel->create($data);
		if($attrOptionModel->add()){
			$this->success('添加成功！',U('Attribute/optionList'));
		}else{
			$this->error('添加失败!',U('Attribute/optionList'));
		}
	}

	public function optionEdit(){
		$option_id = $this->getI($_GET,'option_id');
		$attrOption = M('Attribute_option')->where("option_id=$option_id")->find();
		$this->assign('attrOption',$attrOption);
		$breadArr = array(
			0=>array(
				'title'=>'属性管理',
				'link'=>''
			),
			1=>array(
				'title'=>'编辑属性名',
				'link'=> U('Attribute/optionEdit')
			)
		);
		$breadcrumb = $this->getCurrentBread($breadArr);
		$this->assign('breadcrumb',$breadcrumb);
		$this->display();
	}

	public function optionUpdate(){
		$data = $this->getI($_POST);
		if(empty($data)){
			$this->error('请填写数据！',$_SERVER['HTTP_REFERER']);
		}
		M('Attribute_option')->save($data);
		$this->success('编辑成功！',U('Attribute/optionList'));
	}

	public function optionDel(){
		$option_id = $this->getI($_GET,'option_id');
		M('Attribute_option')->where('option_id='.$option_id)->delete();
		$this->success('删除成功！',U('Attribute/optionList'));
	}

	public function valueList(){
		$optionModel = M('Attribute_option');
		$optionList = $optionModel->select();
		$this->assign('optionList',$optionList);

		$Model = M();
		$filter_sql = "SELECT av.*, ao.option_name FROM attribute_value av 
					   LEFT JOIN attribute a ON av.value_id=a.value_id 
					   LEFT JOIN attribute_option ao ON a.option_id=ao.option_id";
		$valueList = $Model->query($filter_sql);
		$this->assign('valueList',$valueList);
		$this->display();
	}

	public function valueInsert(){
		$return_url = U('Attribute/index');
		$post = $this->getI($_POST);

		if(empty($post['option_id'])){
			$this->error('请选择属性！',$this->return_url);
		}		
		if(empty($post['value_name'])){
			$this->error('请填写属性值！',$this->return_url);
		}
		$option_id = $post['option_id'];
		unset($post['option_id']);
		$value_id = M('Attribute_value')->data($post)->add();

		$attModel = M('Attribute');
		$attModel-> option_id = $option_id;
		$attModel-> value_id  = $value_id; 

		if($attModel->add()){
			$this->success('添加成功！',U('Attribute/valueList'));
		}else{
			$this->error('添加失败!',U('Attribute/valueList'));
		}
	}

	public function valueEdit(){
		$value_id = $this->getI($_GET,'value_id');
		$values   = M('Attribute_value')->where(array('value_id'=>$value_id))->find();
		$this->assign('values',$values);
		$breadArr = array(
			0=>array(
				'title'=>'属性管理',
				'link'=>''
			),
			1=>array(
				'title'=>'编辑属性值',
				'link'=> U('Attribute/valueEdit')
			)
		);
		$breadcrumb = $this->getCurrentBread($breadArr);
		$this->assign('breadcrumb',$breadcrumb);
		$this->display();
	}

	public function valueUpdate(){
		$data = $this->getI($_POST);
		if(empty($data)){
			$this->error('请填写数据！',$_SERVER['HTTP_REFERER']);
		}
		M('Attribute_value')->save($data);
		$this->success('编辑成功！',U('Attribute/valueList'));
	}

	public function valueDel(){
		$value_id = $this->getI($_GET,'value_id');
		M('Attribute_value')->where('value_id='.$value_id)->delete();
		M('Attribute')->where('value_id='.$value_id)->delete();
		$this->success('删除成功！',U('Attribute/valueList'));
	}
}