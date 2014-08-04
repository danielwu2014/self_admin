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
  <legend>添加产品</legend>
  <form enctype="multipart/form-data" action="<?php echo U('Product/insert');?>" method="POST">
  <table cellspacing="1" cellpadding="2" border="0" style="width:100%">
  <tr>
    <td width="15%" nowrap="" align="right">产品SKU:</td>
    <td width="35%"><input type="text" name="product_code" value="<?php echo ($p["product_code"]); ?>" style="width:154px" class="text">
      <span class="red"></span></td>
    <td width="18%" nowrap="" align="right">产品价格:</td>
    <td width="35%"><input type="text" name="product_price" value="<?php echo ($p["product_price"]); ?>" style="width:154px" class="text">
  </tr>
  <tr>
    <td width="15%" nowrap="" align="right">中文名称:</td>
    <td width="35%"><input type="text" name="product_title" value="<?php echo ($p["product_title"]); ?>" style="width:400px" class="text"></td>
    <td width="18%" nowrap="" align="right">采购价格:</td>
    <td width="35%"><input type="text" name="purchase_price" value="<?php echo ($p["purchase_price"]); ?>" style="width:154px" class="text"></td>
  </tr>
  <tr>
    <td width="15%" nowrap="" align="right">产品名称:</td>
    <td width="35%"><input type="text" name="product_name" value="<?php echo ($p["product_name"]); ?>" style="width:400px" class="text"></td>
    <td width="18%" nowrap="" align="right">采购地址一:</td>
    <td width="35%"><input type="text" name="purchase_url_1" value="<?php echo ($p["purchase_url_1"]); ?>" style="width:400px" class="text"></td>
  </tr>
  <tr>
    <td width="15%" nowrap="" align="right">产品数量:</td>
    <td width="35%"><input type="text" name="product_quantity" value="<?php echo ($p["product_quantity"]); ?>" style="width:154px" class="text"></td>
    <td nowrap="nowrap" align="right">采购地址二:</td>
    <td><input type="text" name="purchase_url_2" value="<?php echo ($p["purchase_url_2"]); ?>" style="width:400px" class="text"></td>
  </tr>
  <tr>
    <td width="15%" nowrap="" align="right">产品状态:</td>
    <td width="35%"><input type="radio" name="product_status" value="1" <?php if(!isset($p) || $p['product_status']==1) echo 'checked="checked"' ?>>
      上架
      <input type="radio" name="product_status" value="0" <?php if(isset($p) && $p['product_status']==0) echo 'checked="checked"' ?>>
      下架 </td>
    <td nowrap="nowrap" align="right">产品批次</td>
    <td><input type="text" name="product_batch" value="<?php echo ($p["product_batch"]); ?>" style="width:154px" class="text"></td>
  </tr>
  <tr>
    <td width="15%" nowrap="" align="right" valign="top">产品图片:</td>
    <td colspan="3" valign="top" id="pic_td">
      <div><input type="file" name="pictures[]"><input id="add_pic" class="button" type="button" value="增加"></div>
    </td>
  </tr>
  <tr>
    <td width="15%" nowrap="" align="right" valign="top"></td>
    <td colspan="3">

        <?php if(is_array($product_image)): foreach($product_image as $k=>$image): ?><div style="float:left;margin-left:5px;">
          <div><img src="<?php echo ($image); ?>" height="60"></div>
          <div id="delImg_<?php echo ($k); ?>" style="text-align:center;cursor:pointer;"><img src="/Public/Images/X.gif"></div>
        </div><?php endforeach; endif; ?>
      
    </td>
  </tr>
  <tr>
    <td width="15%" nowrap="" align="right">关键字:</td>
    <td colspan="3"><textarea rows="10" cols="100" name="product_keywords"><?php echo ($p["product_keywords"]); ?></textarea></td>
  </tr>
  <tr>
    <td width="15%" nowrap="" align="right">产品描述:</td>
    <td colspan="3"><textarea rows="10" cols="100" name="product_desc"><?php echo ($p["product_desc"]); ?></textarea></td>
  </tr> 
  <tr>
    <td colspan="4" align="center"><input type="submit" class="button" value="保存">
      <input type="reset" class="button" value="重置"></td>
  </tr>
</table>
<script type="text/javascript">
  $("#add_pic").bind('click',function(){
    var $addform=$("#pic_td div");
    if($addform.length>=5) return false;
    var len  = $addform.length+1;
    var html = '<div><input type="file" name="pictures[]"><input id="delImgInput' +len + '" class="button" type="button" value="删除"></div>';
    $('#pic_td').append(html);
  });

  $("div").on('click',"input[id^='delImgInput']",function(){
    $(this).parent().remove();
  })



  //删除图片
  $("div[id^='delImg_']").on('click',"",function(){
    if(!confirm('确定删除该图片？')){
       return false;
    }
    var $this = $(this);
    var src = $(this).siblings().children().attr('src');
    var obj = new Object();
    obj.product_image = src;
    obj.product_id = $("input[name='product_id']").val();
    obj.target = 'delProductImg';
    $.ajax({
        type : 'POST',
        url  : "<?php echo U('ajax/index');?>",
        data : obj,
        dataType : 'json',
        success:function(data){
           if(data.status==1){
              alert(data.message);
              $this.parent().remove();
           }
        }
    })
  })

</script>
  </form>
</fieldset>
		</td>
      </tr>
    </table>
  </div>
</div>
</body>
</html>