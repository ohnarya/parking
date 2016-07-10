<?php
$dbopts = parse_url(getenv('DATABASE_URL'));

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
            'dsn' => 'pgsql:host='.$dbopts["host"]. ';port=' . $dbopts["port"].';dbname='.ltrim($dbopts["path"],'/'),
            'username' => $dbopts["user"],
            'password' => $dbopts["pass"],
        ],        
    ],
];
