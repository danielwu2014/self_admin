<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//Dtd XHTML 1.0 transitional//EN" "http://www.w3.org/tr/xhtml1/Dtd/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>项目管理系统</title>
<link rel="stylesheet" rev="stylesheet" href="./Public/Css/main.css" type="text/css" media="all" />
<script type="text/javascript" src="/Public/Js/jquery-1.9.1.js"></script>
<script type="text/javascript" src="/Public/Js/jquery.validate.js"></script>
<style>
.systab {
    border-collapse: separate;
    border-color: #DDDDDD #DDDDDD #FFFFFF #FFFFFF;
    border-style: solid;
    border-width: 1px;
    margin: 15px 0;
    text-shadow: 0 1px 0 #FFFFFF;
}
.systab td {
    border-color: #FFFFFF #FFFFFF #DDDDDD #DDDDDD;
    border-style: solid;
    border-width: 1px;
    line-height: 24px;
    margin: 15px 0;
    padding: 5px 10px;
}
.systab thead td {
    text-align: center;
}
.systab tbody tr:hover {
    background: none repeat scroll 0 0 #FFFFFF;
}
.breadcrumb span {
    float:right;
    margin-right: 15px;
}
</style>
</head>

<body class="ContentBody">
<div class="MainDiv">
  <div class="breadcrumb">
    <?php echo ($breadcrumb); ?>
    <span><input type="button" onclick="window.history.go(-1);" class="button" value="返回" ></span>
  </div>
  <div class="CContent">
    <table border="0" cellpadding="0" cellspacing="0" style="width:100%">
      <tr>
        <td width="100%">

<fieldset style="height:100%;">
  <legend>添加节点</legend>
  <form action="<?php echo U('Node/insert');?>" method="POST">
  <input type="hidden" name="pid" value="<?php echo ($pid); ?>">
  <table cellspacing="1" cellpadding="2" border="0" style="width:100%">
  <tr>
    <td width="11%" align="right">节点名称:</td>
    <td width="88%"><input type="text" name="name" value="" style="width:154px" class="text">
  </tr>
<!--   <tr>
    <td width="11%" align="right">节点类型:</td>
    <td width="88%"><input type="radio" name="authtype" value="0">
      模块
      <input type="radio" name="authtype" value="1">
      菜单      
      <input type="radio" name="authtype" value="-1">
      权限</td>
  </tr>  -->
  <?php if($pid > 0): ?><tr>
    <td width="11%" align="right">控制器:</td>
    <td width="88%"><input type="text" name="control" value="" style="width:154px" class="text">
    	<span>如NodeController.class.php的控制器名称为Node</span></td>
  </tr>
  <tr>
    <td width="11%" align="right">操作方法:</td>
    <td width="88%"><input type="text" name="action" value="" style="width:154px" class="text">
    	<span>控制器中的方法名称如：add、index</span></td>
  </tr>
  <tr>
    <td width="11%" align="right">链接网址:</td>
    <td width="88%"><input type="text" name="linkurl" value="" style="width:240px" class="text">
    	<span>选填项，当没填写控制器和方法时，则启用该链接</span></td>
  </tr>  
  <tr>
    <td width="11%" align="right"></td>
    <td width="88%"><input type="radio" name="target" value="main" checked="checked">
      框架窗口
      <input type="radio" name="target" value="blank">
      新开窗口 </td>
  </tr><?php endif; ?> 
  <tr>
    <td width="11%" align="right">启用状态:</td>
    <td width="88%">
    	<select name="status">
			<option value="1">启用</option>
			<option value="0">禁止</option>                
        </select>
    </td>
  </tr>
  <tr>
    <td width="11%" align="right">排序:</td>
    <td width="88%"><input type="text" name="sort" value="0" style="width:46px" class="text">
  </tr>      
  <tr>
    <td width="11%" align="right">备注内容:</td>
    <td width="88%"><textarea rows="10" cols="100" name="remark"></textarea></td>
  </tr>        
  <tr>
    <td colspan="2" align="center"><input type="submit" class="button" value="保存">
      <input type="reset" class="button" value="重置"></td>
  </tr>
</table>
  </form>
</fieldset>
		</td>
      </tr>
    </table>
  </div>
</div>
</body>
</html>