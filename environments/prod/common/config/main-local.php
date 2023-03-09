<?php
return [
    'components' => [
        'mysql' => [
            'class' => 'yii\db\Connection',
            'dsn' => 'mysql:host=localhost;dbname=bobr.yii2',
            'username' => 'root',
            'password' => '',
            'charset' => 'utf8',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'viewPath' => '@common/mail',
            'messageConfig' => [
                'from' => ['support@example.com' => 'Site']
            ],
        ],
        'robokassa' => [
            'class' => '\robokassa\Merchant',
            'baseUrl' => 'https://auth.robokassa.ru/Merchant/Index.aspx',
            'sMerchantLogin' => '',
            'sMerchantPass1' => '',
            'sMerchantPass2' => '',
        ],
    ],
];
