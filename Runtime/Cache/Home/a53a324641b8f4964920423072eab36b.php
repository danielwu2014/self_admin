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

<table width="100%" align="center" cellspacing="0" cellpadding="0" border="0">
  <tbody>
    <tr>
      <td height="40"><table width="100%" bgcolor="#464646" cellspacing="1" cellpadding="4" border="0">
          <tbody>
            <tr>
              <td width="10%" bgcolor="#EEEEEE" align="center">用户ID</td>
              <td width="15%" bgcolor="#EEEEEE" align="center">用户名</td>
              <td width="15%" bgcolor="#EEEEEE" align="center">状态</td>
              <td width="15%" bgcolor="#EEEEEE" align="center">昵称</td>
              <td width="15%" bgcolor="#EEEEEE" align="center">邮箱</td>
              <td width="15%" bgcolor="#EEEEEE" align="center">创建时间</td>
              <td width="15%" bgcolor="#EEEEEE" align="center">操作</td>
            </tr>
            <?php if(is_array($voList)): foreach($voList as $key=>$vo): ?><tr align="center">
                <td bgcolor="#FFFFFF"><?php echo ($vo["admin_id"]); ?></td>
                <td bgcolor="#FFFFFF"><?php echo ($vo["admin_name"]); ?></td>
                <td bgcolor="#FFFFFF"><?php echo ($vo["status"]); ?></td>
                <td bgcolor="#FFFFFF"><?php echo ($vo["nickname"]); ?></td>
                <td bgcolor="#FFFFFF"><?php echo ($vo["email"]); ?></td>
                <td bgcolor="#FFFFFF"><?php echo ($vo["create_time"]); ?></td>
                <td bgcolor="#FFFFFF"></td><?php endforeach; endif; ?>
          </tbody>
        </table></td>
    </tr>
  </tbody>
</table>
		</td>
      </tr>
    </table>
  </div>
</div>
</body>
</html>