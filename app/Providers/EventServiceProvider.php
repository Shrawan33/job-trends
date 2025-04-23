<?php

namespace App\Providers;

use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        'App\Events\NewUser' => [
            'App\Listeners\SendVerificationCodes',
        ],
        'App\Events\UserContactVerified' => [
            'App\Listeners\MakeContactVerified',
        ],
        'App\Events\LoginMobileUser' => [
            'App\Listeners\SendMobileOtp',
        ],
        'App\Events\ResetPasswordThroughEmail' => [
            'App\Listeners\SendEmailPasswordResetCode',
        ],
        'App\Events\CreditUtilizationEvent' => [
            'App\Listeners\CreditUtilizationListener',
        ],
        'App\Events\ImageSizeReset' => [
            'App\Listeners\ImageSizeResetListener',
        ],
        'App\Events\ImageResize' => [
            'App\Listeners\ImageResizeListener',
        ],
        'App\Events\ChangeEmailThroughEmail' => [
            'App\Listeners\SendEmailPhoneChangeCode',
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
