<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//Dtd XHTML 1.0 Frameset//EN" "http://www.w3.org/tr/xhtml1/Dtd/xhtml1-frameset.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>项目管理系统</title>
</head>

<frameset rows="30,*,25" cols="*" frameborder="no" border="0" framespacing="0">
  <frame src="<?php echo U('Index/header');?>" name="topFrame" scrolling="No" noresize="noresize" id="topFrame" title="topFrame" />
  <frameset cols="200,5,*" frameborder="no" border="0" framespacing="0" id="bodyFrame">
    <frame src="<?php echo U('Index/left');?>" name="leftFrame" scrolling="No" noresize="noresize" id="leftFrame" title="leftFrame" />
    <frame src="<?php echo U('Index/spe');?>" name="speFrame" id="speFrame" scrolling="no"   frameborder="no" title="speFrame"/>
    <frame src="<?php echo U('Index/main');?>" name="mainFrame" id="mainFrame" title="mainFrame" />
  </frameset>
  <frame src="<?php echo U('Index/footer');?>" name="bottomFrame" scrolling="No" noresize="noresize" id="bottomFrame" title="bottomFrame" />
</frameset>
<noframes>
<body>
</body>
</noframes>
</html>