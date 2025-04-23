<?php

namespace App\Http\Controllers\Front;

use App\Events\CreditUtilizationEvent;
use App\Http\Controllers\AppBaseController;
use App\Repositories\PackageCategoryRepository;
use App\Repositories\PackageRepository;
use App\Repositories\UserPackageRepository;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;
use Throwable;

class SubscriptionController extends AppBaseController
{
    public $repository;
    public $userPackageRepository;
    public $packageCategoryRepository;

    public function __construct(PackageRepository $packageRepo, UserPackageRepository $userPackageRepo, PackageCategoryRepository $packageCategoryRepo)
    {
        $this->repository = $packageRepo;
        $this->userPackageRepository = $userPackageRepo;
        $this->packageCategoryRepository = $packageCategoryRepo;
    }

    public function plans()
    {
        return view('subscriptions.plans', ['items' => $this->repository->all(['is_default' => 0, 'role_type' => 'jobseekers'])]);
    }

    public function subscribe(Request $request)
    {
        try {
            $package = $this->repository->find($request->get('package_id'));

            if (empty($package)) {
                return redirect()->back()->withInput(['toast_error' => trans('message.package_not_found')]);
            }

            $input = $request->except('_token');
            $input['package_info'] = $package->toArray();
            $renew = $request->get('renew', 0);

            $this->userPackageRepository->subscribe($input, $renew == 1 ? true : false);

            return redirect(route('subscription.my-subscription'))->withInput(['toast_success' => trans('message.package_subscribed_successfully')]);
        } catch (Throwable $e) {
            return redirect()->back()->withInput(['toast_error' => $e->getMessage()]);
        }
    }

    /**
     * mySubscription function
     *
     * @param Request $request
     * @return void
     */
    public function mySubscription(Request $request)
    {
        $userPackage = auth()->user()->activeUserPackage;
        $availablePackages = auth()->user()->userAvailablePackages;
        $pastPackages = auth()->user()->userPastPackages;

        return view('subscriptions.my-subscription', compact('userPackage', 'availablePackages', 'pastPackages'));
    }

    public function activatePlan($id)
    {
        try {
            $userPackage = $this->userPackageRepository->find($id, ['*'], true);

            if (empty($userPackage)) {
                return redirect()->back()->withInput(['toast_error' => trans('message.package_not_found')]);
            }

            $userPackage = $this->userPackageRepository->activate($userPackage);
            return redirect(route('subscription.my-subscription'))->withInput(['toast_success' => trans('message.activate_successful')]);
        } catch (Throwable $e) {
            return redirect()->back()->withInput(['toast_error' => $e->getMessage()]);
        }
    }

    public function unlockCandidate(UserRepository $userRepo, $id = 0)
    {
        $candidate = $userRepo->find($id);

        if (empty($candidate)) {
            return redirect()->back()->withInput(['toast_error' => trans('message.no_user')]);
        }

        try {
            $userPackage = auth()->user()->activeUserPackage;
            throw_if(empty($userPackage), BadRequestException::class, trans('message.no_active_plan_available'));
            CreditUtilizationEvent::dispatch($candidate, $userPackage, 'profile');
        } catch (Throwable $e) {
            return redirect()->back()->withInput(['toast_error' => $e->getMessage()]);
        }
        return redirect()->back()->withInput(['toast_success' => trans('message.profile_unlocked_successfully')]);
    }

    public function expireCurrentPackage($id)
    {
        try {
            $userPackage = $this->userPackageRepository->find($id, ['*'], true);

            if (empty($userPackage)) {
                return redirect()->back()->withInput(['toast_error' => trans('message.package_not_found')]);
            }

            $userPackage = $this->userPackageRepository->expiredEndDate($userPackage);
            return redirect(route('subscription.my-subscription'))->withInput(['toast_success' => trans('message.expireCurrentPackage')]);
        } catch (Throwable $e) {
            return redirect()->back()->withInput(['toast_error' => $e->getMessage()]);
        }
    }

    public function expireGraceCurrentPackage($id)
    {
        try {
            $userPackage = $this->userPackageRepository->find($id, ['*'], true);

            if (empty($userPackage)) {
                return redirect()->back()->withInput(['toast_error' => trans('message.package_not_found')]);
            }

            $userPackage = $this->userPackageRepository->expiredGraceDate($userPackage);
            return redirect(route('subscription.my-subscription'))->withInput(['toast_success' => trans('message.expireCurrentPackage')]);
        } catch (Throwable $e) {
            return redirect()->back()->withInput(['toast_error' => $e->getMessage()]);
        }
    }

    public function expertisePlans()
    {
        $expertise_plan = $this->packageCategoryRepository->all([], null, null, [], [], ['created_at' => 'desc']);
        //dd($expertise_plan);
        return view('subscriptions.expertise-plan-categories', ['items' => $expertise_plan]);
    }

    public function servicePlan()
    {
        return view('subscriptions.service-plans', ['items' => $this->repository->all(['role_type' => 'jobseekers', 'package_type' => 2])]);
    }

    public function empsevices(Request $request)
{
    try {
        $packages = $this->repository->getEmployerPackages();
        $job_posting_packages = $packages->where('employer_package_type', 1);
        $profile_access_packages = $packages->where('employer_package_type', 2);

        return view('subscriptions.employer-expertise-plans', ['packages' => $packages, 'job_posting_packages' => $job_posting_packages, 'profile_access_packages' => $profile_access_packages]);
    } catch (Throwable $e) {
        return redirect()->back()->withInput(['toast_error' => $e->getMessage()]);
    }
}

    public function sevices()
    {
        return view('subscriptions.expertise-plans', ['items' => $this->repository->all(['role_type' => 'jobseekers', 'package_type' => 1, 'is_addon' => 0], null, null, ['*'], ['addOns'])]);
    }

    public function interviewPlans()
    {
        return view('subscriptions.interview-plans', ['items' => $this->repository->all(['role_type' => 'jobseekers', 'package_type' => 5, 'is_addon' => 0])]);
    }
    public function militaryService()
    {
        return view('subscriptions.military-service', ['items' => $this->repository->all(['role_type' => 'jobseekers', 'package_type' => 4, 'is_addon' => 0])]);
    }
    public function career_service()
    {
        return view('subscriptions.career_service');
    }


}
