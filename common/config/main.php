<?php


$cert = '/var/www/vhosts/asiaebuy.com/httpdocs/compose.crt';

$ctx = stream_context_create(array(
    "ssl" => array(
        "cafile"            => $cert,
        "allow_self_signed" => false,
        "verify_peer"       => true, 
        "verify_peer_name"  => true,
        "verify_expiry"     => true, 
    ),
));
return [
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'db' => [
            'class' => 'yii\db\Connection',
            'dsn' => 'mysql:host=103.198.68.62;dbname=cart22',
            'username' => 'leso_cart',
            'password' => 'leso_cart123',
            'charset' => 'utf8',
        ],
        'mongodb' => [
            'class' => '\yii\mongodb\Connection',
            'dsn' => 'mongodb://@aws-ap-southeast-1-portal.2.dblayer.com:15429,aws-ap-southeast-1-portal.0.dblayer.com:15429/asiaebuy-my?',
            'options' => [
                'username' => 'opencart',
                'password' => 'Amtujpino.leso',
                'ssl' => true
            ],
            'driverOptions' => [
                'context' => $ctx
            ]

        ],

        
    ],
    
];
