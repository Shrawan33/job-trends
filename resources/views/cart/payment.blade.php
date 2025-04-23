@extends('layouts.front')

@section('content')
{{-- @dd($order); --}}
{{-- @dd($order->total_amount); --}}
<div class="">
    <div id="order">
        {{-- @include($entity['view'].'.cart_list') --}}
        <div class="card card-default">
            <div class="card-header">
                Click Pay now button to pay your payment.
            </div>
            {{-- @dd($order->order_number); --}}
            <div class="card-body text-center">
                <form action="{{ route('payment.phonepay') }}" method="POST">
                    @csrf
                    {{-- <script
                        src="https://checkout.razorpay.com/v1/checkout.js"
                        data-key="{{ env('RAZORPAY_KEY') }}"
                        data-amount="{{ $order->total_amount }}"
                        data-name="{{ env('APP_NAME') }}"
                        data-description="Payment for Order #{{ $order->order_number }}"
                        data-image="{{ asset('images/Logo.svg') }}"
                        data-prefill.name="{{ $order->user_info['first_name'] }} {{ $order->user_info['last_name'] }}"
                        data-prefill.email="{{ $order->user_info['email'] }}"
                        data-theme.color="#F37254"
                        data-order_id="{{ $orderId }}"
                        data-currency="INR"
                    ></script> --}}
                    {{-- <input type="hidden" name="razorpay_payment_id" value=""> --}}
                    {{-- <input type="hidden" name="razorpay_signature" value=""> --}}
                    <input type="hidden" name="amount" value="{{$order->total_amount}}">
                    <input type="hidden" name="order_number" value="{{$order_number}}">
                    <input type="hidden" name="phone_number" value={{auth()->user()->phone_number}}>
                    <input type="hidden" name="order_id" value={{$order->id}}>
                    <button type="submit" class="btn btn-primary">Pay Now</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
