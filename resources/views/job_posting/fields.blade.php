@section('third_party_stylesheets')
@include('vendor.image_upload.style')
@include('vendor.richtexteditor.style')
@endsection

{{-- <div class="form-group mb-4">
    @include('vendor.image_upload.upload', ['id' => 'employer_job_logo', 'name' => 'employer_job_logo', 'height'
    => '80px', 'width' => '80px', 'document_type' => config('constants.document_type.cropped_images', 2), 'multiple'
    => true, 'limit' => 1])
</div> --}}
{!! Form::hidden('slug',null) !!}
{!! Form::hidden('approval_status',1) !!}
{!! Form::hidden('country_id', config('constants.default_country_id')) !!}
<!-- Job ID Field -->
<div class="form-group col-sm-6 d-none">
    {!! Form::text('job_number',$pattern, ['class' => 'form-control', 'placeholder' => trans('label.job_id'), 'readonly']) !!}

</div>
<!-- Employer Field -->
<div class="form-group mb-4">
    {!! Form::select('created_by', $employers??[],$employerID??null, ['class' => 'form-control '. ($errors->has('created_by') ? 'is-invalid' : ''),
    'placeholder' => trans('label.select_employer')]) !!}
    @if ($errors->has('created_by'))
    <span class="text-danger">{{ $errors->first('created_by') }}</span>
    @endif
</div>

<!-- Title Field -->
<div class="form-group mb-4">
    {!! Form::text('title', null, ['class' => 'form-control '. ($errors->has('title') ? 'is-invalid' : ''),
    'placeholder' => trans('label.candidate_profile_title')]) !!}
    @if ($errors->has('title'))
    <span class="text-danger">{{ $errors->first('title') }}</span>
    @endif
</div>

<!-- Category Id  Field -->
<div class="form-group mb-4">
    {!! Form::select('category_id', $categories??[], null, ['class' => 'form-control '. ($errors->has('category_id') ?
    'is-invalid' : ''), 'data-placeholder' => trans('label.category')]) !!}
    @if ($errors->has('category_id'))
    <span class="text-danger">{{ $errors->first('category_id') }}</span>
    @endif
</div>


<!-- Job Description Field -->
<div class="form-group mb-4">
    {!! Form::textarea('description', null, ['rows' => 4,'class' => 'form-control '. ($errors->has('description') ?
    'is-invalid' : ''), 'placeholder' =>trans('label.job_detail_page.title'), 'richtexteditor' => true]) !!}
    @if ($errors->has('description'))
    <span class="text-danger">{{ $errors->first('description') }}</span>
    @endif
</div>


<!-- Work Type Id Field -->
<div class="form-group mb-4">
    {!! Form::select('work_type_id',['' => trans('label.work_type')] + $workType??[], null, ['class' => 'form-control', 'data-placeholder' => trans('label.work_type')]) !!}

</div>

<!-- Skill Id  Field -->
<div class="form-group mb-4">
    {!! Form::select('skill_id[]', $skills??null,$skillids, ['class' => 'form-control', 'data-placeholder' => trans('label.skills'),
    'multiple'=>true]) !!}

</div>

<!-- certifications Id  Field -->
<div class="form-group mb-4">
    {!! Form::select('certification_id[]', $certifications??null,$certificationids, ['class' => 'form-control',
    'data-placeholder' =>  trans('label.certification'), 'multiple'=>true]) !!}

</div>

<div class="form-group col-md-12 mb-4">
    <label for="">Other Requirement</label>
    {!! Form::textarea('other_recuirements', null, [
        'rows' => 4,
        'class' => 'form-control ' . ($errors->has('other_recuirements') ? 'is-invalid' : ''),
        'placeholder' => trans('label.job_detail_page.other_recuirements'),
        'richtexteditor' => true,
    ]) !!}
    @if ($errors->has('other_recuirements'))
        <span class="text-danger">{{ $errors->first('other_recuirements') }}</span>
    @endif
</div>
<div class="row">
    <div class="col-sm">
        <div class="form-group mb-4">
            @include('components.state', ['states' => $states, 'selected' => $employerJob->state_id ?? ''])
            @error('state_id')
            <span class="error invalid-feedback">{{ $message }}</span>
            @enderror
        </div>
    </div>
    <div class="col-sm">
        <div class="form-group mb-4">
            @include('components.location', ['locations' => $locations, 'selected' => $employerJob->location_id ?? ''])
            @error('location_id')
            <span class="error invalid-feedback">{{ $message }}</span>
            @enderror
        </div>
    </div>
</div>




<div class="form-group mb-4">
    {!! Form::text('area', old('area', $employerJob->area ?? null), ['class' => 'form-control', 'placeholder' =>
    trans('label.area')]) !!}
    @error('area')
    <span class="error invalid-feedback">{{ $message }}</span>
    @enderror
</div>

<!-- Skill Id  Field -->
<div class="form-group mb-4">
    {!! Form::select('qualification_id[]', $qualifications??null,$qualificationIDS, ['class' => 'form-control',
    'data-placeholder' => trans('label.education'), 'multiple'=>true]) !!}

</div>


<!-- Experience Id Field -->
<div class="form-group mb-4">
    {!! Form::select('experience_id', $experinces??[], null, ['class' => 'form-control', 'data-placeholder' =>
    trans('label.experience_in_year')]) !!}

</div>
<div class="row">
    <div class="col-sm">
        <!-- Salary Id  Field -->
        <div class="form-group mb-4">
            {!! Form::select('salary_id', $salaries??[], null, ['class' => 'form-control', 'data-placeholder' => trans('label.annual_salary_range')]) !!}
        </div>
    </div>
    <div class="col-sm">
        <!-- Salary Type Id  Field -->
        <div class="form-group mb-4">
            {!! Form::select('salary_type_id', $salary_types??[], null, ['class' =>
            'form-control', 'data-placeholder' => trans('label.salary_type')]) !!}
        </div>
    </div>
</div>

<div class="col-md-6">
    <!-- Title Field -->
    <div class="form-group mb-4 d-flex pl-1 align-items-center">
        {!! Form::checkbox('is_urgent', 1, $employerJob->is_urgent ?? 0, [
            'class' => ' ' . ($errors->has('is_urgent') ? 'is-invalid' : ''),
        ]) !!}
        {!! Form::label('is_urgent', trans('label.is_urgent'), ['class' => 'required-label mb-0']) !!}
        @if ($errors->has('is_urgent'))
            <span class="text-danger">{{ $errors->first('is_urgent') }}</span>
        @endif
    </div>
</div>
<div class="form-group mb-4">
    <div class="d-flex align-items-center">
        {!! Form::checkbox('is_featured', 1, null, ['class' => '']) !!} {{trans('label.is_featured')}}
    </div>
</div>

<!-- Is featured  Field -->

<div class="form-group mb-4">
    {!! Form::text('expiration_date', null, ['class' => 'form-control datepicker','id'=>'expiration_date','placeholder' => trans('label.expiration_date')]) !!}
    <span class="input-group-addon">
            <span class="glyphicon glyphicon-calendar"></span>
        </span>
        </div>
<hr>
{{-- @if(isset($clone) && $clone == false) --}}
<h4>{!! __('label.screening_title') !!}</h4>
<div id="questionnaire-list" class="my-3">
    @include('questionnaires.list', ['job' => $id, 'list' => $questionnaires ?? [], 'display' => true])
</div>
{{-- @endif --}}
<a class="open-form" data-mode="edit" data-modal-size="modal-lg" data-title="{!! __('label.apply_job_question')!!}"
    data-model="questionnaire"  data-url="{{route('questionnaires.create', ['job' => $id])}}"
    href="javascript:void(0)">{!! __('label.create')!!}</a>

{!! Form::hidden('tmp_id', $id) !!}

@include('imagecropper.croppermodal')
@section('third_party_scripts')
@include('vendor.image_upload.script')
@include('vendor.richtexteditor.script')
@endsection
@push('page_scripts')
<script>
    var date = new Date();
    var threemonthafter = date.setMonth(date.getMonth() + 3);
    $('.datepicker').datetimepicker({
        format: "{{ config('constants.format.moment_date') }}",
        useCurrent: true,
        defaultDate:threemonthafter,
        minDate: new Date(),
        // maxDate:threemonthafter
    });

</script>

@endpush

@if (isset($employerJob->expiration_date))
    @include('vendor.moment.datetimepicker', ['dateFields' => ['expiration_date' => $employerJob->expiration_date]])
@endif
