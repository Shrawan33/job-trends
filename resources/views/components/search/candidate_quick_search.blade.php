{!! Form::open(['id' => 'search-quick', 'url' => route('candidates.index'), 'method' => 'get']) !!}
<div class="search-form after_login_search_form">
    <div class="">
        <div class="row">
            <!-- Title Field -->

            {!! Form::hidden('quick-search', null) !!}
            <div class="form-group mb-20 col-md-3 mb-lg-0">
                <label>Search Role</label>
                {!! Form::text('keyword', null, ['class' => 'form-control', 'placeholder' =>trans('label.search_candidate_by_job')]) !!}
            </div>

            <div class="form-group mb-20 col-md-3 mb-lg-0" id="search-location">
                <label>Location</label>
                @include('components.location', ['locations' => [], 'selected' => '', 'multiple' => false, 'dependent' => false])
            </div>

            <div class="form-group mb-20 col-md-3 mb-lg-0" id="search-category">
                <label>Job Category</label>
                @include('components.category', ['categories' => [], 'selected' => '', 'multiple' => false, 'dependent' => false])
            </div>


            <div class="form-group col-lg-3 pl-lg-0 align-items-center mb-0 mx-auto d-flex justify-content-end">
                {!! Form::submit('Search', ['class' => 'btn btn-primary search_btn mr-10']) !!}
                @if ($package_access)
                    @if (auth()->user()->activeUserPackage)
                        <a href="{{route('employerJobs.create')}}" class="btn btn-secondary">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                                <path d="M7.99998 1.58331V14.4166M1.58331 7.99998H14.4166" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                            </svg>
                            {{ trans('label.add_job') }}</a>
                    @else
                        <a href="javascript:void(0)" data-toggle="tooltip" data-original-title="To use this feature, please activate your package" title="" class="btn btn-secondary">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                                <path d="M7.99998 1.58331V14.4166M1.58331 7.99998H14.4166" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                            </svg>
                            {{ trans('label.add_job') }}</a>
                    @endif
                @else
                    <a href="{{route('employerJobs.create')}}" class="btn btn-secondary">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                            <path d="M7.99998 1.58331V14.4166M1.58331 7.99998H14.4166" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                        </svg>
                        {{ trans('label.add_job') }}</a>
                @endif
            </div>
            <div class="form-group col-12 mb-0">
                {{-- <a href="javascript:;" class="btn btn-secondary font-weight-bold rounded-pill px-4 text-white">Add Jobs</a> --}}

            </div>

        </div>
    </div>
</div>
{!! Form::close() !!}
