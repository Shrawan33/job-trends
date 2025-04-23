@extends('layouts.front')


@section('content')

<div class="container">
    <div class="row">

        <div class="col-12 my-50">
            @if(isset($userPackage) && $userPackage->end_date < now())
                <h4 class="text-success mb-30">{!! trans('message.grace_period_message', ['grace' => $userPackage->package_info['grace_period']??'' ]) !!}</h4>
            @endif
            <div class="d-flex justify-content-between align-items-center flex-column flex-md-row">
                <h1 class="h2 font-weight-bold mb-30 mb-md-0">{!! trans('label.current_subscription_title')!!}</h1>
                <ul class="list-inline mb-0">
                    <li class="list-inline-item"><a href="{{route('subscription.plan')}}" class="btn btn-primary px-lg-50">{!! trans('label.add_plan')!!}</a>
                    </li>

                    {{-- @if(isset($userPackage) && $userPackage->end_date < now())
                    <li class="list-inline-item"><a href="{{route('subscription.expire.grace',$userPackage->id)}}" class="btn btn-primary px-lg-30">Expire Grace Period</a></li>
                    @else
                    <li class="list-inline-item">
                        @if(isset($userPackage))
                        <a href="{{route('subscription.expire',$userPackage->id)}}" class="btn btn-primary px-lg-30">Expire Active Package</a></li>
                        @endif
                    @endif --}}
                </ul>
            </div>
        </div>
    </div>
    @if(!empty($userPackage->package_info))
    <div class="row">
        <div class="col-6 col-md-4 col-lg-3 mb-40">
            @if(!empty($userPackage->package_info['title']))
                <p class="text-primary mb-10">{!! trans('label.package_name')!!}</p>
                <p class="h3">{!! $userPackage->package_info['title']??''  !!}<span class="badge badge-info ">{{config('constants.package_status.'.$userPackage->is_active,null)}}</span></p>
            @endif
        </div>
        <div class="col-6 col-md-4 col-lg-3 mb-40">
            @if(!empty($userPackage->package_info['duration']))
                <p class="text-primary mb-10">{!! trans('label.validity')!!}</p>
                <p class="h3">{{$userPackage->package_info['duration'].' days'}}</p>
            @endif
        </div>
        <div class="col-6 col-md-4 col-lg-3 mb-40">
            @if(!empty($userPackage->start_date))
                <p class="text-primary mb-10">{!! trans('label.activation_date')!!}</p>
                <p class="h3">{{FunctionHelper::fromSqlDate($userPackage->start_date->toDateString(),true) ?? ''}}</p>
            @endif
        </div>
        <div class="col-6 col-md-4 col-lg-3 mb-40">
            <p class="text-primary mb-10">{!! trans('label.expiry_date')!!}</p>
            <p class="h3">
            @if(!empty($userPackage->isEndDateExpired()))
                {{FunctionHelper::fromSqlDate($userPackage->end_date->toDateString(),true) ?? ''}}
            @else
                {{FunctionHelper::fromSqlDate($userPackage->grace_date->toDateString(),true) ?? ''}}
            @endif
            </p>
        </div>
        <div class="col-6 col-md-4 col-lg mb-40">
            @if(!empty($userPackage->package_info['credits']))
                <p class="text-primary mb-10">{!! trans('label.total_credits')!!}</p>
                <p class="h3">{{FunctionHelper::totalCredit($userPackage->package_info['credits']) ?? ''}} </p>
            @endif
        </div>
        <div class="col-6 col-md-4 col-lg mb-40">
            @if(!empty($userPackage->utilization_info))
                <p class="text-primary mb-10">{!! trans('label.remaining_credits')!!}  <a href="javascript:void(0)" data-toggle="tooltip" data-placement="right" data-html="true" title="
                    {{ trans('label.profile_credits') }}: {{$userPackage->utilization_info['profile']}}<br/>{{ trans('label.sms_credits') }}: {{$userPackage->utilization_info['sms']}}"  class="h6"><i class="fi flaticon-info"></i></a></p>
                <p class="h3">{{FunctionHelper::totalCredit($userPackage->utilization_info) ?? ''}}</p>
            @endif
        </div>
        <div class="col-6 col-md-4 col-lg mb-40">
            @if(!empty($userPackage->package_info['credits']))
                <p class="text-primary mb-10">{!! trans('label.total_job_post')!!} </p>
                <p class="h3">{{$userPackage->package_info['credits']['job_posts'] ?? ''}}</p>
            @endif
        </div>

        <div class="col-6 col-md-4 col-lg mb-40">
            @if(!empty($userPackage->utilization_info))
                <p class="text-primary mb-10">{!! trans('label.remaining_job_posts')!!} </p>
                <p class="h3">{{$userPackage->utilization_info['job_posts'] ?? ''}}</p>
            @endif
        </div>
     
        <div class="col-6 col-md-4 col-lg mb-40">
            @if(!empty($userPackage->utilization_info))
                <p class="text-primary mb-10">{!! trans('label.consumed_credits')!!}  <a href="javascript:void(0)" data-toggle="tooltip" data-placement="right" data-html="true" title="
                    {!! FunctionHelper::consumedCredits($userPackage->package_info['credits'], $userPackage->utilization_info, true) ?? ''!!}"  class="h6"><i class="fi flaticon-info"></i></a></p>
                <p class="h3">{{FunctionHelper::consumedCredits($userPackage->package_info['credits'], $userPackage->utilization_info, false) ?? ''}}</p>
            @endif
        </div>
    </div>
    @else
    <div class="alert alert-info"> {{trans('message.no_active_package') }}</div>
    @endif
    <div class="row mb-50">
        <div class="col-12 mt-50">
            <ul class="nav nav-line-tabs">
                <li class="nav-item">
                    <a class="nav-link active" data-toggle="pill" href="#tab_availablePackages">{!! trans('label.available')!!}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="pill" href="#tab_pastPackages">{!! trans('label.past')!!}</a>
                </li>
            </ul>
            <div class="tab-content  px-0 pt-40">
                <div id="tab_availablePackages" class="tab-pane fade in show active">
                @include('subscriptions.partials.available_packages')
                </div>
                <div id="tab_pastPackages" class="tab-pane fade">
                @include('subscriptions.partials.past_packages')
                </div>
            </div>
        </div>
    </div>
</div>


@endsection
