<!-- Title Field -->
<div class="col-sm-12">
    {!! Form::label('country', trans('label.country')) !!}
    <p>{{ $state->country->name }}</p>
</div>

<!-- Title Field -->
<div class="col-sm-12">
    {!! Form::label('title', trans('label.title_')) !!}
    <p>{{ $state->title }}</p>
</div>

