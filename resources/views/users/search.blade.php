

 {!! Form::open(['id' => $form_id]) !!}
<div class="row">
    <div class="col-md-4">
        {!! Form::select('status[]', $statusFilter, 'active', ['class' => 'form-control', 'multiple' => 'multiple', 'data-placeholder' => trans('label.statusSelect')]) !!}
    </div>

     <div class="col-md-4">
        {!! Form::select('role[]', array_merge(['0'=>'All'],$RoleFilter), '0', ['class' => 'form-control', 'multiple' => 'multiple', 'data-placeholder' => trans('label.role')]) !!}
    </div>
    <div class="col-md-4 ml-auto">
        {!! Form::text('search[value]', null, ['class' => 'form-control', 'placeholder' => trans('label.search_term'), "autocomplete" => 'off']) !!}
    </div>


</div>
{!! Form::close() !!}
