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
<div style="margin:0 auto;width:99%;margin-top:5px;text-align:center">
  <h3>产品SKU：<?php echo ($product_url); ?></h3>
</div>
<fieldset style="height:100%;">
  <legend>添加产品属性</legend>
  <form action="<?php echo U('Product/insertAttr');?>" method="POST">
    <input type="hidden" name="product_id" value="<?php echo ($_GET['product_id']); ?>">
    <table align="center" cellspacing="0" cellpadding="2" border="0" style="width:50%">
      <tr>
        <td valign="top" align="right">
          属性名：<br/>
          <select id="option_id" name="option_id" size="15">
            <?php if(is_array($options)): foreach($options as $key=>$op): ?><option value="<?php echo ($op["option_id"]); ?>"><?php echo ($op["option_name"]); ?>&nbsp;&nbsp;[#<?php echo ($op["option_id"]); ?>]</option><?php endforeach; endif; ?>
          </select>
        </td>
        <td widht="30"></td>
        <td valign="top" align="left">
          属性值：<br/>
          <select id="value_id" name="value_id[]" size="15" multiple="multiple">
            <option>请选择属性值</option>
          </select>
        </td>

      </tr>
      <tr>
        <td colspan="3" align="center"><input type="submit" class="button" value="保存">
          <input type="reset" class="button" value="重置"></td>
      </tr>
    </table>
  </form>
</fieldset>

<div style="margin:0 auto;width:99%;margin-top:5px;">
  <table width="100%" align="center" cellspacing="0" cellpadding="0" border="0">
    <tbody>
      <tr>
        <td height="20"><span class="newfont07">产品属性</span></td>
      </tr>
      <tr>
        <td height="40"><table width="100%" bgcolor="#464646" cellspacing="1" cellpadding="4" border="0">
            <tbody>
              <tr>
                <td width="30%" bgcolor="#EEEEEE" align="center">属性名</td>
                <td width="30%" bgcolor="#EEEEEE" align="center">属性值</td>
                <td width="40%" bgcolor="#EEEEEE" align="center">操作</td>
              </tr>
              <?php if(is_array($productAttrs)): foreach($productAttrs as $key=>$attr): ?><tr align="center">
                  <td bgcolor="#FFFFFF"><?php echo ($attr["option_name"]); ?></td>
                  <td bgcolor="#FFFFFF"><?php echo ($attr["value_name"]); ?></td>
                  <td bgcolor="#FFFFFF"><a href="<?php echo U('Product/deleteAttr',array('product_attr_id'=>$attr['product_attr_id']));?>"><input type="button" class="button" value="删除"></a></td><?php endforeach; endif; ?>
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
<script type="text/javascript">
$('#option_id').click(function(){
    $.ajax({
        type : 'POST',
        url  : "<?php echo U('Product/getAttrValue');?>",
        dataType : 'json',
        data : {
            'option_id' : $(this).val(),
        },
        beforeSend:function(){

        },
        success:function(data){
          $('#value_id').html(data);
        }
    })
})
</script>