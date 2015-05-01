<?php

return CMap::mergeArray(
    require(dirname(__FILE__).'/main.php'),
    array(
        'modules'    => array(
            // uncomment the following to enable the Gii tool
            'gii'        => array(
                'class'          => 'system.gii.GiiModule',
                'password'       => '123',
                // If removed, Gii defaults to localhost only. Edit carefully to taste.
                'ipFilters'      => array(
                    '127.0.0.1',
                    '::1'
                ),
            ),
        ),
        // application components
        'components' => array(
            // uncomment the following to use a MySQL database
            'log'          => array(
                'class'  => 'CLogRouter',
                'routes' => array(
                    /*array(
                        'class'=>'CProfileLogRoute',
                        'levels'=>'trace, info, error, warning, profile',
                    ),
                    array(
                        'class'=>'CFileLogRoute',
                        'logFile'=>'application.log',
                        'levels'=>'error, warning',
                        'filter' => 'CLogFilter',
                    ),
                    array(
                        'class'   => 'CFileLogRoute',
                        'logFile' => 'cron_trace.log',
                        'levels'  => 'trace',
                        'filter'  => 'CLogFilter',
                    ),*/
                    // uncomment the following to show log messages on web pages
                    /*
                    array(
                        'class'=>'CWebLogRoute',
                    ),*/
                ),
            ),
            'cache'        => array(
                'class' => 'system.caching.CFileCache',
            ),
        ),
    )
);
