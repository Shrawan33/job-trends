<!-- Title Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name',  __('label.roles').':') !!}
    <p>{{ $role->name }}</p>
</div>
<div class="col-md-12">
    <div class="row">
        <!-- Title Field -->
        <div class="form-group col-sm-6">
            {!! Form::label('title', __('label.title_')) !!}
            <p>{{ $role->title }}</p>
        </div>

        <!-- Guard Name Field -->
        <div class="form-group col-sm-6">
            {!! Form::label('guard_name', __('label.platform').':') !!}
            <p>{{ config("constants.platforms.{$role->guard_name}", null) }}</p>
        </div>
    </div>
</div>
