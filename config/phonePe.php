<?php

return [
    'PHONEPE_MERCHANT_ID' => env('PHONEPE_MERCHANT_ID','M22I8KLF2S2MM'),
    'PHONEPE_SALT_KEy' => env('PHONEPE_SALT_KEy','1237af57-4bcd-4e40-8ab7-3353f2870846'),
    'PHONEPE_SALT_INDEX' => env('PHONEPE_SALT_INDEX','1'),
    'PHONEPE_URL' =>env('PHONEPE_URL','https://api.phonepe.com/apis/hermes/pg/v1/pay'),
    'PHONEPE_CALLBACK_URL' => env('PHONEPE_CALLBACK_URL', "https://api.phonepe.com/apis/hermes/pg/v1/status"),
];
