
<h4 class="font-weight-bold mb-30">{!! trans('label.available_packages')!!}</h4>
<table class="table table-theme">
    <thead>
        <tr>
            <th>{!! trans('label.package_name')!!}</th>
            <th>{!! trans('label.validity')!!}</th>
            <th>{!! trans('label.total_credits')!!}</th>
            <th>{!! trans('label.total_job_post')!!}</th>
            <th></th>
        </tr>
    </thead>
    <tbody>


        @forelse($availablePackages as $package)
        <tr>

            <td data-title="{!! trans('label.package_name')!!}">{!! $package->package_info['title']??''  !!}</td>
            <td data-title="{!! trans('label.validity')!!}">{!! $package->package_info['duration'].' days'??''  !!}</td>
            <td data-title="{!! trans('label.total_credits')!!}">{{$package->package_info['credits'] ? FunctionHelper::totalCredit($package->package_info['credits']??'') : ''}}</td>
            <td data-title="{!! trans('label.total_job_post')!!}">{{$package->package_info['credits'] ? $package->package_info['credits']['job_posts']??'' : ''}}</td>
            <td data-title="Action" class="p-md-0">
                @if(auth()->user()->hasRole('employer') && auth()->user()->activeUserPackage)
                    <a href="{{route('subscription.activate-plan',$package->id)}}" class="btn btn-primary btn-sm rounded-pill mt-2" onclick="return confirm('{{trans('message.package_activation_confirm', ['package' => $userPackage->package_info['title']??'' ])}}')">{!! trans('label.activate')!!}</a>
                @else
                    <a href="{{route('subscription.activate-plan',$package->id)}}" class="btn btn-primary btn-sm rounded-pill mt-2" onclick="return confirm('{{trans('message.first_package_activation', ['package' => $userPackage->package_info['title']??'' ])}}')">{!! trans('label.activate')!!}</a>
                @endif
            </td>
        </tr>

        @empty
        <tr><td colspan="5">{{trans('label.no_data_found')}}</td>
        @endforelse

    </tbody>
</table>
