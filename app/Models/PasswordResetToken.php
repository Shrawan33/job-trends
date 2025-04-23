<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class PasswordResetToken extends Model
{
    public $fillable = [
        'user_id',
        'token'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function hasTokenExpired()
    {
        if (Carbon::parse($this->attributes['created_at'])->addSeconds(config('constants.token_valid_till')) > Carbon::now()) {
            return false;
        }

        return true;
    }

    public function hasTokenNotExpired()
    {
        return !$this->hasTokenExpired();
    }
}
