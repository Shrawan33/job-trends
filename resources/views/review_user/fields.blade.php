{{-- <div class="row">
    <!-- Title Field -->
    <div class="form-group col-sm-12">
        {!! Form::label('name', trans('label.name')) !!}
        {!! Form::text('name', null, ['class' => 'form-control']) !!}
        <span class="help-block"></span>
    </div>
</div> --}}
@section('third_party_stylesheets')
@include('vendor.image_upload.style')
@include('vendor.richtexteditor.style')
@endsection
<div class="row">
    <!-- Client Field -->
	<div class="form-group col-sm-6">
		{!! Form::label('name', trans('label.name').':') !!}
		{!! Form::text('name', null, ['class' => 'form-control']) !!}
		<span class="help-block"></span>
	</div>

   
@include('imagecropper.croppermodal')

@section('third_party_scripts')
@include('vendor.image_upload.script')
@include('vendor.richtexteditor.script')
@endsection
