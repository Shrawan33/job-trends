{!! Form::open(['id' => $form_id]) !!}
<div class="row">
    <div class="col-sm">

        <div class="form-group mb-4">
            {!! Form::select('status[]', $statusFilter, 'active', ['class' => 'form-control', 'multiple' => 'multiple',
            'data-placeholder' =>  trans('label.statusSelect')]) !!}
        </div>

    </div>
    @if(Request::is('*filter-employers*') || Request::is('*filter-employerjobs*'))
    <div class="col-sm">

        <div class="form-group" id="search-location">
            {!! Form::select('is_paid', $freePaidFilter, null, ['class' => 'form-control no-select',
            'placeholder' =>  trans('label.choose_one')]) !!}
        </div>

    </div>
    @endif

    <div class="col-sm">

            @include('components.admin.date_picker_filter')

    </div>


</div>
{!! Form::close() !!}
