<div class="row">
    <!-- Title Field -->
    <div class="form-group col-sm-12">
        {!! Form::hidden('candidate_id', $record->id??null, ['class' => 'form-control']) !!}

        {{-- {!! Form::label('note', trans('label.note').':') !!} --}}
        {!! Form::textarea('note', null, ['class' => 'form-control', 'rows' => 5,'placeholder' => trans('label.remark') . '...',]) !!}

        <span class="help-block"></span>
    </div>
</div>
