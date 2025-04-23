<?php
namespace App\Traits;

use App\Helpers\FunctionHelper;
use App\Models\PasswordResetToken;
use Illuminate\Support\Facades\Hash;

trait UserTokenHelper
{
    public function clearUserTokens($userId)
    {
        PasswordResetToken::whereUserId($userId)->delete();
    }

    public function createUserToken($userId)
    {
        $this->clearUserTokens($userId);

        $token = FunctionHelper::generateRandomString(60);

        PasswordResetToken::create([
            'user_id' => $userId,
            'token' => $token
        ]);

        return $token;
    }

    public function getUserFromToken(string $token)
    {
        $data = PasswordResetToken::with('user')->whereToken($token)->first();

        if (!empty($data->user)) {
            return $data->user;
        } else {
            return null;
        }
    }

    public function isTokenExpired(string $token)
    {
        $data = PasswordResetToken::whereToken($token)->first();

        $expired = true;

        if (!empty($data) && $data->hasTokenNotExpired()) {
            $expired = false;
        }

        return $expired;
    }

    /**
     * Set the user's password.
     *
     * @param  \Illuminate\Contracts\Auth\CanResetPassword  $user
     * @param  string  $password
     * @return void
     */
    protected function setUserPassword($user, $password)
    {
        $user->password = Hash::make($password);
    }
}
