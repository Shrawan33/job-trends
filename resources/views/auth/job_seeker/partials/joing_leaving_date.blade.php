

<div class="row">
    <div class="col-md-6">
        <div class="row">
            <div class="col-md-12">{!! Form::label('duration', 'Joining Date', ['class' => '']) !!}</div>
            <div class="col-md-6 mb-4">
              {!! Form::selectMonth("from_month[$key]", old("from_month.$key", $value->from_month ?? ''), ['class' => 'form-control no-select2', 'placeholder' => 'Select Month']) !!}
            </div>
            <div class="col-md-6 mb-4">
                  {!! Form::selectRange("duration_from[$key]", config('constants.years_range.duration_from'), config('constants.years_range.duration_to'), old("duration_from.$key", $value->duration_from ?? ''), ['class' => 'form-control no-select2 ', 'placeholder' => trans('label.duration_from')]) !!}
              </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="row to_duration">
            <div class="col-md-12">{!! Form::label('duration', 'Leaving Date', ['class' => '']) !!}</div>

            <div class="col-md-6 mb-4">
                {!! Form::selectMonth("to_month[$key]", old("to_month.$key", $value->to_month ?? ''), ['class' => 'form-control no-select2 to_duration', 'placeholder' => 'Select Month']) !!}
            </div>
            <div class="col-md-6 mb-4">
                {!! Form::selectRange("duration_to[$key]", config('constants.years_range.duration_from'), config('constants.years_range.duration_to'), old("duration_to.$key", $value->duration_to ?? ''), ['class' => 'form-control no-select2 to_duration', 'placeholder' => trans('label.duration_to')]) !!}
            </div>
        </div>
    </div>
  </div>
