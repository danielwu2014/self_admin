<?php
namespace Org\Util;
Vendor('PHPExcel.PHPExcel');

class ExcelOption{
	private $error = '';
	private $exts  = 'xlsx';
	private $savePath = './download/';

	public function __construct(){

	}

	/** 读取Excel表格内容
	 * @param string $filePath 文件路径
	 * @param string $exts 文件类型
	 * @return false or array 返回带标题的数组
	 */
	public function readExcel($filePath,$exts){
		if(empty($filePath)){
			$this->error = '没有Excel文件';
			return false;
		}
		$className = $this->getClassName($exts);
		if(empty($className)) {
			$this->error = '上传文件不是Excel文件';
			return false;
		}

		$className = '\PHPExcel_Reader_'.$className;
		$PHPReader = new $className();
		if(!$PHPReader->canRead($filePath)){  
	    	$PHPReader = new $className();  
	        if(!$PHPReader->canRead($filePath)){        
	            $this->error = 'no Excel'; 
	            return false;  
	        } 
		}
		$PHPExcel = $PHPReader->load($filePath);  //建立excel对象，此时你即可以通过excel对象读取文件，也可以通过它写入文件  
		$currentSheet = $PHPExcel->getSheet(0);  //读取excel文件中的第一个工作表
		$allColumn = $currentSheet->getHighestColumn(); //取得最大的列号
		$allRow = $currentSheet->getHighestRow();//取得一共有多少行
		
		$i = 0;$data = array();
		for($rowIndex=1;$rowIndex<=$allRow;$rowIndex++){
			$j = 0;
			for($colIndex='A';$colIndex<=$allColumn;$colIndex++){
				$addr = $colIndex.$rowIndex;  
				$cell = $currentSheet->getCell($addr)->getValue();  
				if($cell instanceof PHPExcel_RichText)
					$cell = $cell->__toString();
				if(is_object($cell)) $cell = ''; //单元格出现两种以上字体时，取到的是一个对象。
				$data[$i][$j] = $cell;
				$j++;
			}
			$i++;  
		}
		return $data;
	}

	/**
	 * 生成Excel
	 * @param array data 二维数组，数组的第一个元素为Excel的标题
	 * @param string fileName 生成的Excel名称
	 * @param array $drawpst 是否图片单元格
	 * @param integer type 0文件通过浏览器下载;1脚本方式运行保存在当前目录
	 *  
	 */
	public function createExcel($data,$fileName='',$drawpst='',$type='0'){

		if(empty($data)){
			$this->error = '没有数据';
			return false;
		}
		if(!is_array($data)){
			$this->error = 'data is not array';
			return false;
		}

		$objExcel = new \PHPExcel();
        $objExcel->getDefaultStyle()->getFont()->setName('Arial');
        $objExcel->setActiveSheetIndex(0);   
  
        $objActSheet = $objExcel->getActiveSheet();   

        //设置当前活动sheet的名称   
        $objActSheet->setTitle('Sheet1'); 

        //设置默认行高
		//$objActSheet->getDefaultRowDimension()->setRowHeight(50);

        //设置单元格信息
        $column = 1;
        foreach($data as $arr){
            $body_assic = ord('A');
            foreach($arr as $val){

                $temp_key = chr($body_assic);
                if($temp_key==strtoupper($drawpst) && $column!=1){
                	$drawinfo['imagePath']   = $val;
                	$drawinfo['position']    = $drawpst.$column;
                	$drawinfo['objActSheet'] = $objActSheet;
                	$this->worksheetDrawing($drawinfo);
                }else{
                	$objActSheet->setCellValue($temp_key.$column,$val);
                }
                $body_assic++;
            }
            $column++;
        }

        $outputFileName = $fileName ? $fileName : "output.".$this->exts;
        $exts = strtolower(substr($outputFileName, strrpos($outputFileName, '.')+1));
        $className = '\PHPExcel_Writer_'.$this->getClassName($exts);  
        $objWriter = new $className($objExcel);

        if($type==0){
        	//$objWriter->save($this->savePath.$outputFileName);
			header("Content-Disposition:attachment;filename=$outputFileName");  
	        header("Content-Type:application/octet-stream");  
	        header("Content-Transfer-Encoding:binary");  
	        header("Pragma:no-cache");
	        //echo file_get_contents($this->savePath.$outputFileName);
	        $objWriter->save('php://output');
        }else{
        	$objWriter->save($this->savePath.$outputFileName);
        }
        return true;
	}

	/**
	 * 判断使用哪个Excel类
	 * @param string $exts Excel文件后缀
	 * @return string $className 类名
	 */
	private function getClassName($exts){
		switch ($exts) {
			case 'xls':
				$className = 'Excel5';
				break;
			case 'xlsx':
				$className = 'Excel2007';
				break;
			default:
				$className = '';
				break;
		}
		return $className;
	}

	/**
	 *  生成图片单元格
	 *	@param array $drawinfo = array(
	 *				'imagePath'   => '',//图片路径，貌似只能为本地路径
	 *				'objActSheet' => '',//Excel单元格对象实例
	 *				'position'    => '',//生成图片的单元格位置即列位置，如：F
	 *				'name'        => '', 
	 *				'description' => ''
	 *			)
	 */
	private function worksheetDrawing($drawinfo){
		if(empty($drawinfo['imagePath']) || empty($drawinfo['objActSheet']) || empty($drawinfo['position'])){
			return false;
		}
        $objDrawing = new \PHPExcel_Worksheet_Drawing();
        $objDrawing->setPath($drawinfo['imagePath']);     
        $objDrawing->setCoordinates(strtoupper($drawinfo['position']));//设置图片所在位置
        if($drawinfo['name']){
			$objDrawing->setName($drawinfo['name']);   
		}   
        if($drawinfo['description']){
        	$objDrawing->setDescription($drawinfo['description']);   
        }
        $objDrawing->setHeight(50); 
        /*$objDrawing->setOffsetX(10);   
        $objDrawing->setRotation(15);   
        $objDrawing->getShadow()->setVisible(true);   
        $objDrawing->getShadow()->setDirection(36); */  
        $objDrawing->setWorksheet($drawinfo['objActSheet']);   
	}

	public function getError(){
		return $this->error;
	}
}