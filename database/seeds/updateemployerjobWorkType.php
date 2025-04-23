<?php

use App\Models\EmployerJob;
use App\Models\EmployerJobWorkType;
use Illuminate\Database\Seeder;

class updateemployerjobWorkType extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $employerJobsId = EmployerJob::whereNotNull('work_type_id')->pluck('work_type_id', 'id');
        foreach ($employerJobsId as $id => $workTypeId) {
            $data = EmployerJobWorkType::where(['employer_job_id' => $id, 'work_type_id' => $workTypeId]);

            if ($data->get()->count() > 1) {
                $data->forceDelete();
            } elseif ($data->get()->count() == 0) {
                $array = [
                    'employer_job_id' => $id,
                    'work_type_id' => $workTypeId
                ];
                EmployerJobWorkType::create($array);
            }
        }
    }
}
