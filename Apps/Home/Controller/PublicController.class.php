<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace Home\Controller;
use Think\Controller;
class PublicController extends CommonController {
    
    public function _initialize(){
        parent::_initialize();
    }
    
    public function index(){
        if(!isset($_SESSION['admin_name']) && MODULE_NAME !="Public"){
            $this->redirect('Public/login');
    	}else{
    	    redirect(__APP__);
    	}
    }

    public function login(){

    	if(!isset($_SESSION['user_id'])){
            $this->display();
    	}else{
            redirect(U('Index/index'));
    	}
    	 
    }

    public function check_login() {
        $post = $this->post;
        $data = array(
            'status'=>0,
            'message'=>''
        );
        if(!$this->check_verify($post['verify_code'])){
            $data['message'] = 'verify code is error';
            $this->ajaxReturn($data);
        }
        $admin = M("Admin");
        $adminInfo = $admin->where("admin_name='".$post['admin_name']."'")->find();
        if(empty($adminInfo)){
            $data['message'] = 'user is not exist';
            $this->ajaxReturn($data);
        }
        if($adminInfo['admin_pwd'] != md5($post['admin_pwd'])){
            $data['message'] = 'your password is error';
            $this->ajaxReturn($data);
        }

        session('admin_name',$adminInfo['admin_name']);
        session('admin_id',$adminInfo['admin_id']);		
        
        $data['status'] = 1;
        $data['message'] = '登陆成功！';
        $data['rdr_url'] = U('Index/index');
        die(json_encode($data));
    }

    public function loginOut(){
        session('admin_name',null);
        session('admin_id',null);
        $this->redirect('Public/login');
    }

    public function check_verify($code='', $id=''){
        $verify = new \Think\Verify(); 
        $chk_rs = $verify->check($code, $id);
        return $chk_rs;
    }

    public function verify_code(){
    	$config = array(
            'fontSize'  =>  9,            // 验证码字体大小(px)
            'useNoise'  =>  false,        // 是否添加杂点	
            'imageH'    =>  30,           // 验证码图片高度
            'imageW'    =>  75,           // 验证码图片宽度
            'length'    =>  4,            // 验证码位数
            'codeSet'   =>  '0123456789', // 验证码字符集合
        );
    	$verify = new \Think\Verify($config);
    	$verify->entry();
    }
}
