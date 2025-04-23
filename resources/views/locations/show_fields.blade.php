<!-- State Field -->
<div class="col-sm-12">
    {!! Form::label('state_id', trans('label.state').':') !!}
    <p>{{ $location->state->title??'' }}</p>
</div>


<!-- Title Field -->
<div class="col-sm-12">
    {!! Form::label('title', trans('label.title_')) !!}
    <p>{{ $location->title }}</p>
</div>
