<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePaymentRequest;
use App\Notifications\PaymentStatus;
use App\Repositories\PackageRepository;
use App\Repositories\PaymentRepository;
use App\Repositories\UserPackageRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Throwable;
use Transbank\Webpay\WebpayPlus\Transaction;
use Illuminate\Support\Str;
use Illuminate\Validation\UnauthorizedException;
use Perception\Libraries\Payment\Facades\PaymentFacade;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;

class PaymentController extends AppBaseController
{
    public $repository;
    private $packageRepository;
    private $userPackageRepository;

    public function __construct(PaymentRepository $paymentRepo, PackageRepository $packageRepo, UserPackageRepository $userPackageRepo)
    {
        $this->repository = $paymentRepo;
        $this->packageRepository = $packageRepo;
        $this->userPackageRepository = $userPackageRepo;
    }

    public function initDirectTransaction(CreatePaymentRequest $request, $type)
    {
        try {
            throw_if(auth()->guest(), UnauthorizedException::class, 'You are not allowed to perform this operation.');
            DB::beginTransaction();
            $data = $request->except('_token');
            $data['session_id'] = Str::uuid();
            $data['entity_type'] = array_search($type, config('constants.payment.entity_types', []));
            $data['renew_package'] = $data['renew_package'] ?? false;

            $dummySuccess = true ? ['transaction_status' => 1, 'transaction_response' => []] : []; // true, in case if dummy payment enabled

            $payment = $this->repository->create($data+$dummySuccess);

            // in case if dummy payment enabled
            $package = $this->packageRepository->find($payment->package_id, ['*'], true);
            throw_if(empty($package), BadRequestException::class, trans('message.package_not_found'));
            // added package to user's account
            $data = ['payment_id' => $payment->id, 'user_id' => $payment->created_by, 'package_id' => $payment->package_id, 'package_info' => $package->toArray()];
            $this->userPackageRepository->subscribe($data, $payment->renew_package ?? false);

            // $parameters = [
            //     'order_id' => $payment->session_id,
            //     'amount' => $payment->amount ?? 0,
            //     'billing_name' => auth()->user()->hasRole('employer') ? auth()->user()->company_name ?? null : auth()->user()->full_name ?? null,
            //     'billing_email' => auth()->user()->email ?? null,
            //     'billing_tel' => auth()->user()->phone_number ?? null,
            //     'merchant_param1' => $type,
            //     'merchant_param2' => $payment->id
            // ];

            // $view = PaymentFacade::paynow($parameters);

            DB::commit();

            // return $view;
            return redirect()->to(route('subscription.my-subscription'));

        } catch (Throwable $e) {
            DB::rollBack();
            return redirect()->back()->withInput(['toast_error' => $e->getMessage()]);
        }
        return redirect()->back()->withInput(['toast_error' => trans('message.general_error_message')]);
    }

    public function commitTransaction(Request $request)
    {
        $response = PaymentFacade::response($request);
        Log::info('Response ', ['method' => $request->method(), 'response' => $response]);
        $type = $response['merchant_param1'] ?? null;
        throw_if(empty($type), BadRequestException::class, 'Your request is not valid');
        // dd($response, $type);
        $input = ['toast_success' => "Payment for $type has been successfully completed."];
        $url = route('subscription.my-subscription');
        $package = null;
        try {
            $payments = $this->repository->all(['session_id' => $response['order_id']]);
            throw_if($payments->count() == 0, BadRequestException::class, 'Payment for the given request is not found.');
            Log::info('after_payment_obj', ['payment' => $payments]);
            // $response = (new Transaction)->commit($request->get('token_ws'));
            $status = $response['order_status'] == 'Success' ? 1 : 2;
            try {
                //code...
                $data = ['transaction_status' => $status, 'transaction_response' => $response];
                Log::info('payment_status', ['data' => $data]);
                $payment = $this->repository->update($data, $payments->first()->id);
            } catch (\Throwable $th) {
                throw $th;
            }

            if ($status == 2) {
                Log::info('after_payment_error', ['payment' => $payment]);
                $input = ['toast_error' => "Payment for $type has been failed, please try again."];
            } else {
                // to assign package to the user on successful payment
                if (!empty($payment->package_id)) {
                    Log::info('after_status', ['payment' => $payment->package_id]);
                    $package = $this->packageRepository->find($payment->package_id, ['*'], true);
                    throw_if(empty($package), BadRequestException::class, trans('message.package_not_found'));
                    // added package to user's account
                    $data = ['payment_id' => $payment->id, 'user_id' => $payment->created_by, 'package_id' => $payment->package_id, 'package_info' => $package->toArray()];
                    $this->userPackageRepository->subscribe($data, $payment->renew_package ?? false);
                }
                Log::info('after_package_id', ['payment' => $payment->package_id]);
                // notify user about successful payment of Cover Video / DISC Test / [Package/Plan/Subscription].
                $payment->createdByUser->notify(new PaymentStatus($type, $package ?? null));
            }
        } catch (Throwable $e) {
            Log::info('after_payment_catch', ['e' => $e]);
            return redirect()->to($url)->withInput(['toast_error' => $e->getMessage()]);
        }
        return redirect()->to($url)->withInput($input);
    }
}
