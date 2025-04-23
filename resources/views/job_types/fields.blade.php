<div class="row">
    <!-- Title Field -->
<div class="form-group col-sm-12">
    {!! Form::label('title', 'Title:') !!}
    {!! Form::text('title', null, ['class' => 'form-control']) !!}
    <span class="help-block"></span>
</div>


<!-- Is Approval Needed Field -->
<div class="form-group col-sm-12">
    {!! Form::hidden('is_approval_needed', 0, ['class' => 'form-check-input']) !!}
    {!! Form::checkbox('is_approval_needed', '1', null, ['class' => 'form-check-input', 'id' => 'is_approval_needed', 'label' => 'Is Approval Needed']) !!}
    <span class="help-block"></span>
</div>


<!-- User Id Field -->
<div class="form-group col-sm-12">
    {!! Form::label('user_id', 'User:') !!}
    {!! Form::select('user_id', $mentors ?? null, null, ['class' => 'form-control custom-select']) !!}
    <span class="help-block"></span>
</div>

</div>
