<?php 
return array (
  'APP_STATE' => 1,
  'APP_NAME' => '会员中心',
  'APP_VER' => '1.0',
  'APP_AUTHOR' => '路过',
  'APP_ORIGINAL_PREFIX' => 'yx_',
  'APP_TABLES' => 'members,member_group,orders,order_detail',
  'TPL' => 
  array (
    'TPL_CACHE_ON' => false,
  ),
  'EMAIL' => 
  array (
    'SMTP_HOST' => 'smtp.163.com',
    'SMTP_PORT' => 25,
    'SMTP_SSL' => false,
    'SMTP_USERNAME' => 'yxcmstest@163.com',
    'SMTP_PASSWORD' => 12345612,
    'SMTP_AUTH' => true,
    'SMTP_CHARSET' => 'utf-8',
    'SMTP_FROM_TO' => 'yxcmstest@163.com',
    'SMTP_FROM_NAME' => 'YXcms官方',
    'SMTP_DEBUG' => false,
  ),
  'HEAD_W' => 100,
  'HEAD_H' => 100,
  'MS_PREFIX' => 'yx_',
  'imgupSize' => 1000000,
  'sortallow' => '100024,100002,100007,100008,100004,100009,100010',
  'MAIL_TYPE' => 
  array (
    'EXPRESS' => 
    array (
      0 => '快递',
      1 => 20,
      2 => true,
    ),
    'POST' => 
    array (
      0 => '平邮',
      1 => 10,
      2 => false,
    ),
    'EMS' => 
    array (
      0 => 'EMS',
      1 => 30,
      2 => false,
    ),
  ),
  'PAYMENT' => 'SELLER_PAY',
);