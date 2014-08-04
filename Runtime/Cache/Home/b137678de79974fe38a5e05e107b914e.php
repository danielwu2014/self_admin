<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//Dtd XHTML 1.0 transitional//EN" "http://www.w3.org/tr/xhtml1/Dtd/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>项目管理系统</title>
<style type="text/css">
<!--
body {
	margin: 0;
}
-->
</style>
<link href="/Public/Css/base.css" rel="stylesheet" type="text/css" />
</head>
<SCRIPT language=JavaScript>
function tupian(idt){
    var nametu="xiaotu"+idt;
    var tp = document.getElementById(nametu);
    tp.src="/Public/Images/ico05.gif";//图片ico04为白色的正方形
	
	for(var i=1;i<30;i++)
	{
	  
	  var nametu2="xiaotu"+i;
	  if(i!=idt*1)
	  {
	    var tp2=document.getElementById('xiaotu'+i);
		if(tp2!=undefined)
	    {tp2.src="/Public/Images/ico06.gif";}//图片ico06为蓝色的正方形
	  }
	}
}

function list(idstr){
	var name1="subtree"+idstr;
	var name2="img"+idstr;
	var objectobj=document.all(name1);
	var imgobj=document.all(name2);

	
	if(objectobj.style.display=="none"){
		for(i=1;i<10;i++){
			var name3="img"+i;
			var name="subtree"+i;
			var o=document.all(name);
			if(o!=undefined){
				o.style.display="none";
				var image=document.all(name3);
				image.src="/Public/Images/ico04.gif";
			}
		}
		objectobj.style.display="";
		imgobj.src="/Public/Images/ico03.gif";
	}
	else{
		objectobj.style.display="none";
		imgobj.src="/Public/Images/ico04.gif";
	}
}

</SCRIPT>

<body>
<table width="100%" height="100%" border="0" cellpadding="0" cellspacing="0" class="left-table01">
  <tr>
    <td valign="top">
      <?php if(is_array($nodeMenu)): foreach($nodeMenu as $key=>$menu): ?><table width="100%" border="0" cellpadding="0" cellspacing="0" class="left-table03">
        <tr>
          <td height="29"><table width="85%" border="0" align="center" cellpadding="0" cellspacing="0">
              <tr>
                <td width="8%"><img name="img<?php echo ($menu["nid"]); ?>" id="img<?php echo ($menu["nid"]); ?>" src="/Public/Images/ico04.gif" width="8" height="11" /></td>
                <td width="92%"><a href="javascript:" target="mainFrame" class="left-font03" onClick="list('<?php echo ($menu["nid"]); ?>');" ><?php echo ($menu["name"]); ?></a></td>
              </tr>
            </table></td>
        </tr>
      </table>
      <table id="subtree<?php echo ($menu["nid"]); ?>" style="DISPLAY: none" width="80%" border="0" align="center" cellpadding="0" cellspacing="0" class="left-table02">
        <?php if(is_array($menu["subnode"])): foreach($menu["subnode"] as $key=>$menu2): ?><tr>
          <td width="9%" height="20" ><img id="xiaotu<?php echo ($menu2['nid']); ?>" src="/Public/Images/ico06.gif" width="8" height="12" /></td>
          <td width="91%"><a href="<?php echo ($menu2["url"]); ?>" target="mainFrame" class="left-font03" onClick="tupian('<?php echo ($menu2["nid"]); ?>');"><?php echo ($menu2["name"]); ?></a></td>
        </tr><?php endforeach; endif; ?>
      </table><?php endforeach; endif; ?>
      </td>
  </tr>
</table>
</body>
</html>