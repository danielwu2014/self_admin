<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//Dtd XHTML 1.0 transitional//EN" "http://www.w3.org/tr/xhtml1/Dtd/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>分隔</title>
<script type="text/javascript" src="./Public/Js/jquery.js"></script>
<style>
body {padding:0;margin:0;}
</style>
</head>
<body>
<div  style="position: absolute;top:50%;"><img style="cursor: pointer;" id="speimg" src="./Public/Images/bar_close.gif" alt="dd"/></div>

<script type="text/javascript">
$(function(){
    $("#speimg").toggle(function(){
         window.parent.document.getElementById("bodyFrame").cols = "0,5,*";
         $(this).attr('src','./Public/Images/bar_open.gif');
    },function(){
         window.parent.document.getElementById("bodyFrame").cols = "200,5,*";
         $(this).attr('src','./Public/Images/bar_close.gif');
    });
});
</script>
</body>
</html>