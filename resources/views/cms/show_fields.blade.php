<!-- Page Name Field -->
<div class="col-sm-12">
    {!! Form::label('page_name', 'Page Name:') !!}
    <p>{{ $cms->page_name }}</p>
</div>

<!-- Title Field -->
<div class="col-sm-12">
    {!! Form::label('title', 'Title:') !!}
    <p>{{ $cms->title }}</p>
</div>

<!-- Description  Field -->
<div class="col-sm-12">
    {!! Form::label('description', 'Description:') !!}
    <p>{{ $cms->description ?? '' }}</p>
</div>
