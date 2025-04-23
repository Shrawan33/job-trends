<div class="inner_wraper">
    <ul class="m-0 p-0 category_sidebar_tab_wraper py-20">
        {{-- @dd($candidate) --}}
        @if ($badges)
            @foreach ($badges as $badge)
            {{-- @dd($badge) --}}
                <li class="active">
                    <a href="javascript:void(0)" class="inner_tab inner_tab" data-badge-value="{{ $badge->id }}" id="badge_{{ $badge->id }}" data-candidate-id="{{ $candidate->id }}">
                        @if (!empty($badge) && $badge->profilePic->count())
                            @include('vendor.image_upload.display', [
                                'document_type' => config('constants.document_type.image', 0),
                                'imageModel' => $badge,
                                'class_li' => '',
                                'wrapper_class' => 'mr-10'
                            ])
                        @else
                            @include('vendor.image_upload.no_user', ['class_li' => ''])
                        @endif
                        <span class="mr-15 ">{{ $badge->title }}</span>
                        <p class="mb-0 number">{{ $badge->total_reviews_count }}</p>
                    </a>
                </li>
            @endforeach
        @endif
    </ul>
</div>


