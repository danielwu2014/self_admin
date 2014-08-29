<?php
return array(
    //'配置项'=>'配置值'
    'PAYMENT_METHODS' => array(
    	'credit_card' => array(
    		'code' => 'credit_card',
    		'name' => '信用卡',
    	)
    ),

    'SHIPPING_METHODS' => array(
    	'express' => array(
    		'code' => 'express',
    		'name' => '快递',
    	),
    	'regular' => array(
    		'code' => 'regular',
    		'name' => '平邮',
    	),    	
    ),


    'ORDER_STATUSES' => array(
    	'unship' => array(
    		'id'   => 1,
    		'code' => 'unship',
    		'name' => '未发货',
    	),
    	'shipped' => array(
    		'id'   => 2,
    		'code' => 'shipped',
    		'name' => '已发货',
    	),
        'signed' => array(
            'id'   => 3,
            'code' => 'signed',
            'name' => '已签收',
        ),        
    	'canceled' => array(
    		'id'   => 4,
    		'code' => 'canceled',
    		'name' => '已取消',
    	)
   ),

   'ORDER_SOURCE'=> 'AMZ',
   'PAGE_SIZE' => '20',
   'Default_COLOR_Option' => 1,// 系统默认属性为颜色(1)、尺寸(2)
   'Default_SIZE_Option' => 2,
   'AMAZON_FEE_PERCENT' => 0.15,//亚马逊15%的手续费
   'IMAGE_DIR' => './images/',

   'ORIGINAL_IMAGE_DIR' => 'o', //original
   'IMAGE_CROP_PARAM' => array(
        'l' => '360:540', //large
        'm' => '240:360', //medium
        'g' => '120:180', //grid
        's' => '60:90'    //small
    )
);