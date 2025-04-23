{!! Form::open(['id' => $form_id]) !!}
<div class="row ">
    <div class="col-sm">
        <div class="form-group mb-4">
            {!! Form::text('search[value]', null, [
                'class' => 'form-control',
                'placeholder' => trans('label.keyword'),
                'autocomplete' => 'off',
            ]) !!}
        </div>
    </div>

    <div class="col-md-3">
        <div class="form-group mb-4">
            {!! Form::select('form', config('constants.review_type'), null, [
                'name' => 'review_type',
                'class' => 'form-control',
                'placeholder' => trans('label.review_type'),
            ]) !!}
        </div>
    </div>

    <div class="col-sm">
        @include('components.admin.date_picker_filter')
    </div>

</div>
{!! Form::close() !!}
