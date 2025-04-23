@section('third_party_stylesheets')
@include('vendor.image_upload.style')
@endsection
<div class="row">

    <!-- Title Field -->
    <div class="form-group col-sm-6">
        {!! Form::label('title', trans('label.title')) !!}
        {!! Form::text('title', null, ['class' => 'form-control']) !!}
        <span class="help-block"></span>
    </div>

    <!-- Tag Line Field -->
    <div class="form-group col-sm-6">
        {!! Form::label('tag_line', trans('label.tag_line')) !!}
        {!! Form::text('tag_line', null, ['class' => 'form-control']) !!}
        <span class="help-block"></span>
    </div>

    <div class="form-group col-sm-12">
    @include('vendor.image_upload.upload', ['id' => 'banner_image', 'name' => 'banner_images',
        'height' => '250px', 'width' => '250px', 'document_type' => config('constants.document_type.cropped_images', 2),
        'multiple' => true, 'limit' => 1, 'bgcolor' => '', 'remove_button_icon' => 'fa fa-times-circle'])
    </div>
</div>
@include('imagecropper.croppermodal')

@section('third_party_scripts')
@include('vendor.image_upload.script')
@endsection
