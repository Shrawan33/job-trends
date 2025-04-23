{!! Form::select($name ?? 'category_id', ['' => ''] + [' ' => 'Select category'] +($category ?? []), old($name ?? 'category_id', $selected ?? null), ['class' => 'form-control select2 ' . (isset($errors) && $errors->has('category_id') ? 'is-invalid' : ''), 'data-placeholder' => trans('label.category')]) !!}
@error('category_id')
    <span class="error invalid-feedback">{{ $message }}</span>
@enderror


