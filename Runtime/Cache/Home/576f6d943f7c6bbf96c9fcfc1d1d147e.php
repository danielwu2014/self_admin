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

<div style="width:100%;background-color:#FFF;padding:10px 0 10px 5px;">
    <form action="" method="get">
    <input type="hidden" name="c" value="<?php echo (CONTROLLER_NAME); ?>">
    <input type="hidden" name="a" value="<?php echo (ACTION_NAME); ?>">
    订单号：<input type="text" name="order_no" value="<?php echo ($_GET['order_no']); ?>">&nbsp;
    订单状态：
    <select name="order_status">
      <option value=''>请选择</option>
      <?php if(is_array($order_statuses)): foreach($order_statuses as $k=>$v): ?><option value="<?php echo ($k); ?>" <?php if($_GET['order_status']==$k) echo 'selected="selected"' ; ?>><?php echo ($v); ?></option><?php endforeach; endif; ?>
    </select>&nbsp;
    姓名：<input type="text" name="customer_name" value="<?php echo ($_GET['customer_name']); ?>">&nbsp;
    邮箱：<input type="text" name="customer_email" value="<?php echo ($_GET['customer_email']); ?>">&nbsp;
    <input type="submit" class="button" value="查询">
    </form>
</div>
<table width="100%" border="0" cellpadding="4" cellspacing="1" bgcolor="#464646" class="newfont03">
  <tr>
    <td width="10%" align="center" bgcolor="#EEEEEE">订单号</td>
    <td width="" align="center" bgcolor="#EEEEEE">交易号</td>
    <td width="" align="center" bgcolor="#EEEEEE">订单金额</td>
    <td width="" align="center" bgcolor="#EEEEEE">订单状态</td>
    <td width="" align="center" bgcolor="#EEEEEE">下单日期</td>
    <td width="" align="center" bgcolor="#EEEEEE">运输方式</td>
    <td width="" align="center" bgcolor="#EEEEEE">运输费用</td>
    <td width="" align="center" bgcolor="#EEEEEE">邮箱</td>
    <td width="" align="center" bgcolor="#EEEEEE">姓名</td>
    <td width="" align="center" bgcolor="#EEEEEE">国家</td>
    <td width="" align="center" bgcolor="#EEEEEE">省/州</td>
    <td width="" align="center" bgcolor="#EEEEEE">城市</td>
    <td width="" align="center" bgcolor="#EEEEEE">地址</td>
    <td width="" align="center" bgcolor="#EEEEEE">邮编</td>
    <td width="" align="center" bgcolor="#EEEEEE">电话</td>
  </tr>
  <?php if(is_array($voList)): foreach($voList as $key=>$vo): ?><tr>
    <td height="30" bgcolor="#FFFFFF"><a href="<?php echo U('Order/detail',array('order_id' => $vo['order_id']));?>"><?php echo ($vo["order_no"]); ?></a></td>
    <td bgcolor="#FFFFFF"><?php echo ($vo["trade_no"]); ?></td>
    <td bgcolor="#FFFFFF"><?php echo ($vo["order_amount"]); ?></td>
    <td bgcolor="#FFFFFF"><?php echo ($vo["order_status"]); ?></td>
    <td bgcolor="#FFFFFF"><?php echo ($vo["order_date"]); ?></td>
    <td bgcolor="#FFFFFF"><?php echo ($vo["shipping_method"]); ?></td>
    <td bgcolor="#FFFFFF"><?php echo ($vo["shipping_fee"]); ?></td>
    <td bgcolor="#FFFFFF"><?php echo ($vo["customer_email"]); ?></td>
    <td bgcolor="#FFFFFF"><?php echo ($vo["customer_name"]); ?></td>
    <td bgcolor="#FFFFFF"><?php echo ($vo["country"]); ?></td>
    <td bgcolor="#FFFFFF"><?php echo ($vo["state"]); ?></td>
    <td bgcolor="#FFFFFF"><?php echo ($vo["city"]); ?></td>
    <td bgcolor="#FFFFFF"><?php echo ($vo["address"]); ?></td>
    <td bgcolor="#FFFFFF"><?php echo ($vo["postcode"]); ?></td>
    <td bgcolor="#FFFFFF"><?php echo ($vo["phone"]); ?></td>
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