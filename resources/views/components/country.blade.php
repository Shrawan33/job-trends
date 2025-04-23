{{-- {!! Form::select($name??'country_id', $countries??null, old($name??'country_id', $selected ?? null), ['class' => 'form-control vue-select2 '. (isset($errors) && $errors->has('state_id') ? 'is-invalid' : ''), 'data-placeholder'=> trans('label.country'), 'ajax-url' => route('ajax.countries'), 'multiple' => $multiple??false,'id' =>'country_id']) !!} --}}
{!! Form::select($name ?? 'country_id', $countries ?? null, old($name ?? 'country_id', 356), [
    'class' => 'form-control vue-select2 ' . (isset($errors) && $errors->has('state_id') ? 'is-invalid' : ''),
    'data-placeholder' => trans('label.country'),
    'ajax-url' => route('ajax.countries'),
    'multiple' => $multiple ?? false,
    'id' => 'country_id',
    'required' => $required ?? false
]) !!}

@push('page_scripts')
    <script>
        $(document).ready(function() {
            $("[name={{ $name ?? 'country_id' }}]").on('change', function() {
                // console.log('state change', $("[select-parent={{ $name ?? 'state_id' }}]"));
                $("[select-parent={{ $name ?? 'country_id' }}]").val('').trigger('change');
            });
        })
    </script>
@endpush
