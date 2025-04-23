<!-- Title Field -->
<div class="col-sm-6">
    {!! Form::label('title', 'Title:') !!}
    <p>{{ $criteria->title }}</p>
</div>

<!-- Max Score Field -->
<div class="col-sm-6">
    {!! Form::label('max_score', 'Max Score:') !!}
    <p>{{ $criteria->max_score }}</p>
</div>

<!-- Level Field -->
<div class="col-sm-12">
    {!! Form::label('level', 'Level:') !!}
    <p>{{ $criteria->level }}</p>
</div>

<!-- Levels Field -->
<div class="col-sm-12 border-top mt-3"></div>
<div class="col-sm-6">
    <h6 class="modal-title mb-3">Levels (L1 - L5)</h6>
</div>
<div class="col-sm-6 mb-3">
    <h6 class="modal-title">Score</h6>
</div>
@foreach($criteriaLevels as $criteriaLevel)
<div class="col-sm-6">
    {!! Form::label('level', config('constants.criteria_max_prefix', '').$criteriaLevel->level) !!}

</div>
<div class="col-sm-6">

    <p>{{ $criteriaLevel->score??null }}</p>
</div>
@endforeach
