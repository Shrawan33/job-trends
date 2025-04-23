<?php

return [
    'contents' => [
        'new_job' => 'Hello @name, new job matching your job alert is available now. Please login to ' . config('app.name') . ' to review it.',
        'mobile_verification' => 'OTP for Login Transaction on ' . config('app.name') . '. is @code and valid for 10 Minutes. Do not share this OTP to anyone for security reasons',
        'email_verification' => 'Hello @name, @code is your verification code to verify your email for ' . config('app.name') . '. Please do not share it with anyone.',
        'mobile_otp' => 'OTP for Login Transaction on Teacher Mount is @code and valid for 10 Minutes. Do not share this OTP to anyone for security reasons.',
        'job_application' => 'Hello @employer, @name has applied on your Job. Please login to ' . config('app.name') . '.',
        'package_expired_end_date' => 'Hello @employer, ' . config('app.name') . ' package is going to expired' . config('constants.duration_package_day.before_end_date') . '.',
        'package_expired_grace_date' => 'Hello @employer, ' . config('app.name') . ' package is going to expired' . config('constants.duration_package_day.before_grace_date') . '.',
        'package_expired' => 'Hello @employer,' . config('app.name') . ' Your Package is expired.',
        'chat_content' => 'Hello @name, @message',
    ],
];
