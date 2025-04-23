<div class="col-lg-2 col-md-3 col-5 text-center mb-20 mb-lg-0">
    @if (!empty($user->usersProfile) && $user->usersProfile->logo->count())
            @include('vendor.image_upload.display', [
                'document_type' => config('constants.document_type.image', 0),
                'imageModel' => $user->usersProfile,
                'class_li' => 'img-slick-slid',
                'title' => $user->company_name,
                'employerlogo' => 1,
            ])
    @else

            @include('vendor.image_upload.no_image', [
                'class_li' => 'img-slick-slid',
                'title' => $job->title ?? '',
                'name' => $user->company_name,
                'employerlogo' => 1,
            ])

    @endif

    <div class="content">
        <a href="{{ route('job-detail.employer.show', $user->slug) }}" class="text-center">
            {{-- <p class="mb-2">{{ $user->company_name }}</p> --}}
            <span class="location">
                <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 20 21" fill="none">
                    <path
                        d="M9.99992 10.9167C11.3806 10.9167 12.4999 9.79737 12.4999 8.41666C12.4999 7.03594 11.3806 5.91666 9.99992 5.91666C8.61921 5.91666 7.49992 7.03594 7.49992 8.41666C7.49992 9.79737 8.61921 10.9167 9.99992 10.9167Z"
                        stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                    <path
                        d="M9.99992 18.8333C11.6666 15.5 16.6666 13.3486 16.6666 8.83332C16.6666 5.15142 13.6818 2.16666 9.99992 2.16666C6.31802 2.16666 3.33325 5.15142 3.33325 8.83332C3.33325 13.3486 8.33325 15.5 9.99992 18.8333Z"
                        stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
                {{-- @dd($jobs) --}}
                <div class="d-flex mt-3 mt-lg-0">
                    {{-- <a href="#" class="social_btn">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="18" viewBox="0 0 20 18" fill="none">
                            <path d="M13.4253 1.5C16.3605 1.5 18.3327 4.29375 18.3327 6.9C18.3327 12.1781 10.1475 16.5 9.99935 16.5C9.8512 16.5 1.66602 12.1781 1.66602 6.9C1.66602 4.29375 3.63824 1.5 6.57342 1.5C8.25861 1.5 9.36046 2.35312 9.99935 3.10312C10.6382 2.35312 11.7401 1.5 13.4253 1.5Z" stroke="#717884" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </a> --}}


                </div>


            </span>
        </a>
    </div>
</div>
