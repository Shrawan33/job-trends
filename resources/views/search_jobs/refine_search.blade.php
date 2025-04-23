<input type="hidden" name="keyword" value="{{ $input['keyword'] ?? null }}">
<input type="hidden" name="job_type" value="{{ $input['job_type'] ?? null }}">
<input type="hidden" name="location_id" value="{{ $input['location_id'] ?? null }}">



{!! Form::hidden('country_id', config('constants.default_country_id')) !!}
{{-- <input type="hidden" name="state_id" value="{{$input['state_id']??null}}"> --}}
<div class="row">
    <div class="col-md-11">
        <div class="row search_filter_main_wraper">
            <div class="search-keywerd col-12 col-md-4 col-xl-3 pr-lg-0 mb-15">
                {{-- <h4>Search Keyword</h4> --}}
                <div class="search-keyword-form position-relative">
                    {!! Form::text('keyword', $input['keyword'] ?? null, [
                        'class' => 'form-control',
                        'placeholder' => __('label.search_by_keyword'),
                        'autocomplete' => 'off',
                        'id' => 'search_term',
                    ]) !!}
                    <svg class="search_icon" width="16" height="16" viewBox="0 0 16 16" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M15 15L12.2779 12.2778M14.2222 7.61111C14.2222 11.2623 11.2623 14.2222 7.61111 14.2222C3.95989 14.2222 1 11.2623 1 7.61111C1 3.95989 3.95989 1 7.61111 1C11.2623 1 14.2222 3.95989 14.2222 7.61111Z"
                            stroke="#0D51A2" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                    </svg>
                </div>
            </div>
            @if (!isset($slug))
                <div class="col-12 col-md-4 col-xl-3 pr-lg-0 mb-15">
                    @include('components.category', [
                        'categories' => $categoryFilter ?? [],
                        'selected' => $input['category_id'] ?? null,
                        'multiple' => true,
                        'data-placeholder' => __('label.search_by_category'),
                        'dependent' => false,
                    ])
                </div>
            @else
                {{-- <div class="col-12 col-md-3 col-lg pr-lg-0 mb-2 ">
                        <div class="from-check"> --}}
                <input type="hidden" name="category_id[]" value="{{ $categoryFilter->id ?? null }}">
                {{-- <label class="form-check-label">{{$categoryFilter->title??''}} ({{ $categoryFilter->employerjobs_count }})</label> --}}
                {{-- </div>
                    </div> --}}
            @endif
            <div class="col-12 col-md-4 col-xl-2 pr-lg-0 mb-15">
                {{-- <h4>State</h4> --}}
                <div class="form-location-input">
                    @include('components.state', [
                        'states' => $stateFilter ?? [],
                        'selected' => $input['state_id'] ?? null,
                        'multiple' => false,
                        'data-placeholder' => __('label.search_by_state'),
                        'dependent' => true,
                    ])
                </div>
            </div>
            <div class="col-12 col-md-4 col-xl-2 pr-lg-0 mb-15">
                {{-- <h4>City</h4> --}}
                <div class="form-location-input">
                    @include('components.location', [
                        'locations' => $locationFilter ?? [],
                        'selected' => $input['location_id'] ?? null,
                        'multiple' => false,
                        'data-placeholder' => __('label.search_by_location'),
                        'dependent' => true,
                    ])
                </div>
            </div>
            {{-- <div class="col-12 col-md-4 col-xl-2 pr-lg-0 mb-3">
                <!-- Category Id  Field -->
                <div class="form-group mb-0">

                    {!! Form::select('job_type_id', $jobTypes ?? [], null, [
                        'class' => 'form-control ' . ($errors->has('job_type_id') ? 'is-invalid' : ''),
                        'data-placeholder' => trans('label.job_type'),
                    ]) !!}
                    @if ($errors->has('job_type_id'))
                        <span class="text-danger">{{ $errors->first('job_type_id') }}</span>
                    @endif
                </div>
            </div> --}}
            <div class="col-12 col-md-4 col-xl-2 pr-lg-0 mb-15">
                @include('components.experience', [
                    'experiences' => $experinceFilter ?? [],
                    'selected' => $input['experience_id'] ?? null,
                    'multiple' => true,
                    'data-placeholder' => __('label.experience'),
                    'dependent' => false,
                ])
            </div>
            <div class="col-12 col-md-4 col-xl-2 pr-lg-0 mb-15">
                @include('components.workType', [
                    'jobTypes' => $jobTypeFilter ?? [],
                    'selected' => $input['work_type_id'] ?? null,
                    'multiple' => true,
                    'data-placeholder' => __('label.work_type_id'),
                    'dependent' => false,
                ])
            </div>
            <div class="col-12 col-md-4 col-xl-2 pr-lg-0 mb-15">
                @include('components.skill', [
                    'skills' => $skillFilter ?? [],
                    'selected' => $input['skill_id'] ?? null,
                    'multiple' => true,
                    'data-placeholder' => __('label.skills'),
                    'dependent' => false,
                ])
            </div>
            <div class="col-12 col-md-4 col-xl-2 pr-lg-0 mb-15">
                {!! Form::select('qualification_id[]', $qualificationFilter ?? [], null, [
                    'class' => 'form-control',
                    'multiple' => true,
                    'data-placeholder' => trans('label.education'),
                ]) !!}
            </div>
            {{-- <div class="col-12 col-md-3 col-lg pr-lg-0 mb-2">
                    <!-- Specialization Id -->
                    <div class="form-group mb-4">
                        @if (isset($label) && $label)
                            {!! Form::label('specialization_id', trans('label.specializations'), ['class' => $labelClass ?? '']) !!}
                        @endif
                        {!! Form::select('specialization_id', $specializationFilter ?? [], null, [
                            'class' => 'form-control ' . ($errors->has('specialization_id') ? 'is-invalid' : ''),
                            'data-placeholder' => trans('label.specializations'),
                        ]) !!}
                        @if ($errors->has('specialization_id'))
                            <span class="text-danger">{{ $errors->first('specialization_id') }}</span>
                        @endif
                    </div>
                </div> --}}

            {{-- <div class="col-12 col-md-3 col-lg pr-lg-0 mb-2">
                <!-- Specialization Id -->
                <div class="form-group mb-4">
                    {!! Form::select('specialization_id', $specializationFilter ?? [], null, [
                        'class' => 'form-control ' . ($errors->has('specialization_id') ? 'is-invalid' : ''),
                        'data-placeholder' => trans('label.specializations'),
                    ]) !!}
                </div>
            </div> --}}

            {{-- <div class="col-12 col-md-3 col-lg pr-lg-0 mb-2">
                <!-- Specialization Id -->
                <div class="form-group mb-4">
                    {!! Form::select('specialization_id', $specializationFilter ?? [], null, [
                        'class' => 'form-control ' . ($errors->has('specialization_id') ? 'is-invalid' : ''),
                        'data-placeholder' => trans('label.specializations'),
                     // Add an ID to the select element for referencing in JavaScript
                    ]) !!}
                </div>
            </div> --}}
            {{-- <div class="col-12 col-md-4 col-xl-2 pr-lg-0 specializations mb-3">
                <!-- Specialization Id -->
                <div class="form-group mb-0">
                    {{-- {!! Form::label('specialization_id', trans('label.specializations')) !!} --}
                        {!! Form::select('specialization_id',$specializationFilter ?? [], old('specialization_id', $selected ?? null), [
                            'class' => 'form-control ' . (isset($errors) && $errors->has('specialization_id') ? 'is-invalid' : ''),
                            'data-placeholder' => $placeholder ?? trans('label.job_detail_page.specialization'),
                        ]) !!}
                </div>
            </div> --}}

            <div class="col-12 col-md-4 col-xl-2 pr-lg-0 mb-15">
                <div class="form-group mb-0">
                    <div class="custom-control custom-switch d-flex align-items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18" fill="none">
                            <path d="M9.00068 11.75C6.09477 11.75 3.51057 13.1531 1.86534 15.3305C1.51124 15.7991 1.33419 16.0334 1.33998 16.3501C1.34446 16.5948 1.49809 16.9034 1.6906 17.0545C1.93977 17.25 2.28506 17.25 2.97564 17.25H15.0257C15.7163 17.25 16.0616 17.25 16.3108 17.0545C16.5033 16.9034 16.6569 16.5948 16.6614 16.3501C16.6672 16.0334 16.4901 15.7991 16.136 15.3305C14.4908 13.1531 11.9066 11.75 9.00068 11.75Z" stroke="#717884" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M9.00068 9C11.2789 9 13.1257 7.15317 13.1257 4.875C13.1257 2.59683 11.2789 0.75 9.00068 0.75C6.7225 0.75 4.87568 2.59683 4.87568 4.875C4.87568 7.15317 6.7225 9 9.00068 9Z" stroke="#717884" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                        <input type="checkbox" class="custom-control-input d-none" id="toggleis_featured" name="is_featured" value="1" {{ request('is_featured') == 1 ? 'checked' : '' }}>
                        <label class="custom-control-label" for="toggleis_featured">Featured Jobs</label>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-4 col-xl-2 pr-lg-0 mb-15 ">
                <h4 class="cursor-pointer form-control mb-0" data-toggle="collapse" data-target="#salary" aria-expanded="false" aria-controls="salary">{!! __('label.salary') !!}</h4>
                <div class="collapse hide drop_wraper" id="salary">
                    <ul class="form-group list-unstyled d-flex flex-wrap">
                        @foreach ($salaryTypeFilter as $key => $salarytype)
                            <li class="mb-1 w-50 "><label><input type="radio" class="mr-2" name="salary_type_id[]" value="{{$key ?? null}}" />{{$salarytype}}</label></li>
                        @endforeach
                    </ul>
                    <ul class="form-group list-unstyled">
                        @foreach ($salaryFilter as $key => $salary)
                            <li class="mb-1"><label><input type="checkbox" class="mr-2" name="salary_id[]" value="{{$key ?? null}}" />{{$salary}}</label></li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-1">
        <div class="row">
            <div class="px-md-3 mb-20 col-12 d-flex flex-wrap flex-xl-nowrap text-md-center justify-content-end justify-content-lg-start">
                <span class="more_search d-block" title="Advance Search" data-toggle="tooltip">
                    <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" viewBox="0 0 44 44" fill="none">
                        <rect width="44" height="44" rx="8" fill="#F6FAFE"/>
                        <path d="M28.3996 18.8L21.9996 25.2L15.5996 18.8" stroke="#717884" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </span>
                {{-- <button class="btn btn-link">Clear</button> --}}
                <a href="{{ route('search-jobs.index') }}" class="btnreset ml-20 ml-md-0 ml-xl-20 mt-md-2 mt-xl-0">
                    <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" viewBox="0 0 44 44" fill="none">
                        <rect width="44" height="44" rx="8" fill="#F6FAFE"/>
                        <path d="M13.1992 20.2222C13.1992 20.2222 13.306 19.4673 16.3989 16.3431C19.4919 13.219 24.5066 13.219 27.5995 16.3431C28.6953 17.4501 29.4029 18.8006 29.7223 20.2222M13.1992 20.2222V14.8889M13.1992 20.2222H18.4792M30.7992 23.7778C30.7992 23.7778 30.6925 24.5327 27.5995 27.6569C24.5066 30.7811 19.4919 30.7811 16.3989 27.6569C15.3031 26.5499 14.5955 25.1994 14.2762 23.7778M30.7992 23.7778V29.1111M30.7992 23.7778H25.5192" stroke="#357de8" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </a>
            </div>
        </div>
    </div>
    {{-- <div class="col-12 col-md-3 col-lg pr-lg-0 mb-2 ">
        <h4 class="cursor-pointer form-control mb-0" data-toggle="collapse" data-target="#experience" aria-expanded="false" aria-controls="experience">{!! __('label.experience') !!}</h4>
        <div class="collapse hide drop_wraper" id="experience">
            <ul class="form-group list-unstyled">
            @foreach ($experinceFilter as $key => $experince)
                <li class="mb-1"><label><input type="checkbox" class="mr-2" name="experience_id[]" value="{{$key ?? null}}" />{{$experince}}</label></li>
                @endforeach
            </ul>
        </div>
    </div> --}}
    {{-- <div class="col-12 col-md-3 col-lg pr-lg-0 mb-2 ">
        <h4 class="cursor-pointer form-control mb-0" data-toggle="collapse" data-target="#education" aria-expanded="false" aria-controls="education">{!! __('label.education') !!}</h4>
        <div class="collapse hide drop_wraper" id="education">
            <ul class="form-group list-unstyled">
                @foreach ($qualificationFilter as $key => $qualification)
                    <li class="mb-1"><label><input type="checkbox" class="mr-2" name="qualification_id[]" value="{{$key ?? null}}" />{{$qualification}}</label></li>
                @endforeach
            </ul>
        </div>
    </div> --}}
    {{-- @if (!isset($slug))
        <div class="col-12 col-md-3 col-lg pr-lg-0 mb-2 ">
            <h4 class="cursor-pointer form-control mb-0" data-toggle="collapse" data-target="#category" aria-expanded="false" aria-controls="category">{!! __('label.category') !!} </h4>
            <div class="collapse hide drop_wraper" id="category">
                <ul class="form-group list-unstyled">
                    @foreach ($categoryFilter as $key => $category)
                    <li class="mb-1"><label><input type="checkbox" class="mr-2" name="category_id[]"
                                value="{{$key ?? null}}" />{{$category}}</label></li>
                    @endforeach
                </ul>
            </div>
        </div>
    @else
        <div class="col-12 col-md-3 col-lg pr-lg-0 mb-2 ">
            <h4 class="cursor-pointer form-control mb-0" data-toggle="collapse" data-target="#category" aria-expanded="false" aria-controls="category">{!! __('label.category') !!} </h4>
            <div class="collapse show drop_wraper" id="category">
                <ul class="form-group list-unstyled">
                    <li class="mb-1"><label>{{$categoryFilter->title??''}} </label></li>
                    <input type="hidden" name="category_id" value="{{$categoryFilter->id??null}}">
                </ul>
            </div>
        </div>
    @endif --}}

    {{-- <div class="col-12 col-md-3 col-lg pr-lg-0 mb-2 ">
        <h4 class="cursor-pointer form-control mb-0" data-toggle="collapse" data-target="#experience" aria-expanded="false" aria-controls="experience">{!! __('label.experience') !!}</h4>
        <div class="collapse hide drop_wraper" id="experience">
            <ul class="form-group list-unstyled">
            @foreach ($experinceFilter as $key => $experince)
                <li class="mb-1"><label><input type="checkbox" class="mr-2" name="experience_id[]" value="{{$key ?? null}}" />{{$experince}}</label></li>
                @endforeach
            </ul>
        </div>
    </div> --}}


</div>
</div>
<script>
    $(document).ready(function(){
        $(".more_search").click(function(){
            $(".search_filter_main_wraper").toggleClass("active");
            $(".filter-list").toggleClass("active");
        });
    });
</script>
<style>
    .custom-switch .custom-control-input:checked ~ .custom-control-label::after{
        background-color: #fff !important;
        transform: translateX(0.7rem) !important;
    }
    .custom-control-input:checked ~ .custom-control-label::before{
        background-color: #163bb9 !important;
    }
    @media(min-width: 1650px){
        .custom-switch .custom-control-input:checked ~ .custom-control-label::after{
            transform: translateX(0.95rem) !important;
        }
    }
</style>
