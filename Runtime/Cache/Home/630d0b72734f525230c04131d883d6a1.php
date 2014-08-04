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
  <legend>添加管理员</legend>
  <form action="<?php echo U('Admin/insert');?>" method="POST">
  <table cellspacing="1" cellpadding="2" border="0" style="width:100%">
  <tr>
    <td width="15%" nowrap="" align="right">用户名:</td>
    <td width="84%"><input type="text" name="admin_name" value="<?php echo ($p["admin_name"]); ?>" style="width:154px" class="text">
  </tr>
  <tr>
    <td width="15%" nowrap="" align="right">密码:</td>
    <td width="84%"><input type="password" name="admin_pwd" value="<?php echo ($p["admin_pwd"]); ?>" style="width:154px" class="text"></td>
  </tr>
  <tr>
    <td width="15%" nowrap="" align="right">状态:</td>
    <td width="84%"><input type="radio" name="status" value="1" <?php if(!isset($p) || $p['status']==1) echo 'checked="checked"' ?>>
      启用
      <input type="radio" name="status" value="0" <?php if(isset($p) && $p['status']==0) echo 'checked="checked"' ?>>
      禁用 </td>
  </tr>
  <tr>
    <td width="15%" nowrap="" align="right">邮箱:</td>
    <td width="84%"><input type="text" name="email" value="<?php echo ($p["email"]); ?>" style="width:154px" class="text"></td>
  </tr>      
  <tr>
    <td width="15%" nowrap="" align="right">昵称:</td>
    <td width="84%"><input type="text" name="nickname" value="<?php echo ($p["nickname"]); ?>" style="width:154px" class="text"></td>
  </tr>     
  <tr>
  <tr>
    <td width="15%" nowrap="" align="right"></td>
    <td width="84%"><input type="submit" class="button" value="保存">
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