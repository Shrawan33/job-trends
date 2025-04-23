<div class="row">
     <!-- State Id  Field -->
    <div class="form-group col-sm-12">
        {!! Form::select('state_id', $states??[], null, ['class' => 'form-control', 'data-placeholder' => 'Choose One']) !!}
        <span class="help-block"></span>
    </div>
    <!-- Title Field -->
    <div class="form-group col-sm-12">
        {!! Form::label('title', trans('label.title_')) !!}
        {!! Form::text('title', null, ['class' => 'form-control']) !!}
        <span class="help-block"></span>
    </div>
</div>

@push('page_scripts')
    <script src="{{asset('js/validation/location.js')}}"></script>
@endpush
