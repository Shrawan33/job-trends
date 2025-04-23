


    <div class="col-md-4">
        <div class="row">
            <div class="col-md-12">{!! Form::label('duration', 'Duration From', ['class' => '']) !!}</div>
            <div class="col-md-6 mb-3">
                {!! Form::selectMonth("education_from_month[$key]", old("education_from_month.$key", $value->education_from_month ?? ''), ['class' => 'form-control no-select2', 'placeholder' => 'Select Month']) !!}
            </div>
            <div class="col-md-6">
                {!! Form::selectRange("education_duration_from[$key]", config('constants.education_years_range.education_duration_from'), config('constants.education_years_range.education_duration_to'), old("education_duration_from.$key", $value->education_duration_from ?? ''), ['class' => 'form-control no-select2', 'placeholder' => trans('label.education_duration_from')]) !!}
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="row">
            <div class="col-md-12">{!! Form::label('duration', 'Duration To', ['class' => '']) !!}</div>

        <div class="col-md-6 mb-3">
            {!! Form::selectMonth("education_to_month[$key]", old("education_to_month.$key", $value->education_to_month ?? ''), ['class' => 'form-control no-select2', 'placeholder' => 'Select Month']) !!}
        </div>
        <div class="col-md-6">
            {!! Form::selectRange("education_duration_to[$key]", config('constants.education_years_range.education_duration_from'), config('constants.education_years_range.education_duration_to'), old("education_duration_to.$key", $value->education_duration_to ?? ''), ['class' => 'form-control no-select2', 'placeholder' => trans('label.education_duration_to')]) !!}
        </div>
        </div>
  </div>

