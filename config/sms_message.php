<?php

return [
    'url'      => env('SMS_URL', 'https://api.kavenegar.com/v1'),
    'api'      => env('SMS_API'),
    'secret'   => env('SMS_SECRET'),
    'number'   => env('SMS_LINE_NUMBER'),
    'bridge'   => \Amirmahvari\SmsMessage\Bridges\Kavenegar::class,
    'patterns' => [
        'verification' => [
            'title'     => 'کد تایید ورود و ثبت نام',//description
            'template'  => 'verification',//sms panel pattern name
            'is_active' => true,
        ],
    ],
];
