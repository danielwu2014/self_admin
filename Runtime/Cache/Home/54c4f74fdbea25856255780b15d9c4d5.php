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

<div>
  <div style="margin:5px;">
    <input type="button" id="btn_order_product_add" class="button" value="录入订单产品">
  </div>
  <div id="order_product_add" style="display:none">
    <fieldset style="height:100%;">
      <legend>产品信息</legend>
      <form action="<?php echo U('Order/productAdd');?>" method="POST">
        <table cellspacing="1" cellpadding="2" border="0" style="width:100%">
          <tr>
            <td width="15%" nowrap="" align="right">SKU:</td>
            <td width="35%"><input type="text" name="product_code" value="" style="width:154px" class="text">
              <span class="red"></span></td>
            <td width="18%" nowrap="" align="right">销售价格:</td>
            <td width="35%"><input type="text" name="product_price" value="" style="width:154px" class="text">
          </tr>
          <tr>
            <td width="15%" nowrap="" align="right">产品名称:</td>
            <td width="35%"><input type="text" name="product_name" value="" style="width:154px" class="text"></td>
            <td width="18%" nowrap="" align="right">采购价格:</td>
            <td width="35%"><input type="text" name="purchase_price" value="" style="width:154px" class="text"></td>
          </tr>
          <tr>
            <td width="15%" nowrap="" align="right">产品颜色:</td>
            <td id="product_color_td" width="35%"><input type="text" name="product_color" value="" style="width:154px" class="text"></td>
            <td width="18%" nowrap="" align="right">采购地址:</td>
            <td width="35%"><input type="text" name="purchase_url" value="" style="width:400px" class="text"></td>
          </tr>
          <tr>
            <td width="15%" nowrap="" align="right">产品尺寸:</td>
            <td id="product_size_td" width="35%"><input type="text" name="product_size" value="" style="width:154px" class="text"></td>
            <td nowrap="nowrap" align="right"></td>
            <td></td>
          </tr>
          <tr>
            <td colspan="4" align="center"><input type="submit" class="button" value="保存">
              <input type="reset" class="button" value="重置"></td>
          </tr>
        </table>
      </form>
    </fieldset>
  </div>
  <notempty name="order_products">
  <div id="order_products_temp" style="margin:0 auto;width:99%;margin-top:5px;">
    <table width="100%" align="center" cellspacing="0" cellpadding="0" border="0">
      <tbody>
        <tr>
          <td height="20"><span class="newfont07">订单产品列表</span></td>
        </tr>
        <tr>
          <td height="40" class="font42"><table width="100%" bgcolor="#464646" cellspacing="1" cellpadding="4" border="0">
              <tbody>
                <tr>
                  <td width="10%" bgcolor="#EEEEEE" align="center">SKU</td>
                  <td width="20%" bgcolor="#EEEEEE" align="center">产品名称</td>
                  <td width="10%" bgcolor="#EEEEEE" align="center">产品颜色</td>
                  <td width="10%" bgcolor="#EEEEEE" align="center">产品尺寸</td>
                  <td width="5%" bgcolor="#EEEEEE" align="center">产品价格</td>
                  <td width="5%" bgcolor="#EEEEEE" align="center">采购价格</td>
                  <td width="30%" bgcolor="#EEEEEE" align="center">采购地址</td>
                  <td width="10%" bgcolor="#EEEEEE" align="center">操作</td>
                </tr>
                <?php if(is_array($order_products)): foreach($order_products as $key=>$p): ?><tr align="center">
                  <td bgcolor="#FFFFFF"><?php echo ($p["product_code"]); ?></td>
                  <td bgcolor="#FFFFFF"><?php echo ($p["product_name"]); ?></td>
                  <td bgcolor="#FFFFFF"><?php echo ($p["product_color"]); ?></td>
                  <td bgcolor="#FFFFFF"><?php echo ($p["product_size"]); ?></td>
                  <td bgcolor="#FFFFFF"><?php echo ($p["product_price"]); ?></td>
                  <td bgcolor="#FFFFFF"><?php echo ($p["purchase_price"]); ?></td>
                  <td bgcolor="#FFFFFF"><?php echo ($p["purchase_url"]); ?></td>
                  <td bgcolor="#FFFFFF"><a href="<?php echo U('Order/productDel', array('id' => $p['product_code']));?>">删除</a></td>
                </tr><?php endforeach; endif; ?>
              </tbody>
            </table></td>
        </tr>
      </tbody>
    </table>
  </div>
  <notempty>
</div>
<table cellspacing="0" cellpadding="0" border="0" style="width:100%">
  <tr>
    <td width="100%"><fieldset style="height:100%;">
        <legend>订单信息</legend>
        <form action="<?php echo U('Order/insert');?>" method="POST">
          <table cellspacing="1" cellpadding="2" border="0" style="width:100%">
            <tr>
              <td width="15%" nowrap="" align="right">交易号:</td>
              <td width="35%"><input type="text" name="trade_no" value="" style="width:154px" class="text"></td>
              <td width="18%" nowrap="" align="right">邮箱:</td>
              <td width="35%"><input type="text" name="customer_email" value="" style="width:154px" class="text"></td>
            </tr>
            <tr>
              <td width="15%" nowrap="" align="right">订单金额:</td>
              <td width="35%"><input type="text" name="order_amount" value="" style="width:154px" class="text"></td>
              <td width="18%" nowrap="" align="right">姓名:</td>
              <td width="35%"><input type="text" name="customer_name" value="" style="width:154px" class="text"></td>
            </tr>
            <tr>
              <td width="15%" nowrap="" align="right">订单币种:</td>
              <td width="35%"><select name="order_currency" id="select1">
                  <option value="USD">USD</option>
                </select></td>
              <td width="18%" nowrap="" align="right">国家:</td>
              <td width="35%"><input type="text" name="country" value="" style="width:154px" class="text"></td>
            </tr>
            <tr>
              <td width="15%" nowrap="" align="right">订单状态:</td>
              <td width="35%"><select name="order_status">
                  <?php if(is_array($order_statuses)): foreach($order_statuses as $k=>$v): ?><option value="<?php echo ($k); ?>"><?php echo ($v); ?></option><?php endforeach; endif; ?>
                </select></td>
              <td nowrap="nowrap" align="right">省/州:</td>
              <td><input type="text" name="state" value="" style="width:154px" class="text"></td>
            </tr>
            <tr>
              <td width="15%" nowrap="" align="right">下单日期:</td>
              <td width="35%"><input type="text" id="order_date" name="order_date" value="" style="width:154px" class="text">
                <!-- <img class="trigger datepick-trigger" alt="Popup" src="./Public/Images/Datepicker/calendar-green.gif"> --> <span class="red"></span></td>
              <td width="18%" nowrap="" align="right">城市:</td>
              <td width="35%"><input type="text" name="city" value="" style="width:154px" class="text"></td>
            </tr>
            <tr>
              <td width="15%" nowrap="" align="right">支付方式:</td>
              <td width="35%"><select name="payment_method_code">
                  <?php if(is_array($payment_methods)): foreach($payment_methods as $key=>$vo): ?><option value="<?php echo ($vo["code"]); ?>"><?php echo ($vo["name"]); ?></option><?php endforeach; endif; ?>
                </select>
                <span class="red"></span></td>
              <td width="18%" nowrap="" align="right">地址:</td>
              <td width="35%"><input type="text" name="address" value="" style="width:154px" class="text"></td>
            </tr>
            <tr>
              <td width="15%" nowrap="" align="right">运输方式:</td>
              <td width="35%"><select name="shipping_method_code">
                  <?php if(is_array($shipping_methods)): foreach($shipping_methods as $key=>$vo): ?><option value="<?php echo ($vo["code"]); ?>"><?php echo ($vo["name"]); ?></option><?php endforeach; endif; ?>
                </select>
                <span class="red"></span></td>
              <td width="18%" nowrap="" align="right">邮编:</td>
              <td width="35%"><input type="text" name="postcode" value="" style="width:154px" class="text">
                <!-- <span class="red">*</span> --></td>
            </tr>
            <tr>
              <td nowrap="nowrap" align="right">运输费用:</td>
              <td><input type="text" name="shipping_fee" value="" style="width:154px" class="text"></td>
              <td align="right">电话:</td>
              <td><input type="text" name="phone" value="" style="width:154px" class="text"></td>
            </tr>
            <tr>
              <td width="15%" nowrap="" align="right">客户备注:</td>
              <td colspan="3"><textarea rows="10" cols="100" name="customer_remark"></textarea></td>
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

  $('#btn_order_product_add').click(function(){
    $d = $('#order_product_add').css('display')
    if($d=='none'){
       $('#order_product_add').show('slow');
    }else{
       $('#order_product_add').fadeOut('slow');
    }
  })

  $("input[name='product_code']").bind('blur',function(){
     var product_code = $(this).val();
     if(product_code=='' || product_code==null) return false;
     $.ajax({
        type : 'POST',
        url  : "<?php echo U('ajax/index');?>",
        data : {product_code : product_code, target : 'getProduct'},
        dataType : 'json',
        success:function(data){
           if(data.status==1){
              $("input[name='product_name']").val(data.datas.product_name);
              $("input[name='product_price']").val(data.datas.product_price);
              $("input[name='purchase_price']").val(data.datas.purchase_price);
              $("input[name='purchase_url']").val(data.datas.purchase_url_1);
              $("#product_color_td").html(data.datas.colorValues);
              $("#product_size_td").html(data.datas.sizeValues)
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