
<h4 class="font-weight-bold mb-30">{!! trans('label.past_package')!!}</h4>
<table class="table table-theme">
    <thead>
        <tr>
            <th>{!! trans('label.package_name')!!}</th>
            <th>{!! trans('label.validity')!!}</th>
            <th>{!! trans('label.activation_date')!!}</th>
            <th>{!! trans('label.expiry_date')!!}</th>
            <th> </th>

        </tr>
    </thead>
    <tbody>


        @forelse($pastPackages as $pastpackage)
        <tr>
            <td data-title="Package Name">{!! $pastpackage->package_info['title']??''  !!}</td>
            <td data-title="Validity">{!! $pastpackage->package_info['duration'].' days'??''  !!}</td>
            <td data-title="Activation Date">{{$pastpackage->start_date ? FunctionHelper::fromSqlDate($pastpackage->start_date->toDateString(),true) :''}}</td>
            <td data-title="Expiry Date">{{$pastpackage->grace_date ? FunctionHelper::fromSqlDate($pastpackage->grace_date->toDateString(),true) : ''}}</td>
            <td data-title="Action" class="p-md-0">
                @if($pastpackage->package)
                @include('subscriptions.form',['package_id' => $pastpackage->package_id, 'text' => trans('label.renew'), 'class'=>'btn-sm mt-2','renew' =>true])
                @endif
            </td>
        </tr>
        @empty
        <tr><td colspan="5">{{trans('label.no_data_found')}}</td>
        @endforelse
    </tbody>
</table>
