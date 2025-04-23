@extends('layouts.front')

@section('content')
{{-- @dd($order); --}}
{{-- @dd($order->total_amount); --}}
<div class="">
    <div id="order">
        {{-- @include($entity['view'].'.cart_list') --}}
        <div class="card card-default">
            <div class="card-header">
                Laravel - Razorpay Payment Gateway Integration
            </div>
            {{-- @dd($order->order_number); --}}
            <div class="card-body text-center">
                <form action="{{ route('payment.initiate') }}" method="POST">
                    @csrf
                    <script
                        src="https://checkout.razorpay.com/v1/checkout.js"
                        data-key="{{ env('RAZORPAY_KEY') }}"
                        data-amount="{{ $total_amount }}"
                        data-name="{{ env('APP_NAME') }}"
                        data-description="Payment for Order"
                        data-image="{{ asset('images/Logo.svg') }}"
                        data-prefill.name="{{ $user->first_name }} {{ $user->last_name }}"
                        data-prefill.email="{{ $user->email }}"
                        data-theme.color="#F37254"
                        data-order_id="{{ $orderId }}"
                        data-currency="INR"
                    ></script>
                <input type="hidden" name="razorpay_payment_id" value="">
                    <input type="hidden" name="razorpay_signature" value="">
                    {{-- <button type="submit" class="btn btn-primary">Pay Now</button> --}}
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
