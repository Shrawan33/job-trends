<div class="row">
    <div class="form-group col-sm-12">
        {!! Form::label('country_id', trans('label.country')) !!}
        {!! Form::select('country_id', $countries??[], null, ['class' => 'form-control', 'data-placeholder' => 'Choose One']) !!}
        <span class="help-block"></span>
    </div>

    <!-- Title Field -->
    <div class="form-group col-sm-6">
        {!! Form::label('title', trans('label.title_')) !!}
        {!! Form::text('title', null, ['class' => 'form-control']) !!}
        <span class="help-block"></span>
    </div>

</div>
