<?php

namespace App\Console\Commands;

use App\Repositories\EmployerJobRepository;
use Illuminate\Console\Command;
use App\Helpers\FunctionHelper;
use App\Notifications\JobExpiredNotification;
use Throwable;

class SendExpirationDate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'employerjob:expired';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Expired job on expiration date.';
    private $employerJobRepository;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(EmployerJobRepository $employerJobRepo)
    {
        parent::__construct();
        $this->employerJobRepository = $employerJobRepo;
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        try {
            // code to expire job on date of expiration_date.
            $date = FunctionHelper::today(false, true);

            $employerJobs = $this->employerJobRepository->all(['raw_query' => "expiration_date <= '$date'"]);
        // dd($employerJobs);
            if ($employerJobs->count() > 0) {
                // dd("Hello");
                foreach ($employerJobs as $employerJob) {
                    // dd($employerJob);
                    $employerJob->notify(new JobExpiredNotification($employerJob));
                    // $employerJob->notify(new JobExpiredNotification());
                    $this->employerJobRepository->delete($employerJob->id);

                    // $employerJob->is_deleted = 1;
                    // $employerJob->save();
                }
            }
        } catch (Throwable $e) {
            throw $e;
        }
        return 0;
    }


}
