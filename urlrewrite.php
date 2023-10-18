<?php
$arUrlRewrite=array (
  9 => 
  array (
    'CONDITION' => '#^/catalog/([0-9a-zA-Z\\%\\_\\-]+)/([0-9a-zA-Z\\%\\_\\-]+)/([0-9a-zA-Z\\%\\_\\-]+)/(.*)#',
    'RULE' => 'PROPARENT_SECTION_CODE=$1&PARENT_SECTION_CODE=$2&SECTION_CODE=$3',
    'ID' => '',
    'PATH' => '/catalog/list.php',
    'SORT' => 100,
  ),
  8 => 
  array (
    'CONDITION' => '#^/catalog/([0-9a-zA-Z\\%\\_\\-]+)/([0-9a-zA-Z\\%\\_\\-]+)/(.*)#',
    'RULE' => 'PARENT_SECTION_CODE=$1&SECTION_CODE=$2',
    'ID' => '',
    'PATH' => '/catalog/list.php',
    'SORT' => 100,
  ),
  2 => 
  array (
    'CONDITION' => '#^/online/([\\.\\-0-9a-zA-Z]+)(/?)([^/]*)#',
    'RULE' => 'alias=$1',
    'ID' => NULL,
    'PATH' => '/desktop_app/router.php',
    'SORT' => 100,
  ),
  1 => 
  array (
    'CONDITION' => '#^/video([\\.\\-0-9a-zA-Z]+)(/?)([^/]*)#',
    'RULE' => 'alias=$1&videoconf',
    'ID' => NULL,
    'PATH' => '/desktop_app/router.php',
    'SORT' => 100,
  ),
  10 => 
  array (
    'CONDITION' => '#^/product/([0-9a-zA-Z\\%\\_\\-]+)/(.*)#',
    'RULE' => 'ELEMENT_CODE=$1',
    'ID' => '',
    'PATH' => '/catalog/detail.php',
    'SORT' => 100,
  ),
  7 => 
  array (
    'CONDITION' => '#^/catalog/([\\w\\d\\-]+)(\\\\?(.*))?#',
    'RULE' => 'SECTION_CODE=$1',
    'ID' => '',
    'PATH' => '/catalog/list.php',
    'SORT' => 100,
  ),
  4 => 
  array (
    'CONDITION' => '#^\\/?\\/mobileapp/jn\\/(.*)\\/.*#',
    'RULE' => 'componentName=$1',
    'ID' => NULL,
    'PATH' => '/bitrix/services/mobileapp/jn.php',
    'SORT' => 100,
  ),
  6 => 
  array (
    'CONDITION' => '#^/bitrix/services/ymarket/#',
    'RULE' => '',
    'ID' => '',
    'PATH' => '/bitrix/services/ymarket/index.php',
    'SORT' => 100,
  ),
  3 => 
  array (
    'CONDITION' => '#^/online/(/?)([^/]*)#',
    'RULE' => '',
    'ID' => NULL,
    'PATH' => '/desktop_app/router.php',
    'SORT' => 100,
  ),
  0 => 
  array (
    'CONDITION' => '#^/stssync/calendar/#',
    'RULE' => '',
    'ID' => 'bitrix:stssync.server',
    'PATH' => '/bitrix/services/stssync/calendar/index.php',
    'SORT' => 100,
  ),
  5 => 
  array (
    'CONDITION' => '#^/rest/#',
    'RULE' => '',
    'ID' => NULL,
    'PATH' => '/bitrix/services/rest/index.php',
    'SORT' => 100,
  ),
);