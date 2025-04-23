<div class="row">
    <!-- Title Field -->
<div class="form-group col-sm-12">
    {!! Form::label('title', 'Title') !!}
    {!! Form::text('title', null, ['class' => 'form-control','placeholder' => 'Title']) !!}
    <span class="help-block"></span>
</div>


<!-- Level Field -->
@for($i=1;$i<=5;$i++)
    <div class="form-group col-sm-3">
        {!! Form::label('level', config('constants.criteria_max_prefix', '').$i) !!}
        {!! Form::hidden("level[$i][level_id]", $scores[$i-1]->id??null) !!}
    </div>
    <div class="form-group col-sm-9">
        {!! Form::text("level[$i][score]", $scores[$i-1]->score??null, ['class' => 'form-control','placeholder' => 'Score']) !!}
        <span class="help-block"></span>
    </div>
@endfor
</div>
