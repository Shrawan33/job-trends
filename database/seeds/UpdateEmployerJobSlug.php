<?php

use App\Models\EmployerJob;
use Illuminate\Database\Seeder;

class UpdateEmployerJobSlug extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $employerJobs = EmployerJob::whereNull('slug')->withTrashed()->get();
        // dd($employerJobs);
        foreach ($employerJobs as $employerJob) {
            $title = $employerJob->title;
            $company = $employerJob->createdByUser ? $employerJob->createdByUser->company_name : '';
            $location = $employerJob->location ? $employerJob->location->title : '';
            $experience = $employerJob->experience ? $employerJob->experience->title : '';

            $slug = \Illuminate\Support\Str::slug("$title $company $location $experience", '-');

            echo "\n",
            $employerJob->slug = $slug;
            $employerJob->save();
        }
    }
}
