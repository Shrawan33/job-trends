<?php

namespace App\Http\View\Composers;

use App\Models\DBNotification;
use App\Repositories\AreaRepository;
use App\Repositories\CategoryRepository;
use Illuminate\View\View;

use App\Repositories\LocationRepository;
use App\Repositories\StateRepository;
use Illuminate\Support\Facades\Auth;

class LayoutComposer
{


    public function __construct(  )
    {



    }

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {

        if (Auth::user()) {
            $notificationUnreadCount = DBNotification::OfTypes(['SendMessage', 'SendMessageIndividual'])
                ->where('notifiable_id', auth()->user()->id)
                ->whereNull('read_at')
                ->count();

            $view->with('notificationUnreadCount', $notificationUnreadCount);
        }
    }
}
