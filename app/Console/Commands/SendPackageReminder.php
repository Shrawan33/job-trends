<?php

namespace App\Console\Commands;

use App\Channels\SmsChannel;
use App\Classes\NotifyEmployer;
use App\Helpers\FunctionHelper;
use App\Repositories\UserPackageRepository;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;
use Throwable;

class SendPackageReminder extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'subscription:reminder {event : which reminder to trigger? beforeEndDate|beforeGraceDate|subscriptionExpired}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send email to remind employer about package expiration';

    private $userPackageRepository;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(UserPackageRepository $userPackageRepo)
    {
        parent::__construct();
        $this->userPackageRepository = $userPackageRepo;
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $event = $this->argument('event');
        try {
            $events = ['beforeEndDate', 'beforeGraceDate', 'subscriptionExpired'];
            throw_if(!in_array($event, $events), BadRequestException::class, 'please choose event from beforeEndDate|beforeGraceDate|subscriptionExpired');
            switch ($event) {
                case 'beforeEndDate':
                    // code to remind employer that subscription is going to expire with the consideration of end date.
                    $duration = config('constants.duration_package_day.before_end_date') ?? 0;
                    $expiredEndDateBefore = FunctionHelper::addDuration($duration, null, false, true);
                    $this->line("for Date: $expiredEndDateBefore");
                    $subscriptions = $this->userPackageRepository->all(['is_active' => 1, 'raw_query' => "end_date like '$expiredEndDateBefore'"]);
                    if ($subscriptions->count() > 0) {
                        foreach ($subscriptions as $subscription) {
                            // (new NotifyEmployer($subscription->user_id, $subscription, 'PackageExpiredReminder', ['mail', SmsChannel::class], 'beforeEndDate'))->notify();
                            (new NotifyEmployer($subscription->user_id, $subscription, 'PackageExpiredReminder', ['mail'], 'beforeEndDate'))->notify();
                        }
                        Log::info("Notified: Before End Date -> User Packages -> {$subscriptions->pluck('id')->toJson()}");
                        $this->line("Subscriptions: {$subscriptions->pluck('id')->toJson()}");
                    }
                    break;
                case 'beforeGraceDate':
                    // code to remind employer that subscription is going to expire with the consideration of grace date.
                    $duration = config('constants.duration_package_day.before_grace_date') ?? 0;
                    $expiredGraceDateBefore = FunctionHelper::addDuration($duration, null, false, true);
                    $this->line("for Date: $expiredGraceDateBefore");
                    $subscriptions = $this->userPackageRepository->all(['is_active' => 1, 'raw_query' => "grace_date != end_date AND grace_date like '$expiredGraceDateBefore'"]);
                    if ($subscriptions->count() > 0) {
                        foreach ($subscriptions as $subscription) {
                            // (new NotifyEmployer($subscription->user_id, $subscription, 'PackageExpiredReminder', ['mail', SmsChannel::class], 'beforeGraceDate'))->notify();
                            (new NotifyEmployer($subscription->user_id, $subscription, 'PackageExpiredReminder', ['mail'], 'beforeGraceDate'))->notify();
                        }
                        Log::info("Notified: Before Grace Date -> User Packages -> {$subscriptions->pluck('id')->toJson()}");
                        $this->line("Subscriptions: {$subscriptions->pluck('id')->toJson()}");
                    }
                    break;
                case 'subscriptionExpired':
                    // code to remind employer that subscription is expired with the consideration of grace date.
                    $date = FunctionHelper::today(false, true);
                    $this->line("for Date: $date");
                    $subscriptions = $this->userPackageRepository->all(['is_active' => 1, 'raw_query' => "grace_date <= '$date'"]);
                    if ($subscriptions->count() > 0) {
                        foreach ($subscriptions as $subscription) {
                            $this->userPackageRepository->expired($subscription);
                        }
                        Log::info("Notified: Subscription Expired -> User Packages -> {$subscriptions->pluck('id')->toJson()}");
                        $this->line("Subscriptions: {$subscriptions->pluck('id')->toJson()}");
                    }
                    break;
            }
            $this->info("The event {$event} completed.");
        } catch (Throwable $e) {
            // throw $e;
            $this->error($e->getMessage());
            Log::error($e);
        }
        return 0;
    }
}
