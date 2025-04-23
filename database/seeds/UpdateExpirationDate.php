<?php

use App\Helpers\FunctionHelper;
use App\Repositories\EmployerJobRepository;
use Illuminate\Database\Seeder;

class UpdateExpirationDate extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(EmployerJobRepository $employerJobRepo)
    {
        $date = FunctionHelper::today(false, true);
        $date = FunctionHelper::dateToString($date, false);
        $date->addMonths(3);
        foreach ($employerJobRepo->all() as $employerJob) {
            $employerJob->expiration_date = $date->format('Y-m-d');
            $employerJob->save();
        }
    }
}
