<div class="row">
    <!-- Title Field -->
    <div class="form-group col-sm-12">
        {!! Form::hidden('reporter_id',Auth::user()->id??null, ['class' => 'form-control']) !!}
        {!! Form::hidden('reported_id', $record->id??null, ['class' => 'form-control']) !!}

        {!! Form::label('content', trans('label.content').':') !!}
        {!! Form::textarea('content', null, ['class' => 'form-control', 'rows' => 5]) !!}

        <span class="help-block"></span>
    </div>
</div>
