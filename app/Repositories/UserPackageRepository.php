<?php

namespace App\Repositories;

use App\Channels\SmsChannel;
use App\Classes\NotifyEmployer;
use App\Helpers\FunctionHelper;
use App\Models\Package;
use App\Models\User;
use App\Models\UserPackage;
use App\Models\UserPackageTransaction;
use Illuminate\Database\Eloquent\Builder;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;
use Throwable;

/**
 * Class UserPackageRepository
 * @package App\Repositories
 * @version April 5, 2021, 8:41 am UTC
*/

class UserPackageRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'id',
        'user_id',
        'package_id',
        'is_active',
        'end_date',
        'grace_date'
    ];

    /**
     * Return searchable fields
     *
     * @return array
     */
    public function getFieldsSearchable()
    {
        return $this->fieldSearchable;
    }

    /**
     * Configure the Model
     **/
    public function model()
    {
        return UserPackage::class;
    }

    public function subscribe($input = [], $activate = false)
    {
        try {
            $creditInfo = $input['package_info']['credit_info'] ?? [];
            $input['utilization_info'] = $creditInfo['credits'] ?? null;

            $package = $this->create($input);
            if ($activate) {
                return $this->activate($package);
            }
        } catch (Throwable $e) {
            throw $e;
        }
    }

    public function creditLimitExceed($type = '', $userPackage = [])
    {
        try {
            throw_if($type == '', BadRequestException::class, 'Credit Type is not valid, please provide valid credit type.');
            $userPackage = !empty($userPackage) ? $userPackage : auth()->user()->activeUserPackage;
            $creditInfo = $userPackage->package_info['credit_info'] ?? [];
            $deduction = $creditInfo['deduction'][$type] ?? 0;
            $remaining = $this->getTypeWiseCredit($userPackage, $type);
            if (!empty($creditInfo) && $deduction > 0) {
                throw_if($remaining < $deduction, BadRequestException::class, trans('message.insufficient_credits'));
                return false;
            }
            return true;
        } catch (Throwable $e) {
            throw $e;
            return true;
        }
    }

    public function getTypeWiseCredit($userPackage, $type = '')
    {
        try {
            throw_if($type == '', BadRequestException::class, 'Credit Type is not valid, please provide valid credit type.');
            $utilizationInfo = $userPackage->utilization_info ?? [];
            return $utilizationInfo[$type] ?? 0;
        } catch (Throwable $e) {
            throw $e;
        }
    }

    public function candidateUnlocked($user_id)
    {
        $unlocked = UserPackageTransaction::whereHasMorph(
            'transactable',
            [User::class],
            function (Builder $query) {
                $query->whereUserId(auth()->user()->id);
            }
        )->where('transactable_id', $user_id)->first();
        return  empty($unlocked) ? false : true;
    }

    public function activate(UserPackage $package)
    {
        if (auth()->user()) {
            if (!empty(auth()->user()->activeUserPackage)) {
                $this->expired(auth()->user()->activeUserPackage);
            }
        }

        $package->start_date = FunctionHelper::today(false, true);
        $package->end_date = FunctionHelper::addDuration($package->package_info['duration'] ?? 0);
        $package->grace_date = FunctionHelper::addDuration($package->package_info['grace_period'] ?? 0, $package->end_date, false, true);
        $package->is_active = 1;
        $package->save();
        return $package;
    }

    public function expired(UserPackage $package)
    {
        if (!empty($package)) {
            $package->end_date = empty($package->end_date) ? FunctionHelper::today() : $package->end_date;
            $package->grace_date = empty($package->grace_date) ? FunctionHelper::today() : $package->grace_date;
            $package->is_active = 0;
            $package->save();

            // to notify employer that the package is expired
            (new NotifyEmployer($package->user_id, $package, 'PackageExpiredReminder', ['mail'], 'expired'))->notify();
                                                                                // , SmsChannel::class
            return $package;
        }
    }

    public function expiredEndDate(UserPackage $package)
    {
        if (!empty($package)) {
            $duration = -1;
            $package->end_date = FunctionHelper::addDuration($duration ?? 0, null, false, true);
            $package->grace_date = FunctionHelper::addDuration($package->package_info['grace_period'] ?? 0, $package->end_date, false, true);

            $package->save();

            // to notify employer that the package is expired
            (new NotifyEmployer($package->user_id, $package, 'PackageExpiredReminder', ['mail'], 'beforeEndDate'))->notify();
                                                                                    // , SmsChannel::class
            return $package;
        }
    }

    public function expiredGraceDate(UserPackage $package)
    {
        if (!empty($package)) {
            $package->is_active = 0;
            $package->save();

            // to notify employer that the package is expired
            (new NotifyEmployer($package->user_id, $package, 'PackageExpiredReminder', ['mail'], 'expired'))->notify();
                                                                                    // , SmsChannel::class
            return $package;
        }
    }
}
