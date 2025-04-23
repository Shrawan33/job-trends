<!-- Title Field -->
<div class="col-sm-12">
    {!! Form::label('title',  __('label.title_')) !!}
    <p>{{ $salary->title }}</p>
</div>


<!-- Start Field -->
<div class="col-sm-6">
    {!! Form::label('start',  __('label.start')) !!}
    <p>{{ $salary->start }}</p>
</div>


<!-- End Field -->
<div class="col-sm-6">
    {!! Form::label('end',  __('label.end')) !!}
    <p>{{ $salary->end ??'' }}</p>
</div>
