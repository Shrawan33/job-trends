@if($dependent??true)
{!! Form::select($name??'location_id', $locations, old($name??'location_id', $selected ?? null), ['class' => 'form-control vue-select2 '. (isset($errors) && $errors->has('location_id') ? 'is-invalid' : ''), 'data-placeholder'=> $placeholder??trans('label.city'), 'ajax-url' => route('ajax.locations'), 'multiple' => $multiple??false, 'select-parent' => 'state_id']) !!}
@else
{!! Form::select($name??'location_id', $locations, old($name??'location_id', $selected ?? null), ['class' => 'form-control vue-select2 '. (isset($errors) && $errors->has('location_id') ? 'is-invalid' : ''), 'data-placeholder'=> $placeholder??trans('label.city'), 'ajax-url' => route('ajax.locations'), 'multiple' => $multiple??false]) !!}
@endif
