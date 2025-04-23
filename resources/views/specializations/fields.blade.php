<div class="row">
    <!-- Title Field -->
    <div class="form-group col-sm-12">
        {!! Form::label('name', trans('label.name')) !!}
        {!! Form::text('name', null, ['class' => 'form-control']) !!}
        <span class="help-block"></span>
    </div>
</div>

@push('page_scripts')
    <script src="{{asset('js/validation/specialization.js')}}"></script>
@endpush
