<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');
// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
require_once(dirname(__FILE__) . '/../configSetting/params.php');

Yii::setPathOfAlias('common', dirname(__FILE__) . '/../../../common');

return array(
    'basePath'   => dirname(__FILE__) . DIRECTORY_SEPARATOR . '..',
    'name'       => 'My Web Application',
    'language'   => 'vi',
    // preloading 'log' component
    'preload'    => array('log'),

    // autoloading model and component classes
    'import'     => array(
        'application.models.*',
        'application.components.*',
        'application.extensions.*',
        'common.*',
        'application.modules.SuperAdmin.models.Cache',
        'application.modules.SuperAdmin.models.Lookup',
        'application.modules.Admin.models.*',
    ),
    'modules'    => array(
        'SuperAdmin' => array(),
        'Admin'      => array(),
        'Shop'       => array(),
        'News'       => array(),
    ),
    // application components
    'components' => array(
        'db'           => array(
            'connectionString' => 'mysql:host=' . DB_HOST . ';port=' . DB_PORT . ';dbname=' . DB_NAME,
            'emulatePrepare'   => true,
            'username'         => DB_USER,
            'password'         => stripslashes(DB_PSWD),
            'charset'          => 'utf8',
        ),
        'clientScript' => array(
            'class'              => 'common.packagecompressor.PackageCompressor',
            'coreScriptPosition' => 2,
            //  POS_HEAD=0, POS_BEGIN=1, POS_END=2, POS_LOAD=3, POS_READY=4;
            'packages'           => array(
                'allJs'   => array(
                    'baseUrl' => 'themes/Frontend/js',
                    'depends' => array('maskedinput'),
                    'js'      => array(
//                        'jquery.js',
                        'jquery.bxslider.min.js',
                        'cloud-zoom.1.0.2.js',
                        'myScript.js',
                        'scriptLoad.js',
                    ),
                ),
                /*'allJsBk' => array(
                    'baseUrl' => 'themes/Backend/js',
                    'depends' => array(),
                    // requires write permission for this directory
                    'js'      => array(
                        'jquery.js' => false,
                        'jquery-ui.min.js',
                        'simpla.jquery.configuration.js',
                        'menudrop.js',
                        'common.js',
                        'multi-delete.js',
                        'jquery.uploadfile.min.js',
                        'facebox.js',
                    ),
                ),*/
            ),
        ),
        // uncomment the following to enable URLs in path-format
        'urlManager'=>require(dirname(__FILE__).'/../configSetting/rewriteUrl.php'),

        'request'      => array(
            'class' => 'application.components.HttpRequest',
            'enableCookieValidation' => true,
//            'enableCsrfValidation'=>true,
        ),
        'user'=>array(
            // enable cookie-based authentication
            'allowAutoLogin'=>true,
            'class'=>'WebUser',
        ),
        /*'authManager'=>array(
            'class'=>'CDbAuthManager',
            'connectionID'=>'db',
            'itemTable'=>'authitem',
            'itemChildTable'=>'authitemchild',
            'assignmentTable'=>'authassignment',
        ),*/
        // UserCounter
        'counter'      => array(
            'class' => 'common.UserCounter',
        ),
        'errorHandler' => array(
            // use 'site/error' action to display errors
            'errorAction' => 'site/error',
        ),
        'mail'         => array(
            'class'            => 'common.yii-mail.YiiMail',
            'transportType'    => 'smtp',
            // php
            'transportOptions' => array(
                'host'       => SMTP_HOST,
                'username'   => SMTP_USERNAME,
                'password'   => SMTP_PASSWORD,
                'port'       => SMTP_PORT,
                'encryption' => SMTP_SECURE,
            ),
            'logging'          => true,
            'dryRun'           => false
        ),
    ),
    // application-level parameters that can be accessed
    // using Yii::app()->params['paramName']
    'params'     => require_once(dirname(__FILE__) . '/params.php'),
);
