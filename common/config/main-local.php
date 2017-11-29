<?php


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
        'mongodb' => [
            'class' => '\yii\mongodb\Connection',
            'dsn' => 'mongodb://root:secret@mongo:27017/asiaebuy-my',

        ],
        'db' => [
            'class' => 'yii\db\Connection',
            //'dsn' => 'mysql:host=127.0.0.1;dbname=migrate', //for migrate
            'dsn' => 'mysql:host=mariadb;dbname=asiaebuy',
            'username' => 'root',
            'password' => '',
            'charset' => 'utf8',
        ],

        /*'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'viewPath' => '@common/mail',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => true,
        ],*/

    ],
    
];

