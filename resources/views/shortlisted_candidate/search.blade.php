{!! Form::open(['id' => $form_id]) !!}
<div class="row">
    <div class="col-sm">
        <div class="form-group">
            {!! Form::text('searchTerm', $searchTerm ?? null, ['class' => 'form-control', 'placeholder' =>trans('label.search_by_name'), "autocomplete" => 'off']) !!}
        </div>
    </div>
    <div class="col-sm">
        <div class="form-group">
            {!! Form::text('searchJob', $searchJob ?? null, ['class' => 'form-control', 'placeholder' => trans('label.searchByTitle'), "autocomplete" => 'off']) !!}
        </div>
    </div>

    <div class="col-auto">
        {!! Form::submit(__('label.searchBtn'), ['class' => 'btn btn-primary']) !!}
    </div>

</div>
{!! Form::close() !!}
