
@forelse($appliedJobs as $data)
<a href="{{!empty($data->slug)? route('job-detail',$data->slug) : "#" }}" title="{!!__('label.applied_jobs') !!}" class="{{$class_a??'btn btn-md '}}">{{$data->title??''}}</a><br>
@empty
{!! trans('message.not_applied_job')!!}
@endforelse

