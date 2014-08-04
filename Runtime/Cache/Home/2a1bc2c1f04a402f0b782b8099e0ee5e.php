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
  <legend>系统信息</legend>
  <table width="100%" border="0" cellspacing="0" cellpadding="0" class="systab">
    <tr>
      <td width="120" align="right">操作系统：</td>
      <td><?php echo ($info['system']); ?></td>
      <td width="120" align="right">主机名IP端口：</td>
      <td><?php echo ($info['hostport']); ?></td>
    </tr>
    <tr>
      <td width="120" align="right">服务器：</td>
      <td><?php echo ($info['server']); ?></td>
      <td width="120" align="right">PHP运行方式：</td>
      <td><?php echo ($info['php_env']); ?></td>
    </tr>
    <tr>
      <td width="120" align="right">程序目录：</td>
      <td><?php echo ($info['app_dir']); ?></td>
      <td width="120" align="right">MYSQL版本：</td>
      <td><?php echo ($info['mysql']); ?></td>
    </tr>
    <tr>
      <td width="120" align="right">GD库版本：</td>
      <td><?php echo ($info['gd']); ?></td>
      <td width="120" align="right">上传附件限制：</td>
      <td><?php echo ($info['upload_size']); ?></td>
    </tr>
    <tr>
      <td width="120" align="right">执行时间限制：</td>
      <td><?php echo ($info['exec_time']); ?></td>
      <td width="120" align="right">剩余空间：</td>
      <td><?php echo ($info['disk_free']); ?></td>
    </tr>
    <tr>
      <td width="120" align="right">服务器时间：</td>
      <td><?php echo ($info['server_time']); ?></td>
      <td width="120" align="right">北京时间：</td>
      <td><?php echo ($info['beijing_time']); ?></td>
    </tr>
    <tr>
      <td width="120" align="right">Allow_url_fopen</td>
      <td><?php echo ($info['fopen']); ?></td>
      <td width="120" align="right">Register_globals：</td>
      <td><?php echo ($info['reg_gbl']); ?></td>
    </tr>
    <tr>
      <td width="120" align="right">Magic_quotes_gpc：</td>
      <td><?php echo ($info['quotes_gpc']); ?></td>
      <td width="120" align="right">Magic_quotes_runtime：</td>
      <td><?php echo ($info['quotes_runtime']); ?></td>
    </tr>
  </table>
</fieldset>
		</td>
      </tr>
    </table>
  </div>
</div>
</body>
</html>