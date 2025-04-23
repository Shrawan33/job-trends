<?php

namespace App\Listeners;

use App\Events\CreditUtilizationEvent;
use App\Models\UserPackageTransaction;
use App\Repositories\UserPackageRepository;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;
use Throwable;

class CreditUtilizationListener
{
    private $userPackageRepository;

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(UserPackageRepository $repo)
    {
        $this->userPackageRepository = $repo;
    }

    /**
     * Handle the event.
     *
     * @param  CreditUtilizationEvent  $event
     * @return void
     */
    public function handle(CreditUtilizationEvent $event)
    {
        $userPackage = $event->userPackage;

        try {
            $limitExceed = $this->userPackageRepository->creditLimitExceed($event->type, $userPackage);
            if ($limitExceed) {
                throw_if(false, BadRequestException::class, trans('message.insufficient_credits'));
            } else {
                $creditInfo = $userPackage->package_info['credit_info'] ?? [];
                $deduction = $creditInfo['deduction'][$event->type] ?? 0;
                $utilizationInfo = $userPackage->utilization_info ?? [];

                if (!empty($creditInfo) && isset($utilizationInfo[$event->type]) && $deduction > 0) {
                    $remaining = $utilizationInfo[$event->type];
                    $available = $remaining - $deduction ?? 0;

                    // save into user package transaction table
                    $entity = $event->entity;
                    if (!empty($entity)) {
                        $transaction = (new UserPackageTransaction);
                        $transaction->fill([
                            'user_id' => $userPackage->user_id,
                            'user_package_id' => $userPackage->id,
                            'credit_type' => $event->type,
                            'deducted_credit' => $deduction,
                            'remaining_credit' => $available,
                        ]);
                        $entity->creditTransactions()->save($transaction);
                    }

                    // set reduced amount for type
                    $utilizationInfo[$event->type] = $available;
                    $userPackage->utilization_info = $utilizationInfo;
                    $userPackage->save();
                }
            }
        } catch (Throwable $e) {
            throw $e;
        }
    }
}
