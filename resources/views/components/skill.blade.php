{{-- @dd($skills); --}}
@if($label??false)
{!! Form::label('skill_id', trans('label.job_detail_page.skills'), ['class' => $labelClass??'']) !!}
@endif
{!! Form::select($name??'skill_id[]', $skills??[], old($name??'skill_id', $selected ?? null), ['class' => 'form-control vue-select2'. (isset($errors) && $errors->has($name??'skill_id') ? 'is-invalid' : ''), 'data-placeholder'=> $placeholder??trans('label.applyjob_skills'), 'ajax-url' => route('ajax.skill'), 'multiple' => $multiple??false]) !!}
