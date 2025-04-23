<div class="row form-group">
    <div class="col-md-12">{!! Form::label('duration', 'Year Known', ['class' => '']) !!}</div>
    <div class="col-12">
        {!! Form::selectYear("year", date('Y') - 30, date('Y'), old("year", $seekerDetail->year ?? ''), ['class' => 'form-control no-select2', 'placeholder' => 'Select Year', 'id' => 'yearSelect']) !!}

    </div>
</div>
