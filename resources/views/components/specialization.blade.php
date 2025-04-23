{!! Form::select($name ?? 'specialization_id', ['' => ''] + [' ' => 'Select specialization'] +($specializations ?? []), old($name ?? 'specialization_id', $selected ?? null), ['class' => 'form-control select2 ' . (isset($errors) && $errors->has('specialization_id') ? 'is-invalid' : ''), 'data-placeholder' => trans('label.specializations')]) !!}
@error('specialization_id')
    <span class="error invalid-feedback">{{ $message }}</span>
@enderror


