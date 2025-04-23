<?php

namespace App\Observers;

use App\Events\CreditUtilizationEvent;
use App\Models\Configuration;
use App\Models\User;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;
use Throwable;

class UserObserver
{
    public function creating(User $user)
    {
        try {
            $company = $user->company_name ? str_replace(' ', '', $user->company_name) : '';
            $first_name = $user->first_name ? str_replace(' ', '', $user->first_name) : '';
            $last_name = $user->last_name ? str_replace(' ', '', $user->last_name) : '';
            $uuid = Str::uuid();
            $concateFields = "$company" . ' ' . "$first_name" . ' ' . "$last_name" . ' ' . "$uuid";
            $slug = Str::slug($concateFields, '-');
            $user->slug = $slug;

        } catch (Throwable $e) {
            throw $e;
        }
    }

    /**
     * Handle the User "created" event.
     *
     * @param  \App\models\User  $user
     * @return void
     */
    public function created(User $user)
    {
        //
    }

    /**
     * Handle the User "updated" event.
     *
     * @param  \App\User  $user
     * @return void
     */
    public function updated(User $user)
    {
        //
    }

    /**
     * Handle the User "deleted" event.
     *
     * @param  \App\User  $user
     * @return void
     */
    public function deleted(User $user)
    {
    }

    /**
     * Handle the User "restored" event.
     *
     * @param  \App\User  $user
     * @return void
     */
    public function restored(User $user)
    {
        //
    }

    /**
     * Handle the User "force deleted" event.
     *
     * @param  \App\User  $user
     * @return void
     */
    public function forceDeleted(User $user)
    {
        //
    }
}
