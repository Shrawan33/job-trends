<div class="row">
    <!-- Title Field -->

    <div class="form-group col-sm-12">
        {!! Form::label('title', trans('label.title')) !!}
        {!! Form::text('title', null, ['class' => 'form-control']) !!}
        <span class="help-block"></span>
    </div>
</div>

@push('page_scripts')
    <script src="{{asset('js/validation/certification.js')}}"></script>
@endpush
