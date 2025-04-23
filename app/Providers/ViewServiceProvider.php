<?php

namespace App\Providers;

use App\Helpers\FunctionHelper;
use App\Models\Configuration;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\View;
use App\Models\DBNotification;
use Illuminate\View\ViewServiceProvider as BaseViewServiceProvider;

class ViewServiceProvider extends BaseViewServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        parent::register();
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $entity = FunctionHelper::getEntity();

        View::composer('layouts.menu', function ($view) {
            $activeSettingsMenu = in_array(true, [
                Request::is('*roles*'),
                Request::is('*locations*'),
                Request::is('*states*'),
                Request::is('*configurations*'),
                Request::is('*criterias*'),
            ]);
            $activeReviewMenu = in_array(true, [
                Request::is('*reviewCategories*'),
                Request::is('*reviewCategoryStrengthWeeknesses*'),
                Request::is('*badges*'),
                Request::is('*ReviewUser*'),
            ]);

            $activeReportAbusesMenu = in_array(true, [
                Request::is('*index/employerjobs*'),
                Request::is('*index/employers*'),
                Request::is('*index/jobseekers*'),
            ]);

            $activeReportMenu = in_array(true, [
                Request::is('*filter-employers*'),
                Request::is('*filter-jobseekers*'),
                Request::is('*filter-employerjobs*'),
                Request::is('*filter-transaction*'),
            ]);

            $activeJobBoardMenu = in_array(true, [
                Request::is('*users*'),
                Request::is('*job-posting*'),
                Request::is('*packages*'),
                Request::is('*categories*'),
                Request::is('*skills*'),
                Request::is('*salaries*'),
                Request::is('*experiences*'),
                Request::is('*qualifications*'),
                Request::is('*interviewTypes*'),
                Request::is('*workTypes*'),
                Request::is('*certifications*'),
                Request::is('*specializations*')
            ]);

            $impAnnouncements = in_array(true, [
                Request::is('*important-announcement*'),
            ]);

            $activeContentMenu = in_array(true, [
                Request::is('*bannerManagements*'),
                Request::is('*blogs*'),
                Request::is('*events*'),
                Request::is('*faqs*'),
                Request::is('*testimonials*'),
                Request::is('*cms*'),
            ]);
            $view->with('activeSettingsMenu', $activeSettingsMenu)->with('activeReportAbusesMenu', $activeReportAbusesMenu)->with('activeJobBoardMenu', $activeJobBoardMenu)->with('impAnnouncements', $impAnnouncements)->with('activeContentMenu', $activeContentMenu)->with('activeReportMenu', $activeReportMenu)->with('activeReviewMenu', $activeReviewMenu);
        });

        // composer to provide model's current state[active/archive/delete,etc..] to datatables_actions.
        View::composer(['*.datatables_actions', '*.extra_action_buttons', 'components.status'], function ($view) use ($entity) {
            $url = $view->href_url ?? false;
            if (method_exists($view->model, 'getCurrentState')) {
                $view->with($view->model->getCurrentState() + ['href_url' => $url] + ['entity' => $entity] + ['model' => $view->model] + ['permissionModule' => $entity['targetModel'] ?: null]);
            } else {
                $view->with(['entity' => $entity] + ['href_url' => $url] + ['model' => $view->model] + ['permissionModule' => $entity['targetModel'] ?: null]);
            }
        });
        View::composer(['components.admin.report_abuse_status'], function ($view) {
            // dd($view, 2);
            if (method_exists($view->model, 'getCurrentState')) {
                $view->with($view->model->getCurrentState() + ['entity' => $view->entity] + ['model' => $view->model] + ['permissionModule' => $view->entity['targetModel'] ?: null]);
            } else {
                $view->with(['entity' => $view->entity] + ['model' => $view->model] + ['permissionModule' => $view->entity['targetModel'] ?: null]);
            }
        });

        View::composer('layouts.admin', function ($view) {
            if (Auth::user() && Auth::user()->hasRole('admin|mentor|account')) {
                $routes = [
                    'logoutRoute' => route('staff.logout'),
                    'homeRoute' => route('dashboard.index'),   ];
                $view->with($routes);
            }
            if (Auth::user() && Auth::user()->hasRole('mentor')) {
                $routes = [
                    'logoutRoute' => route('staff.logout'),
                    'homeRoute' => route('mentor_candidates.index'),   ];
                $view->with($routes);
            }
            if (Auth::user() && Auth::user()->hasRole('account')) {
                $routes = [
                    'logoutRoute' => route('staff.logout'),
                    'homeRoute' => route('account-dashboard.index'),   ];
                $view->with($routes);
            }
        });

        View::composer(['layouts.front', 'layouts.admin', 'employer_jobs.*', 'application_trackings.*', 'messages.*', 'candidates.index', 'welcome','front_pages.about', 'candidates.*', 'shortlisted_candidate.*'], function ($view) {


            $package_access = [
                'package_access' => Configuration::getSessionConfigurationName(['general'], null, 'package_access')
            ];
            $view->with($package_access);
        });

        View::composer(['auth.login'], function ($view) {

            $sms_access = [
                'sms_access' => Configuration::getSessionConfigurationName(['general'], null, 'sms_access')
            ];
            $view->with($sms_access);
        });

        // View::composer('layouts.front', function ($view) {
        //     if (Auth::user()) {
        //         $userId = Auth::user()->id;
        //         $routes = [
        //             'notificationUnreadCount' => DBNotification::OfTypes(['SendMessage', 'SendMessageIndividual'])
        //                 ->where('notifiable_id', $userId)
        //                 ->whereNull('read_at')
        //                 ->count()
        //         ];
        //         // dd($routes);
        //         $view->with($routes);
        //     }
        // });
        View::composer('layouts.front', function ($view) {
            if (Auth::check()) {
                $userId = Auth::user()->id;
                $routes = [
                    'notificationUnreadCount' => DBNotification::OfTypes(['SendMessage', 'SendMessageIndividual'])
                        ->where('notifiable_id', $userId)
                        ->whereNull('read_at')
                        ->count()
                ];
                $view->with($routes);
            } else {
                $view->with('notificationUnreadCount', 0);
            }
        });


        View::composer(
            ['layouts.front', 'cart.checkout'],
            'App\Http\View\Composers\CartComposer'
        );

        // composer for categories create/edit/show
        View::composer(
            ['categories.fields'],
            'App\Http\View\Composers\CategoryComposer'
        );

        // composer for categories create/edit/show
        View::composer(
            ['job_types.fields'],
            'App\Http\View\Composers\JobTypeComposer'
        );

        // composer for Search listings
        View::composer(
            ['components.table', 'components.admin.table', 'users.search', 'jobs.search', 'users.table', 'employer_jobs.table', 'mentor_candidates.table', 'account_dashboard.index', 'account_dashboard.table', 'filter_reports.table'],
            'App\Http\View\Composers\SearchComposer'
        );

        // composer for roles create/edit/show
        View::composer(
            ['roles.create', 'roles.edit', 'roles.show'],
            'App\Http\View\Composers\RoleComposer'
        );

        // composer for User fields
        View::composer(
            ['users.create', 'users.edit', 'users.show', 'users.assign_form', 'profiles.profile_fields', 'users.load_pdf'],
            'App\Http\View\Composers\UserComposer'
        );

        // composer for Employer job create/edit/show
        View::composer(
            ['employer_jobs.create', 'employer_jobs.edit', 'employer_jobs.show', 'employer_jobs.search-jobs', 'job_posting.create', 'job_posting.edit', 'job_posting_mentor.create', 'job_posting_mentor.edit'],
            'App\Http\View\Composers\EmployerJobComposer'
        );

        // composer for user profile
        View::composer(
            ['auth.employer.profile.edit', 'auth.employer.profile.show'],
            'App\Http\View\Composers\UserProfileComposer'
        );

        // composer for Jobseeker
        View::composer(
            ['auth.job_seeker.profile.edit', 'auth.job_seeker.profile.show','resume_builder.edit'],
            'App\Http\View\Composers\JobSeekerComposer'
        );

        // composer for Search Jobs
        View::composer(
            ['search_jobs.index', 'search_jobs.show'],
            'App\Http\View\Composers\JobSearchComposer'
        );

        // composer for Candidate
        View::composer(
            ['candidates.index', 'candidates.show', 'auth.job_seeker.show', 'candidates.partial_index', 'candidates.script', 'candidates.review'],
            'App\Http\View\Composers\CandidatesComposer'
        );

        // composer for Employer
        View::composer(
            ['employers.index', 'employers.show'],
            'App\Http\View\Composers\EmployerComposer'
        );

        // composer for application tracking
        View::composer(
            ['application_trackings.actions'],
            'App\Http\View\Composers\ApplicationComposer'
        );

        // composer for front Home
        View::composer(
            ['welcome', 'front_pages.about'],
            'App\Http\View\Composers\FrontHomeComposer'
        );

        // composer for front Home
        View::composer(
            ['apply_jobs.datatables_actions', 'apply_jobs.search'],
            'App\Http\View\Composers\ApplyJobComposer'
        );

        // composer for image upload
        View::composer(
            ['vendor.image_upload.upload', 'vendor.image_upload.display'],
            'App\Http\View\Composers\ImageCropperComposer'
        );

        // composer for Configuration create/edit/show view
        View::composer(
            ['configurations.edit'],
            'App\Http\View\Composers\ConfigurationComposer'
        );
        //composer for Specialization create/edit/show view
        View::composer(
            ['specializations.create', 'specializations.edit', 'specializations.show'],
            'App\Http\View\Composers\LocationComposer'
        );
        // composer for Location create/edit/show view
        View::composer(
            ['locations.create', 'locations.edit', 'locations.show'],
            'App\Http\View\Composers\LocationComposer'
        );

        // composer for State create/edit/show view
        View::composer(
            ['states.create', 'states.edit', 'states.show'],
            'App\Http\View\Composers\StateComposer'
        );

        // composer for front cms view
        View::composer(
            ['front_pages.about', 'front_pages.contact', 'front_pages.faq', 'front_pages.blog', 'employer', 'job-seeker'],
            'App\Http\View\Composers\FrontPageComposer'
        );

        // composer for front Score view
        View::composer(
            ['mentor_candidates.score'],
            'App\Http\View\Composers\ScoreComposer'
        );

        // composer for admin filter-report
        View::composer(
            ['filter_reports.employer', 'filter_reports.jobseeker', 'filter_reports.package', 'filter_reports.job'],
            'App\Http\View\Composers\FilterReportComposer'
        );
        View::composer(
            ['orders.search','users.load_pdf'],
            'App\Http\View\Composers\OrderComposer'
        );
        // composer for admin review category strength and weekness type
        View::composer(
            ['review_category_strength_weeknesses.create', 'review_category_strength_weeknesses.edit', 'review_category_strength_weeknesses.show'],
            'App\Http\View\Composers\ReviewCategoryStrengthWeeknessComposer'
        );

        View::composer(
            ['user_reviews.create', 'user_reviews.edit', 'user_reviews.show'],
            'App\Http\View\Composers\UserReviewsComposer'
        );

        View::composer(
            ['packages.create', 'packages.edit', 'packages.show'],
            'App\Http\View\Composers\PackagesComposer'
        );

    }
}
