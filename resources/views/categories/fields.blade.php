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

    <div class="form-group col-sm-12">
        {!! Form::select('parent_id', $parent_list??[], null, ['class' => 'form-control', 'data-placeholder' => 'Choose Parent Job Category']) !!}
        <span class="help-block"></span>
    </div>

    <!-- Image Upload Field -->
     <div class="form-group col-sm-12">
        @include('vendor.image_upload.upload', ['id' => 'icon_image', 'name' => 'icon_images', 'height'
        => '80px', 'width' => '80px', 'document_type' => config('constants.document_type.image', 0), 'multiple'
        => true, 'limit' => 1])
    </div>

</div>
@include('imagecropper.croppermodal')

@section('third_party_scripts')
@include('vendor.image_upload.script')
@include('vendor.richtexteditor.script')
@endsection
