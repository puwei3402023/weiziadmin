<?php
return [
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'db' => [
            'class' => 'yii\db\Connection',
            'dsn' => 'mysql:host=localhost;dbname=tcjdxm',
            'username' => 'root',
            'password' => 'root',
            'charset' => 'utf8',
            'tablePrefix'=>"pw_",
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
//        'db2' => [
//            'class' => 'yii\db\Connection',
////            'class'  => 'CDbConnection' ,
////            'dsn' => 'mysql:host=192.168.1.53;dbname=crm',
//            'dsn' => 'mysql:host=127.0.0.1;dbname=statbao',
//            'username' => 'root',
//            'password' => '111111',
//            'charset' => 'utf8',
//            'tablePrefix'=>"edai_",
//        ],
    ],
];
