<?php
return [
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'authManager' => [
            'class' => 'yii\rbac\PhpManager',
            'itemFile' => '@frontend/rbac/items.php',
            'assignmentFile' => '@frontend/rbac/assignments.php',
            'ruleFile' => '@frontend/rbac/rules.php'            
        ],        
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'db' => [
            'class' => 'yii\db\Connection',
            'dsn' => 'pgsql:host=127.0.0.1;dbname=parking',
            'username' => 'ubuntu',
            'password' => 'parking',
        ],        
    ],
];
