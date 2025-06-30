<!-- Page -->
<div class="form-group col-sm-6">
    {!! Form::label('page', __('page')) !!}
    <p>{{ $setting->page ?? '-' }}</p>
</div>

<!-- Meta Title -->
<div class="form-group col-sm-6">
    {!! Form::label('meta_title', __('meta_title')) !!}
    <p>{{ $setting->decoded_value['meta_title'] ?? '-' }}</p>
</div>

<!-- Meta Description -->
<div class="form-group col-sm-12">
    {!! Form::label('meta_description', __('meta_description')) !!}
    <p>{{ $setting->decoded_value['meta_description'] ?? '-' }}</p>
</div>
