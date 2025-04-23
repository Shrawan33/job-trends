{!! Form::open(['id' => $form_id]) !!}
<div class="row ">
    {{-- <div class="col-sm-2">
        <div class="form-group">
            {!! Form::select('message_type', config('constants.message_type.data', []),
            config('constants.message_type.default', null), ['class' => 'form-control no-select2']) !!}
        </div>
    </div> --}}

    <style>
        .hide {
            display: none;
        }
    </style>
    {{-- <div class="col-sm-2 ">
        <div class="form-group">
            {!! Form::select(
                'message_type',
                config('constants.message_type.data', []),
                config('constants.message_type.default', null),
                ['class' => 'form-control no-select2'],
            ) !!}
        </div>
    </div> --}}
    <div class="col-sm-2">
        <div class="form-group">
            {!! Form::select(
                'message_type',
                [1 => 'Received', 2 => 'Sent'],
                auth()->user()->hasRole('jobseeker') ? 1 : 2,
                ['class' => 'form-control no-select2'],
            ) !!}
        </div>
    </div>



    <div class="col-sm">
        <div class="form-group">
            {!! Form::text('keyword', $searchTerm ?? null, [
                'class' => 'form-control',
                'placeholder' => __('label.search_by_name'),
                'autocomplete' => 'off',
            ]) !!}
        </div>
    </div>
    <div class="col-sm">
        <div class="form-group">
            {!! Form::text('description', null, [
                'class' => 'form-control',
                'placeholder' => __('label.search_by_description'),
                'autocomplete' => 'off',
            ]) !!}
        </div>
    </div>
    <div class="col-auto">
        <div class="form-group">
            {!! Form::submit(__('label.find_message'), ['class' => 'btn btn-primary']) !!}
        </div>
    </div>
</div>
{!! Form::close() !!}
