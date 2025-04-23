@if (!empty($reviewed_users))
        @foreach ($reviewed_users->reverse() as $user)

                <div class="inner_box p-20 border-bottom position-relative">
                    <div class="d-flex align-items-center mb-20 user_to_reviews" data-user-id="{{ $user->id }}">
                        @if ($user->role_id == '2')
                            @if(!empty($user->usersProfile->logo) && $user->usersProfile->logo->count())
                                @include('vendor.image_upload.display', [
                                    'document_type' => config('constants.document_type.image', 0),
                                    'imageModel' => $user->usersProfile,
                                    'class_li' => '',
                                    'wrapper_class' => 'mr-10 profile_img',
                                    'thumbnail' => true,
                                ])
                            @else
                                @include('vendor.image_upload.no_user', [
                                    'class_li' => 'mr-10 profile_img',
                                    'wrapper_class' => 'mr-10 profile_img',
                                ])
                            @endif
                            <div class="info">
                                <h3 class="mb-5">
                                    {{$user->company_name}}
                                </h3>
                                <p class="mb-10">{{$user->usersProfile->user_address}}</p>
                                @if ($user->badge_data)
                                    <ul class="m-0 p-0 group_noti">
                                        @foreach ($user->badge_data as $badge)
                                            @if ($badge['badge_count'] >= $badge['badge_model']->min_review_count)
                                                <li>
                                                    @include('vendor.image_upload.display', [
                                                        'wrapper_class' => 'mr-10',
                                                        'document_type' => config('constants.document_type.image', 0),
                                                        'imageModel' => $badge['badge_model'],
                                                    ])
                                                    <span class="number">{{$badge['badge_count']}}</span>
                                                </li>
                                            @endif
                                        @endforeach
                                    </ul>
                                @endif
                            </div>
                        @else
                            @if (!empty($user->seekerDetail) && $user->seekerDetail->logo->count())
                                @include('vendor.image_upload.display', [
                                    'document_type' => config('constants.document_type.image', 0),
                                    'imageModel' => $user->seekerDetail,
                                    'class_li' => '',
                                    'wrapper_class' => 'mr-10 profile_img',
                                    'thumbnail' => true,
                                ])
                            @else
                                @include('vendor.image_upload.no_user', [
                                        'class_li' => 'mr-10 profile_img',
                                        'wrapper_class' => 'mr-10 profile_img',
                                ])
                            @endif
                            <div class="info">
                                <h3 class="mb-5">
                                    {{$user->first_name}} {{$user->last_name}}
                                </h3>
                                <p class="mb-10">{{$user->seekerDetail->address ?? ''}}</p>
                                @if ($user->badge_data)
                                    <ul class="m-0 p-0 group_noti">
                                        @foreach ($user->badge_data as $badge)
                                            @if ($badge['badge_count'] >= $badge['badge_model']->min_review_count)
                                                <li>
                                                    @include('vendor.image_upload.display', [
                                                        'wrapper_class' => 'mr-10',
                                                        'document_type' => config('constants.document_type.image', 0),
                                                        'imageModel' => $badge['badge_model'],
                                                    ])
                                                    <span class="number">{{$badge['badge_count']}}</span>
                                                </li>
                                            @endif
                                        @endforeach
                                    </ul>
                                @endif

                            </div>
                        @endif
                        <div class="d-md-none feed_mobile_arrow">
                            <svg xmlns="http://www.w3.org/2000/svg" width="8" height="12" viewBox="0 0 8 12" fill="none">
                                <path d="M1 1L6 6L1 11" stroke="#838383" stroke-width="1.5"/>
                            </svg>
                        </div>
                    </div>
                    <div class="review_sectioon d-flex align-items-center justify-content-between">
                        <a href="{{route('social-profile.show', $user->slug)}}" class="d-flex align-items-center" data-context="social-profile">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                                <path d="M3.32141 13.2069C3.74723 12.2036 4.74145 11.5 5.9 11.5H10.1C11.2586 11.5 12.2528 12.2036 12.6786 13.2069M10.8 6.25C10.8 7.7964 9.5464 9.05 8 9.05C6.4536 9.05 5.2 7.7964 5.2 6.25C5.2 4.7036 6.4536 3.45 8 3.45C9.5464 3.45 10.8 4.7036 10.8 6.25ZM15 8C15 11.866 11.866 15 8 15C4.13401 15 1 11.866 1 8C1 4.13401 4.13401 1 8 1C11.866 1 15 4.13401 15 8Z" stroke="#838383" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        {{__('label.view_profile')}}
                        </a>
                        <a href="{{route('social-profile.show', $user->slug)}}/#review_tab_main_wraper" class="d-flex align-items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" width="15" height="14" viewBox="0 0 15 14" fill="none">
                                <path d="M6.81442 1.54995C6.96831 1.23819 7.04525 1.0823 7.14971 1.0325C7.24059 0.989167 7.34618 0.989167 7.43706 1.0325C7.54152 1.0823 7.61846 1.23819 7.77235 1.54995L9.23235 4.50774C9.27778 4.59978 9.3005 4.6458 9.33369 4.68153C9.36309 4.71316 9.39834 4.7388 9.4375 4.75701C9.48172 4.77757 9.5325 4.78499 9.63406 4.79984L12.8999 5.27718C13.2438 5.32745 13.4157 5.35258 13.4953 5.43658C13.5645 5.50966 13.5971 5.61008 13.5839 5.70988C13.5687 5.82459 13.4443 5.94584 13.1953 6.18834L10.833 8.48918C10.7594 8.56091 10.7226 8.59677 10.6988 8.63944C10.6778 8.67722 10.6643 8.71873 10.6591 8.76165C10.6532 8.81014 10.6619 8.8608 10.6793 8.96211L11.2366 12.2119C11.2954 12.5547 11.3248 12.7261 11.2696 12.8278C11.2215 12.9163 11.1361 12.9784 11.0371 12.9967C10.9233 13.0178 10.7694 12.9369 10.4616 12.775L7.542 11.2396C7.45104 11.1918 7.40555 11.1679 7.35763 11.1585C7.31521 11.1501 7.27157 11.1501 7.22914 11.1585C7.18122 11.1679 7.13574 11.1918 7.04477 11.2396L4.1252 12.775C3.81739 12.9369 3.66349 13.0178 3.54969 12.9967C3.45068 12.9784 3.36525 12.9163 3.31718 12.8278C3.26194 12.7261 3.29134 12.5547 3.35013 12.2119L3.90751 8.96211C3.92489 8.8608 3.93358 8.81014 3.9277 8.76165C3.92249 8.71873 3.909 8.67722 3.88796 8.63944C3.8642 8.59677 3.82738 8.56091 3.75374 8.48918L1.39149 6.18834C1.14251 5.94584 1.01802 5.82459 1.00288 5.70988C0.989696 5.61008 1.02226 5.50966 1.09149 5.43658C1.17107 5.35258 1.34302 5.32745 1.68692 5.27718L4.95271 4.79984C5.05427 4.78499 5.10505 4.77757 5.14928 4.75701C5.18843 4.7388 5.22369 4.71316 5.25308 4.68153C5.28628 4.6458 5.30899 4.59978 5.35442 4.50774L6.81442 1.54995Z" stroke="#838383" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                            {{__('label.review')}}
                        </a>
                        {{-- <a href="{{ route('candidates.show', ['slug' => $user->slug, 'activate_tab' => 'review_tab']) }}#review_tab" class="d-flex align-items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" width="15" height="14" viewBox="0 0 15 14" fill="none">
                                <path d="M6.81442 1.54995C6.96831 1.23819 7.04525 1.0823 7.14971 1.0325C7.24059 0.989167 7.34618 0.989167 7.43706 1.0325C7.54152 1.0823 7.61846 1.23819 7.77235 1.54995L9.23235 4.50774C9.27778 4.59978 9.3005 4.6458 9.33369 4.68153C9.36309 4.71316 9.39834 4.7388 9.4375 4.75701C9.48172 4.77757 9.5325 4.78499 9.63406 4.79984L12.8999 5.27718C13.2438 5.32745 13.4157 5.35258 13.4953 5.43658C13.5645 5.50966 13.5971 5.61008 13.5839 5.70988C13.5687 5.82459 13.4443 5.94584 13.1953 6.18834L10.833 8.48918C10.7594 8.56091 10.7226 8.59677 10.6988 8.63944C10.6778 8.67722 10.6643 8.71873 10.6591 8.76165C10.6532 8.81014 10.6619 8.8608 10.6793 8.96211L11.2366 12.2119C11.2954 12.5547 11.3248 12.7261 11.2696 12.8278C11.2215 12.9163 11.1361 12.9784 11.0371 12.9967C10.9233 13.0178 10.7694 12.9369 10.4616 12.775L7.542 11.2396C7.45104 11.1918 7.40555 11.1679 7.35763 11.1585C7.31521 11.1501 7.27157 11.1501 7.22914 11.1585C7.18122 11.1679 7.13574 11.1918 7.04477 11.2396L4.1252 12.775C3.81739 12.9369 3.66349 13.0178 3.54969 12.9967C3.45068 12.9784 3.36525 12.9163 3.31718 12.8278C3.26194 12.7261 3.29134 12.5547 3.35013 12.2119L3.90751 8.96211C3.92489 8.8608 3.93358 8.81014 3.9277 8.76165C3.92249 8.71873 3.909 8.67722 3.88796 8.63944C3.8642 8.59677 3.82738 8.56091 3.75374 8.48918L1.39149 6.18834C1.14251 5.94584 1.01802 5.82459 1.00288 5.70988C0.989696 5.61008 1.02226 5.50966 1.09149 5.43658C1.17107 5.35258 1.34302 5.32745 1.68692 5.27718L4.95271 4.79984C5.05427 4.78499 5.10505 4.77757 5.14928 4.75701C5.18843 4.7388 5.22369 4.71316 5.25308 4.68153C5.28628 4.6458 5.30899 4.59978 5.35442 4.50774L6.81442 1.54995Z" stroke="#838383" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                            {{__('label.review')}}
                        </a> --}}
                    </div>
                </div>

        @endforeach
@endif
{{-- {{ $reviewed_users->links() }} --}}
                    {{-- <p class="text-black mb-4 show_result_text">{!! __('label.showing') !!} {{$reviewed_users->firstItem()??0}}-{{$reviewed_users->lastItem()}} of {{$reviewed_users->total()}} {!! __('label.result') !!}</p> --}}
@push('page_scripts')
    <script>
        $(document).on('click', '.user_to_reviews', function(e) {
            var user_id = $(this).data("user-id");
            var url = "{{ route('user_review.getRevieweFromUserList', ':user_id') }}";
            url = url.replace(':user_id', user_id);
            $(".inner_box.active").removeClass("active");
            $(this).parent().addClass('active');
            processAjaxOperation(url, 'GET', 'applicaion/json')
        })
    </script>
@endpush
