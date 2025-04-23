<!-- Title Field -->
<div class="col-sm-12">
    {!! Form::label('title', 'Title:') !!}
    <p>{{ $jobType->title }}</p>
</div>

<!-- Is Approval Needed Field -->
<div class="col-sm-12">
    {!! Form::label('is_approval_needed', 'Is Approval Needed:') !!}
    <p>{{ $jobType->is_approval_needed }}</p>
</div>

<!-- User Id Field -->
<div class="col-sm-12">
    {!! Form::label('user_id', 'User:') !!}
    <p>{{ $jobType->user_id }}</p>
</div>

<!-- Created At Field -->
<div class="col-sm-12">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{{ $jobType->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="col-sm-12">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{{ $jobType->updated_at }}</p>
</div>

