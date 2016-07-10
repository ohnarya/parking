<?php
if (getenv("YII_ENV") == 'prod') {
    $url = parse_url(getenv("DATABASE_URL"));
    $dsn = 'pgsql:host='.$url['host'].';port='.$url['port'].';dbname='.substr($url["path"], 1);
    $username = $url["user"];
    $password = $url["pass"];
echo("<pre>");
print_r($url);
echo("</pre>");
} else {
    $dsn = 'pgsql:host=localhost;dbname=parking';
    $username = 'ubuntu';
    $password = 'parking';
}

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
            'dsn' => $dsn,
            'username' => $username,
            'password' =>$password,
        ],        
    ],
];
