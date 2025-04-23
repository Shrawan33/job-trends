<!-- Title Field -->
<div class="col-sm-12">
    {!! Form::label('title', trans('label.title_')) !!}
    <p>{{ $experience->title??'' }}</p>
</div>

<!-- From Field -->
<div class="col-sm-12">
    {!! Form::label('from', trans('label.from_')) !!}
    <p>{{ $experience->from??'' }}</p>
</div>

<!-- To Field -->
<div class="col-sm-12">
    {!! Form::label('to', trans('label.to_')) !!}
    <p>{{ $experience->to??'' }}</p>
</div>

