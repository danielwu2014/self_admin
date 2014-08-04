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

<style type="text/css">
#node-wrap {
	position: relative;
  top: 5px;
	z-index: 100;
}
#node-nav {
	position: absolute;
	left: 0;
	top: 0;
}
#node-nav, #node-nav ul {
	padding: 0;
	margin: 0;
	list-style: none;
	font-family: "Microsoft 雅黑";
	font-weight: bold;
}
#node-nav li a {
	padding-left: 36px;
	white-space: nowrap;
}
#node-nav li ul li a {
	padding-left: 5px;
}
#node-nav ul {
	padding-left: 20px;
}
#node-nav li a {
	/*color: #66b;*/
  color: #666666;
	text-decoration: none;
	font-size: 13px;
}
#node-nav li {
  text-indent: 22px;
	font-size: 13px;
	line-height: 25px;
  color: #666666;
	/*color: #d80;*/
	cursor: pointer;
	width: 100%;
}
#node-nav li.down {
	text-indent: 20px;
}
#node-nav li a:hover {
	text-decoration: underline;
}
.span{
  display: inline-block; 
  height: 18px; vertical-align: middle; 
  width: 16px;
  /*cursor: pointer;*/
  padding-right: 1px;
}
.closed {
    background: url("./Public/Images/tree_node.gif") no-repeat scroll -4px -31px rgba(0, 0, 0, 0);
}
.opened {
    background: url("./Public/Images/tree_node.gif") no-repeat scroll -4px -7px rgba(0, 0, 0, 0);
}
#node-nav li span .opr-a{
  padding-left: 0px;
  color: #999;
}

.input-button{
  cursor: pointer;
}

</style>
<div style="margin:5px;">
  <input type="button" onclick="window.location='<?php echo U("Node/add");?>'"  class="button input-button" value="新增一级节点">
</div>
<fieldset style="height:400px;">
  <legend>节点列表</legend>
 <div id="node-wrap">
    <ul id="node-nav">  
      <?php echo ($nodeListHtml); ?>
<!--       <li class="p1 down"><span class="span closed"></span>系统管理<span><a href="<?php echo U('Node/add',array('pid'=>1));?>">[添加]</a><a class="opr-a" href="">[修改]</a></span>
        <ul>
          <li><a href="#url">Printing</a></li>
          <li><a href="#url">Photo Framing</a></li>
          <li><a href="#url">Retouching</a></li>
          <li><a href="#url">Archiving</a></li>
        </ul>
      </li> -->
     <!--  <li class="p1 down"><span class="span closed"></span>订单管理
        <ul>
          <li><a href="#url">Support</a></li>
          <li class="p2 down"><span class="span closed"></span>订单列表
            <ul>
              <li><a href="#url">Canadian</a></li>
              <li><a href="#url">Australian</a></li>
            </ul>
          </li>
        </ul>
      </li>
      <li class="p1 down"><span class="span closed"></span>产品管理
        <ul>
          <li><a href="#url">Online</a></li>
          <li><a href="#url">Catalogue</a></li>
          <li><a href="#url">Mail Order</a></li>
        </ul>
      </li>
      <li><a href="#url">属性管理</a></li> -->
    </ul>
  </div>
</fieldset>

<script language="javascript" type="text/javascript">
$(document).ready(function() {

  $("ul#node-nav ul").hide();
  $('ul#node-nav li:has(ul)').each(function(i) {
    $(this).children("li:not('span')").slideUp(400);
  });

  $('li.p1:has(ul)').click(function(event){
    if (this == event.target) {
      current = this;
      $('ul#node-nav li:has(ul)').each(function(i) {
        if (this != current) {
          $(this).children("li:not('span')").slideUp(400);
        }
      });
      if($(this).children("ul").css('display')=='none'){
        $(this).children(".span").removeClass('closed').addClass('opened');
      }else{
        $(this).children(".span").removeClass('opened').addClass('closed');
      }
      $(this).children("ul:eq(0)").slideToggle(400);
    }
  });

  $('li.p2:has(ul)').click(function(event){
    if (this == event.target) {
      current = this;
      $('li.p2:has(ul)').each(function(i) {
        if (this != current) {$(this).children("li:not('span')").slideUp(400);}
      });
      $('li.p3:has(ul)').each(function(i) {
        if (this != current) {$(this).children().slideUp(400);}
      });
      if($(this).children("ul").css('display')=='none'){
        $(this).children(".span").removeClass('closed').addClass('opened');
      }else{
        $(this).children(".span").removeClass('opened').addClass('closed');
      }
      $(this).children("ul:eq(0)").slideToggle(400); 
    }
  });

  $('li.p3:has(ul)').click(function(event){
    if (this == event.target) {
      current = this;
      $('li.p3:has(ul)').each(function(i) {
        if (this != current) {$(this).children().slideUp(400);}
      });
      $(this).children("ul:eq(0)").slideToggle(400); 
    }
  });
});
</script> 
		</td>
      </tr>
    </table>
  </div>
</div>
</body>
</html>