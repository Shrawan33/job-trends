<!-- Role Field -->
<div class="form-group col-sm-6">
    {!! Form::label('role', trans('label.role').':') !!}
    <p>{!! $user->role_title??'' !!}</p>
</div>

<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', trans('label.name').':') !!}
    <p>{!! $user->role_title =="Employer" ? $user->company_name : $user->full_name !!}</p>
</div>

<!-- Email Field -->
<div class="form-group col-sm-6">
    {!! Form::label('email', trans('label.email').':') !!}
    <p>{!! $user->email !!}</p>
</div>

<!-- phone_number Field -->
<div class="form-group col-sm-6">
    {!! Form::label('phone_number', trans('label.phone_number').':') !!}
    <p>
        {{-- {{ config('constants.phone_prefix') }} --}}
        {!! $user->phone_number !!}</p>
</div>
