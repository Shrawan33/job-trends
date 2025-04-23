{!! Form::open(['id' => $form_id]) !!}
<div class="row">
    <div class="col-sm">

        <div class="form-group">
            {!! Form::text('searchTerm', $searchTerm ?? null, [
                'class' => 'form-control',
                'placeholder' => __('label.search_by_job'),
                'autocomplete' => 'off',
            ]) !!}
        </div>

    </div>
    <div class="col-sm">

        {{-- <div class="form-group" id="search-location">
            @include('components.location', ['locations' => [], 'selected' => '', 'multiple' => false, 'dependent' => false])
        </div> --}}
        <div class="form-group">
            {!! Form::select('candidate_status',['' => 'Job Status'] + config('constants.candidate_status', []),$selectedStatusFilter,['class' => 'form-control no-select2']) !!}
        </div>
    </div>

    <div class="col-auto">
        {!! Form::submit(__('label.searchBtn'), ['class' => 'btn btn-primary']) !!}
    </div>

</div>
{!! Form::close() !!}
