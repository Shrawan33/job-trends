<style>
    .img_wraper img {
        border-radius: 0 !important;
    }
</style>
<table style="width:100%" cellspacing="0" cellpadding="0" style="font-family: Verdana, Geneva, sans-serif; font-size:14px">
    <tr>
        <td>
            <table style="width:100%" cellspacing="0" cellpadding="0">
                <tr>
                    <td style="padding:0 20px; vertical-align:top">
                        {{-- @dd($input); --}}
                        @if (isset($input->logo) && !empty($input->logo))
                            <div style="width: 120px; margin-right: 15px; margin-bottom: 20px; vertical-align: top ">
                                {!! $input->logo !!}
                            </div>
                        @endif


                        <h2
                            style="margin-top:0;font-family: 'Helvetica', sans-serif; font-size:22px; margin-bottom:10px; padding:0; color: #000; font-weight: bold;">
                            {{ $input->first_name ?? 'no-data' }}</h2>
                        @if (!empty($input))
                            <p
                                style="font-family: 'Helvetica', sans-serif; font-size:16px; margin-bottom:8px; margin-top: 0;">
{{-- @dd($input->seekerDetail->current_company) --}}
                                <?php
                                if (isset($input->job_title) && isset($input->current_company)) {
                                    echo $input->job_title . ' | ' . $input->current_company;
                                } elseif (isset($input->job_title)) {
                                    echo $input->job_title;
                                } elseif (isset($input->current_company)) {
                                    echo $input->current_company;
                                } else {
                                    // If neither job_title nor current_company are available, you can provide a default value or leave it empty.
                                    echo '';
                                }
                                ?>

                                {{-- {{ $input->job_title ?? '' }} | {{ $input->current_company ?? '' }}</p> --}}
                                {{-- <p style="font-family: 'Helvetica', sans-serif; font-size:16px; marign-bottom:10px;">
                                {{ config('constants.gender.' . $input->seekerDetail->gender) }}</p> --}}

                            <p
                                style="font-family: 'Helvetica', sans-serif; font-size:16px; margin-bottom: 10px; margin-top: 0;">
                                {{ $input->total_experience . ' Years Experience' ?? '' }}</p>
                            <p
                                style="font-family: 'Helvetica', sans-serif; font-size:16px; margin-bottom: 10px; margin-top: 0;">
                                Address: {{ isset($input->address) ? $input->address : '' }}
                            </p>

                            @role('jobseeker')
                                @if ($input->is_public_profile == 1)
                                    <p
                                        style="font-family: 'Helvetica', sans-serif; font-size:16px; margin-bottom:10px; margin-top: 0;">
                                        Mobile:
                                        <a class="text-body"
                                            href="tel:{{ $input->phone_number ?? '' }}">{{ $input->phone_number ?? '' }}</a>
                                    </p>

                                    <p
                                        style="font-family: 'Helvetica', sans-serif; font-size:16px; margin-bottom:10px; margin-top: 0;">
                                        Email: <a class="text-body"
                                            href="mailto:{{ $input->email ?? '' }}">{{ $input->email ?? '' }}</a>
                                    </p>
                                @endif
                            @endrole

                            {{-- <p style="font-family: 'Helvetica', sans-serif; font-size:16px; marign-bottom:10px;">
                                @foreach ($input->seekerDetail->workTypes as $item)
                                    <span
                                        style="font-family: 'Helvetica', sans-serif;
                                padding: 12px 25px !important;
                                border: 1px solid #dee2e6 !important;
                                background-color: #f8f9fa !important;
                                display: inline-block !important;
                                border-radius: 25px;
                                margin-right:12px;
                                margin-bottom:12px;">{{ $item->workType->title ?? '' }}</span>
                                @endforeach
                            </p> --}}
                        @endif

                    </td>
                    <td style="padding-left:20px; vertical-align:top">
                        @if (!empty($input))
                            {{-- <p style="font-family: 'Helvetica', sans-serif; font-size: 16px; margin-bottom: 10px; white-space: nowrap; overflow: auto;">
                            @foreach ($input->seekerDetail->workTypes as $item)
                                <span style="font-family: 'Helvetica', sans-serif; padding: 10px 20px !important;
                                    border: 1px solid #dee2e6 !important; background-color: #f8f9fa !important;
                                    display: inline-block !important; border-radius: 0px;
                                    margin-right: 10px; margin-bottom: 10px;">{{ $item->workType->title ?? '' }}</span>
                            @endforeach
                        </p> --}}
                        @endif
                    </td>
                </tr>
                <tr>
                    <td style="padding:0 20px; vertical-align:top">
                        <h3
                            style="font-family: 'Helvetica', sans-serif; font-size:16px; font-weight: 700; color: #000; margin-top: 20px; margin-bottom:8px;">
                            Profile Summary</h3>
                        <p
                            style="font-family: 'Helvetica', sans-serif; font-size:16px; marign-bottom:10px; color: #000; margin-top: 0; line-height: 26px;">
                            {!! $input->description ?? '' !!}</p>
                    </td>
                </tr>
                <tr>
                    <td style="padding:0 20px; vertical-align:top">
                        <h3
                            style="font-family: 'Helvetica', sans-serif; font-size:16px; font-weight: 700; color: #000; margin-top: 20px; margin-bottom:8px;">
                            Academic Details</h3>
                        @if (isset($input->seekerEducation) && $input->seekerEducation->count() > 0)
                            <ul style="padding-left: 20px;">
                                @foreach ($input->seekerEducation as $education)
                                    <li
                                        style="font-family: 'Helvetica', sans-serif; font-size:16px; margin-bottom:10px; color: #000; margin-top: 0;">
                                        {{ $education->qualification->title ?? '' }},
                                        {{ $education->university ?? '' }}, {{ $education->location ?? '' }},
                                        {{ $education->percentile_cgpa ?? '' }},
                                        {{ $education->specialization->name ?? '' }}
                                        {{ $education->duration_from ?? '' }}
                                        {{ date('M', mktime(0, 0, 0, $education->from_month, 1)) }} -
                                        {{ $education->duration_to ?? '' }}
                                        {{ date('M', mktime(0, 0, 0, $education->to_month, 1)) }}
                                    </li>
                                @endforeach
                            </ul>
                        @else
                            {{ 'N/A' }}
                        @endif
                    </td>
                </tr>
                <tr>
                    <td style="padding:0 20px; vertical-align:top">
                        <h3
                            style="font-family: 'Helvetica', sans-serif; font-size:16px; font-weight: 700; color: #000; margin-top: 20px; margin-bottom:8px;">
                            {{ trans('label.experience') }}</h3>
                        @if (isset($input->seekerExperience) && $input->seekerExperience->count() > 0)
                            <ul style="padding-left: 20px;">
                                @foreach ($input->seekerExperience as $experience)
                                    <li
                                        style="font-family: 'Helvetica', sans-serif; font-size:16px; margin-bottom:10px; color: #000; margin-top: 0;">
                                        {{ $experience->company ?? '' }}, {{ $experience->role ?? '' }},
                                        {{ $experience->location ?? '' }},
                                        {{ date('M', mktime(0, 0, 0, $experience->from_month, 1)) }}
                                        {{ $experience->duration_from ?? '' }} -
                                        {{ date('M', mktime(0, 0, 0, $experience->to_month, 1)) }}
                                        {{ $experience->duration_to ?? '' }}
                                        <p
                                            style="font-family: 'Helvetica', sans-serif; font-size:16px; margin-bottom:10px; color: #000; margin-top: 0;">
                                            {!! $experience->description ?? '' !!}
                                        </p>
                                    </li>
                                @endforeach
                            </ul>
                        @else
                            {{ 'N/A' }}
                        @endif
                    </td>
                </tr>

                <tr>
                    <td style="padding:0 20px; vertical-align:top">
                        <h3
                            style="font-family: 'Helvetica', sans-serif; font-size:16px; font-weight: 700; color: #000; margin-top: 20px; margin-bottom:8px;">
                            {{ trans('label.job_detail_page.training_certificate') }}</h3>
                        @if (!empty($input->seekerLicense))
                            <ul style="padding-left: 20px;">
                                @forelse($input->seekerLicense as $license)
                                    <li
                                        style="font-family: 'Helvetica', sans-serif; font-size:16px; margin-bottom:10px; color: #000; margin-top: 0;">
                                        {{ $license->certificate_name ?? '' }},
                                        {{ $license->certifying_authority ?? '' }},
                                        {{ $license->certifying_authority ?? '' }},
                                        {{ $license->from_year ?? '' }} -
                                        {{ date('M', mktime(0, 0, 0, $education->from_month, 1)) }}
                                    </li>
                                @endforeach
                            </ul>
                        @else
                            {{ 'N/A' }}
                        @endif
                    </td>
                </tr>
                {{-- <tr>
                    <td style="padding:0 20px; vertical-align:top">
                        <h3 style="font-family: 'Helvetica', sans-serif; font-size:16px; font-weight: 700; color: #000; margin-top: 20px; margin-bottom:8px;">{{ trans('label.skills') }}</h3>
                        @if (!empty($input->seekerSkill))
                            <ul style="padding: 0; list-style: none;">
                                @forelse($input->seekerSkill as $skill)
                                    <li style="font-family: 'Helvetica', sans-serif; font-size:16px; margin-bottom:10px; color: #000; margin-top: 0; display: inline-block; margin-right: 8px; border: 1px solid #dee2e6 !important; background-color: #f8f9fa !important; padding: 8px; width: auto !important; min-width: 150px;">
                                        {{ $skill->skill->title ?? '' }}
                                    </li>
                                @empty
                                    {{ 'N/A' }}
                            </ul>
                        @endforelse
                    @endif
                    </td>
                </tr> --}}
                <tr>
                    <td style="padding:0 20px; vertical-align:top">
                        <h3
                            style="font-family: 'Helvetica', sans-serif; font-size:16px; font-weight: 700; color: #000; margin-top: 20px; margin-bottom:8px;">
                            {{ trans('label.personal_details') }}</h3>
                        @if (isset($input))
                            <div style="width: 100%; float: left;">
                                {{-- @if (!empty($input->seekerDetail->parent_name))
                                    <div style="width: 30%; float: left; padding-right: 10px; margin-bottom: 20px;">
                                        <h6 style="font-family: 'Helvetica', sans-serif; color: #a5a5a5 !important;font-weight: 600 !important; margin-bottom: 8px; font-size: 15px; margin-top: 0;">
                                            {{ trans('label.parent_name') }}</h6>
                                        <p style="font-family: 'Helvetica', sans-serif; font-size:16px; margin-bottom:10px; color: #000; margin-top: 0;">
                                            {{ $input->seekerDetail->parent_name ?? null }}</p>
                                        </div>
                                @endif
                                @if (!empty($input->seekerDetail->permanent_address))
                                    <div style="width: 30%; float: left; padding-right: 10px; margin-bottom: 20px;">
                                        <h6 style="font-family: 'Helvetica', sans-serif; color: #a5a5a5 !important;font-weight: 600 !important; margin-bottom: 8px; font-size: 15px; margin-top: 0;">
                                            {{ trans('label.permanent_address') }}</h6>
                                        <p style="font-family: 'Helvetica', sans-serif; font-size:16px; margin-bottom:10px; color: #000; margin-top: 0;">
                                            {{ $input->seekerDetail->permanent_address ?? null }}</p>
                                    </div>
                                @endif --}}
                                @if (!empty($input->dob))
                                    <div style="width: 30%; float: left; padding-right: 10px; margin-bottom: 20px;">
                                        <h6
                                            style="font-family: 'Helvetica', sans-serif; color: #a5a5a5 !important;font-weight: 600 !important; margin-bottom: 8px; font-size: 15px; margin-top: 0;">
                                            {{ trans('label.dob') }}</h6>
                                        <p
                                            style="font-family: 'Helvetica', sans-serif; font-size:16px; margin-bottom:10px; color: #000; margin-top: 0;">
                                            {{ isset($input->dob) ? FunctionHelper::fromSqlDate($input->dob->toDateString(), true, 'd M, Y') : null }}
                                        </p>
                                    </div>
                                @endif
                                @if (!empty($input->language_known))
                                    <div style="width: 30%; float: left; padding-right: 10px; margin-bottom: 20px;">
                                        <h6
                                            style="font-family: 'Helvetica', sans-serif; color: #a5a5a5 !important;font-weight: 600 !important; margin-bottom: 8px; font-size: 15px; margin-top: 0;">
                                            {{ trans('label.language_known') }}</h6>
                                        <p
                                            style="font-family: 'Helvetica', sans-serif; font-size:16px; margin-bottom:10px; color: #000; margin-top: 0;">
                                            {{ $input->language_known ?? null }}</p>
                                    </div>
                                @endif

                                @if (!empty($input->marital_status))
                                    <div style="width: 30%; float: left; padding-right: 10px; margin-bottom: 20px;">
                                        <h6
                                            style="font-family: 'Helvetica', sans-serif; color: #a5a5a5 !important;font-weight: 600 !important; margin-bottom: 8px; font-size: 15px; margin-top: 0;">
                                            {{ trans('label.marital_status') }}</h6>
                                        <p
                                            style="font-family: 'Helvetica', sans-serif; font-size:16px; margin-bottom:10px; color: #000; margin-top: 0;">
                                            {{-- {{ ($input->seekerDetail->marital_status) }} --}}
                                            {{ config("constants.marital_status." . $input->marital_status, '-') }}
                                        </p>
                                    </div>
                                @endif

                            </div>
                            <div
                                style="flex: 0 0 100%;max-width: 100%;margin-bottom:0 !important;position: relative;width: 100%;">
                                {{-- @if (!empty($input->seekerDetail->language_known))
                                <div
                                    style="flex: 0 0 25%;max-width: 25%;float:left; margin-bottom: 15px !important;position: relative;width: 100%;">
                                    <h6 style="color: #28527A !important;font-weight: 600 !important; margin-bottom: 10px; font-size: 18px; margin-top: 0;">
                                        {{ trans('label.language_known') }}</h6>
                                    <p style="margin-bottom: 0 !important;">
                                        {{ $input->seekerDetail->language_known ?? null }}</p>
                                </div>
                            @endif --}}
                                {{-- @if (!empty($input->seekerDetail->indentity_no))

                                <div style="flex: 0 0 25%;max-width: 25%;float:left; margin-bottom: 15px !important;position: relative;width: 100%;">
                                    <h6 style="color: #28527A !important;font-weight: 600 !important; margin-bottom: 10px; font-size: 18px; margin-top: 0;">{{trans('label.aadhar_no')}}</h6>
                                    <p style="margin-bottom: 0 !important;">{{$input->seekerDetail->indentity_no ?? null}}</p>
                                </div>

                            @endif --}}
                            </div>
                        @endif
                    </td>
                </tr>
            </table>
        </td>
    </tr>


    {{-- <tr>
        <td>
            <div style="page-break-before:always">&nbsp;</div>
        </td>
    </tr> --}}
</table>
