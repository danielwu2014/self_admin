<?php
namespace Org\Util;

class Breadcrumb {
	private $_trail;

	public function Breadcrumb(){
		$this->reset();
	}

	private function reset(){
		$this->_trail = array();
	}

	public function add($title, $link=''){
		$this->_trail[] = array('title'=>$title, 'link'=>$link);
	}

	public function trail($separator='&nbsp;»&nbsp;'){
		$trailStr = '';
		$trailCnt = count($this->_trail);
		for($i=0;$i<=$trailCnt;$i++){
			$skipLink = false;
			if($i==0 || (($i+1)==$trailCnt)){//第一个和最后一个元素不加link
				$skipLink = true;
			}
			if(!empty($this->_trail[$i]['link']) && !$skipLink){
				$trailStr .= '<a href="' . $this->_trail[$i]['link'] . '">' . $this->_trail[$i]['title'] . '</a>';
			}else{
				$trailStr .= $this->_trail[$i]['title'];
			}
			if(($i+1)<$trailCnt) $trailStr .= $separator; 
		} 
		return $trailStr;
	}

	public function last(){
		$trailSize = count($this->_trail);
		return $this->_trail[$trailSize-1]['title'];
	}
}