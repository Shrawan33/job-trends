<?php

namespace App\Http\View\Composers;

use App\Repositories\PackageCategoryRepository;
use App\Repositories\PackageRepository;
use Illuminate\View\View;

class PackagesComposer
{
    public $repository;
    public $packageCategoryRepository;

    public function __construct(PackageCategoryRepository $packageCategoryRepo, PackageRepository $packageRepo)
    {
        $this->repository = $packageRepo;
        $this->packageCategoryRepository = $packageCategoryRepo;
    }

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $seekerProducts = ['' => ''] + $this->repository->all(['role_type' => 'jobseekers', 'is_addon' => 0, 'package_type' => 1])->pluck('title', 'id')->toArray();

        $view->with([
            'seekerProducts' => $seekerProducts
        ]);
    }
}
