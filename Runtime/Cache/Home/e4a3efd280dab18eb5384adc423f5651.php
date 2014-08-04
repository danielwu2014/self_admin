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
  <legend>产品信息</legend>
  <form action="<?php echo U('Order/productUpdate');?>" method="POST">
    <input type="hidden" name="order_product_id" value="<?php echo ($p["order_product_id"]); ?>">
    <input type="hidden" name="order_id" value="<?php echo ($p["order_id"]); ?>">
    <table cellspacing="1" cellpadding="2" border="0" style="width:100%">
      <tr>
        <td width="15%" nowrap="" align="right">SKU:</td>
        <td width="35%"><input type="text" name="product_code" value="<?php echo ($p["product_code"]); ?>" style="width:154px" class="text">
          <span class="red"></span></td>
        <td nowrap="nowrap" align="right">产品尺寸:</td>
        <td><input type="text" name="product_size" value="<?php echo ($p["product_size"]); ?>" style="width:154px" class="text" /></td>
      </tr>
      <tr>
        <td width="15%" nowrap="" align="right">产品名称:</td>
        <td width="35%"><input type="text" name="product_name" value="<?php echo ($p["product_name"]); ?>" style="width:154px" class="text"></td>
        <td nowrap="nowrap" align="right">销售价格:</td>
        <td><input type="text" name="product_price" value="<?php echo ($p["product_price"]); ?>" style="width:154px" class="text" /></td>
      </tr>
      <tr>
        <td width="15%" nowrap="" align="right">产品颜色:</td>
        <td width="35%"><input type="text" name="product_color" value="<?php echo ($p["product_color"]); ?>" style="width:154px" class="text"></td>
        <td nowrap="nowrap" align="right">&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td colspan="4" align="center"><input type="submit" class="button" value="保存">
          <input type="reset" class="button" value="重置"></td>
      </tr>
    </table>
  </form>
</fieldset>

<?php if($p['purchase_status'] == 1): ?><fieldset style="height:100%;">
  <legend>采购信息</legend>
  <form action="<?php echo U('Order/productUpdate');?>" method="POST">
    <input type="hidden" name="order_product_id" value="<?php echo ($p["order_product_id"]); ?>">
    <input type="hidden" name="order_id" value="<?php echo ($p["order_id"]); ?>">
    <table cellspacing="1" cellpadding="2" border="0" style="width:100%">
      <tr>
        <td nowrap="nowrap" align="right">采购价格:</td>
        <td><input type="text" name="purchase_price" value="<?php echo ($p["purchase_price"]); ?>" style="width:154px" class="text" /></td>
        <td nowrap="nowrap" align="right">快递公司:</td>
        <td><input type="text" name="express_company" value="<?php echo ($p["express_company"]); ?>" style="width:154px" class="text" /></td>
      </tr>
      <tr>
        <td nowrap="nowrap" align="right">采购地址:</td>
        <td><input type="text" name="purchase_url" value="<?php echo ($p["purchase_url"]); ?>" style="width:400px" class="text" /></td>
        <td nowrap="nowrap" align="right">快递单号:</td>
        <td><input type="text" name="express_number" value="<?php echo ($p["express_number"]); ?>" style="width:154px" class="text" /></td>
      </tr>
      <tr>
        <td nowrap="nowrap" align="right">采购状态:</td>
        <td><?php if($p['purchase_status'] == 1): ?><span style="color:red;font-size:14px;">是</span>
            <?php else: ?>
            否<?php endif; ?></td>
        <td nowrap="nowrap" align="right">快递费用:</td>
        <td><input type="text" name="express_fee" value="<?php echo ($p["express_fee"]); ?>" style="width:154px" class="text" /></td>
      </tr>
      <tr>
        <td nowrap="nowrap" align="right">采购时间:</td>
        <td><?php if($p['purchase_date'] > 0): echo (date("Y-m-d",$p["purchase_date"])); endif; ?></td>
        <td nowrap="nowrap" align="right"></td>
        <td></td>
      </tr>
      <tr>
        <td colspan="4" align="center"><input type="submit" class="button" value="保存">
          <input type="reset" class="button" value="重置"></td>
      </tr>
    </table>
  </form>
</fieldset><?php endif; ?>
		</td>
      </tr>
    </table>
  </div>
</div>
</body>
</html>