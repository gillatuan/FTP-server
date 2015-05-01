<?php
return CMap::mergeArray(
    require(dirname(__FILE__).'/main.php'),
    array(
        // application components
        'components' => array(
            // uncomment the following to use a MySQL database
            'log'=>array(
                'class'=>'CLogRouter',
                'routes'=>array(
                    array(
                        'class'=>'CFileLogRoute',
                        'levels'=>'error, warning',
                    ),
                ),
            ),
            'cache'        => array(
                'class' => 'CMemCache',
                'servers'=>array(
                    array(
                        'host'=>'localhost',
                        'port'=>11211,
                        'weight'=>60,
                    ),
                ),
            ),
        ),
    )
);
