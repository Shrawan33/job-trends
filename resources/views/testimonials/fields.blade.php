@section('third_party_stylesheets')
@include('vendor.image_upload.style')
@include('vendor.richtexteditor.style')
@endsection
<div class="row">
    <!-- Client Field -->
	<div class="form-group col-sm-6">
		{!! Form::label('client', trans('label.client').':') !!}
		{!! Form::text('client', null, ['class' => 'form-control']) !!}
		<span class="help-block"></span>
	</div>

    <!-- Location Field -->
	<div class="form-group col-sm-6">
		{!! Form::label('title', trans('label.employer_view.title').':') !!}
		{!! Form::text('title', null, ['class' => 'form-control']) !!}
		<span class="help-block"></span>
	</div>

	<!-- Location Field -->
	<div class="form-group col-sm-6">
		{!! Form::label('location', trans('label.employer_view.location').':') !!}
		{!! Form::text('location', null, ['class' => 'form-control']) !!}
		<span class="help-block"></span>
	</div>


	<!-- Description Field -->
	<div class="form-group col-sm-12 col-lg-12">
		{!! Form::label('description', trans('label.description').':') !!}
		{!! Form::textarea('description', null, ['class' => 'form-control']) !!}
		<span class="help-block"></span>
	</div>

	<!-- Image Upload Field -->
     <div class="form-group col-sm-12 img_upload_wraper mt-5">
        @include('vendor.image_upload.upload', ['id' => 'test_image', 'name' => 'test_images', 'height'
        => '80px', 'width' => '80px', 'document_type' => config('constants.document_type.image', 0), 'multiple'
        => true, 'limit' => 1])
    </div>
	<div class="image_resolution_info px-2">
		<P class="mb-0"><b>Note:</b> Please upload 430 X 446 image resolution</p>
	</div>
</div>
@include('imagecropper.croppermodal')

@section('third_party_scripts')
@include('vendor.image_upload.script')
@include('vendor.richtexteditor.script')
@endsection
