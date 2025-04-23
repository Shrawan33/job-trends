{!! Form::open(['route' => [$entity['url'].'.update-destroy', $id], 'method' => 'delete', 'data-model' => $entity['targetModel'], 'id' => "{$entity['targetModel']}_$id"]) !!}
{!! Form::hidden('process', 'delete') !!}
@php
    $entity['singular'] = 'InterviewSchedule'
@endphp
@hasanyrole('employer|admin')
<div class="d-inline-block pr-xl-3 pr-lg-2">
    <a class="open-form btn-icon pre-screening text-body font-weight-bold" data-toggle="tooltip" title="{{ trans('label.show') }} " data-mode="show" data-modal-size="modal-lg" data-title="{{ __('Interview Details') }}"
    data-model="interviewschedule"  data-url="{{ route('interviewschedules.show',$model->id) }}"
    href="javascript:void(0)"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="16" viewBox="0 0 22 16" fill="none">
            <path d="M1.26387 8.71318C1.12769 8.49754 1.05959 8.38972 1.02147 8.22342C0.992842 8.0985 0.992842 7.9015 1.02147 7.77658C1.05959 7.61028 1.12769 7.50246 1.26387 7.28682C2.38928 5.50484 5.73915 1 10.8442 1C15.9492 1 19.299 5.50484 20.4244 7.28682C20.5606 7.50246 20.6287 7.61028 20.6668 7.77658C20.6955 7.9015 20.6955 8.0985 20.6668 8.22342C20.6287 8.38972 20.5606 8.49754 20.4244 8.71318C19.299 10.4952 15.9492 15 10.8442 15C5.73915 15 2.38928 10.4952 1.26387 8.71318Z" stroke="#1B2432" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
            <path d="M10.8442 11C12.501 11 13.8442 9.65685 13.8442 8C13.8442 6.34315 12.501 5 10.8442 5C9.1873 5 7.84415 6.34315 7.84415 8C7.84415 9.65685 9.1873 11 10.8442 11Z" stroke="#1B2432" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
        </svg></a>
</div>
<div class="d-inline-block pr-xl-3 pr-lg-2">
    <a class="btn-icon text-body" href="{{ route($entity['url'].'.edit', ['id' => $id, 'employer_job_id' => $employer_job_id]) }}"  data-toggle="tooltip" title="{{ trans('label.edit') }}">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 18 18" fill="none">
            <path d="M13.9818 7.43286L10.5672 4.0182M0.75 17.25L3.63911 16.929C3.99209 16.8898 4.16859 16.8702 4.33355 16.8168C4.47991 16.7694 4.61919 16.7024 4.74761 16.6177C4.89236 16.5223 5.01793 16.3967 5.26906 16.1456L16.5428 4.87186C17.4857 3.92893 17.4857 2.40013 16.5428 1.4572C15.5999 0.514268 14.0711 0.514267 13.1281 1.4572L1.85441 12.7309C1.60328 12.9821 1.47771 13.1076 1.38226 13.2524C1.29757 13.3808 1.23063 13.5201 1.18325 13.6664C1.12984 13.8314 1.11023 14.0079 1.07101 14.3609L0.75 17.25Z" stroke="#1B2432" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
        </svg>
    </a>
</div>
<div class="d-inline-block">
    {{--@include('components.front_delete_link', ['class' => 'btn-icon  text-danger', 'entity' => $entity, 'id' => $id])--}}
    <a class="btn-icon  text-danger" href="javascript:submitFormByaction('delete', '{{$entity['targetModel']}}_{{$id}}','{{ __('label.do_you_want_to_delete_this_remark') }}')" title="{{ trans('label.delete') }} " data-toggle="tooltip" >
        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="16" viewBox="0 0 18 20" fill="none" class="mr-2">
            <path d="M12.5556 4.6V3.88C12.5556 2.87191 12.5556 2.36786 12.3618 1.98282C12.1913 1.64413 11.9194 1.36876 11.5849 1.19619C11.2046 1 10.7068 1 9.71111 1H8.28889C7.29324 1 6.79542 1 6.41513 1.19619C6.08062 1.36876 5.80865 1.64413 5.63821 1.98282C5.44444 2.36786 5.44444 2.87191 5.44444 3.88V4.6M7.22222 9.55V14.05M10.7778 9.55V14.05M1 4.6H17M15.2222 4.6V14.68C15.2222 16.1921 15.2222 16.9482 14.9316 17.5258C14.6759 18.0338 14.268 18.4469 13.7662 18.7057C13.1958 19 12.449 19 10.9556 19H7.04445C5.55097 19 4.80423 19 4.2338 18.7057C3.73204 18.4469 3.32409 18.0338 3.06843 17.5258C2.77778 16.9482 2.77778 16.1921 2.77778 14.68V4.6" stroke="#F00404" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
        </svg>
    </a>
</div>
@endhasanyrole
{!! Form::close() !!}

