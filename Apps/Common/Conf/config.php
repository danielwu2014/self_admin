<?php
return array(
    //'配置项'=>'配置值'
    'URL_MODEL'			=>	0, // URL访问模式,可选参数0、1、2、3,代表以下四种模式：
    //'URL_HTML_SUFFIX'		=>	'shtml'; // URL伪静态后缀设置

     /* 数据库设置 */
    'DB_TYPE'               =>  'mysql',	// 数据库类型
    'DB_HOST'               =>  'localhost', // 服务器地址
    'DB_NAME'               =>  'self_admin', // 数据库名
    'DB_USER'               =>  'root', // 用户名
    'DB_PWD'                =>  '', // 密码
    'DB_PORT'               =>  '3306', // 端口
    'DB_PREFIX'             =>  '', // 数据库表前缀
    'DB_FIELDTYPE_CHECK'    =>  false, // 是否进行字段类型检查
    'DB_FIELDS_CACHE'       =>  true,  // 启用字段缓存
    'DB_CHARSET'            =>  'utf8', // 数据库编码默认采用utf8
);