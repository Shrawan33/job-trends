{!! Form::open(['id' => $form_id]) !!}
<div class="row mb-3">
    <div class="col-md-4">
        <div class="d-none"> {!! Form::select('status[]', $statusFilter, ['active','archived'], ['class' => 'form-control', 'multiple' => 'multiple', 'data-placeholder' => __('label.statusSelect')]) !!}
        </div>
        <div class="form-group">
            {!! Form::text('search[value]', $searchTerm ?? null, ['class' => 'form-control', 'placeholder' => __('label.searchByTitle'), "autocomplete" => 'off']) !!}
        </div>
    </div>
    <div class="col-5 col-md-2 pl-lg-0">
        {!! Form::submit(__('label.searchBtn'), ['class' => 'btn btn-primary']) !!}
    </div>
    <div class="col-7 col-md-6 text-right">
        @hasanyrole('employer|admin')
            @if ($package_access)

                @if (auth()->user()->activeUserPackage)
                <a class="btn btn-primary d-inline-block" href="{{ route('subscription.service.employer') }}">
                    {!! __('label.buy_package') !!}
                 </a>
                    <a class="btn btn-primary d-inline-block ml-15" href="{{ route($entity['url'].'.create') }}">
                        <span class="">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                                <path d="M7.99998 1.58331V14.4166M1.58331 7.99998H14.4166" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </span> {!! __('label.add_job') !!}
                    </a>
                @else
                    <a class="btn btn-secondary d-inline-block" href="{{ route('subscription.service.employer') }}">
                        {!! __('label.buy_package') !!}
                    </a>

                    <a class="btn btn-primary d-inline-block ml-15" href="{{ route($entity['url'].'.create') }}">
                        <span class="">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                                <path d="M7.99998 1.58331V14.4166M1.58331 7.99998H14.4166" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </span> {!! __('label.add_job') !!}
                    </a>
                @endif
            @else
            <a class="btn btn-secondary d-inline-block" href="{{ route('subscription.service.employer') }}">
                {!! __('label.buy_package') !!}
             </a>
            <a class="btn btn-primary d-inline-block ml-15" href="javascript:void(0)" title="To use this feature, please activate your package" data-toggle ="tooltip">
                <span class="" >
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                        <path d="M7.99998 1.58331V14.4166M1.58331 7.99998H14.4166" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </span>
                    {{ trans('label.add_job') }}
            </a>

            @endif
        @endhasanyrole
    </div>

</div>
{!! Form::close() !!}
