{!! Form::open(['id' => $form_id]) !!}

<div class="row ">
    <div class="col-sm">
        {!! Form::select('status[]', $statusFilter, 'active', ['class' => 'form-control', 'multiple' => 'multiple', 'data-placeholder' => trans('label.statusSelect')]) !!}
    </div>

    <div class="col-sm">
        <div class="form-group mb-4">
            {!! Form::text('search[value]', null, ['class' => 'form-control', 'placeholder' =>  trans('label.keyword'),"autocomplete" => 'off']) !!}
        </div>
    </div>

</div>
{!! Form::close() !!}
