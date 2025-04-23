@if($label??false)
{!! Form::label('category_id', trans('label.category'), ['class' => $labelClass??'']) !!}
@endif
{!! Form::select($name??'category_id[]', $categories??[], old($name??'category_id', $selected ?? null), ['class' => 'form-control vue-select2 '. (isset($errors) && $errors->has($name??'category_id') ? 'is-invalid' : ''), 'data-placeholder'=> $placeholder??trans('label.category'), 'ajax-url' => route('ajax.categories'), 'multiple' => $multiple??false]) !!}
