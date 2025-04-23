{!! Form::open(['id' => $form_id]) !!}
<div class="row">
    <div class="col-sm pr-sm-0">
        <div class="form-group">
            {!! Form::text('searchTerm', $searchTerm ?? null, ['class' => 'form-control', 'placeholder' => __('label.search_by_job'), "autocomplete" => 'off']) !!}
        </div>
    </div>
    <div class="col-auto ">
   <button type="submit" class="btn btn-primary search-icon-btn">Search</button>
        <!-- {!! Form::submit(__('label.searchBtn'), ['class' => 'btn btn-primary rounded-pill px-5']) !!} -->
    </div>
    {{-- <div class="col-sm text-right" id="search-employerJob">
        @if($employer_job_id != 0)
            <a class="btn btn-primary btn-sm ml-auto" href="{{ route($entity['url'].'.create', ['employer_job_id' => $employer_job_id, 'user_id' => 0]) }}">{!! __('label.add_interview_schedule') !!}</a>
        @endif
    </div> --}}
    <div class="col-sm text-right" id="search-employerJob">
        @if($employer_job_id != 0)

            <a class="btn btn-primary btn-sm ml-auto" href="{{ route($entity['url'].'.create', ['employer_job_id' => $employer_job_id, 'user_id' => 0]) }}">
                <span class="">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                        <path d="M7.99998 1.58331V14.4166M1.58331 7.99998H14.4166" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg> {!! __('label.interview_schedule') !!}
                </span>
            </a>

        @endif
    </div>
</div>
{!! Form::close() !!}
