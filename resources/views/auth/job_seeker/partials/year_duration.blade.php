<div class="row form-group">
    <div class="col-md-4">
        <div class="row">
            <div class="col-md-12">{!! Form::label('duration', 'Year', ['class' => '']) !!}</div>
            <div class="col-md-6">
                {!! Form::selectRange("year[$key]", config('constants.years_range.duration_to'), old("year.$key", $seekerDetail->year ?? ''), ['class' => 'form-control no-select2', 'placeholder' => trans('label.year')]) !!}
            </div>
            </div>
        </div>
    </div>
</div>

