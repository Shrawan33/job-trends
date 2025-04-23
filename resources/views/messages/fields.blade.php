<div class="row">
    <!-- Type Field -->
<div class="form-group col-sm-6">
    {!! Form::label('type', trans('label.type')) !!}
    {!! Form::text('type', null, ['class' => 'form-control']) !!}
    <span class="help-block"></span>
</div>


<!-- Sender Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('sender_id', trans('label.sender_id')) !!}
    {!! Form::number('sender_id', null, ['class' => 'form-control']) !!}
    <span class="help-block"></span>
</div>


<!-- Notifiable Type Field -->
<div class="form-group col-sm-6">
    {!! Form::label('notifiable_type', trans('label.notifiable_type')) !!}
    {!! Form::text('notifiable_type', null, ['class' => 'form-control']) !!}
    <span class="help-block"></span>
</div>


<!-- Notifiable Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('notifiable_id', trans('label.notifiable_id')) !!}
    {!! Form::number('notifiable_id', null, ['class' => 'form-control']) !!}
    <span class="help-block"></span>
</div>


<!-- Data Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('data', trans('label.data')) !!}
    {!! Form::textarea('data', null, ['class' => 'form-control']) !!}
    <span class="help-block"></span>
</div>


<!-- Read At Field -->
<div class="form-group col-sm-6">
    {!! Form::label('read_at', trans('label.read_at')) !!}
    {!! Form::text('read_at', null, ['class' => 'form-control','id'=>'read_at']) !!}
    <span class="help-block"></span>
</div>

@push('page_scripts')
    <script type="text/javascript">
        $('#read_at').datetimepicker({
            format: 'YYYY-MM-DD HH:mm:ss',
            useCurrent: true,
            sideBySide: true
        })
    </script>
@endpush

</div>
