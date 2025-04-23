<?php

namespace App\Providers;

use App\Channels\DatabaseChannel;
use Illuminate\Support\ServiceProvider;
use App\Mixins\StrMixin;
use App\Models\Category;
use App\Models\DBNotification;
use App\Models\EmployerJob;
use App\Models\FavoriteCandidate;
use App\Models\User;
use App\Observers\CategoryObserver;
use App\Observers\EmployerJobObsever;
use App\Observers\FavoriteCandidateObserver;
use App\Observers\UserObserver;
use Illuminate\Support\Facades\View;
use App\Http\View\Composers\LayoutComposer;
use Illuminate\Notifications\Channels\DatabaseChannel as IlluminateDatabaseChannel;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // Macro to use auto generate number module wise
        \Illuminate\Support\Str::mixin(new StrMixin);
        FavoriteCandidate::observe(FavoriteCandidateObserver::class);
        EmployerJob::observe(EmployerJobObsever::class);
        Category::observe(CategoryObserver::class);
        User::observe(UserObserver::class);
        $this->app->instance(IlluminateDatabaseChannel::class, new DatabaseChannel);
        $this->app->instance(BaseNotification::class, new DBNotification());
        View::composer('auth.job_seeker.profile.layout', LayoutComposer::class);
        View::composer('messages.datatables_actions', LayoutComposer::class);
    }
}
