{!! Form::open(['id' => $form_id]) !!}
<div class="row">
    <div class="col-sm">

        <div class="form-group">
            {!! Form::text('searchTerm', $searchTerm ?? null, ['class' => 'form-control', 'placeholder' => __('label.search_by_name'), "autocomplete" => 'off']) !!}
        </div>

    </div>
    <div class="col-sm">

        <div class="form-group" id="search-location">
            @include('components.location', ['locations' => [], 'selected' => '', 'multiple' => false, 'dependent' => false])
        </div>

    </div>

    <div class="col-auto">
        {!! Form::submit(__('label.find_job'), ['class' => 'btn btn-primary']) !!}
    </div>

</div>
{!! Form::close() !!}
