@if($dependent??true)
{!! Form::select($name??'city_preference[]', $city_preference, old($name??'city_preference[]', $selected ?? null), ['class' => 'form-control vue-select2 '. (isset($errors) && $errors->has('city_preference') ? 'is-invalid' : ''), 'data-placeholder'=> $placeholder??trans('label.city'), 'ajax-url' => route('ajax.locations'), 'multiple' => $multiple??false]) !!}
@else
{!! Form::select($name??'city_preference[]', $city_preference, old($name??'city_preference[]', $selected ?? null), ['class' => 'form-control vue-select2 '. (isset($errors) && $errors->has('city_preference') ? 'is-invalid' : ''), 'data-placeholder'=> $placeholder??trans('label.city'), 'ajax-url' => route('ajax.locations'), 'multiple' => $multiple??false]) !!}
@endif
