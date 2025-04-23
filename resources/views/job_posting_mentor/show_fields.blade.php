<!-- Title Field -->
<div class="col-sm-12">
    {!! Form::label('title', trans('label.title')) !!}
    <p>{{ $job->title }}</p>
</div>

<!-- createdby Field -->
<div class="col-sm-12">
    {!! Form::label('created_by', trans('label.employer')) !!}
    <p>{!! $job->createdByUser->company_name ?? '' !!}</p>
</div>

<!-- Created at Field -->
<div class="col-sm-12">
    {!! Form::label('created_at', trans('label.posted_on')) !!}
    <p>{{ $job->created_at ? FunctionHelper::fromSqlDateTime($job->created_at, true, '') : '' }}</p>
</div>


<!-- is_featured Field -->
<div class="col-sm-12">
    {!! Form::label('is_featured', trans('label.is_featured')) !!}
    <p>{{ $job->is_featured == 1 ? 'Yes' : 'No' }}</p>
</div>

<!-- category Field -->
<div class="col-sm-12">
    {!! Form::label('category', trans('label.category')) !!}
    <p>{{ $job->category->title ?? '' }}</p>
</div>

<!-- is_featured Field -->
<div class="col-sm-12">
    {!! Form::label('status', trans('label.statusSelect')) !!}
    <p>{{ $job->deleted_at == null ? 'Active' : 'Inactive' }}</p>
</div>
<!-- Description -->
<div class="col-sm-12">
    {!! Form::label('Description', trans('label.description')) !!}
    <p>{!! $job->description ?? '' !!}</p>
</div>

<!-- Licence/Certification -->
<div class="col-sm-12">
    {!! Form::label('skills', trans('label.skills')) !!}
    @foreach ($job->skills as $skill)
        <li class="">
            {{ $skill->skill->title ?? '' }}
        </li>
    @endforeach
    <br>
</div>

<!-- Licence/Certification -->
<div class="col-sm-12">
    {!! Form::label('licence_and_certification', trans('label.licence_and_certification')) !!}
    @foreach ($job->certifications as $certification)
        <li class="">
            {{ $certification->certification->title ?? '' }}</li>
    @endforeach
    <br>
</div>

<!-- Years of Experience -->
<div class="col-sm-12">
    {!! Form::label('experience_in_year', trans('label.experience_in_year')) !!}
    @if ($job->experience)
        <p>
            {{ $job->experience->title ?? '' }}</p>
    @endif
</div>

<!-- Education -->
<div class="col-sm-12">
    {!! Form::label('education', trans('label.education')) !!}
    @foreach ($job->qualifications as $qualification)
        <li class="">
            {{ $qualification->qualification->title ?? '' }}</li>
    @endforeach
    <br>
</div>

<!-- Other Requirement -->
<div class="col-sm-12">
    {!! Form::label('other_recuirements', trans('label.other_requirements')) !!}
    <p class="mb-0">{!! $job->other_recuirements ?? '-' !!}</p>
</div>

<!-- Location -->
<div class="col-sm-12">
    {!! Form::label('other_recuirements', trans('label.job_detail_page.job_location')) !!}
    @if ($job->address)
        <p>{{ $job->address ?? '' }}</p>
    @endif
</div>

<!-- Location -->
<div class="col-sm-12">
    {!! Form::label('other_recuirements', trans('label.job_detail_page.community')) !!}
    @if ($job->address)
        <p>{{ $job->area ?? '-' }}</p>
    @endif
</div>

<!-- is_urgent -->
<div class="col-sm-12">
    {!! Form::label('is_urgent', trans('label.is_urgent')) !!}
    <p>
        {{ $errors->has('is_urgent') ? $errors->first('is_urgent') : ($job->is_urgent ? 'Yes' : 'No') }}
    </p>
</div>

<!-- Expiry Date -->
<div class="col-sm-12">
    {!! Form::label('expiration_date', trans('label.expiration_date')) !!}
    <p>{{ $job->expiration_date ? FunctionHelper::fromSqlDateTime($job->expiration_date, true, '') : '' }}

</div>
