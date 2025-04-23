<div class="col-12  {{$class ??'col-md-4'}}">

    <div class="list_card position-relative d-flex align-items-center justify-content-between flex-wrap">
        <div class="d-flex col-md-8 p-0">
            <div class="user-profile-img">
                @if(!empty($candidate->seekerDetail) && $candidate->seekerDetail->logo->count())
                @include('vendor.image_upload.display', ['document_type' => config('constants.document_type.image',
                0), 'imageModel' => $candidate->seekerDetail, 'class_li' => 'mb-2', 'thumbnail' => true])
                @else
                    @include('vendor.image_upload.no_user', ['class_li' => 'mb-2'])
                @endif
            </div>

            <div class="user-profile-info pl-3">
                <div class="user-basic-info flex-fill">
                    <a href="{{route($prefix.'candidates.show', $candidate->slug)}}" class="name">{{$candidate->full_name ?? ''}}</a>
                    @if (!empty($candidate->seekerDetail))
                        @if(!empty($candidate->seekerDetail->title))
                            <p class="mb-3 title">{{$candidate->seekerDetail->title??''}}</p>
                        @endif
                    @endif

                    <div class="d-flex align-items-center">
                        @if (!empty($candidate->seekerDetail))
                            @if (!empty($candidate->seekerDetail->address))
                                <p class="location">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18" fill="none" class="mr-1">
                                        <path d="M9 9.74939C10.2426 9.74939 11.25 8.74203 11.25 7.49939C11.25 6.25675 10.2426 5.24939 9 5.24939C7.75736 5.24939 6.75 6.25675 6.75 7.49939C6.75 8.74203 7.75736 9.74939 9 9.74939Z" stroke="#717884" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                        <path d="M9 16.4994C12 13.4994 15 10.8131 15 7.49939C15 4.18568 12.3137 1.49939 9 1.49939C5.68629 1.49939 3 4.18568 3 7.49939C3 10.8131 6 13.4994 9 16.4994Z" stroke="#717884" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                    {{$candidate->seekerDetail->short_address??''}}
                                </p>
                            @endif
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <div class="d-flex align-items-center mt-3 mt-lg-0 col-md-4 p-0 justify-md-content-end">
            <div class="user-action-info flex-shrink-0" id="user_action_{{$candidate->id}}">
                @role('employer')
                    @include('components.candidate-buttons', ['class_unfav_btn' => ' btn-md','class_fav_btn' => 'btn-md','class_report_btn'=> ' btn-md', 'class_reportmobile_btn'=> ' btn-md','class_share_btn'=> 'btn-md','class_sendmail_btn' => ' btn-sm','class_sendmailmobile_btn' => ' btn-md', 'id' => $candidate->id,'model' =>$candidate??[], 'from' => $from??'detail-page'])
                @endrole
            </div>
            <a href="{{route('social-profile.show', $candidate ->slug)}}" class="btn btn-primary btn-sm ml-2">View Profile
                <svg xmlns="http://www.w3.org/2000/svg" width="8" height="14" viewBox="0 0 8 14" fill="none" class="ml-3 mr-0">
                    <path d="M1.25 12.5L6.75 7L1.25 1.5" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </a>
        </div>
    </div>

</div>
