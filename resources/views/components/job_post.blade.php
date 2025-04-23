
<a class="open-form {!! $class??'' !!}" data-mode="show" data-title="{!! trans('message.job_post_applied_message',['user'=>$user->full_name??'','company' =>auth()->user()->company_name ?? ''])!!}"
    data-model="{!! $entity['targetModel']??null !!}" data-url="{{ route($entity['url'].'.appliedJobs.list',$model->id) }}"
    href="javascript:void(0)" data-toggle="tooltip" title="View Applied Jobs" >
    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="16" viewBox="0 0 20 16" fill="none">
        <path d="M1.21845 8.65391C1.09361 8.45624 1.03119 8.3574 0.996247 8.20496C0.970001 8.09045 0.970001 7.90987 0.996247 7.79536C1.03119 7.64292 1.09361 7.54408 1.21845 7.34642C2.25007 5.71293 5.32078 1.5835 10.0004 1.5835C14.68 1.5835 17.7507 5.71293 18.7823 7.34642C18.9071 7.54408 18.9696 7.64292 19.0045 7.79536C19.0307 7.90987 19.0307 8.09045 19.0045 8.20496C18.9696 8.3574 18.9071 8.45624 18.7823 8.65391C17.7507 10.2874 14.68 14.4168 10.0004 14.4168C5.32078 14.4168 2.25007 10.2874 1.21845 8.65391Z" stroke="#717884" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
        <path d="M10.0004 10.7502C11.5192 10.7502 12.7504 9.51894 12.7504 8.00016C12.7504 6.48138 11.5192 5.25016 10.0004 5.25016C8.48159 5.25016 7.25037 6.48138 7.25037 8.00016C7.25037 9.51894 8.48159 10.7502 10.0004 10.7502Z" stroke="#717884" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
    </svg>
</a>
