{!! Form::open(['id' => $form_id]) !!}
<div class="row">
    <div class="col-sm pr-sm-0">
        <div class="form-group">
            {!! Form::text('searchTerm', $searchTerm ?? null, ['class' => 'form-control', 'placeholder' => __('label.search_by_job'), "autocomplete" => 'off']) !!}
        </div>
    </div>
    <div class="col-sm pr-sm-0">
        {{-- <div class="form-group">
            {!! Form::text('interview_title', $searchTerm ?? null, ['class' => 'form-control', 'placeholder' => __('label.search_by_interview'), "autocomplete" => 'off']) !!}
        </div> --}}
    </div>
    <div class="col-auto ">
   <button type="submit" class="btn btn-primary search-icon-btn">Search</button>
        <!-- {!! Form::submit(__('label.searchBtn'), ['class' => 'btn btn-primary rounded-pill px-5']) !!} -->
    </div>
</div>
{!! Form::close() !!}