@extends('layouts.front')
@section('content')
    <div class="container plan_package_main_wraper">
        <div class="package_heading_wraper pt-20 text-center">
            <h1 class="title mb-30">{{ trans('label.career_support_service') }}</h1>
            <div class="description mb-60">{{ trans('message.expertise_page_text') }}</div>
        </div>
        <div class="row mb-40">
            @foreach ($items as $item)
                <div class="col-md-6 col-lg-4 mb-40">
                    <div class="plan-box single_box p-20 p-lg-30 text-center h-100">
                        <a class="d-block w-100 h-100" href="{{ route('subscription.service', $item->id) }}">
                            <h2 class="pb-25 mb-25">{{$item->title??null}}</h2>
                            <div class="description">{{$item->description??null}}</div>
                        </a>
                        {{-- @include('components.payment.entity', ['package_id' => $item->id, 'amount' => $item->price??0, 'type' => 'plan', 'button' => trans('label.btn_select'), 'btnClass' => 'btn-primary rounded-pill px-5']) --}}
                        {{-- @include('subscriptions.form',['package_id' => $item->id, 'text' => trans('label.btn_select'),'class' => 'px-5']) --}}
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
