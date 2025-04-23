{!! Form::open(['id' => 'search-quick', 'url' => route('search-jobs.index'), 'method' => 'get']) !!}
<div class="search-form d-flex align-items-center flex-wrap">
    {!! Form::hidden('quick-search', null) !!}

            <div class="form-group mb-20 mb-lg-0">
                <label>Search Role</label>
                {!! Form::text('keyword', null, ['class' => 'form-control', 'placeholder' =>trans('label.search_by_job_key')]) !!}
            </div>

            <div class="form-group mb-20 mb-lg-0" id="search-location">
                <label>Location</label>
                @include('components.location', ['locations' => [], 'selected' => '', 'multiple' => false, 'dependent' => false])
            </div>

            {{-- <div class="form-group col-12 mb-0" id="search-category">
                @include('components.category', ['categories' => [], 'selected' => '', 'multiple' => false, 'dependent' => false])
            </div> --}}

            <div class="ml-lg-auto mb-0 search_btn">
                <span class="position-relative search_icon d-block">
                    {!! Form::submit('Search Jobs', ['class' => 'btn btn-secondary search_btn']) !!}</span>
            </div>
</div>
{{-- ~ --}}
{!! Form::close() !!}
