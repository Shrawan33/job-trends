@section('third_party_stylesheets')
@include('vendor.image_upload.style')

@endsection
<div class="row">
    <!-- Title Field -->
    <div class="form-group col-sm-12">
        {!! Form::label('title', trans('label.title')) !!}
        {!! Form::text('event_title', null, ['class' => 'form-control']) !!}
        <span class="help-block"></span>
    </div>
    <!-- Created Date Field -->
    <div class="form-group col-sm-6">
        {!! Form::label('createdDate', trans('label.event_date')) !!}
        {!! Form::datetimeLocal('event_date', null, ['class' => 'form-control', 'id' => 'event_date', 'placeholder' => trans('label.event_date')]) !!}
        <span class="help-block"></span>
    </div>
    <div class="form-group col-sm-12">
        {!! Form::label('small_description', trans('label.small_description')) !!}
        {!! Form::textarea('small_description', null, ['class' => 'form-control', 'maxlength' => '70']) !!}
        <span class="help-block"></span>
        <span id="char-count"></span> characters remaining
    </div>
    <!-- Description Field -->
    <div class="form-group col-sm-12">
        {!! Form::label('description', trans('label.description')) !!}
        {!! Form::textarea('event_description', null, ['id' => 'event_description', 'richtexteditor' => true]) !!}
        <span class="help-block"></span>
    </div>
    <!-- Banner Upload Field -->
    {{-- <div class="form-group col-sm-12">
        @include('vendor.image_upload.upload', ['id' => 'event_image', 'name' => 'event_images', 'height'
        => '80px', 'width' => '80px', 'document_type' => config('constants.document_type.image', 0), 'multiple'
        => true, 'limit' => 1])
    </div> --}}
    <div class="form-group col-sm-12">
            @include('vendor.image_upload.upload', ['id' => 'icon_image', 'name' => 'icon_images', 'height'
        => '80px', 'width' => '80px', 'document_type' => config('constants.document_type.image', 0), 'multiple'
        => true, 'limit' => 1, 'bgcolor' => '', 'remove_button_icon' => 'fa fa-times-circle'])
    </div>

    <div class="form-group col-sm-12">
    </div>
    <div class="form-group col-sm-12">
        {!! Form::label('meta_title', 'Meta Title') !!}
        {!! Form::text('meta_title', null, ['class' => 'form-control', 'maxlength' => 255]) !!}
    </div>

    <div class="form-group col-sm-12">
        {!! Form::label('meta_description', 'Meta Description') !!}
        {!! Form::textarea('meta_description', null, ['class' => 'form-control', 'rows' => 3]) !!}
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const textarea = document.querySelector('textarea[name="small_description"]');
        const charCount = document.getElementById('char-count');

        textarea.addEventListener('input', function() {
            const remainingChars = 70 - textarea.value.length;
            charCount.textContent = remainingChars >= 0 ? remainingChars : 0;
        });
    });
</script>
@include('imagecropper.croppermodal')

@section('third_party_scripts')
@include('vendor.image_upload.script')
@include('vendor.richtexteditor.script')
@endsection


