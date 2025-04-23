@if($label??false)
{!! Form::label('work_type_id', trans('label.work_types'), ['class' => $labelClass??'']) !!}
@endif
{!! Form::select($name??'work_type_id[]', $jobTypeFilter??[], old($name??'work_type_id', $selected ?? null), ['class' => 'form-control vue-select2'. (isset($errors) && $errors->has($name??'skill_id') ? 'is-invalid' : ''), 'data-placeholder'=> $placeholder??trans('label.work_types'), 'ajax-url' => route('ajax.workType'), 'multiple' => $multiple??false]) !!}
