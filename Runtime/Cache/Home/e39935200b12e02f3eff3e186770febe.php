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

<link rel="stylesheet" rev="stylesheet" href="/Public/Css/Smoothness/jquery-ui-1.9.2.custom.css" type="text/css"/>
<script type="text/javascript" src="/Public/Js/jquery-ui-1.9.2.custom.js"></script>

<?php if(!empty($optionList)): ?><div style="margin:5px;">
  <input type="button" id="attr_value_add" class="button" value="新增属性值">
</div><?php endif; ?>

<div style="margin:0 auto;width:99%;margin-top:5px;">
  <table width="100%" align="center" cellspacing="0" cellpadding="0" border="0">
    <tbody>
      <tr>
        <td height="20"><span class="newfont07">属性值列表</span></td>
      </tr>
      <tr>
        <td height="40"><table width="100%" bgcolor="#464646" cellspacing="1" cellpadding="4" border="0">
            <tbody>
              <tr>
                <td width="20%" bgcolor="#EEEEEE" align="center">ID</td>
                <td width="20%" bgcolor="#EEEEEE" align="center">名称</td>
                <td width="20%" bgcolor="#EEEEEE" align="center">排序</td>
                <td width="20%" bgcolor="#EEEEEE" align="center">所属属性</td>
                <td width="20%" bgcolor="#EEEEEE" align="center">操作</td>
              </tr>
              <?php if(is_array($valueList)): foreach($valueList as $key=>$vl): ?><tr align="center">
                <td bgcolor="#FFFFFF"><?php echo ($vl["value_id"]); ?></td>
                <td bgcolor="#FFFFFF"><?php echo ($vl["value_name"]); ?></td>
                <td bgcolor="#FFFFFF"><?php echo ($vl["value_sort"]); ?></td>
                <td bgcolor="#FFFFFF"><?php echo ($vl["option_name"]); ?></td>
                <td bgcolor="#FFFFFF">
                 <a href="<?php echo U('Attribute/valueEdit',array('value_id'=>$vl['value_id']));?>"><input type="button" class="button" value="编辑"></a>
                 <a href="<?php echo U('Attribute/valueDel',array('value_id'=>$vl['value_id']));?>"><input type="button" class="button" value="删除"></a>
                </td><?php endforeach; endif; ?>
            </tbody>
          </table></td>
      </tr>
    </tbody>
  </table>
</div>

<div id="attr_value_dlg" title="新增属性值">
    <form action="<?php echo U('Attribute/valueInsert');?>" method="POST">
      <table cellspacing="1" cellpadding="2" border="0" style="width:100%">
        <tr height='40'>
          <td width="21%">属性名:</td>
          <td><select name="option_id">
                <?php if(is_array($optionList)): foreach($optionList as $key=>$op): ?><option value="<?php echo ($op["option_id"]); ?>"><?php echo ($op["option_name"]); ?></option><?php endforeach; endif; ?>
              </select></td>
        </tr>
        <tr>
          <td>属性值:</td>
          <td><input type="text" name="value_name" class="text"></td>
        </tr>          
        <tr>
          <td>排序:</td>
          <td><input type="text" name="value_sort" value='0' class="text"></td>
        </tr>
      </table>
    </form>
</div>

<script type="text/javascript">

$(function(){

    $("#attr_value_dlg" ).dialog({
      autoOpen: false,
      height: 200,
      width: 400,
      modal: true,
      buttons: {
        "取消": function() {
          $(this).dialog("close");
        },
        "提交":  function() {
          $('form').submit();
        }
      }
    });
    $('#attr_value_add').click(function(){
      $("#attr_value_dlg").dialog( "open" );
    })
})
</script>

		</td>
      </tr>
    </table>
  </div>
</div>
</body>
</html>