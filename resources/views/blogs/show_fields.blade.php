<!-- Title Field -->
<div class="col-sm-12">
    {!! Form::label('title', trans('label.title')) !!}
    <p>{{ $blog->title }}</p>
</div>

<!-- Description Field -->
<div class="col-sm-12">
    {!! Form::label('description', trans('label.description')) !!}
    <p>{!! $blog->description !!}</p>
</div>

<!-- Createdby Field -->
<div class="col-sm-12">
    {!! Form::label('createdBy', trans('label.created_by')) !!}
    <p>{{ $blog->createdBy }}</p>
</div>

<!-- Createddate Field -->
<div class="col-sm-12">
    {!! Form::label('createdDate', trans('label.created_date')) !!}

    <p>{{ FunctionHelper::fromSqlDateTime($blog->createdDate->toDateTimeString(), true, 'd-m-Y')??''}}</p>
</div>

