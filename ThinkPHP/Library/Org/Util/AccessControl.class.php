<?php
namespace Org\Util;
use Think\Db;

class AccessControl {

	static public function getNodeList($level=3) {

		$db = Db::getInstance();
		$sql = "SELECT * FROM node WHERE status=1 AND level=1 ORDER BY sort";
		$modules = $db->query($sql);
		$nodeList = array();
		if(empty($modules)) return $modules;
		foreach($modules as $key => $module){
			$module['class'] = 'p'.$module['level'].' down';
			$nodeList[$module['nid']] = $module;
			if($level==1) continue;
			$sql = "SELECT * FROM node WHERE status=1 AND level=2 AND pid=".(int)$module['nid']." ORDER BY sort";
			$actions = $db->query($sql);
			if($actions){
				foreach($actions as $key => $action){
					$actions[$key]['url'] = self::getNodeUrl($action['nid']);
					if($level==3){
						$sql = "SELECT * FROM node WHERE status=1 AND level=3 AND pid=".(int)$action['nid']." ORDER BY sort";
						$accesses = $db->query($sql);
						if($accesses){
							$actions[$key]['class'] = 'p'.$action['level'].' down';
							$actions[$key]['subnode'] = $accesses;
						}else{
							$actions[$key]['subnode'] = array();
						}
					}
				}
				$nodeList[$module['nid']]['subnode'] = $actions;
			}else{
				$nodeList[$module['nid']]['subnode'] = array();
			}
		}
		return  $nodeList;
	}

	static public function getNodeUrl($nid,$vars=''){
		$db = Db::getInstance();
		$node = $db->query("SELECT control,action,linkurl FROM node WHERE nid='".$nid."'");
		$node = isset($node[0]) ? $node[0] : '';
		if(empty($node)) return;
		$url = U($node['control'].'/'.$node['action'],$vars);
		return $url ? $url : ($node['linkurl'] ? $node['linkurl'] : '');
	}
}