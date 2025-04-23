<?php

namespace App\Models;

use Illuminate\Notifications\DatabaseNotification;

class DBNotification extends DatabaseNotification
{
    public function actor()
    {
        return $this->belongsTo(User::class, 'sender_id');
    }

    public function actorWithTrashed()
    {
        return $this->belongsTo(User::class, 'sender_id')->withTrashed();
    }

    public function scopeOfCurrentUser($query, $as = 'sender')
    {
        if (!auth()->guest()) {
            if ($as == 'both') {
                return $query->where(function($query) {
                    return $query->where('sender_id', auth()->user()->id)->orWhere('notifiable_id', auth()->user()->id);
                });
            } else if ($as == 'sender') {
                return $query->where('sender_id', auth()->user()->id);
            } else {
                $query->where('notifiable_id', auth()->user()->id);
            }
        }
        return $query;
    }

    public function scopeOfTypes($query, $types = ['SendMessage'])
    {
        $types = collect($types)->transform(function ($type) { return "App\Notifications\\$type"; })->all();
        return $query->whereIn('notifications.type', $types);
    }

    public function creditTransactions()
    {
        return $this->morphMany(UserPackageTransaction::class, 'transactable');
    }

    public function notifiableWithTrashed()
    {
        return $this->belongsTo(User::class, 'notifiable_id')->withTrashed();
    }
}
