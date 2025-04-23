@section('third_party_stylesheets')
@include('vendor.image_upload.style')
@include('vendor.richtexteditor.style')
@endsection
<div class="row">
    <!-- Title Field -->
    <div class="form-group col-sm-12">
        {!! Form::label('title', trans('label.title')) !!}
        {!! Form::text('title', null, ['class' => 'form-control']) !!}
        <span class="help-block"></span>
    </div>
    <!-- Created By Field -->
    <div class="form-group col-sm-6">
        {!! Form::label('createdBy', trans('label.created_by')) !!}
        {!! Form::text('createdBy', null, ['class' => 'form-control']) !!}
        <span class="help-block"></span>
    </div>
    <!-- Created Date Field -->
    <div class="form-group col-sm-6">
        {!! Form::label('createdDate', trans('label.created_date')) !!}
        {!! Form::date('createdDate', $blog->createdDate??null, ['class' => 'form-control']) !!}
        <span class="help-block"></span>
    </div>

    <!-- Description Field -->
    <div class="form-group col-sm-12">
        {!! Form::label('description', trans('label.description')) !!}
        {!! Form::textarea('description', null, ['id' => 'desciption', 'richtexteditor' => true]) !!}
        <span class="help-block"></span>
    </div>

    <div class="form-group col-sm-12">
        {!! Form::label('small_description', trans('label.small_description')) !!}
        {!! Form::textarea('small_description', null, ['class' => 'form-control', 'maxlength' => '70']) !!}
        <span class="help-block"></span>
        <span id="char-count"></span> characters remaining
    </div>

    <!-- Image Upload Field -->
    <div class="form-group col-sm-12">
        @include('vendor.image_upload.upload', ['id' => 'blog_image', 'name' => 'blog_images',
            'height' => '250px', 'width' => '250px', 'document_type' => config('constants.document_type.cropped_images', 2),
            'multiple' => true, 'limit' => 1, 'bgcolor' => '', 'remove_button_icon' => 'fa fa-times-circle'])
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
