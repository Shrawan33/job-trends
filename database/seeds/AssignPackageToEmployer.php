<?php

use App\Repositories\PackageRepository;
use App\Repositories\UserPackageRepository;
use App\Repositories\UserRepository;
use Illuminate\Database\Seeder;

class AssignPackageToEmployer extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(UserRepository $userRepo, PackageRepository $packageRepo, UserPackageRepository $userPackageRepo)
    {
        foreach ($userRepo->all() as $model) {
            if ($model->hasRole('employer')) {
                $package = $packageRepo->all(['is_default' => 1])->first();

                $data = ['user_id' => $model->id, 'package_id' => $package->id, 'package_info' => $package->toArray()];
                $activePackage = $userPackageRepo->all(['user_id' => $model->id]);
                if ($activePackage->count() == 0) {
                    $userPackageRepo->subscribe($data, true);
                }
            }
        }
    }
}
