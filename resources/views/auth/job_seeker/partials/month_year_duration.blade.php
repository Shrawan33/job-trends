
{{-- <div class="row form-group">
    <div class="col-md-12">{!! Form::label('duration', 'Duratio Monthn', ['class' => '']) !!}</div>
    <div class="col-md-6">
        {!! Form::selectRange("from_month[$key]", 1, 12, old("from_month.$key", $value->from_month ?? ''), ['class' => 'form-control no-select2', 'placeholder' => trans('label.duration_from')]) !!}
    </div>
    <div class="col-md-6">
        {!! Form::selectRange("to_month[$key]", 1, 12, old("to_month.$key", $value->to_month ?? ''), ['class' => 'form-control no-select2', 'placeholder' => trans('label.duration_to')]) !!}
    </div>
</div> --}}

<div class="row form-group">
    <div class="col-md-12">
        {!! Form::label('duration', 'Month Year / Valid / Expired', ['class' => '']) !!}
    </div>
    <div class="col-md-6">
        {!! Form::selectMonth("from_month[$key]", old("from_month.$key", $value->from_month ?? ''), ['class' => 'form-control no-select2', 'placeholder' => 'Select Month']) !!}
    </div>
    <div class="col-md-6">
        {!! Form::selectYear("from_year[$key]", config('constants.years_range.duration_from'), config('constants.years_range.duration_to'), old("from_year.$key", $value->from_year ?? ''), ['class' => 'form-control no-select2', 'placeholder' => 'Select Year']) !!}
    </div>
</div>


{{-- <div class="row form-group">
    <div class="col-md-12">{!! Form::label('duration', 'Duration Year', ['class' => '']) !!}</div>
    <div class="col-md-6">
        {!! Form::selectRange("from_year[$key]", config('constants.years_range.duration_from'), config('constants.years_range.duration_to'), old("from_year.$key", $value->from_year ?? ''), ['class' => 'form-control no-select2', 'placeholder' => trans('label.duration_from')]) !!}
    </div>
    <div class="col-md-6">
        {!! Form::selectRange("to_year[$key]", config('constants.years_range.duration_from'), config('constants.years_range.duration_to'), old("to_year.$key", $value->to_year ?? ''), ['class' => 'form-control no-select2', 'placeholder' => trans('label.duration_to')]) !!}
    </div>
</div> --}}
