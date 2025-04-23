<?php

use App\Repositories\JobSeekerDetailRepository;
use Illuminate\Database\Seeder;

class UpdateNationalitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(JobSeekerDetailRepository $jobSeekerDetailRepo)
    {
        foreach ($jobSeekerDetailRepo->all() as $model) {
            $model->nationality = 1;
            $model->save();
        }
    }
}
