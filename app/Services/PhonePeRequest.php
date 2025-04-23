<?php

namespace App\Services;

use Illuminate\Support\Facades\Auth;

class PhonePeRequest
{
    protected $data;
    protected $encodedData;
    protected $saltKey;
    protected $saltIndex;

    public function __construct($orderId, $amount, $phoneNumber)
    {
        $this->data = [
            'merchantId' => env('PHONEPE_MERCHANT_ID'),
            'merchantTransactionId' => uniqid() . '-' . $orderId,
            'merchantUserId' => 'MUID' . Auth::user()->id,
            'amount' => $amount * 100,
            'redirectUrl' => route('response'),
            'redirectMode' => 'POST',
            'callbackUrl' => route('response'),
            'mobileNumber' => $phoneNumber,
            'paymentInstrument' => [
                'type' => 'PAY_PAGE',
            ],
            'metadata' => [
                'order_id' => $orderId,
            ],
        ];

        $this->saltKey = env('PHONEPE_SALT_KEY');
        $this->saltIndex = env('PHONEPE_SALT_INDEX');
        $this->encodedData = base64_encode(json_encode($this->data));
    }

    public function getHeaders()
    {
        $stringToHash = $this->encodedData . '/pg/v1/pay' . $this->saltKey;
        $sha256 = hash('sha256', $stringToHash);
        $finalXHeader = $sha256 . '###' . $this->saltIndex;

        return [
            'Content-Type: application/json',
            'X-VERIFY: ' . $finalXHeader,
        ];
    }

    public function getRequestData()
    {
        return ['request' => $this->encodedData];
    }

    public function getApiUrl()
    {
        return env('PHONEPE_URL');
    }
}
