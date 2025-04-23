{!! Form::open(['id' => 'search-quick', 'url' => route('search-jobs.index'), 'method' => 'get']) !!}
<div class="search-form about_page_search_form">
    {!! Form::hidden('quick-search', null) !!}

            <div class="form-group mb-20">
                
                {!! Form::text('keyword', null, ['class' => 'form-control', 'placeholder' =>trans('label.search_by_job_key')]) !!}
            </div>

            <div class="form-group mb-20" id="search-location">
                @include('components.location', ['locations' => [], 'selected' => '', 'multiple' => false, 'dependent' => false])
            </div>

            {{-- <div class="form-group col-12 mb-0" id="search-category">
                @include('components.category', ['categories' => [], 'selected' => '', 'multiple' => false, 'dependent' => false])
            </div> --}}

            <div class="ml-lg-auto mb-0 search_btn d-flex">
                <span class="position-relative search_icon d-block w-100">
                    {!! Form::submit('Search Jobs', ['class' => 'w-100 btn btn-secondary search_btn']) !!}</span>
                <button class="w-100 btn border-0 px-2 btn-secondary bg-white text-secondary">
                    <a class=" text-secondary @if (Route::is('subscription.expertise-plan')) active @endif"
                        href="{{ route('career-service') }}">
                        {{ trans('label.career_services') }}</a>
                </button>
            </div>
</div>
{{-- ~ --}}
{!! Form::close() !!}
