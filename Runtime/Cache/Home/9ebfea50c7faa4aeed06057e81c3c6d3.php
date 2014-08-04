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

<script type="text/javascript" src="/Public/Js/Layer/layer.js"></script>
<div style="width:100%;background-color:#FFF;padding:10px 0 10px 5px;">
    <form action="" method="get">
    <input type="hidden" name="c" value="<?php echo (CONTROLLER_NAME); ?>">
    <input type="hidden" name="a" value="<?php echo (ACTION_NAME); ?>">
    SKU：<input type="text" name="product_code" value="<?php echo ($_GET['product_code']); ?>">&nbsp;
    产品状态：
    <select name="product_status">
      <option value=''>所有</option>
      <option value="1">上架</option>
      <option value="0">下架</option>
    </select>
    <input type="submit" class="button" value="查询">
    </form>
</div>
<table width="100%" border="0" cellpadding="4" cellspacing="1" bgcolor="#464646" class="newfont03">
  <tr>
    <td width="5%" align="center" bgcolor="#EEEEEE">SKU</td>
    <td width="10%" align="center" bgcolor="#EEEEEE">中文名称</td>
    <td width="10%" align="center" bgcolor="#EEEEEE">产品名称</td>
    <td width="5%" align="center" bgcolor="#EEEEEE">产品数量</td>
    <td width="5%" align="center" bgcolor="#EEEEEE">产品状态</td>
    <td width="5%" align="center" bgcolor="#EEEEEE">产品价格</td>
    <td width="5%" align="center" bgcolor="#EEEEEE">采购价格</td>
    <td width="15%" align="center" bgcolor="#EEEEEE">采购地址一</td>
    <td width="5%" align="center" bgcolor="#EEEEEE">采购地址二</td>
    <td width="10%" align="center" bgcolor="#EEEEEE">关键字</td>
    <td width="10%" align="center" bgcolor="#EEEEEE">产品描述</td>
    <td width="5%" align="center" bgcolor="#EEEEEE">产品图片</td>
    <td width="10%" align="center" bgcolor="#EEEEEE">操作</td>
  </tr>
  <?php if(is_array($voList)): foreach($voList as $key=>$vo): ?><tr>
    <td height="30" bgcolor="#FFFFFF" bgcolor="#FFFFFF"><a href="<?php echo U('Product/detail',array('product_id' => $vo['product_id']));?>"><?php echo ($vo["product_code"]); ?></a></td>
    <td bgcolor="#FFFFFF" val="<?php echo ($vo["product_title"]); ?>"><?php echo ($vo["product_title_s"]); ?></td>
    <td bgcolor="#FFFFFF"><?php echo ($vo["product_name_s"]); ?></td>
    <td bgcolor="#FFFFFF"><?php echo ($vo["product_quantity"]); ?></td>
    <td bgcolor="#FFFFFF"><?php echo ($vo["product_status"]); ?></td>
    <td bgcolor="#FFFFFF"><?php echo ($vo["product_price"]); ?></td>
    <td bgcolor="#FFFFFF"><?php echo ($vo["purchase_price"]); ?></td>
    <td bgcolor="#FFFFFF"><?php echo ($vo["purchase_url_1_s"]); ?></td>
    <td bgcolor="#FFFFFF"><?php echo ($vo["purchase_url_2"]); ?></td>
    <td id="p_kwds_<?php echo ($vo['product_id']); ?>" val="<?php echo ($vo["product_keywords"]); ?>" bgcolor="#FFFFFF"><?php echo ($vo["product_keywords_s"]); ?></td>
    <td id="p_desc_<?php echo ($vo['product_id']); ?>"  val="<?php echo ($vo["product_desc"]); ?>" bgcolor="#FFFFFF"><?php echo ($vo["product_desc_s"]); ?></td>
    <td bgcolor="#FFFFFF"><?php echo ($vo["product_image_url"]); ?></td>
    <td bgcolor="#FFFFFF">
    <a href="<?php echo U('Product/edit',array('product_id' => $vo['product_id']));?>"><input type="button" class="button" value="编辑"></a>
    <a href="<?php echo U('Product/attr',array('product_id' => $vo['product_id']));?>"><input type="button" class="button" value="属性"></a>
    <a onclick="return confirm('确定删除？')" href="<?php echo U('Product/delete',array('product_id' => $vo['product_id']));?>"><input type="button" class="button" value="删除"></a>    
    </td>
  </tr><?php endforeach; endif; ?>
</table>
<div style="padding:5px;text-align:center"><?php echo ($page); ?></div>
		</td>
      </tr>
    </table>
  </div>
</div>
</body>
</html>

<script type="text/javascript">
$(function(){
    $("td[id^='p_kwds_'],[id^='p_desc_']").click(function(){
        var val = $(this).attr('val');
        layer.tips(val, this, {
            style: ['background-color:#78BA32; color:#fff', '#78BA32'],
            maxWidth:400,
            time: 3,
            closeBtn:[0, true]
        });
    })
})
</script>