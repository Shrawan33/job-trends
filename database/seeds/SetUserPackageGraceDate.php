<?php

use App\Helpers\FunctionHelper;
use App\Repositories\UserRepository;
use Illuminate\Database\Seeder;

class SetUserPackageGraceDate extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(UserRepository $userRepo)
    {
        foreach ($userRepo->all() as $model) {
            if ($model->hasRole('employer')) {
                if ($model->userPackages->count() > 0) {
                    foreach ($model->userPackages as $package) {
                        if (!empty($package->end_date)) {
                            $duration = $package->package_info['grace_period'] ?? 0;
                            $package->grace_date = $duration > 0 ? FunctionHelper::addDuration($package->package_info['grace_period'] ?? 0, $package->end_date, false, true) : $package->end_date;
                            $package->save();
                        }
                    }
                }
            }
        }
    }
}
