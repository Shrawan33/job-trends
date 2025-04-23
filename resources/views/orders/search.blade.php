{!! Form::open(['id' => $form_id]) !!}

    <div class="row ">
        <div class="col-md-3">
            <div class="form-group mb-4">
                {!! Form::select('form', config('constants.payment_status'), null, [
                    'name' => 'payment_status',
                    'class' => 'form-control',
                    'placeholder' => trans('label.payment_status'),
                ]) !!}
            </div>
        </div>

        <div class="col-md-4">
            @include('components.admin.date_picker_filter')
        </div>
        <div class="col-md-5">
            <div class="form-group mb-4">
                {!! Form::text('search[value]', null, [
                    'class' => 'form-control',
                    'placeholder' => trans('label.keyword'),
                    'autocomplete' => 'off',
                ]) !!}
            </div>
        </div>
    </div>


</div>
{!! Form::close() !!}
