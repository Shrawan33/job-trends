<!-- Title Field -->
<div class="col-sm-12">
    {!! Form::label('title', trans('label.title')) !!}
    <p>{{ $job->title }}</p>
</div>

<!-- createdby Field -->
<div class="col-sm-12">
    {!! Form::label('created_by', trans('label.employer')) !!}
    <p>{!! $job->createdByUser->company_name??'' !!}</p>
</div>

<!-- Created at Field -->
<div class="col-sm-12">
    {!! Form::label('created_at', trans('label.posted_on')) !!}
    <p>{{ $job->created_at ? FunctionHelper::fromSqlDateTime($job->created_at, true, '') : '' }}</p>
</div>


<!-- is_featured Field -->
<div class="col-sm-12">
    {!! Form::label('is_featured', trans('label.is_featured')) !!}
    <p>{{ $job->is_featured==1 ? 'Yes':'No'}}</p>
</div>

<!-- category Field -->
<div class="col-sm-12">
    {!! Form::label('category', trans('label.category')) !!}
    <p>{{ $job->category->title??''}}</p>
</div>

<!-- is_featured Field -->
<div class="col-sm-12">
    {!! Form::label('status', trans('label.statusSelect')) !!}
    <p>{{ $job->deleted_at==null ? 'Active':'Inactive'}}</p>
</div>


