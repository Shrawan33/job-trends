<?php

use App\Repositories\UserRepository;
use Illuminate\Database\Seeder;

class SetDefaultUserCode extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(UserRepository $userRepo)
    {
        foreach ($userRepo->all() as $model) {
            $field = $model->hasRole('jobseeker') ? 'jobseeker_number' : 'employer_number';
            $model->user_code = \Illuminate\Support\Str::getNextNumber($field, $model->id, null);
            $model->save();
        }
    }
}
