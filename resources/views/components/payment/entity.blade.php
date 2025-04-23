{!! Form::open(['url' => route('payment.initDirectTransaction', ['type' => $type])]) !!}
    {!! Form::hidden('amount', $amount??0) !!}
    @if ($package_id??false)
        {!! Form::hidden('package_id', $package_id??0) !!}
        {!! Form::hidden('renew_package', $renew??false) !!}
    @endif
    {!! Form::submit($button??trans('label.paynow'), ['class' => 'btn '.($btnClass??'btn-link')]) !!}
{!! Form::close() !!}
