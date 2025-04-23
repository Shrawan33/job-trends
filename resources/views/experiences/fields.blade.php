<div class="row">
    <!-- Title Field -->
    <div class="form-group col-sm-12">
        {!! Form::label('title', trans('label.title_')) !!}
        {!! Form::text('title', null, ['class' => 'form-control']) !!}
        <span class="help-block"></span>
    </div>
       <!-- From Field -->
    <div class="form-group col-sm-6">
        {!! Form::label('from', trans('label.from_')) !!}
        {!! Form::number('from', null, ['class' => 'form-control']) !!}
        <span class="help-block"></span>
    </div>
       <!-- To Field -->
    <div class="form-group col-sm-6">
        {!! Form::label('to', trans('label.to_')) !!}
        {!! Form::number('to', null, ['class' => 'form-control']) !!}
        <span class="help-block"></span>
    </div>
</div>

@push('page_scripts')
    <script src="{{asset('js/validation/experience.js')}}"></script>
@endpush
