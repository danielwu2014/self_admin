<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends CommonController {
    public function index(){
       $this->display();
    }

    public function header(){
    	$this->display();
    }

    public function left(){
        $nodeMenu =  \Org\Util\AccessControl::getNodeList(2);
        $this->assign('nodeMenu',$nodeMenu);
    	$this->display();
    }

    public function main(){
        $gd = '不支持';
        if (function_exists('gd_info')) {
            $gd = gd_info();
            $gd = $gd['GD Version'];
        }

        $hostport = $_SERVER['SERVER_NAME']
                    ."($_SERVER[SERVER_ADDR]:$_SERVER[SERVER_PORT])";
        $mysql = function_exists('mysql_close') ? mysql_get_client_info()
                                                : '不支持';
        $info = array(
            'system' => get_system(),
            'hostport' => $hostport,
            'server' => $_SERVER['SERVER_SOFTWARE'],
            'php_env' => php_sapi_name(),
            'app_dir' => WEB_ROOT,
            'mysql' => $mysql,
            'gd' => $gd,
            'upload_size' => ini_get('upload_max_filesize'),
            'exec_time' => ini_get('max_execution_time') . '秒',
            'disk_free' => round((@disk_free_space(".")/(1024 * 1024)),2).'M',
            'server_time' => date("Y-n-j H:i:s"),
            'beijing_time' => gmdate("Y-n-j H:i:s", time() + 8 * 3600),
            'reg_gbl' => get_cfg_var("register_globals") == '1'? 'ON' : 'OFF',
            'quotes_gpc' => (1 === get_magic_quotes_gpc()) ? 'YES' : 'NO',
            'quotes_runtime' => (1===get_magic_quotes_runtime()) ?'YES' : 'NO',
            'fopen' => ini_get('allow_url_fopen') ? '支持' : '不支持'
        );
        $this->assign('info', $info);
        $this->display();
    }

    public function footer(){
    	$this->display();
    }

    public function spe(){
        $this->display();
    }

    public function getNodeMenu($pid=0){
        $nModel = M('Node');
        $nodeMenu = is_array($nodeMenu) ? $nodeMenu : array();
        $nodeList = $nModel->query("SELECT nid,name,level,target,control,action,linkurl FROM node WHERE status=1 AND pid=".$pid." ORDER BY sort");
        if($nodeList){
            foreach ($nodeList as $key => $node) {
                if($node['control'] && $node['action']){
                    $node['url'] = U($node['control'].'/'.$node['action']);
                }else{
                    $node['url'] = $node['linkurl'] ? $node['linkurl'] : '';
                }
                $node['class'] = $node['level']!=3 ?'p'.$node['level'].' down' : '';
                $nodeMenu[$node['nid']] = $node;
                if($node['level']==1){
                    $nodeMenu[$node['nid']]['submenu'] = $this->getNodeMenu($node['nid']);
                }
            }
        }
        return $nodeMenu;
    }
}