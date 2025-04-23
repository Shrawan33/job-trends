<!-- Image Upload Field -->
<div class="col-sm-12">
	@include('vendor.image_upload.upload', ['id' => 'test_image', 'name' => 'test_images', 'height'
	=> '80px', 'width' => '80px', 'document_type' => config('constants.document_type.image', 0), 'multiple'
	=> true, 'limit' => 1])
</div>
<!-- Client Field -->
<div class="col-sm-12">
    {!! Form::label('client', trans('label.client').':') !!}
    <p>{{ $testimonial->client }}</p>
</div>

<!-- Location Field -->
<div class="col-sm-12">
    {!! Form::label('location', trans('label.employer_view.location').':') !!}
    <p>{{ $testimonial->location }}</p>
</div>

<!-- Description Field -->
<div class="col-sm-12">
    {!! Form::label('description', trans('label.description').':') !!}
    <p>{!! $testimonial->description !!}</p>
</div>
