<div class="inner_box pb-30">
    <p class="mb-20 section_title">Select Badge</p>
    {!! Form::hidden('badge_id', null, ['class' => 'form-control', 'id' => 'badge_id']) !!}
    <ul class="nav nav-tabs category_wraper row column_gaping_8 border-0" id="myTab" role="tablist">
        @foreach ($badges as $badge)
            <li class="nav-item col-6 col-md-3 mb-3 mb-md-0" role="presentation">
                <button onclick="myFunction()"
                    class="nav-link badge-tab inner_wraper @if ($badge->id == $selectedBadgeId) active @endif"
                    id="badge-{{ $badge->id }}-tab" data-badge-value="{{ $badge->id }}" data-toggle="tab"
                    data-target="#badge-{{ $badge->id }}" type="button" role="tab"
                    aria-controls="badge-{{ $badge->id }}" aria-selected="true">
                    <div class="img_wraper">
                        @include('vendor.image_upload.display', [
                            'wrapper_class' => 'img-fluid user-90',
                            'document_type' => config('constants.document_type.image', 0),
                            'imageModel' => $badge,
                        ])
                    </div>
                    <p class="title mb-0 text-center">{{ $badge->title ?? null }}</p>
                </button>
            </li>
        @endforeach
    </ul>

    <div class="tab-content mt-30 mt-lg-40 category_content" id="myTabContent">
        @foreach ($badges as $badge)
            <div class="tab-pane fade show @if ($badge->id == $selectedBadgeId) active @endif"
                id="badge-{{ $badge->id }}" role="tabpanel" aria-labelledby="badge-{{ $badge->id }}-tab">
                <div class="mb-30">
                    <p class="mb-20 section_title">{{ trans('label.responsibility') }}</p>
                    @if (!empty($badge->responsibilities))
                        <ol class="responsibilities-list">
                            @include('user_reviews.selected_badge_strength', [
                                'model' => $badge->responsibilities,
                                'name' => 'responsibilities[]',
                                'id' => 'responsibilities',
                            ])
                        </ol>
                    @endif
                </div>
                <div class="">
                    {{-- @dd($badge->weeknessesq) --}}
                    <p class="mb-20 section_title">{{ trans('label.weakness') }}</p>
                    @if (!empty($badge->weeknesses))
                        <ol class="weaknesses-list">
                            @include('user_reviews.selected_badge_weekness', [
                                'model' => $badge->weeknesses,
                                'name' => 'weeknesses[]',
                                'id' => 'weeknesses',
                            ])
                        </ol>
                    @endif
                </div>
            </div>
        @endforeach
    </div>
</div>

{!! Form::hidden('review_to_id', $record->id ?? null, ['class' => 'form-control']) !!}
{!! Form::label('review', trans('label.write_review') . '', ['class' => 'section_title mb-20']) !!}
{!! Form::textarea('advance_review', $review->review ?? null, ['class' => 'form-control', 'rows' => 5]) !!}

<div class="upload_section">
    <p class="section_title mt-30 mb-20">Upload Video or Audio</p>
    <ul class="nav nav-tabs upload_tabs mt-20 row column_gaping_8 border-0" id="myTab" role="tablist">
        <li class="nav-item col-6" role="presentation">
            <button class="nav-link inner_wraper active p-20 file_upload_tab" id="advance-video-tab" data-toggle="tab"
                data-target="#advance-video" type="button" role="tab" aria-controls="video" aria-selected="true">
                <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 30 30" fill="none"
                    class="mb-5">
                    <path
                        d="M21.2085 25.2712C19.3971 26.3684 17.2724 27 15 27C8.37264 27 3 21.6274 3 15C3 8.37259 8.37264 3 15 3C21.6274 3 27 8.37259 27 15C27 17.4644 26.2402 19.7553 24.9661 21.661"
                        stroke="black" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round"
                        stroke-linejoin="round" />
                    <path
                        d="M13.0769 19.8117L19.3083 16.2017C20.2306 15.6673 20.2306 14.3327 19.3083 13.7984L13.0769 10.1883C12.154 9.65362 11 10.3213 11 11.3899V18.6101C11 19.6787 12.154 20.3464 13.0769 19.8117Z"
                        stroke="#357DE8" stroke-width="1.5" stroke-miterlimit="10" stroke-linejoin="round" />
                </svg>
                <p class="mb-0">Video</p>
                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 14 14" fill="none"
                    class="check_icon">
                    <rect x="0.45459" y="0.454559" width="13.0909" height="13.0909" rx="6.54545"
                        fill="#357DE8" />
                    <path d="M9.54537 4.81818L5.79537 9.18181L4.09082 7.52892" stroke="white" stroke-width="1.09091"
                        stroke-linecap="round" stroke-linejoin="round" />
                </svg>
            </button>
        </li>
        <li class="nav-item col-6" role="presentation">
            <button class="nav-link inner_wraper p-20 file_upload_tab" id="advance-audio-tab" data-toggle="tab"
                data-target="#advance-audio" type="button" role="tab" aria-controls="audio" aria-selected="false">
                <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 30 30" fill="none"
                    class="mb-5">
                    <path d="M5.80078 6.44531V23.5547" stroke="black" stroke-width="1.5" stroke-miterlimit="10" />
                    <path d="M10.3711 1.75781V28.2422" stroke="black" stroke-width="1.5" stroke-miterlimit="10" />
                    <path d="M14.9414 11.1328V18.8672" stroke="#357DE8" stroke-width="1.5" stroke-miterlimit="10" />
                    <path d="M19.5703 4.6875V25.3125" stroke="black" stroke-width="1.5" stroke-miterlimit="10" />
                    <path d="M28.8281 11.1328V19.4531" stroke="#357DE8" stroke-width="1.5" stroke-miterlimit="10" />
                    <path d="M24.1992 1.75781V28.2422" stroke="black" stroke-width="1.5" stroke-miterlimit="10" />
                    <path d="M1.17188 11.1328V18.8672" stroke="black" stroke-width="1.5" stroke-miterlimit="10" />
                    <path d="M1.17188 11.1328V18.8672" stroke="#357DE8" stroke-width="1.5" stroke-miterlimit="10" />
                </svg>
                <p class="mb-0">Audio</p>
                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 14 14"
                    fill="none" class="check_icon">
                    <rect x="0.45459" y="0.454559" width="13.0909" height="13.0909" rx="6.54545"
                        fill="#357DE8" />
                    <path d="M9.54537 4.81818L5.79537 9.18181L4.09082 7.52892" stroke="white" stroke-width="1.09091"
                        stroke-linecap="round" stroke-linejoin="round" />
                </svg>
            </button>
        </li>

    </ul>
    <div class="message p-2" id="video-message" style="display:none; color:red;">Please Remove Video first</div>
    <div class="message p-2" id="audio-message" style="display:none; color:red;">Please Remove Audio first</div>
    <div class="tab-content mt-30" id="myTabContent">

        <div class="tab-pane fade show active" id="advance-video" role="tabpanel"
            aria-labelledby="advance-video-tab">
            @include('vendor.dropzone.advance_video_upload', [
                'form_id' => 'frm_userReview',
                'dropzone_id' => 'advance-video-dropzone',
                'disk' => $entity['disk'],
                'documents' => old(
                    'advance_video',
                    isset($review) && $review->videos ? $review->videos->toArray() : []),
                'maxFiles' => 1,
                'acceptedFileType' => 'video',
                'name' => 'advance_video',
                'link_text' => 'Upload Video  (file size 2 MB only)&nbsp;<small class="red">*</small>',
            ])
        </div>

        <div class="tab-pane fade" id="advance-audio" role="tabpanel" aria-labelledby="advance-audio-tab">
            @include('vendor.dropzone.advance_audio_upload', [
                'form_id' => 'frm_userReview',
                'dropzone_id' => 'advance-audio-dropzone',
                'disk' => $entity['disk'],
                'documents' => old(
                    'advance_audio',
                    isset($review) && $review->audios ? $review->audios->toArray() : []),
                'maxFiles' => 1,
                'acceptedFileType' => 'audio',
                'name' => 'advance_audio',
                'filetype' => 'audio',
                'link_text' => 'Upload Audio  (file size 1 MB only)&nbsp;<small class="red">*</small>',
            ])
        </div>

    </div>
</div>

<div class="inner_box pt-30">
    <div class="d-flex align-items-center flex-wrap">
        {!! Form::checkbox('advance_anonymous', 1, $review->is_anonymous == 1, ['id' => 'advance_anonymous']) !!}
        <span class="section_title font-16">Submit as an Anonymous</span>
    </div>
</div>
{{-- <script>
    function clearCheckboxes() {
        $('input[type="checkbox"]').prop('checked', false);
    }

    $(document).ready(function() {
        const badgeTabs = document.querySelectorAll('.badge-tab');
        badgeTabs.forEach(tab => {
            tab.addEventListener('click', clearCheckboxes);
        });
    });
</script> --}}
<script>
    function clearCheckboxes() {
        $('input[type="checkbox"]').prop('checked', false);
    }

    $(document).ready(function() {
        const badgeTabs = document.querySelectorAll('.badge-tab');
        badgeTabs.forEach(tab => {
            tab.addEventListener('click', clearCheckboxes);
        });

        $('form').submit(function() {
            if ($('input[type="checkbox"]:checked').length === 0) {
                alert("Please Check at least one Check Box");
                return false; // Prevent form submission if no checkbox is checked
            }
        });
    });
</script>

<script>



    $('.file_upload_tab').on('click', function(e) {
        var tabId = this.id;
        if (tabId == 'advance-audio-tab') {
            var ulElement = $('#advance-video-dropzone-preview');
            if (ulElement.html().trim() !== '') {
                // Show the video message div
                $('#video-message').show();
                e.preventDefault();
                return false;
            } else {
                // Hide the video message div
                $('#video-message').hide();
            }
        } else {
            var ulElement = $('#advance-audio-dropzone-preview');
            if (ulElement.html().trim() !== '') {
                // Show the audio message div
                $('#audio-message').show();
                e.preventDefault();
                return false;
            } else {
                // Hide the audio message div
                $('#audio-message').hide();
            }
        }
        // alert(tabId);
    });
    </script>
<script>
    $(document).ready(function() {
        // Check if video files have been uploaded
        var videoFilesUploaded = {!! json_encode(isset($review) && $review->videos && count($review->videos) > 0) !!};

        // Check if audio files have been uploaded
        var audioFilesUploaded = {!! json_encode(isset($review) && $review->audios && count($review->audios) > 0) !!};

        // Function to switch to the "Video" tab
        function switchToVideoTab() {
            $('#advance-video-tab').tab('show');
        }

        // Function to switch to the "Audio" tab
        function switchToAudioTab() {
            $('#advance-audio-tab').tab('show');
        }

        // Check if video files have been uploaded and switch to the "Video" tab
        if (videoFilesUploaded) {
            switchToVideoTab();
        }

        // Check if audio files have been uploaded and switch to the "Audio" tab
        if (audioFilesUploaded) {
            switchToAudioTab();
        }
    });
</script>
