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


<div style="margin:5px;">
  <a href="<?php echo U('Attribute/optionAdd');?>"><input type="button" class="button" value="新增属性"></a>
</div>


<div style="margin:0 auto;width:99%;margin-top:5px;">
  <table width="100%" align="center" cellspacing="0" cellpadding="0" border="0">
    <tbody>
      <tr>
        <td height="20"><span class="newfont07">属性名列表</span></td>
      </tr>
      <tr>
        <td height="40"><table width="100%" bgcolor="#464646" cellspacing="1" cellpadding="4" border="0">
            <tbody>
              <tr>
                <td width="20%" bgcolor="#EEEEEE" align="center">ID</td>
                <td width="30%" bgcolor="#EEEEEE" align="center">属性名</td>
                <td width="30%" bgcolor="#EEEEEE" align="center">排序</td>
                <td width="20%" bgcolor="#EEEEEE" align="center">操作</td>
              </tr>
              <?php if(is_array($attrOptions)): foreach($attrOptions as $key=>$op): ?><tr align="center">
                <td bgcolor="#FFFFFF"><?php echo ($op["option_id"]); ?></td>
                <td bgcolor="#FFFFFF"><?php echo ($op["option_name"]); ?></td>
                <td bgcolor="#FFFFFF"><?php echo ($op["option_sort"]); ?></td>
                <td bgcolor="#FFFFFF">
                 <a href="<?php echo U('Attribute/optionEdit',array('option_id'=>$op['option_id']));?>"><input type="button" class="button" value="编辑"></a>
                 <a onclick="return confirm('确定删除？')" href="<?php echo U('Attribute/optionDel',array('option_id'=>$op['option_id']));?>"><input type="button" class="button" value="删除"></a>
                </td><?php endforeach; endif; ?>
            </tbody>
          </table></td>
      </tr>
    </tbody>
  </table>
</div>

		</td>
      </tr>
    </table>
  </div>
</div>
</body>
</html>