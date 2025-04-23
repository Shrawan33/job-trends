@section('third_party_stylesheets')
  @include('vendor.richtexteditor.style')
@endsection
<div class="row">
    <!-- Page Name Field -->

    <div class="form-group col-sm-12">
        {!! Form::label('page_name', 'Page Name:') !!}
        {!! Form::text('page_name', null, ['class' => 'form-control']) !!}
        <span class="help-block"></span>
    </div>

    <!-- Title Field -->
    <div class="form-group col-sm-12">
        {!! Form::label('title', 'Title:') !!}
        {!! Form::text('title', null, ['class' => 'form-control']) !!}
        <span class="help-block"></span>
    </div>

    <!-- Description Field -->
    {{-- <div class="form-group col-sm-12">
        {!! Form::label('description', 'Description:') !!}
        {!! Form::textarea('description', null, ['class' => 'form-control']) !!}
        <span class="help-block"></span>
    </div> --}}

    <!-- Description Field -->
<div class="form-group col-sm-12">
    {!! Form::label('description', 'Description:') !!}
    {!! Form::textarea('description', null, ['id' => 'description', 'richtexteditor' => true]) !!}
    <span class="help-block"></span>
</div>





</div>

@push('page_scripts')
  <script src="{{ asset('js/validation/cms.js') }}"></script>
@endpush

@section('third_party_scripts')
  @include('vendor.richtexteditor.script')

@endsection


