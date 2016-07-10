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
    ],
];
