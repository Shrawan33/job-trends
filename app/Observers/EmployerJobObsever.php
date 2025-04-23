<?php

namespace App\Observers;

use App\Events\CreditUtilizationEvent;
use App\Models\Configuration;
use App\Models\EmployerJob;
use App\Repositories\UserPackageRepository;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;
use Throwable;

class EmployerJobObsever
{
    private $userPackageRepository;

    public function __construct(UserPackageRepository $userPackageRepository)
    {
        $this->userPackageRepository = $userPackageRepository;
    }

    public function creating(EmployerJob $employerJob)
    {
        try {
            if (auth()->user()->hasRole('employer') && Configuration::getSessionConfigurationName(['general'], null, 'package_access')) {
                $userPackage = $employerJob->createdByUser->activeUserPackage;
                throw_if(empty($userPackage), BadRequestException::class, trans('message.no_active_plan_available'));

                $this->userPackageRepository->creditLimitExceed('job_posts');
            }
            $title = str_replace(' ', '', $employerJob->title);
            $company = str_replace(' ', '', $employerJob->createdByUser->company_name);
            $location = str_replace(' ', '', $employerJob->location->title);
            $experience = $employerJob->experience ? str_replace(' ', '', $employerJob->experience->title) : '';
            $concateFields = "$title" . ' ' . "$company" . ' ' . "$location" . ' ' . "$experience";
            $slug = Str::slug($concateFields, '-');
            $getCountBySlug = EmployerJob::whereRaw("slug like '$slug%'")->count();
            // dd($getCountBySlug);
            if (isset($getCountBySlug) && $getCountBySlug > 0) {
                $slug = Str::slug($concateFields . ' ' . $getCountBySlug, '-');
            }

            $employerJob->slug = $slug;
        } catch (Throwable $e) {
            throw $e;
        }
    }

    /**
     * Handle the employerJob "created" event.
     *
     * @param  \App\models\EmployerJob  $employerJob
     * @return void
     */
    public function created(EmployerJob $employerJob)
    {
        if (auth()->user()->hasRole('employer') && Configuration::getSessionConfigurationName(['general'], null, 'package_access')) {
            $userPackage = $employerJob->createdByUser->activeUserPackage;
            try {
                throw_if(empty($userPackage), BadRequestException::class, trans('message.no_active_plan_available'));
                CreditUtilizationEvent::dispatch($employerJob, $userPackage, 'job_posts');
            } catch (Throwable $e) {
                throw $e;
            }
        }
    }

    /**
     * Handle the employerJob "updated" event.
     *
     * @param  \App\EmployerJob  $employerJob
     * @return void
     */
    public function updated(EmployerJob $employerJob)
    {
        //
    }

    /**
     * Handle the employerJob "deleted" event.
     *
     * @param  \App\EmployerJob  $employerJob
     * @return void
     */
    public function deleted(EmployerJob $employerJob)
    {
    }

    /**
     * Handle the favorite candidate "restored" event.
     *
     * @param  \App\EmployerJob  $employerJob
     * @return void
     */
    public function restored(EmployerJob $employerJob)
    {
        //
    }

    /**
     * Handle the favorite candidate "force deleted" event.
     *
     * @param  \App\EmployerJob  $employerJob
     * @return void
     */
    public function forceDeleted(EmployerJob $employerJob)
    {
        //
    }
}
