<?php

use Illuminate\Database\Seeder;
use App\Repositories\EmployerJobRepository;

class UpdateJobApproval extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(EmployerJobRepository $employerJobRepo)
    {
        foreach ($employerJobRepo->all() as $employerJob) {
            $employerJob->approval_status = 1;
            $employerJob->save();
        }
    }
}
