<?php
$url = parse_url("postgres://ubuntu:parking@localhost:5432/parking");
$dsn = 'pgsql:host='.$url['host'].';port='.$url['port'].';dbname='.substr($url["path"], 1);
$username = $url["user"];
$password = $url["pass"];

return [
    'components' => [
        'db' => [
            'class' => 'yii\db\Connection',
            'dsn' => $dsn,
            'username' => $username,
            'password' =>$password,
        ],  
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'viewPath' => '@common/mail',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => true,
        ],
    ],
];
?>