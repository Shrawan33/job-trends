<div class="row">
    <!-- Question Field -->
    <div class="form-group col-sm-12">
        {!! Form::label('question', trans('label.question')) !!}
        {!! Form::text('question', null, ['class' => 'form-control']) !!}
        <span class="help-block"></span>
    </div>

    <!-- Answer Field -->
    <div class="form-group col-sm-12">
        {!! Form::label('answer', trans('label.answer')) !!}
        {!! Form::textarea('answer', null, ['class' => 'form-control', 'rows' => 5]) !!}
        <span class="help-block"></span>
    </div>

</div>
