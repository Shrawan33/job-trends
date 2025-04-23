<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\App;

class UserVerification extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    public $fillable = [
        'user_id',
        'mobile_verification_code',
        'email_verification_code',
        'verification_type',
        'mobile_verified',
        'email_verified',
    ];

    public function getEmailVerificationCode()
    {
        return $this->email_verification_code;
    }

    public function getMobileVerificationCode()
    {
        return $this->mobile_verification_code;
    }

    public function isVerificationCodeCorrect(string $verificationCode, string $verification)
    {
        $result = false;

        switch ($verification) {
            case 'email':
                $result = $this->email_verification_code == $verificationCode;
                break;

            case 'phone':
                $result = $this->mobile_verification_code == $verificationCode;
                break;
        }

        //added for testing. remove this condition once on production
        if (App::environment(['local', 'development']) && $verificationCode == config('constants.verification_code.fake')) {
            $result = true;
        }

        return $result;
    }

    public function verificationDone()
    {
        $sms_access = Configuration::getSessionConfigurationName(['general'], null, 'sms_access');
        if ($sms_access) {
            return $this->mobile_verified == 1 && $this->email_verified == 1;
        } else {
            return $this->email_verified == 1;
        }
    }
}
