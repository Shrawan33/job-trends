<?php

namespace App\Http\Controllers\Front;

use App\Classes\Cart;
use App\Classes\NotifyAdmin;
use App\Classes\NotifyCandidate;
use App\Helpers\FunctionHelper;
use App\Http\Controllers\AppBaseController;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProcessPaymentRequest;
use App\Notifications\AdminReviewNotification;
use App\Notifications\PackagePurchaseNotification;
use App\Notifications\PaymentStatus;
use App\Repositories\CartRepository;
use App\Repositories\PackageRepository;
use Illuminate\Http\Request;
use App\Repositories\DocumentRepository;
use App\Repositories\OrderDetailRepository;
use App\Repositories\UserPackageRepository;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Laracasts\Flash\Flash;
use Illuminate\Support\Str;
use Razorpay\Api\Api;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;
use Throwable;
use Ixudra\Curl\Facades\Curl;
use App\Services\PhonePeRequest;


class CartController extends AppBaseController
{
    public $repository;
    public $documentRepository;
    public $cartRepository;
    public $orderDetailRepository;
    public $userPackageRepository;
    protected $cartService;
    private $disk = 'order';

    public function __construct(PackageRepository $packageRepo, Cart $cartService, DocumentRepository $documentRepo, CartRepository $cartRepo, OrderDetailRepository $orderDetailRepo, UserPackageRepository $userPackageRepo) {

        $this->repository = $packageRepo;
        $this->cartService = $cartService;
        $this->getEntity(null, $this->disk);
        $this->documentRepository = $documentRepo;
        $this->cartRepository = $cartRepo;
        $this->orderDetailRepository = $orderDetailRepo;
        $this->userPackageRepository = $userPackageRepo;
        $this->documentRepository->setDisk($this->disk);
    }

    public function addToCart(Request $request) {

        try {
            $input = $request->all();
            //dd($input);
            if ($input['addOn']) {
                foreach ($input['addOn'] as $key => $addOn) {
                    $addedCart = $this->cartService->addToCart($addOn);
                    if (isset($addedCart['error']) && $addedCart['error'] == 1) {

                        Flash::error('Unable to add different type of product!. Please remove other type product from cart first.');
                        return redirect()->route('cart.list')->withInput(['toast_error' => 'Unable to add different type of product!. Please remove other type product from cart first.']);
                    }
                }
            }

            return redirect()->route('cart.list')->with('success', 'Product add to cart successfully!');
        } catch (\Exception $e) {

            return redirect()->back()->with('error', $e->getMessage());
        }
        return redirect()->route('cart.list')->with('success', 'Product add to cart successfully!');
    }

    public function addItemToCart($id) {
        try {
            $addedCart = $this->cartService->addToCart($id);
            if (isset($addedCart['error']) && $addedCart['error'] == 1) {
                Flash::error('Unable to add different type of product!. Please remove other type product from cart first.');
                return redirect()->route('cart.list')->withInput(['toast_error' => 'Unable to add different type of product!. Please remove other type product from cart first.']);
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
        return redirect()->route('cart.list')->with('success', 'Product add to cart successfully!');
    }

    public function listCart() {
        $cartItems = $this->cartService->getCartItems();

        $cartTotal = $this->cartService->getTotal();
        $addOns = $this->cartService->getAddonItems();

        return view($this->entity['view'] . '.index', ['entity' => $this->entity, 'cart' => $cartItems, 'cartTotal' => $cartTotal, 'addOns' => $addOns]);
    }

    public function updateCart(Request $request)
    {
        $productId = $request->input('product_id');
        $quantity = $request->input('quantity');

        try {
            $entity = FunctionHelper::getEntity('cart');
            $this->cartService->addToCart($productId, $quantity);
            $cartItems = $this->cartService->getCartItems();

            $cartTotal = $this->cartService->getTotal();
            $addOns = $this->cartService->getAddonItems();
            $cartItems['refreshContentId'] = 'cart_list';

            $cartItems['refreshContent'] = view('cart.cart_list', ['entity' => $entity, 'cart' => $cartItems, 'cartTotal' => $cartTotal, 'addOns' => $addOns])->render();
            //dd($cartItems);
            $success_message ='';
            return $this->sendResponse($cartItems, $success_message);

        } catch (\Exception $e) {

            //return response()->json(['error' => $e->getMessage()], 400);
        }
    }

    public function removeCart(Request $request) {
        $entity = FunctionHelper::getEntity('cart');
        $productId = $request->input('product_id');
        $this->cartService->removeFromCart($productId);
        $cartItems = $this->cartService->getCartItems();
        $cartTotal = $this->cartService->getTotal();
        $addOns = $this->cartService->getAddonItems();
        $cartItems['refreshContentId'] = 'cart_list';
        $cartItems['refreshContent'] = view('cart.cart_list', ['entity' => $entity, 'cart' => $cartItems, 'cartTotal' => $cartTotal, 'addOns' => $addOns])->render();

        $success_message ='Item removed from cart successfully';
        return $this->sendResponse($cartItems, $success_message);
    }

    public function checkout() {
        //$entity = FunctionHelper::getEntity('cart');
        $cartItems = $this->cartService->getCartItems();
        $cartTotal = $this->cartService->getTotal();
        $cartId = $this->cartService->getCartid();


        $user = Auth::user();
        $seekerDetail = $user->seekerDetail??null;
        $orderDetail = $this->orderDetailRepository->makeModel();
        $user_type = '';
        if ($cartItems) {
            foreach ($cartItems as $key => $cart) {
                $product_type = $cart['package_info']['package_type'];
                $user_type = $cart['package_info']['role_type'];
            }
        }

        return view('cart.checkout', ['entity' => $this->entity, 'cart' => $cartItems, 'cartTotal' => $cartTotal, 'user' => $user, 'imageModel' => $seekerDetail, 'seekerDetail' => $seekerDetail, 'cartId' => $cartId, 'orderDetail' => $orderDetail, 'product_type' => $product_type, 'user_type' => $user_type]);
    }

    public function processPayment(ProcessPaymentRequest $request) {
        try {
            $input = $request->all();
            //dd($input);
            $cart = $this->cartRepository->find($input['cart_id']);
            $input['item_info'] = $cart['cart_items'] ?? '';
            $input['user_info']['user_id'] = $input['user_id'] ?? '';
            $input['user_info']['first_name'] = $input['first_name'] ?? '';
            $input['user_info']['last_name'] = $input['last_name'] ?? '';
            $input['user_info']['email'] = $input['email'] ?? '';
            $input['user_info']['phone_number'] = $input['phone_number'] ?? '';
            $input['user_info']['state_id'] = $input['state_id'] ?? '';
            $input['user_info']['location_id'] = $input['location_id'] ?? '';
            $input['user_info']['postal_code'] = $input['postal_code'] ?? '';
            $input['user_info']['comment'] = $input['comment'] ?? '';
            $input['order_number'] = Str::uuid();
            $orderDetails = $this->orderDetailRepository->create($input);

            if ($request->get('document')) {
                // order document upload
                $document = $request->get('document', []);
                $doc_type = config('constants.document_type.order_document', 6);
                $this->documentRepository->savePermanent($document, $doc_type, $orderDetails);
            }

            // (new NotifyAdmin($orderDetails, 'OrderConfirm', $request->get('via', [])))->notify();

            return redirect()->route('pay.order', ['order_number' => $input['order_number']]);
        } catch (Throwable $e) {
            throw $e;
            Flash::error($e->getMessage());
        }
    }

    public function payOrder($order_number) {
        $order = $this->orderDetailRepository->orderDetail($order_number);
        // $api = new Api(env('RAZORPAY_KEY'), env('RAZORPAY_SECRET'));
        // $orderInfo = $api->order->create([
        //     'amount' => $order->total_amount*100, // Amount in paise
        //     'currency' => 'INR',
        //     'notes' => [
        //         'order_number' => $order->order_number,
        //         'order_id' => $order->id
        //     ]
        // ]);
        // //dd($orderInfo);
        // $orderId = $orderInfo['id'];
        return view('cart.payment', ['order' => $order,'order_number' => $order_number]);
    }

    public function payOrderStore(Request $request) {
        $input = $request->all();
        $api = new Api(env('RAZORPAY_KEY'), env('RAZORPAY_SECRET'));

        $paymentInfo = $api->payment->fetch($input['razorpay_payment_id']);

        if(count($input)  && !empty($input['razorpay_payment_id'])) {

            $order_id = $paymentInfo->notes['order_id'];
            $order = $this->orderDetailRepository->find($order_id);
            //dd($paymentInfo, $input);
            $info['payment_status'] = 1;
            $info['payment_info'] = $input;

            $this->orderDetailRepository->update($info, $order_id);

            $this->cartRepository->deleteByType($ids = [], $order->user_id, 'user_id');


            if ($order['item_info']) {
                foreach ($order['item_info'] as $key => $info) {

                    $package = $this->repository->find($key, ['*'], true);
                    throw_if(empty($package), BadRequestException::class, trans('message.package_not_found'));
                    //dd($package);
                    if ($package['role_type'] == 'employers') {
                        $data['renew_package'] = $data['renew_package'] ?? false;
                        $data = ['payment_id' => 0, 'user_id' => $order['user_id'], 'package_id' => $key, 'package_info' => $package->toArray()];
                        $this->userPackageRepository->subscribe($data, true);
                    } else if ($package['role_type'] == 'jobseekers' && $package['package_type'] == 2) {
                        Flash::success('Profile updated successfully.');
                        return redirect()->route('resume-builder.create');
                    } else if ($package['role_type'] == 'jobseekers' && $package['package_type'] == 6) {
                        //$adminEmail = 'info@jobtrendsindia.com'; // Replace with the actual admin email address
                        $adminEmail = 'psdindia1@gmail.com'; // Replace with the actual admin email address
                        $user = Auth::user();
                        $downloadDoclink = $user->seekerDetail->documents->first()->presigned_url;
                        Mail::to('psdindia1@gmail.com')->send(new PackagePurchaseNotification($user, $downloadDoclink));
                        return view('auth.offer_thank');
                    }
                }
            }

            Flash::success('Profile updated successfully.');
            return redirect()->route('order.detail', ['order_number' => $order->order_number]);
        }
    }

    public function orderDetail($id) {
        $order = $this->orderDetailRepository->orderDetail($id);
        return view('cart.order_details', ['order' => $order]);
    }

    public function orderList() {
        $orders = $this->cartService->getorders();
        return view('cart.order_list', ['orders' => $orders]);
    }

    public function phonepay(Request $request)
    {
        // Validate request data
        $request->validate([
            'order_id' => 'required|string',
            'amount' => 'required|numeric',
            'phone_number' => 'required|string',
        ]);

        // Create PhonePeRequest instance
        $phonePeRequest = new PhonePeRequest(
            $request->order_id,
            $request->amount,
            $request->phone_number
        );

        // Make the request to PhonePe API
        $response = Curl::to($phonePeRequest->getApiUrl())
            ->withHeaders($phonePeRequest->getHeaders())
            ->withData(json_encode($phonePeRequest->getRequestData()))
            ->post();


        $rData = json_decode($response);
        if ($rData && isset($rData->data->instrumentResponse->redirectInfo->url)) {

            return redirect()->to($rData->data->instrumentResponse->redirectInfo->url);
        } else {

            Flash::error('Something went wrong while processing the payment. Please try again.');
            return redirect()->back()->with('error', 'Something went wrong while processing the payment. Please try again.');
        }
    }

        public function response(Request $request){

            \Log::info('Incoming PhonePe response: ', $request->all());

            $input = $request->all();
            $saltIndex = 1;

            $saltKey = env('PHONEPE_SALT_KEY');
            $finalXHeader = hash('sha256','/pg/v1/status/'.$input['merchantId'].'/'.$input['transactionId'].$saltKey).'###'.$saltIndex;
            $url = env('PHONEPE_CALLBACK_URL');
            $response = Curl::to($url.'/'.$input['merchantId'].'/'.$input['transactionId'])
                    ->withHeader('Content-Type:application/json')
                    ->withHeader('accept:application/json')
                    ->withHeader('X-VERIFY:'.$finalXHeader)
                    ->withHeader('X-MERCHANT-ID:'.$input['merchantId'])
                    ->get();

                    $rData = json_decode($response);

                    if(isset($rData->success) && $rData->success == 1 && $rData->code == 'PAYMENT_SUCCESS')
                    {
                        $packageId = explode("-", $rData->data->merchantTransactionId);

                        $order_id = $packageId[1];

                    $order = $this->orderDetailRepository->find($order_id);

                    $info['payment_status'] = 1;
                    $info['payment_info'] = $input;

                    $this->orderDetailRepository->update($info, $order_id);

                    $this->cartRepository->deleteByType($ids = [], $order->user_id, 'user_id');
                    $user = Auth::user();

                    if ($order['item_info']) {
                        foreach ($order['item_info'] as $key => $info) {

                            $package = $this->repository->find($key, ['*'], true);
                            throw_if(empty($package), BadRequestException::class, trans('message.package_not_found'));
                            //dd($package);
                            if ($package['role_type'] == 'employers') {
                                $data['renew_package'] = $data['renew_package'] ?? false;
                                $data = ['payment_id' => 0, 'user_id' => $order['user_id'], 'package_id' => $key, 'package_info' => $package->toArray()];
                                $confirmPayment = $this->userPackageRepository->subscribe($data, true);
                                $user->notify(new PaymentStatus($confirmPayment ?? null));

                            } else if ($package['role_type'] == 'jobseekers' && $package['package_type'] == 2) {
                                Flash::success('Profile updated successfully.');
                                return redirect()->route('resume-builder.create');
                            } else if ($package['role_type'] == 'jobseekers' && $package['package_type'] == 6) {
                                $adminEmail = 'info@jobtrendsindia.com'; // Replace with the actual admin email address
                                //$downloadDoclink = $user->seekerDetail->documents->first()->presigned_url;
                                $downloadDoclink = route('download-public-attachment', $user->id);
                                Mail::to($adminEmail)->send(new PackagePurchaseNotification($user, $downloadDoclink));
                                return view('auth.offer_thank');
                            }
                        }
                    }

                    Flash::success('Profile updated successfully.');
                    return redirect()->route('order.detail', ['order_number' => $order->order_number]);
            }
            else
            {
                Flash::error('Your payment process is Faild');
                return redirect()->route('cart.list');
            }
        }
}
