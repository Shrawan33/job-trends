<!-- Type Field -->
<div class="col-sm-12">
    {!! Form::label('type', trans('label.type')) !!}
    <p>{{ $message->type }}</p>
</div>

<!-- Sender Id Field -->
<div class="col-sm-12">
    {!! Form::label('sender_id', trans('label.sender_id')) !!}
    <p>{{ $message->sender_id }}</p>
</div>

<!-- Notifiable Type Field -->
<div class="col-sm-12">
    {!! Form::label('notifiable_type', trans('label.notifiable_type')) !!}
    <p>{{ $message->notifiable_type }}</p>
</div>

<!-- Notifiable Id Field -->
<div class="col-sm-12">
    {!! Form::label('notifiable_id', trans('label.notifiable_id')) !!}
    <p>{{ $message->notifiable_id }}</p>
</div>

<!-- Data Field -->
<div class="col-sm-12">
    {!! Form::label('data', trans('label.data')) !!}
    <p>{{ $message->data }}</p>
</div>

<!-- Read At Field -->
<div class="col-sm-12">
    {!! Form::label('read_at', trans('label.read_at')) !!}
    <p>{{ $message->read_at }}</p>
</div>

