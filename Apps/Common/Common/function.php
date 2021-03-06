<?php

function st_dump($data, $die=false){
	$args = debug_backtrace();
	echo "<pre>";
	echo '<font color="red">Dubug in File:'.$args[0]['file']."  Line:".$args[0]['line']."</font><hr><br />";
	if(empty($data)){
		var_dump($data);
	}else{
		print_r($data);
	}
	if($die){
		echo "<hr>";
		die('');
	}
	echo "</pre>";
}

/**
 * 得到操作系统信息
 * @return string
 */
function get_system() {
    $sys = $_SERVER['HTTP_USER_AGENT'];

    if (stripos($sys, "NT 6.1")) {
        $os = "Windows 7";
    } else if (stripos($sys, "NT 6.0")) {
        $os = "Windows Vista";
    }  else if (stripos($sys, "NT 5.1")) {
        $os = "Windows XP";
    } else if (stripos($sys, "NT 5.2")) {
        $os = "Windows Server 2003";
    } else if (stripos($sys, "NT 5")) {
        $os = "Windows 2000";
    } else if (stripos($sys, "NT 4.9")) {
        $os = "Windows ME";
    } else if (stripos($sys, "NT 4")) {
        $os = "Windows NT 4.0";
    } else if (stripos($sys, "98")) {
        $os = "Windows 98";
    } else if (stripos($sys, "95")) {
        $os = "Windows 95";
    } else if (stripos($sys, "Mac")) {
        $os = "Mac";
    } else if (stripos($sys, "Linux")) {
        $os = "Linux";
    } else if (stripos($sys, "Unix")) {
        $os = "Unix";
    } else if (stripos($sys, "FreeBSD")) {
        $os = "FreeBSD";
    } else if (stripos($sys, "SunOS")) {
        $os = "SunOS";
    } else if (stripos($sys, "BeOS")) {
        $os = "BeOS";
    } else if (stripos($sys, "OS/2")) {
        $os = "OS/2";
    } else if (stripos($sys, "PC")) {
        $os = "Macintosh";
    } else if(stripos($sys, "AIX")) {
        $os = "AIX";
    } else {
        $os = "未知操作系统";
    }
    return $os;
}

function getBreadcrumb($control='',$action=''){
    $control = $control ? $control : CONTROLLER_NAME;
    $action  = $action ? $action : ACTION_NAME;
    $control = ucfirst($control);
    $node = M('Node')->field('nid')->where(array('control'=>$control,'action'=>$action))->find();
    if(!empty($node)){
        $pnodeList = getAllParent($node['nid']);
        $breadcrumb = new \Org\Util\Breadcrumb();
        foreach($pnodeList as $key=>$val){
            $title = $val['name'];
            if($val['pid']!=0){
                $link = \Org\Util\AccessControl::getNodeUrl($key);
            }else{
                $link = '';
            }
            $breadcrumb->add($title,$link);
        }
        return $breadcrumb->trail();
    }else{
        return;
    }
}

function getAllParent($nid, &$node_arr=''){
    $node_arr = is_array($node_arr) ? $node_arr : array();
    $node = M('Node')->where(array('nid'=>$nid))->find();
    if($node['pid'] != 0){
        getAllParent($node['pid'],$node_arr);
    }
    $node_arr[$node['nid']] = $node;
    return $node_arr;
}

/**
 * 获取当前目录下的文件或目录
 * @param string $dirname 目录路径
 * @param string $exclude 排除函数名
 */
function get_dir_file($dirname,$exclude=''){
    $handler  = opendir($dirname);
    if(false==$handler) return ;
    $file_arr = array();
    while(false!==($file=readdir($handler))){
        if(preg_match('/\.db$/', $file)) continue;//windows缩略图db文件
        if($file != "." && $file != ".."){
            $filepath = $dirname.DIRECTORY_SEPARATOR.$file;
            if($exclude && function_exists($exclude) && !$exclude($filepath))
                continue;
            $file_arr[] = $file;
        }
    }
    closedir($handler);
    return $file_arr;
}

/**
 * 创建目录，可创建多级
 * @param string $dir 路径
 * @param string $mode 权限
 * @return bool 创建成功，返回true，否则返回false 
 */
function mk_dir($dir, $mode = 0775) {
    if(is_dir($dir) || @mkdir($dir, $mode))
       return true;
    if(!mk_dir(dirname($dir), $mode))
       return false;
    return @mkdir($dir, $mode);
}
