{!! Form::open(['id' => $form_id]) !!}
<div class="row">
    <div class="col-sm">
        <div class="form-group">
            {!! Form::text('searchTerm', $searchTerm ?? null, ['class' => 'form-control', 'placeholder' =>trans('label.search_by_term'), "autocomplete" => 'off']) !!}
        </div>
    </div>
    <div class="col-sm">
        <div class="form-group">
            <div class="form-location-input">
                @include('components.state', ['states' => $stateFilter??[], 'selected' => $input['state_id']??null,'multiple' => false,'data-placeholder' => __('label.search_by_state'), 'dependent' => true])
            </div>
        </div>
    </div>
    <div class="col-sm">
        <div class="form-group ">
            @include('components.location', ['locations' => $locationFilter??[], 'selected' =>
            $input['location_id']??'','multiple' => false,'placeholder' => __('label.city')])
        </div>
    </div>

    <div class="col-auto">
        {!! Form::submit(__('label.find_job_alert'), ['class' => 'btn btn-primary']) !!}
    </div>

</div>
{!! Form::close() !!}
