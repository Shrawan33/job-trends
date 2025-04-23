{!! Form::open(['id' => 'candidate-search']) !!}

<input type="hidden" name="keyword" value="{{ $input['keyword'] ?? null }}">
<input type="hidden" name="location_id" value="{{ $input['location_id'] ?? null }}">
{{-- <input type="hidden" name="state_id" value="{{$input['state_id']??null}}"> --}}
<div class="form-group border-bottom pb-4 mb-4">
    <label>Search Keyword</label>
    <div class="search-keyword-form position-relative">
        {!! Form::text('keyword', $input['keyword'] ?? null, [
            'class' => 'form-control form-control-lg',
            'placeholder' => __('label.software_engineer'),
            'autocomplete' => 'off',
            'id' => 'search_term',
        ]) !!}
        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="15" viewBox="0 0 14 15" fill="none"
            class="search_icon">
            <path
                d="M13 13.5L10.1 10.6M11.6667 6.83333C11.6667 9.77885 9.27885 12.1667 6.33333 12.1667C3.38781 12.1667 1 9.77885 1 6.83333C1 3.88781 3.38781 1.5 6.33333 1.5C9.27885 1.5 11.6667 3.88781 11.6667 6.83333Z"
                stroke="#717884" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
        </svg>
    </div>
</div>
<div class="border-bottom pb-2 mb-4">
    <h3 class="mb-3">Location</h3>
    <div class="form-location-input form-group">
        <label for="">{{ trans('label.state') }}</label>
        @include('components.state', [
            'states' => $stateFilter ?? [],
            'selected' => $input['state_id'] ?? null,
            'multiple' => false,
            'data-placeholder' => __('label.search_by_state'),
            'dependent' => true,
        ])
    </div>
    <div class="form-location-input form-group">
        <label for="">{{ trans('label.city') }}</label>
        @include('components.location', [
            'locations' => $locationFilter ?? [],
            'selected' => $input['location_id'] ?? null,
            'multiple' => false,
            'data-placeholder' => __('label.search_by_location'),
            'dependent' => true,
        ])
    </div>
</div>
<div class="inner_wraper mb-4  pb-3 border-bottom mb-4  pb-3 border-bottom">
    <h4 class="cursor-pointer d-flex align-items-center justify-content-between mb-0 collapsed" data-toggle="collapse"
        data-target="#JobType" aria-expanded="false" aria-controls="JobType">{{ __('label.candidate.work_type') }}
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none"
            class="plus_icon">
            <path d="M10.0001 4.16666V15.8333M4.16675 9.99999H15.8334" stroke="#357de8" stroke-width="1.5"
                stroke-linecap="round" stroke-linejoin="round" />
        </svg>
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none"
            class="minus_icon">
            <path d="M4.16675 10H15.8334" stroke="#357de8" stroke-width="1.5" stroke-linecap="round"
                stroke-linejoin="round" />
        </svg>
    </h4>
    <div class="collapse hide" id="JobType">
        <ul class="form-group list-unstyled mb-0 mt-3 mb-0 mt-3">
            @foreach ($jobtypeFilter as $key => $jobtype)
                <li class="mb-1"><label class="mb-0"><input type="checkbox" name="job_type_id[]"
                            value="{{ $key ?? null }}" class="mr-2" />{{ $jobtype }}</label> </li>
            @endforeach
        </ul>
    </div>
</div>
<div class="inner_wraper mb-4  pb-3 border-bottom">
    <h4 class="cursor-pointer d-flex align-items-center justify-content-between mb-0 collapsed" data-toggle="collapse"
        data-target="#Experience" aria-expanded="false" aria-controls="Experience">{{ __('label.experience') }}
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none"
            class="plus_icon">
            <path d="M10.0001 4.16666V15.8333M4.16675 9.99999H15.8334" stroke="#357de8" stroke-width="1.5"
                stroke-linecap="round" stroke-linejoin="round" />
        </svg>
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none"
            class="minus_icon">
            <path d="M4.16675 10H15.8334" stroke="#357de8" stroke-width="1.5" stroke-linecap="round"
                stroke-linejoin="round" />
        </svg>
    </h4>
    <div class="collapse hide" id="Experience">
        <ul class="form-group list-unstyled mb-0 mt-3">
            @foreach ($experinceFilter as $key => $experince)
                <li class="mb-1"><label class="mb-0"><input type="checkbox" name="experience_id[]"
                            value="{{ $key ?? null }}" class="mr-2" />{{ $experince }}</label> </li>
            @endforeach
        </ul>
    </div>
</div>
<div class="inner_wraper mb-4  pb-3 border-bottom">
    <h4 class="cursor-pointer d-flex align-items-center justify-content-between mb-4 collapsed" data-toggle="collapse"
        data-target="#Skill" aria-expanded="false" aria-controls="Skill">{{ __('label.skills') }}
        {{-- <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none"
            class="plus_icon">
            <path d="M10.0001 4.16666V15.8333M4.16675 9.99999H15.8334" stroke="#357de8" stroke-width="1.5"
                stroke-linecap="round" stroke-linejoin="round" />
        </svg>
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none"
            class="minus_icon">
            <path d="M4.16675 10H15.8334" stroke="#357de8" stroke-width="1.5" stroke-linecap="round"
                stroke-linejoin="round" />
        </svg> --}}
    </h4>
    @include('components.skill', [
        'skill' => $skillFilter ?? [],
        'selected' => $input['skill_id'] ?? null,
        'multiple' => false,
        'data-placeholder' => __('label.skills'),
        'dependent' => true,
    ])
    {{-- {{ dd($skillFilter) }} --}}

    {{-- <div class="collapse hide" id="Skill">
        <ul class="form-group list-unstyled mb-0 mt-3">
            @foreach ($skillFilter as $key => $skill)
                <li class="mb-1"><label class="mb-0"><input class="mr-2" type="checkbox" name="skill_id[]"
                            value="{{ $key ?? null }}" />{{ $skill }}</label> </li>
            @endforeach
        </ul>
    </div> --}}
</div>
<div class="inner_wraper mb-4  pb-3">
    <h4 class="cursor-pointer d-flex align-items-center justify-content-between mb-0 collapsed" data-toggle="collapse"
        data-target="#Qualification" aria-expanded="false" aria-controls="Qualification">{{ __('label.education') }}
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none"
            class="plus_icon">
            <path d="M10.0001 4.16666V15.8333M4.16675 9.99999H15.8334" stroke="#357de8" stroke-width="1.5"
                stroke-linecap="round" stroke-linejoin="round" />
        </svg>
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none"
            class="minus_icon">
            <path d="M4.16675 10H15.8334" stroke="#357de8" stroke-width="1.5" stroke-linecap="round"
                stroke-linejoin="round" />
        </svg>
    </h4>
    <div class="collapse hide" id="Qualification">
        <ul class="form-group list-unstyled mb-0 mt-3">
            @foreach ($qualificationFilter as $key => $qualification)
                <li class="mb-1"><label class="mb-0"><input class="mr-2" type="checkbox"
                            name="qualification_id[]" value="{{ $key ?? null }}" />{{ $qualification }}</label>
                </li>
            @endforeach


        </ul>
    </div>
</div>

{{-- <div class="inner_wraper mb-4  pb-3 border-bottom">
    <h4 class="cursor-pointer d-flex align-items-center justify-content-between mb-3 collapsed" data-toggle="collapse"
        data-target="#Specialization" aria-expanded="false" aria-controls="Specialization">
        {{ __('label.specializations') }}
        {{-- <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none"
            class="plus_icon">
            <path d="M10.0001 4.16666V15.8333M4.16675 9.99999H15.8334" stroke="#357de8" stroke-width="1.5"
                stroke-linecap="round" stroke-linejoin="round" />
        </svg>
         <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none"
            class="minus_icon">
            <path d="M4.16675 10H15.8334" stroke="#357de8" stroke-width="1.5" stroke-linecap="round"
                stroke-linejoin="round" />
        </svg> --}}


    </h4>
    {{-- {!! Form::select('specialization_id', $specializationFilter ?? null, [
        'class' => 'form-control vue-select2 ',
        'data-placeholder' => trans('label.specializations'),
        'multiple' => false,
    ]) !!} --}

    {!! Form::select('specialization_id',['' => ''] + $specializationFilter ?? [], old('specialization_id', $selected ?? null), [
        'class' => 'form-control ' . (isset($errors) && $errors->has('specialization_id') ? 'is-invalid' : ''),
        'data-placeholder' => $placeholder ?? trans('label.job_detail_page.specialization'),
    ]) !!}







    {{-- <div class="collapse hide" id="Specialization">
        <ul class="form-group list-unstyled mb-0 mt-3">
            @foreach ($specializationFilter as $key => $specialization)
                <li class="mb-1"><label class="mb-0"><input class="mr-2" type="checkbox"
                            name="specialization_id[]" value="{{ $key ?? null }}" />{{ $specialization }}</label>
                </li>
            @endforeach

        </ul>
    </div> --}
</div> --}}

{{-- <div class="inner_wraper mb-4  pb-3 border-bottom">
        <h4 class="cursor-pointer d-flex align-items-center justify-content-between mb-0 collapsed" data-toggle="collapse" data-target="#salary_type" aria-expanded="false" aria-controls="salary_type">{!! __('label.salary_type') !!}
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none" class="plus_icon">
                <path d="M10.0001 4.16666V15.8333M4.16675 9.99999H15.8334" stroke="#357de8" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none" class="minus_icon">
                <path d="M4.16675 10H15.8334" stroke="#357de8" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
        </h4>
        <div class="collapse hide" id="salary_type">
            <ul class="form-group list-unstyled mb-0 mt-3 d-flex flex-wrap">
                @foreach ($salaryTypeFilter as $key => $salarytype)
                    <li class="mb-1 w-50 "><label><input type="radio" class="mr-2" name="salary_type_id[]" value="{{$key ?? null}}" />{{$salarytype}}</label></li>
                @endforeach
            </ul>

        </div>
    </div>
    <div class="inner_wraper mb-4  pb-3 border-bottom">
        <h4 class="cursor-pointer d-flex align-items-center justify-content-between mb-0 collapsed" data-toggle="collapse" data-target="#salary" aria-expanded="false" aria-controls="salary">{!! __('label.salary') !!}
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none" class="plus_icon">
                <path d="M10.0001 4.16666V15.8333M4.16675 9.99999H15.8334" stroke="#357de8" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none" class="minus_icon">
                <path d="M4.16675 10H15.8334" stroke="#357de8" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
        </h4>
        <div class="collapse hide" id="salary">
            <ul class="form-group list-unstyled mb-0 mt-1">
                @foreach ($salaryFilter as $key => $salary)
                    <li class="mb-1"><label class="mb-0"><input type="checkbox" class="mr-2" name="salary_id[]" value="{{$key ?? null}}" />{{$salary}}</label></li>
                @endforeach
            </ul>
        </div>
    </div> --}}
{!! Form::close() !!}
