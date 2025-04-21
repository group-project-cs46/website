<?php

return [
    'database' => [
        'host' => 'aws-0-ap-southeast-1.pooler.supabase.com',
        'port' => 6543,
        'user' => 'postgres.nqxowqbchzwpdhiogtgw',
        'password' => 'vyvwe3-xegNyt-wunxow',
        'dbname' => 'postgres',
        'charset' => 'utf8mb4',
    ],

//    'mail' => [
//        'mailer' => 'smtp',
//        'host' => 'in-v3.mailjet.com',
//        'port' => 587,
//        'username' => 'c177156b80ce436cd5535ea1f3d84c1c',
//        'password' => '07bbcd7cadd44f81f205cb5ed04de177',
//        'encryption' => 'tls',
//        'from_address' => 'admin@noufa.site',
//        'from_name' => 'traveLK',
//    ]

    'mail' => [
        'mailer' => 'smtp',
        'host' => 'email-smtp.us-east-1.amazonaws.com',
        'port' => 587,
        'username' => 'AKIAT3IPZKBSHCTVDQPR',
        'password' => 'BAQ945DlKpvWnjVpI3fvSUSqxv0hwoG007mAKmsM5VIi',
        'encryption' => 'tls',
        'from_address' => 'admin@launchpad.thathsara.lk',
        'from_name' => 'Launchpad',
    ]
];