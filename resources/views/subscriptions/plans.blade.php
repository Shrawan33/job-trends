@extends('layouts.front')


@section('content')
<div class="container">
    <div class="row my-5">
        <div class="col-12">
            <h1 class="h2 font-weight-bold">{{ trans('label.select_package') }}</h1>
        </div>
    </div>
    <div class="row mb-5 align-items-center">
        @foreach ($items as $item)
        @if ($item->is_contact_sales)
        <div class="col-md-6 col-xl-3 mb-3">
            <div class="plan-box border px-3 text-center">
                <h2 class="text-primary sub-h2 font-weight-bold mb-0">{{$item->title??null}}</h2>
                <p class="my-4">{{Str::limit($item->description, 100, '...')??null}}</p>
                <a href="{{route('contact-us')}}" class="btn btn-primary">{{ trans('label.btn_contact_sales') }}</a>
            </div>
        </div>
        @else
        <div class="col-md-6 col-xl-3 mb-3">
            <div class="plan-box border px-3 text-center {{$item->is_best_selling?'best-plan':''}}">
                @if ($item->is_best_selling)
                    <div class="ribbon"><span>{{ trans('label.is_best_selling') }}</span></div>
                @endif
                <h2 class="h3 mb-3">
                    {{$item->title??null}}
                    @if ($item->is_best_selling)
                        <a href="javascript:void(0)" data-toggle="tooltip" title="Hooray!"  class="h6"><i class="fi flaticon-info"></i></a>
                    @endif
                </h2>
                <h2 class="text-primary sub-h1 font-weight-bold">{{$item->price !== null ? FunctionHelper::formatPrice($item->price, true, true, '') : null}}</h2>
                <ul class="list-unstyled py-4 text-black">
                    @if($item->duration)
                        <li class="mb-3">Validity: {{$item->duration??null}} {{ trans('label.days') }}</li>
                    @endif
                    @if($item->grace_period)
                        <li class="mb-3">Grace Period: {{$item->grace_period??null}} {{ trans('label.days') }}</li>
                    @endif
                    @if(isset($item->credit_info['credits']['profile']))
                    <li class="mb-3">Total Credits Points:{{FunctionHelper::totalCredit($item->credit_info['credits']) ?? ''}}</li>
                    @endif
                    @if(isset($item->credit_info['credits']['job_posts'])&& !empty($item->credit_info['credits']['job_posts']))
                    <li class="mb-3">Job Posts: {{$item->credit_info['credits']['job_posts']??null}} </li>
                    @endif
                    @if(isset($item->credit_info['credits']['sms']))
                    <li class="mb-0">Features:  {{Str::limit($item->description, 100, '...')??null}}</li>
                    @endif
                </ul>
                @include('components.payment.entity', ['package_id' => $item->id, 'amount' => $item->price??0, 'type' => 'plan', 'button' => trans('label.btn_select'), 'btnClass' => 'btn-primary rounded-pill px-5'])
                {{-- @include('subscriptions.form',['package_id' => $item->id, 'text' => trans('label.btn_select'),'class' => 'px-5']) --}}
            </div>
        </div>
        @endif
        @endforeach
    </div>
</div>
@endsection
