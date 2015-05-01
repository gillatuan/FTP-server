<?php

// change the following paths if necessary
$yii=dirname(__FILE__).'/../common/yii/framework/yii.php';
$config=dirname(__FILE__).'/protected/config/prod.php';

if ($_SERVER['SERVER_ADDR'] == '127.0.0.1') {
    $yii=dirname(__FILE__).'/../common/yii/framework/yii.php';
    $config=dirname(__FILE__).'/protected/config/dev.php';

// remove the following lines when in production mode
    defined('YII_DEBUG') or define('YII_DEBUG',true);
// specify how many levels of call stack should be shown in each log message
    defined('YII_TRACE_LEVEL') or define('YII_TRACE_LEVEL',3);
}

require_once($yii);
$app = Yii::createWebApplication($config);
$app->run();
