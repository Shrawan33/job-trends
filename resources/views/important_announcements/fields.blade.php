@section('third_party_stylesheets')
  @include('vendor.richtexteditor.style')
@endsection

<div class="row">

    <div class="form-group mb-4 col-md-6 col-lg-6">
        <label for="">Country</label>
        @include('components.country', [
            'id' => 'country_id',
            'countries' => $countries ?? [],
            'data-placeholder' => __('label.search_by_country'),
        ])
    </div>
    <div class="form-group mb-4 col-md-6 col-lg-6">
        <label for="">{{ trans('label.state') }}</label>
        @include('components.state', [
            'id' => 'state_id',
            'states' => $states ?? [],
            'data-placeholder' => __('label.search_by_state'),
            'dependent' => true,
        ])
    </div>

</div>

<div class="row">

    <!-- select users Field -->
    <div class="col-sm mb-4">
        {!! Form::label('selected_audience', __('label.select_audience')) !!}
        {!! Form::select('selected_audience[]', config("constants.notification_audience")??[], 'active', ['class' => 'form-control', 'multiple' => 'multiple', 'data-placeholder' => trans('label.select_audience')]) !!}
    </div>

    <!-- select users Field -->
    <div class="form-group col-sm-12">
        {!! Form::label('subject', __('label.enter_subject')) !!}
        {!! Form::text('subject', null, ['class' => 'form-control', 'data-placeholder' => trans('label.enter_subject')]) !!}
    </div>

    <!-- Message Field -->
    <div class="form-group col-sm-12">
        {!! Form::label('message', 'Type Notification Message') !!}
        {!! Form::textarea('message', null, ['id' => 'message', 'richtexteditor' => true]) !!}
        <span class="help-block"></span>
    </div>

</div>

@push('page_scripts')
  <script src="{{ asset('js/validation/cms.js') }}"></script>
@endpush

@section('third_party_scripts')
  @include('vendor.richtexteditor.script')

@endsection


