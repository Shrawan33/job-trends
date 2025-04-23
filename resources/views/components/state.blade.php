{!! Form::select($name??'state_id', $states??null, old($name??'state_id', $selected ?? null), ['class' => 'form-control vue-select2 '. (isset($errors) && $errors->has('state_id') ? 'is-invalid' : ''), 'data-placeholder'=> trans('label.state'), 'ajax-url' => route('ajax.states'), 'multiple' => $multiple??false, 'select-parent' => 'country_id']) !!}
@push('page_scripts')
<script>
$(document).ready(function(){
    $("[name={{$name??'state_id'}}]").on('change', function() {
        // console.log('state change', $("[select-parent={{$name??'state_id'}}]"));
        $("[select-parent={{$name??'state_id'}}]").val('').trigger('change');
    });
})
</script>
@endpush
