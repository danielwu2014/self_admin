<?php

namespace Home\Controller;
use Think\Controller;
class OrderController extends CommonController {
	var $return_url;
	public function _initialize(){
		parent::_initialize();
		$this->return_url = U('Order/index');
	}
	public function index(){
		$get = $this->getI($_GET);
		$filter  = "1=1"; 

		$filter .= !empty($get['order_no']) ? " AND order_no='".$get['order_no']."'" : '';
		$filter .= !empty($get['order_status']) ? " AND order_status='".$get['order_status']."'" : '';
		$filter .= !empty($get['customer_name']) ? " AND customer_name='".$get['customer_name']."'" : '';
		$filter .= !empty($get['customer_email']) ? " AND customer_email='".$get['customer_email']."'" : '';		

		$p = $_GET['p'] ? $_GET['p'] : 1;
		$oModel = M('Order');
		$voList = $oModel->where($filter)->order('create_time')->page($p.','.C('PAGE_SIZE'))->select();

		foreach($voList as &$val){
			$val['order_status'] = $this->_getOrderStatus($val['order_status']);
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
		$this->assign('order_statuses',$this->_getOrderStatus());
		$this->display();
	}

	public function detail(){
		$order_id = $_GET['order_id'];
		$oModel = M('Order');
		$order = $oModel->where(array('order_id'=>$order_id))->find();
		$order['order_status'] = $this->_getOrderStatus($order['order_status']);
		$this->assign('vo',$order);
		$opModel = M('Order_product');
		$products = $opModel->where("order_id='$order_id'")->select();
		$this->assign('products',$products);
		$this->display();
	}

	public function add(){
		$this->assign('order_statuses',$this->_getOrderStatus());
		$this->assign('payment_methods',C('PAYMENT_METHODS'));
		$this->assign('shipping_methods',C('SHIPPING_METHODS'));
		$this->assign('order_products',$_SESSION['order_products']);
		$this->display();
	}

	public function insert(){
		$post = $this->post;
		if(!isset($_SESSION['order_products'])){
			$this->error('请先添加产品信息！',U('order/add'));
		}
		$order = M('order');
		$post['order_no'] = $this->_getOrderNo();
		$post['payment_method'] = $this->_getPaymentORShippingName($post['payment_method_code'],1);
		$post['shipping_method'] = $this->_getPaymentORShippingName($post['shipping_method_code'],2);
		$post['create_time'] = date('Y-m-d H:i:s');
		$post['order_amount'] = $post['order_amount']*(1-C('AMAZON_FEE_PERCENT'));
		$order->create($post);
		$insert_id = $order->add();
		if($insert_id){
			foreach($_SESSION['order_products'] as $product){
				$product['order_id'] = $insert_id;
				M('order_product')->data($product)->add();
			}
			unset($_SESSION['order_products']);
			$this->success('录入订单成功！',U('Order/add'));
		}else{
			$this->error('录入订单失败','order/add');
		}
	}

	public function edit(){
		$order_id = $this->getI($_GET,'order_id');
		$oModel = M('Order');
		$order = $oModel->where(array('order_id'=>$order_id))->find();
		$this->assign('o',$order);

		$this->assign('order_statuses',$this->_getOrderStatus());
		$this->assign('payment_methods',C('PAYMENT_METHODS'));
		$this->assign('shipping_methods',C('SHIPPING_METHODS'));
		$this->display();
	}

	public function update(){
		$data = $this->getI($_POST);
		$order = M('order');
		$data['order_no'] = $this->_getOrderNo();
		$data['payment_method'] = $this->_getPaymentORShippingName($data['payment_method_code'],1);
		$data['shipping_method'] = $this->_getPaymentORShippingName($data['shipping_method_code'],2);
		$order->where("order_id=".$data['order_id'])->save($data);
		$this->success("修改订单成功！",U('Order/detail','order_id='.$data['order_id']));
	}


	public function productAdd(){
		$post = $this->post;
		if(empty($post)){
			$this->error('产品数据不能为空!',U('Order/add'));
		}
		if(empty($post['product_color'])){
			$this->error('请选择产品颜色!',U('Order/add'));
		}
		if(empty($post['product_size'])){
			$this->error('请选择产品尺寸!',U('Order/add'));
		}
		$_SESSION['order_products'][$post['product_code']] = $post;
		redirect(U('Order/add'));
	}

	public function productEdit(){
		$order_product_id = $this->getI($_GET,'order_product_id');
		$product = M('Order_product')->where("order_product_id=$order_product_id")->find();
		$this->assign('p',$product);
		$this->display();
	}

	public function productUpdate(){
		$data = $this->getI($_POST);
		M('Order_product')->where("order_product_id=".$data['order_product_id'])->save($data); 
		$this->success('编辑成功！',U('Order/detail','order_id='.$data['order_id']));
	}

	public function productDel(){
		$product_code = $this->get['id'];
		if(isset($_SESSION['order_products'][$product_code])){
			unset($_SESSION['order_products'][$product_code]);
		}
		$this->success('删除成功！',U('Order/add'));
	}

	public function productPurchase(){
		$data['order_product_id'] = $this->getI($_POST,'order_product_id');
		$data['purchase_date'] = time();
		$data['purchase_status'] =1;
		M('Order_product')->where("order_product_id=".$data['order_product_id'])->save($data);
		$this->ajaxReturn(1);
	}

	private function _getOrderNo(){
		return C('ORDER_SOURCE').substr(date('YmdHis'), 2).rand(10,99);
	}

	private function _getPaymentORShippingName($code,$type=1){
		if($code == '') return;
 		$methods = $type==1 ? C('PAYMENT_METHODS') :C('SHIPPING_METHODS');
		return isset($methods[$code]) ? $methods[$code]['name'] : '';
	}

	private function _getOrderStatus($status_id=''){
		$orderStatuses = M('Order_status')->getField('status_id,status_name');
		return isset($orderStatuses[$status_id]) ? $orderStatuses[$status_id] : $orderStatuses;
	}
}