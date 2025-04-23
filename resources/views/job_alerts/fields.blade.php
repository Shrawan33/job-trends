<div class="row">
    <!-- Id Field -->
<!-- Search Term Field -->
{!! Form::hidden('user_id', Auth::user()->id) !!}
<div class="form-group col-sm-12">
    <label for="" class="text-black ml-1 ">Term<span style="color: red">*</span></label>

    {!! Form::text('search_term', null, ['class' => 'form-control','placeholder' => trans('label.search_term')]) !!}
    <span class="help-block"></span>
</div>

<div class="form-group col-sm-12">
    <label for="" class="text-black ml-1 ">Select State</label>
    @include('components.state', [
            'states' => $stateFilter ?? [],
            'selected' => $input['state_id'] ?? null,
            'multiple' => false,
            'data-placeholder' => __('label.search_by_state'),
            'dependent' => true,
        ])
    @error('state_id')
    <span class="error invalid-feedback">{{ $message }}</span>
    @enderror
</div>

<div class="form-group col-sm-12">
    <label for="" class="text-black ml-1 ">Select City</label>

    @include('components.location', [
            'locations' => $locationFilter ?? [],
            'selected' => $input['location_id'] ?? null,
            'multiple' => false,
            'data-placeholder' => __('label.search_by_location'),
            'dependent' => true,
        ])
    @error('location_id')
    <span class="error invalid-feedback">{{ $message }}</span>
    @enderror
</div>



@push('page_scripts')
    <script src="{{asset('js/validation/jobAlert.js')}}"></script>
@endpush
