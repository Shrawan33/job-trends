{!! Form::open(['url' => $formUrl,'method'=>'get', 'id' => 'frm_'.$entity['targetModel']]) !!}
<div class="row border-bottom">
    <div class="col-md-4">
        <div class="form-group">
            {!! Form::text('keyword',  $input['keyword']??null, ['class' => 'form-control', 'placeholder' => __('label.search_by_keyword') , "autocomplete" => 'off','id' => 'search_term']) !!}
        </div>
    </div>
    <div class="col-md">
        <div class="form-group">
            {!! Form::select('job_type', $jobTypeFilter??null,$input['job_type']??null, ['class' => 'form-control',
            'data-placeholder' => __('label.job_type')]) !!}
        </div>
    </div>
    {{-- <div class="col-md">
        <div class="form-group">
            @include('components.state', ['states' => $stateFilter??[], 'selected' => $input['state_id']??null,'multiple' => false])
        </div>
    </div> --}}
    <div class="col-md">
        <div class="form-group">
            @include('components.location', ['locations' => $locationFilter??[], 'selected' => $input['location_id']??null,'multiple' => false,'data-placeholder' => __('label.search_by_location'), 'dependent' => false])
        </div>

    </div>
    <div class="col-md-auto">
        <div class="form-group ">
            {!! Form::submit('Search', ['class' => 'btn btn-primary ','id' => 'top-search']) !!}
        </div>
    </div>
</div>
{!! Form::close() !!}
