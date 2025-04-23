<?php

namespace App\Repositories;

use App\Channels\SmsChannel;
use App\Classes\NotifyJobSeeker;
use App\Helpers\FunctionHelper;
use App\Models\User;
use App\Models\UserVerification;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\Log;
use App\Notifications\VerifyEmailPhoneNotification;

/**
 * Class VerificationCodeRepository
 * @package App\Repositories
 * @version January 18, 2021, 10:08 am UTC
*/

class VerificationCodeRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [];

    /**
     * Return searchable fields
     *
     * @return array
     */
    public function getFieldsSearchable()
    {
        return $this->fieldSearchable;
    }

    /**
     * Configure the Model
     **/
    public function model()
    {
        return UserVerification::class;
    }

    public function getVerificationData(array $extraData = [])
    {
        return array_merge(
            $extraData,
            [
                'mobile_verification_code' => FunctionHelper::generateRandomString(
                    config('constants.verification_code.length.phone'),
                    true
                ),
                'email_verification_code' => FunctionHelper::generateRandomString(
                    config('constants.verification_code.length.email'),
                    true
                )
            ]
        );
    }

    public function sendOtp(User $user)
    {
        $verificationData = [
            'user_id' => $user->id,
            'verification_type' => 2,
            'email_verified' => 1
        ];

        $verificationData = $this->getVerificationData($verificationData);

        $this->createAndSendVerificationCodes($user, $verificationData, 'SendOtp');
    }

    public function sendEmailPasswordResetCode(User $user)
    {
        $verificationData = [
            'user_id' => $user->id,
            'verification_type' => 2,
            'mobile_verified' => 1
        ];

        $verificationData = $this->getVerificationData($verificationData);

        $this->createAndSendVerificationCodes($user, $verificationData, 'SendVerificationCodes', ['mail']);
    }
    //send email on change of email and phone

    // ...

    public function sendEmailPhoneChangedCode(User $user, $type = 'change_mobile')
    {
        $verificationData = [
            'user_id' => $user->id,
            'verification_type' => 2
        ];

        if ($type == 'change_email') {
            $verificationData['mobile_verified'] = 1;
            $via = ['mail'];
        } else {
            $verificationData['email_verified'] = 1;
            $via = ['mail'];
        }

        $verificationData = $this->getVerificationData($verificationData);
        $this->createAndSendVerificationCodes($user, $verificationData, 'SendVerificationCodes', $via);
    }

    public function createAndSendVerificationCodes(
        User $user,
        array $verificationData,
        string $notificationName,
        array $via = []
    ) {
        $this->clearPastVerifications($user->id);

        $userVerification = $this->create($verificationData);
        Log::info('before sending verification ', ['verificationData' => $verificationData]);
        (new NotifyJobSeeker($user, $userVerification, $notificationName, $via))->notify();
    }

    public function startUserRegistration(User $newUser)
    {
        $verificationData = [
            'user_id' => $newUser->id,
            'verification_type' => 1
        ];

        $via = [];

        if ($newUser->isEmailVerified()) {
            $verificationData['email_verified'] = 1;
            array_push($via, SmsChannel::class);
        }

        if ($newUser->isPhoneVerified()) {
            $verificationData['mobile_verified'] = 1;
            array_push($via, 'mail');
        }

        $verificationData = $this->getVerificationData($verificationData);

        $this->createAndSendVerificationCodes($newUser, $verificationData, 'SendVerificationCodes', $via);
    }

    public function clearPastVerifications(int $userId)
    {
        return $this->model()::whereUserId($userId)->delete();
    }

    public function getUserVerificationData(int $userId)
    {
        return $this->model()::whereUserId($userId)->first();
    }

    public function makeUserDataVerified(int $userId, string $verification)
    {
        $updateData = [];

        switch ($verification) {
            case 'email':
                $updateData['email_verified'] = 1;
                break;

            case 'phone':
                $updateData['mobile_verified'] = 1;
                break;
        }

        return $this->model()::whereUserId($userId)->update($updateData);
    }
}
