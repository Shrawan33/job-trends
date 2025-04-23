<div class="row">
    <!-- Title Field -->
    <div class="form-group col-sm-12">
        {!! Form::label('title',  __('label.title_')) !!}
        {!! Form::text('title', null, ['class' => 'form-control']) !!}
        <span class="help-block"></span>
    </div>

     <!-- Start Field -->
     <div class="form-group col-sm-6">
        {!! Form::label('start', trans('label.start')) !!}
        {!! Form::number('start', null, ['class' => 'form-control']) !!}
        <span class="help-block"></span>
    </div>
       <!-- End Field -->
    <div class="form-group col-sm-6">
        {!! Form::label('end', trans('label.end')) !!}
        {!! Form::number('end', null, ['class' => 'form-control']) !!}
        <span class="help-block"></span>
    </div>
</div>

@push('page_scripts')
    <script src="{{asset('js/validation/salary.js')}}"></script>
@endpush
