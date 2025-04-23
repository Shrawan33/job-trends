
    @foreach ($reviews->reverse() as $review)
        {{-- @dd($review->video->presigned_url); --}}
        <div class="inner_box mb-40">
            <div class="d-flex align-items-center user_info mb-10">
                @if ($review->is_anonymous)
                    @include('vendor.image_upload.anonymous_user', [
                        'class_li' => '',
                        'wrapper_class' => 'mr-5 profile_img',
                    ])
                @else
                    @if ($review->reviewFromUser->hasRole('jobseeker'))
                        @if (!empty($review->reviewFromUser->seekerDetail) && $review->reviewFromUser->seekerDetail->logo->count())
                            @include('vendor.image_upload.display', [
                                'document_type' => config('constants.document_type.image', 0),
                                'imageModel' => $review->reviewFromUser->seekerDetail,
                                'class_li' => '',
                                'wrapper_class' => 'mr-5 profile_img',
                                'thumbnail' => true,
                            ])
                        @else
                            @include('vendor.image_upload.no_user', [
                                    'class_li' => '',
                                    'wrapper_class' => 'mr-5 profile_img',
                            ])
                        @endif
                    @else
                        @if (!empty($review->reviewFromUser->usersProfile) && $review->reviewFromUser->usersProfile->logo->count())
                            @include('vendor.image_upload.display', [
                                'document_type' => config('constants.document_type.image', 0),
                                'imageModel' => $review->reviewFromUser->usersProfile,
                                'class_li' => '',
                                'wrapper_class' => 'mr-5 profile_img',
                                'thumbnail' => true,
                            ])
                        @else
                            @include('vendor.image_upload.no_user', [
                                    'class_li' => '',
                                    'wrapper_class' => 'mr-5 profile_img',
                            ])
                        @endif
                    @endif
                @endif

                <p class="mb-0">
                    <span class="text-black font-weight-bold">
                        @if ($review->is_anonymous)
                            Anonymous user
                        @else
                            @if ($review->reviewFromUser->hasRole('jobseeker'))
                                <a class="text-black font-weight-bold" href="{{route('candidates.show', $review->reviewFromUser->slug)}}">{{$review->reviewFromUser->first_name}} {{$review->reviewFromUser->last_name}}</a>
                            @else
                                <a class="text-black font-weight-bold" href="{{ route('job-detail.employer.show', $review->reviewFromUser->slug) }}">{{$review->reviewFromUser->company_name}}</a>
                            @endif
                        @endif

                    </span> has reviewed this profile</p>
            </div>
            <div class="description mb-20">
                {{ $review->review }}
            </div>
            @if (!empty($review->video))
                <div class="audio_file">
                    <video width="400" height="250" controls>
                        <source src="{{ $review->video->presigned_url }}">
                        Your browser does not support the video tag.
                    </video>
                </div>
            @endif

            @if (!empty($review->audio))
                <div class="audio_file">
                    <audio controls>
                        <source src="{{ $review->audio->presigned_url }}" type="audio/mpeg">
                        Your browser does not support the audio element.
                    </audio>
                </div>
            @endif
            @if(!empty($review->profilePic))
                @include('vendor.image_upload.display',
                    [
                        'wrapper_class' => 'inner_img',
                        'document_type' => config('constants.document_type.image', 0),
                        'imageModel' => $review,
                        'thumbnail' => false
                    ])
            @endif
        </div>
    @endforeach

