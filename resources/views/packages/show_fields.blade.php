<!-- Title Field -->
<div class="col-sm-12">
    {!! Form::label('title', trans('label.title')) !!}
    <p>{{ $package->title }}</p>
</div>

<!-- Description Field -->
<div class="col-sm-12">
    {!! Form::label('description', trans('label.description')) !!}
    <p>{!! $package->description !!}</p>
</div>

<!-- Price Field -->
<div class="col-sm-12">
    {!! Form::label('price', trans('label.price')) !!}
    <p>{{ $package->price }}</p>
</div>

<!-- Duration Field -->
<div class="col-sm-12">
    {!! Form::label('duration', trans('label.duration')) !!}
    <p>{{ $package->duration }}</p>
</div>

<!-- Grace Period Field -->
<div class="col-sm-12">
    {!! Form::label('grace_period', trans('label.grace_period')) !!}
    <p>{{ $package->grace_period }}</p>
</div>

@foreach (config('constants.credit_fields') as $field)
<div class="col-sm-6">
    {!! Form::label("credits[$field]", trans("label.{$fields}_credits")) !!}
    <p>{{ $package->credit_info['credits'][$field]??null }}</p>
</div>
<div class="col-sm-6">
    {!! Form::label("credits[$field]", trans("label.{$fields}_deduction")) !!}
    <p>{{ $package->credit_info['deduction'][$field]??null }}</p>
</div>
@endforeach

{{-- <!-- Profile Unlock Credits Field -->
<div class="col-sm-12">
    {!! Form::label('profile_unlock_credits', trans('label.profile_unlock_credits')) !!}
    <p>{{ $package->profile_unlock_credits }}</p>
</div>

<!-- No Of Job Posts Field -->
<div class="col-sm-12">
    {!! Form::label('no_of_job_posts', trans('label.no_job_post')) !!}
    <p>{{ $package->no_of_job_posts }}</p>
</div>

<!-- No Of Sms Field -->
<div class="col-sm-12">
    {!! Form::label('no_of_sms', trans('label.no_of_sms')) !!}
    <p>{{ $package->no_of_sms }}</p>
</div> --}}
