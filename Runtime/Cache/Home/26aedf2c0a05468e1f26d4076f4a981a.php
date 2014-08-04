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
  <legend>订单基本信息</legend>
  <table border="0" cellpadding="2" cellspacing="1" style="width:100%">
    <tr>
      <td nowrap align="right" width="15%">订单编号:</td>
      <td width="35%"><?php echo ($vo["order_no"]); ?></td>
      <td nowrap align="right" width="15%">邮箱:</td>
      <td width="35%"><?php echo ($vo["customer_email"]); ?></td>
    </tr>
    <tr>
      <td nowrap align="right" width="15%">交易号:</td>
      <td width="35%"><?php echo ($vo["trade_no"]); ?></td>
      <td nowrap align="right" width="15%">姓名:</td>
      <td width="35%"><?php echo ($vo["customer_name"]); ?></td>
    </tr>
    <tr>
      <td nowrap align="right" width="15%">订单金额:</td>
      <td width="35%"><?php echo ($vo["order_amount"]); ?></td>
      <td nowrap align="right" width="15%">国家:</td>
      <td width="35%"><?php echo ($vo["country"]); ?></td>
    </tr>
    <tr>
      <td nowrap align="right" width="15%">订单状态:</td>
      <td width="35%"><?php echo ($vo["order_status"]); ?></td>
      <td nowrap align="right" width="15%">省/州:</td>
      <td width="35%"><?php echo ($vo["state"]); ?></td>
    </tr>
    <tr>
      <td nowrap align="right" width="15%">下单日期:</td>
      <td width="35%"><?php echo ($vo["order_date"]); ?></td>
      <td nowrap align="right" width="15%">城市:</td>
      <td width="35%"><?php echo ($vo["city"]); ?></td>
    </tr>
    <tr>
      <td nowrap align="right" width="15%">支付方式:</td>
      <td width="35%"><?php echo ($vo["payment_method"]); ?></td>
      <td nowrap align="right" width="15%">地址:</td>
      <td width="35%"><?php echo ($vo["address"]); ?></td>
    </tr>
    <tr>
      <td nowrap align="right" width="15%">运输方式:</td>
      <td width="35%"><?php echo ($vo["shipping_method"]); ?></td>
      <td nowrap align="right" width="15%">邮编:</td>
      <td width="35%"><?php echo ($vo["postcode"]); ?></td>
    </tr>
    <tr>
      <td nowrap align="right" width="15%">运输费用:</td>
      <td width="35%"><?php echo ($vo["shipping_fee"]); ?></td>
      <td nowrap align="right" width="15%">电话:</td>
      <td width="35%"><?php echo ($vo["phone"]); ?></td>
    </tr>
    <tr>
      <td width="15%" nowrap="" align="right">客户备注:</td>
      <td colspan="3"><?php echo ($vo["customer_remark"]); ?></td>
    </tr> 
    <tr>
      <td colspan="4" align="center"><input type="button" onclick="window.location='<?php echo U("Order/edit",array('order_id'=>$vo['order_id']));?>'" class="button" value="编辑"></td>
    </tr>
  </table>
  <br />
</fieldset>

<fieldset style="height:100%;">
  <legend>订单产品信息</legend>
  <table border="0" cellpadding="4" cellspacing="1" style="width:100%" bgcolor="#464646">
    <tr>
      <td bgcolor="#EEEEEE" width="5%" align="center">SKU</td>
      <td bgcolor="#EEEEEE" width="15%" align="center">产品名称</td>
      <td bgcolor="#EEEEEE" width="5%" align="center">产品颜色</td>
      <td bgcolor="#EEEEEE" width="5%" align="center">产品尺寸</td>
      <td bgcolor="#EEEEEE" width="5%" align="center">产品价格</td>
      <td bgcolor="#EEEEEE" width="5%" align="center">是否采购</td>
      <td bgcolor="#EEEEEE" width="5%" align="center">采购价格</td>
      <td bgcolor="#EEEEEE" width="30%" align="center">采购地址</td>
      <td bgcolor="#EEEEEE" width="5%" align="center">快递公司</td>
      <td bgcolor="#EEEEEE" width="10%" align="center">运单号</td>
      <td bgcolor="#EEEEEE" width="10%" align="center">操作</td>
    </tr>
    <?php if(is_array($products)): foreach($products as $key=>$p): ?><tr align="center">
        <td  bgcolor="#FFFFFF"><?php echo ($p["product_code"]); ?></td>
        <td  bgcolor="#FFFFFF"><?php echo ($p["product_name"]); ?></td>
        <td  bgcolor="#FFFFFF"><?php echo ($p["product_color"]); ?></td>
        <td  bgcolor="#FFFFFF"><?php echo ($p["product_size"]); ?></td>
        <td  bgcolor="#FFFFFF"><?php echo ($p["product_price"]); ?></td>
        <td  bgcolor="#FFFFFF">
          <?php if($p['purchase_status'] == 1): ?><span style="color:red;font-size:14px;">是</span>
          <?php else: ?>
              否<?php endif; ?>
        </td>
        <td  bgcolor="#FFFFFF"><?php echo ($p["purchase_price"]); ?></td>
        <td  bgcolor="#FFFFFF"><?php echo ($p["purchase_url"]); ?></td>
        <td  bgcolor="#FFFFFF"><?php echo ($p["express_company"]); ?></td>
        <td  bgcolor="#FFFFFF"><?php echo ($p["express_number"]); ?></td>        
        <td  bgcolor="#FFFFFF">
          <?php if($p['purchase_status'] == 0): ?><input type="button" id="p_purchase" val="<?php echo ($p["order_product_id"]); ?>" class="button" value="采购"><?php endif; ?>
          <input type="button" onclick="window.location='<?php echo U("Order/productEdit",array('order_product_id'=>$p['order_product_id']));?>'" class="button" value="编辑">
          
        </td>
      </tr><?php endforeach; endif; ?>
  </table>
  <br />
</fieldset>

<script type="text/javascript">
$(function(){
  $('#p_purchase').bind('click',function(){
    $.ajax({
      type : 'POST',
      url  : "<?php echo U('order/productPurchase');?>",
      data : {order_product_id : $(this).attr('val')},
      dataType : 'json',
      success:function(data){
         if(data==1){
            $('#p_purchase').attr('disabled','disabled').removeClass('button');
         }
      }
    })
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