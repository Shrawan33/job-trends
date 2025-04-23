<?php

namespace App\Http\View\Composers;

use App\Models\User;
use Illuminate\View\View;

class JobTypeComposer
{
    public function __construct()
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
        $mentors = ['' => ''] + User::members(['mentor'])->get()->pluck('first_name', 'id')->toArray();

        $view->with([
            'mentors' => $mentors,
        ]);
    }
}
