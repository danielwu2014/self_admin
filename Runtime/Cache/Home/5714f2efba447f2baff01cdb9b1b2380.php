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

<link rel="stylesheet" rev="stylesheet" href="/Public/Css/Datepicker/jquery.datepick.css" type="text/css" media="all" />
<script type="text/javascript" src="/Public/Js/Datepicker/jquery.plugin.js"></script>
<script type="text/javascript" src="/Public/Js/Datepicker/jquery.datepick.js"></script>
<script type="text/javascript" src="/Public/Js/Datepicker/jquery.datepick-zh-CN.js"></script>

<table cellspacing="0" cellpadding="0" border="0" style="width:100%">
  <tr>
    <td width="100%"><fieldset style="height:100%;">
        <legend>订单信息</legend>
        <form action="<?php echo U('Order/update');?>" method="POST">
          <input type="hidden" name="order_id" value="<?php echo ($o["order_id"]); ?>">
          <table cellspacing="1" cellpadding="2" border="0" style="width:100%">
            <tr>
              <td width="15%" nowrap="" align="right">交易号:</td>
              <td width="35%"><input type="text" name="trade_no" value="<?php echo ($o["trade_no"]); ?>" style="width:154px" class="text"></td>
              <td width="18%" nowrap="" align="right">邮箱:</td>
              <td width="35%"><input type="text" name="customer_email" value="<?php echo ($o["customer_email"]); ?>" style="width:154px" class="text"></td>
            </tr>
            <tr>
              <td width="15%" nowrap="" align="right">订单金额:</td>
              <td width="35%"><input type="text" name="order_amount" value="<?php echo ($o["order_amount"]); ?>" style="width:154px" class="text"></td>
              <td width="18%" nowrap="" align="right">姓名:</td>
              <td width="35%"><input type="text" name="customer_name" value="<?php echo ($o["customer_name"]); ?>" style="width:154px" class="text"></td>
            </tr>
            <tr>
              <td width="15%" nowrap="" align="right">订单币种:</td>
              <td width="35%"><select name="order_currency" id="select1">
                  <option value="USD">USD</option>
                </select></td>
              <td width="18%" nowrap="" align="right">国家:</td>
              <td width="35%"><input type="text" name="country" value="<?php echo ($o["country"]); ?>" style="width:154px" class="text"></td>
            </tr>
            <tr>
              <td width="15%" nowrap="" align="right">订单状态:</td>
              <td width="35%"><select name="order_status">
                  <?php if(is_array($order_statuses)): foreach($order_statuses as $k=>$v): ?><option value="<?php echo ($k); ?>" <?php if($k == $o['order_status']): ?>selected="selected"<?php endif; ?>><?php echo ($v); ?></option><?php endforeach; endif; ?>
                </select></td>
              <td nowrap="nowrap" align="right">省/州:</td>
              <td><input type="text" name="state" value="<?php echo ($o["state"]); ?>" style="width:154px" class="text"></td>
            </tr>
            <tr>
              <td width="15%" nowrap="" align="right">下单日期:</td>
              <td width="35%"><input type="text" id="order_date" name="order_date" value="<?php echo ($o["order_date"]); ?>" style="width:154px" class="text">
                <img class="trigger datepick-trigger" alt="Popup" src="./Public/Images/Datepicker/calendar-green.gif"> <span class="red"></span></td>
              <td width="18%" nowrap="" align="right">城市:</td>
              <td width="35%"><input type="text" name="city" value="<?php echo ($o["city"]); ?>" style="width:154px" class="text"></td>
            </tr>
            <tr>
              <td width="15%" nowrap="" align="right">支付方式:</td>
              <td width="35%"><select name="payment_method_code">
                  <?php if(is_array($payment_methods)): foreach($payment_methods as $key=>$vo): ?><option value="<?php echo ($vo["code"]); ?>"><?php echo ($vo["name"]); ?></option><?php endforeach; endif; ?>
                </select>
                <span class="red"></span></td>
              <td width="18%" nowrap="" align="right">地址:</td>
              <td width="35%"><input type="text" name="address" value="<?php echo ($o["address"]); ?>" style="width:154px" class="text"></td>
            </tr>
            <tr>
              <td width="15%" nowrap="" align="right">运输方式:</td>
              <td width="35%"><select name="shipping_method_code">
                  <?php if(is_array($shipping_methods)): foreach($shipping_methods as $key=>$vo): ?><option value="<?php echo ($vo["code"]); ?>"  <?php if($vo['code'] == $o['shipping_method_code']): ?>selected="selected"<?php endif; ?>><?php echo ($vo["name"]); ?></option><?php endforeach; endif; ?>
                </select>
                <span class="red"></span></td>
              <td width="18%" nowrap="" align="right">邮编:</td>
              <td width="35%"><input type="text" name="postcode" value="<?php echo ($o["postcode"]); ?>" style="width:154px" class="text">
                <!-- <span class="red">*</span> --></td>
            </tr>
            <tr>
              <td nowrap="nowrap" align="right">运输费用:</td>
              <td><input type="text" name="shipping_fee" value="<?php echo ($o["shipping_fee"]); ?>" style="width:154px" class="text"></td>
              <td align="right">电话:</td>
              <td><input type="text" name="phone" value="<?php echo ($o["phone"]); ?>" style="width:154px" class="text"></td>
            </tr>
            <tr>
              <td width="15%" nowrap="" align="right">客户备注:</td>
              <td colspan="3"><textarea rows="10" cols="100" name="customer_remark"><?php echo ($o["customer_remark"]); ?></textarea></td>
            </tr>
            <tr>
              <td width="15%" nowrap="" align="right">发货费用:</td>
              <td colspan="3"><input type="sendfee" value="<?php echo ($o["sendfee"]); ?>"></td>
            </tr>            
            <tr>
              <td colspan="4" align="center"><input type="submit" class="button" value="保存">
              <input type="reset" class="button" value="重置"></td>
            </tr>
          </table>
        </form>
        <br>
      </fieldset></td>
  </tr>
</table>
<script type="text/javascript">

$(function(){
  $('#order_date').datepick({
    dateFormat: 'yyyy-mm-dd',
    // rangeSelect: true, 
    // monthsToShow: 2, 
    showTrigger: '#calImg',
  });
})

</script> 
		</td>
      </tr>
    </table>
  </div>
</div>
</body>
</html>