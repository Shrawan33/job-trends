
{!! Form::open(['route' => $targetUrl??$entity['url'].'.index','method'=>'get', 'id' => 'frm_'.$entity['targetModel']]) !!}
<div class="row my-5">
    <div class="col-md-6">
        <div class="form-group ">
            {!! Form::text('keyword', $input['keyword']??null, ['class' => 'form-control', 'placeholder' =>
            __('label.search_candidate_by_job') , "autocomplete" => 'off','id' => 'search_term']) !!}
        </div>
    </div>

    <div class="col-md">
        <div class="form-group ">
            @include('components.location', ['locations' => $locationFilter??[], 'selected' =>
            $input['location_id']??'','multiple' => false,'placeholder' => __('label.search_location')])
        </div>

    </div>
    <div class="col-md-auto">
        <div class="form-group ">
            {!! Form::submit('Search', ['class' => 'btn btn-primary','id' => 'top-search']) !!}
        </div>
    </div>
</div>
{!! Form::close() !!}
