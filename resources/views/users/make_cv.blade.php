@extends('layouts.front')


@section('content')
<div class="container my-50">
    <div class="job_top_banner bg_frame position-relative">
        <img src="{{ asset('images/inner_banner.png') }}" alt="fea_img" width="100%" class="inner_banner">
        <h1 class="inner_page_heading py-lg-4 position-relative">
            <a href="{{route('users.profile')}}">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="24" viewBox="0 0 8 14" fill="none" class="mr-2">
                    <path d="M6.75 12.5L1.25 7L6.75 1.5" stroke="#357de8" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                </svg>
            </a> {{trans('label.make_a_cv')}}
        </h1>
    </div>
    <div class="info_box profile_box border-bottom pb-30">
        <div class="row align-items-center mb-50">
            <div class="col-md-6 mb-40 mb-md-0">
                <div class="d-flex align-items-center">
                    @if(isset($jobseeker->seekerDetail->profilePic) && $jobseeker->seekerDetail->profilePic->count() > 0)
                        <div class="job-detail-img img-preview mr-4">
                            <img src="{{ $jobseeker->seekerDetail->profilePic->presignedthumbnail_url }}" alt=""
                        class="img-fluid user-profile-pic">
                        </div>
                    @endif
                    <div class="">
                        <h3 class="mb-1">{{$jobseeker->full_name??''}}</h3>
                        @if (!empty($jobseeker->seekerDetail))
                            <p class="mb-0 name">{{$jobseeker->seekerDetail->title??''}}</p>
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-md-6 text-md-right">
                {{-- <a href="{{route('download-cv', $jobseeker->id)}}"
                    class="btn btn-primary ml-lg-auto">Download {{$jobseeker->full_name}}-cv.pdf</a> --}}
                    <a href="{{route('download-cv', $jobseeker->id)}}" class="btn btn-primary ml-lg-auto">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18" fill="none">
                            <path d="M17.25 11.75V12.85C17.25 14.3901 17.25 15.1602 16.9503 15.7485C16.6866 16.2659 16.2659 16.6866 15.7485 16.9503C15.1602 17.25 14.3901 17.25 12.85 17.25H5.15C3.60986 17.25 2.83978 17.25 2.25153 16.9503C1.73408 16.6866 1.31338 16.2659 1.04973 15.7485C0.75 15.1602 0.75 14.3901 0.75 12.85V11.75M13.5833 7.16667L9 11.75M9 11.75L4.41667 7.16667M9 11.75V0.75" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                        </svg>
                        Download Resume</a>
            </div>
        </div>
        <div class="row">
            @if (!empty($jobseeker->seekerDetail))
                <div class="col-md-6 col-lg-3 mb-30">
                    <span>Gender</span>
                    <p class="mb-0"> {{config("constants.gender.".$jobseeker->seekerDetail->gender)}}</p>
                </div>
                {{-- <div class="col-md-6 col-lg-3 mb-lg-0 mb-3">
                    <span>Experience</span>
                    <p class="mb-0"> {{$jobseeker->seekerDetail->total_experience.' Years Experience' ?? ''}}</p>
                </div> --}}
                <div class="col-md-6 col-lg-3 mb-30">
                    <span>Experience</span>
                    @php
                        $experience = $jobseeker->seekerDetail->total_experience ?? 0;
                    @endphp
                    <p class="mb-0">
                        @if ($experience == 0)
                            0 Year
                        @elseif ($experience == 1)
                            1 Year
                        @else
                            {{ $experience }} Years
                        @endif
                    </p>
                </div>

                <div class="col-md-6 col-lg-3 mb-30">
                    <span>Work Type</span>
                    {{-- @dd($jobseeker->seekerDetail->workTypes) --}}
                    <p class="mb-0">
                        @foreach ($jobseeker->seekerDetail->workTypes as $item)
                            <span class="rounded-pill tag-btn bg-light py-5 px-15 d-inline-block border mb-2  mr-2 list-inline-item">{{$item->workType->title ?? '-'}}</span>
                         @endforeach
                    </p>
                </div>
                <div class="col-md-6 col-lg-3 mb-30">
                    <span>Address</span>
                    <p class="mb-0"> {{$jobseeker->seekerDetail->address??''}}</p>
                </div>
            @endif
            @role('jobseeker')
            <div class="col-md-6 col-lg-3 mb-30">
                <span>Phone Number</span>
                <p class="mb-2"><a class="text-primary" href="tel:{{$jobseeker->phone_number??''}}">{{$jobseeker->phone_number??''}}</a></p>
            </div>
            <div class="col-md-6 col-lg-3 mb-30">
                <span>Email</span>
                <p class="mb-2"><a class="text-primary" href="mailto:{{$jobseeker->email??''}}">{{$jobseeker->email??''}}</a></p>
            </div>
            @endrole
            @if (!empty($jobseeker->seekerDetail))
                <div class="col-12 mt-5">
                    <span>Description</span>
                    <p class="mb-0"> {!! $jobseeker->seekerDetail->description?? '' !!}</p>
                </div>
            @endif
        </div>
    </div>
    <div class="profile_box border-bottom py-40">
        <h3 class="mb-4">{{trans('label.experience')}}</h3>
        @if (isset($jobseeker->seekerExperience) && $jobseeker->seekerExperience->count() > 0)
        <ul class="profile_list_item m-0 pl-4 mb-3">
            @foreach($jobseeker->seekerExperience as $experience)
                <li class="profile_list_item m-0 mb-5">
                    <h3 class="company_name mb-2">{{$experience->company ?? ''}}</h3>
                    <p class="role">{{$experience->role ?? ''}} • {{$experience->location??''}}</p>
                    <p class="duration"> {{ date('M', mktime(0, 0, 0, $experience->from_month, 1)) }} / {{$experience->duration_from ?? ''}} -  {{ date('M', mktime(0, 0, 0, $experience->to_month, 1)) }} / {{$experience->duration_to ?? ''}}</p>
                    <div class="description">
                        @if (strlen($experience->description) > 100)
                            <div class="collapse-text position-relative">
                                <p class="message-text mb-0 collapse " id="content_{{$experience->id??0}}">{!! $experience->description??null !!}</p>

                            </div>
                        @else
                            {!! $experience->description ?? '' !!}
                        @endif
                    </div>
                </li>
            @endforeach
        </ul>
        @else
        {{'N/A'}}
        @endif
    </div>
    <div class="profile_box border-bottom py-40">
        <h3 class="mb-4">{{trans('label.education')}}</h3>
        @if (isset($jobseeker->seekerEducation) && $jobseeker->seekerEducation->count() > 0)
        <table class="table mb-0">
            <thead class="">
                <tr>
                    <th class=""> {{trans('label.course_name')}} </th>
                    <th class=""> {{trans('label.institute')}} </th>
                    <th class=""> {{trans('label.employer_view.location')}} </th>
                    <th class=""> {{trans('label.duration')}} </th>
                    <th class=""> {{trans('label.specialization')}} </th>
                    <th class=""> {{trans('label.percentile_cgpa')}} </th>

                </tr>
            </thead>
            <tbody>
                @foreach($jobseeker->seekerEducation as $education)
                <tr>
                    <td data-title="Course Name ">{{$education->qualification->title ?? ''}}s</td>
                    <td data-title="University/Institute">{{$education->university ?? ''}}</td>
                    <td data-title="Location">{{$education->location??''}}</td>
                    <td data-title="Duration">
                        {{-- {{ date('M', mktime(0, 0, 0, $item->from_month ?? '', 1)) }} / {{$education->duration_from ?? ''}} - {{ date('M', mktime(0, 0, 0, $item->to_month ?? '', 1)) }} / {{$education->duration_to ?? ''}} --}}
                    </td>
                    <td data-title="specialization">{{$education->specialization->name ??''}}</td>
                    <td data-title="percentile_cgpa">{{$education->percentile_cgpa ??''}}</td>


                </tr>
                @endforeach
            </tbody>
        </table>
        @else
        {{'N/A'}}
        @endif
    </div>
    <div class="profile_box border-bottom py-40">
        <h3 class="mb-4">{{trans('label.trainin_certificate')}}</h3>
        <ul class="profile_list_item inline_btn_style m-0 p-0">

            @if (isset($jobseeker->seekerLicense) && $jobseeker->seekerLicense->count() > 0)
        <table class="table mb-0">
            <thead class="">
                <tr>
                    <th class=""> {{trans('label.certificate_name')}} </th>
                    <th class=""> {{trans('label.certifying_authority')}} </th>
                    <th class=""> {{trans('label.duration')}} </th>
                </tr>
            </thead>
            <tbody>
                @foreach($jobseeker->seekerLicense as $license)
                <tr>
                    <td data-title="certificate_name">{{$license->certificate_name ?? ''}}s</td>
                    <td data-title="certifying_authority">{{$license->certifying_authority ?? ''}}</td>
                    <td data-title="Duration"> {{ date('M', mktime(0, 0, 0, $education->from_month, 1)) }} / {{$education->duration_from ?? ''}} -
                        {{ date('M', mktime(0, 0, 0, $education->to_month, 1)) }} / {{$education->duration_to ?? ''}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @else
        {{'N/A'}}
        @endif
        </ul>
    </div>
    <div class="profile_box border-bottom py-40">
        <h3 class="mb-4">{{trans('label.skills')}} </h3>
        <ul class="profile_list_item inline_btn_style m-0 p-0">
            @if(!empty($jobseeker->seekerSkill))
            @forelse($jobseeker->seekerSkill as $skill)
            <li
                class="">
                {{$skill->skill->title ?? ''}}</li>
                @empty
            {{'N/A'}}
            @endforelse
            @endif
        </ul>
    </div>
    <div class="profile_box pt-40">
        <h3 class="mb-4">{{trans('label.personal_details')}}</h3>
        @if(isset($jobseeker->seekerDetail))
            <div class="row">
            @if (!empty($jobseeker->seekerDetail->parent_name))
                <div class="col-md-4 col-lg-3 mb-3">
                    <span>{{trans('label.parent_name')}}</span>
                    <p class="mb-2">{{$jobseeker->seekerDetail->parent_name ?? null}}</p>
                </div>
            @endif
            @if (!empty($jobseeker->seekerDetail->permanent_address))
                <div class="col-md-4 col-lg-3 mb-3">
                    <span>{{trans('label.permanent_address')}}</span>
                    <p class="mb-2">{{$jobseeker->seekerDetail->permanent_address ?? null}}</p>
                </div>
            @endif
            @if (!empty($jobseeker->seekerDetail->dob))
                <div class="col-md-4 col-lg-3 mb-3">
                    <span>{{trans('label.dob')}}</span>
                    <p class="mb-2">{{isset($jobseeker->seekerDetail->dob) ? FunctionHelper::fromSqlDate($jobseeker->seekerDetail->dob->toDateString(), true, 'd M, Y') : null}}</p>
                </div>
            @endif
            {{-- @if (!empty($jobseeker->seekerDetail->language_known))
                <div class="col-md-4 col-lg-3 mb-3">
                    <span>{{trans('label.language_known')}}</span>
                    <p class="mb-2">{{$jobseeker->seekerDetail->language_known ?? null}}</p>
                </div>
            @endif --}}
            {{-- @if (!empty($jobseeker->seekerDetail->indentity_no))
            <div class="col-md-6 mb-3">
                <h6 class="font-weight-bold">{{trans('label.aadhar_no')}}</h6>
                <p class="mb-2">{{$jobseeker->seekerDetail->indentity_no ?? null}}</p>
            </div>
            @endif --}}
            @if($jobseeker->seekerDetail->nationality ===0 || $jobseeker->seekerDetail->nationality ===1)
                <div class="col-md-4 col-lg-3 mb-3">
                    <span>{{trans('label.nationality')}}</span>
                    <p class="mb-2">{{config('constants.nationality_choices.data.'.$jobseeker->seekerDetail->nationality) ?? null}}</p>
                </div>
            @endif
        </div>
    @endif
    </div>
</div>
@endsection
