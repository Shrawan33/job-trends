{!! Form::hidden('review_to_id', $record->id??null, ['class' => 'form-control']) !!}
{!! Form::label('review', trans('label.write_review').'' , ['class' => 'section_title mb-20']) !!}
{!! Form::textarea('basic_review', null, ['class' => 'form-control', 'rows' => 5]) !!}

<div class="upload_section">
    <p class="section_title mt-30 mb-20">Upload Video, Audio or Image </p>
    <ul class="nav nav-tabs upload_tabs mt-20 row mx-0 border-0" id="myTab" role="tablist">
        <li class="nav-item col-4 pl-lg-0" role="presentation">
            <button class="nav-link inner_wraper active p-20" id="video-tab" data-toggle="tab" data-target="#video" type="button" role="tab" aria-controls="video" aria-selected="true">
                <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 30 30" fill="none" class="mb-5">
                    <path d="M21.2085 25.2712C19.3971 26.3684 17.2724 27 15 27C8.37264 27 3 21.6274 3 15C3 8.37259 8.37264 3 15 3C21.6274 3 27 8.37259 27 15C27 17.4644 26.2402 19.7553 24.9661 21.661" stroke="black" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M13.0769 19.8117L19.3083 16.2017C20.2306 15.6673 20.2306 14.3327 19.3083 13.7984L13.0769 10.1883C12.154 9.65362 11 10.3213 11 11.3899V18.6101C11 19.6787 12.154 20.3464 13.0769 19.8117Z" stroke="#357DE8" stroke-width="1.5" stroke-miterlimit="10" stroke-linejoin="round"/>
                </svg>
                <p class="mb-0">Video</p>
                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 14 14" fill="none" class="check_icon">
                    <rect x="0.45459" y="0.454559" width="13.0909" height="13.0909" rx="6.54545" fill="#357DE8"/>
                    <path d="M9.54537 4.81818L5.79537 9.18181L4.09082 7.52892" stroke="white" stroke-width="1.09091" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </button>
        </li>
        <li class="nav-item col-4 pl-lg-0" role="presentation">
            <button class="nav-link inner_wraper p-20" id="audio-tab" data-toggle="tab" data-target="#audio" type="button" role="tab" aria-controls="audio" aria-selected="false">
                <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 30 30" fill="none" class="mb-5">
                    <path d="M5.80078 6.44531V23.5547" stroke="black" stroke-width="1.5" stroke-miterlimit="10"/>
                    <path d="M10.3711 1.75781V28.2422" stroke="black" stroke-width="1.5" stroke-miterlimit="10"/>
                    <path d="M14.9414 11.1328V18.8672" stroke="#357DE8" stroke-width="1.5" stroke-miterlimit="10"/>
                    <path d="M19.5703 4.6875V25.3125" stroke="black" stroke-width="1.5" stroke-miterlimit="10"/>
                    <path d="M28.8281 11.1328V19.4531" stroke="#357DE8" stroke-width="1.5" stroke-miterlimit="10"/>
                    <path d="M24.1992 1.75781V28.2422" stroke="black" stroke-width="1.5" stroke-miterlimit="10"/>
                    <path d="M1.17188 11.1328V18.8672" stroke="black" stroke-width="1.5" stroke-miterlimit="10"/>
                    <path d="M1.17188 11.1328V18.8672" stroke="#357DE8" stroke-width="1.5" stroke-miterlimit="10"/>
                  </svg>
                  <p class="mb-0">Audio</p>
                  <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 14 14" fill="none" class="check_icon">
                    <rect x="0.45459" y="0.454559" width="13.0909" height="13.0909" rx="6.54545" fill="#357DE8"/>
                    <path d="M9.54537 4.81818L5.79537 9.18181L4.09082 7.52892" stroke="white" stroke-width="1.09091" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </button>
        </li>
        <li class="nav-item col-4 pl-lg-0" role="presentation">
            <button class="nav-link inner_wraper p-20" id="image-tab" data-toggle="tab" data-target="#image" type="button" role="tab" aria-controls="image" aria-selected="false">
                <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 26 26" fill="none" class="mb-5">
                    <path d="M25.2383 4.84103C25.2383 4.40822 25.0669 3.99334 24.761 3.68739C24.455 3.38102 24.0389 3.20928 23.6065 3.20928H2.39347C1.96107 3.20928 1.54497 3.38102 1.23901 3.68739C0.933105 3.99334 0.761719 4.40822 0.761719 4.84103V21.1588C0.761719 21.5916 0.933105 22.0065 1.23901 22.3124C1.54497 22.6188 1.96107 22.7905 2.39347 22.7905H23.6065C24.0389 22.7905 24.455 22.6188 24.761 22.3124C25.0669 22.0065 25.2383 21.5916 25.2383 21.1588V4.84103Z" stroke="black" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M2.39355 22.7905L10.5524 14.6317L13.816 17.8953L20.343 11.3681L25.2384 16.2635" stroke="black" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M6.47305 6.4729C7.82337 6.4729 8.9207 7.56988 8.9207 8.92056C8.9207 10.2712 7.82337 11.3682 6.47305 11.3682C5.12272 11.3682 4.02539 10.2712 4.02539 8.92056C4.02539 7.56988 5.12272 6.4729 6.47305 6.4729Z" stroke="#357DE8" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
                <p class="mb-0">Image</p>
                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 14 14" fill="none" class="check_icon">
                    <rect x="0.45459" y="0.454559" width="13.0909" height="13.0909" rx="6.54545" fill="#357DE8"/>
                    <path d="M9.54537 4.81818L5.79537 9.18181L4.09082 7.52892" stroke="white" stroke-width="1.09091" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </button>
        </li>
    </ul>
    <div class="tab-content mt-30" id="myTabContent">
        <div class="tab-pane fade show active" id="video" role="tabpanel" aria-labelledby="video-tab">
            @include('vendor.dropzone.basic_video_upload', [
                'form_id' => 'frm_userReview',
                'dropzone_id' => 'basic-video-dropzone',
                'disk' => $entity['disk'],
                'documents' => old('basic_video', []),
                'maxFiles' => 1,
                'acceptedFileType' => 'video',
                'filetype' => 'video',
                'name' => 'basic_video',
                'link_text' => 'Upload Video  (file size 2 MB only)&nbsp;<small class="red">*</small>',
            ])
        </div>
        <div class="tab-pane fade" id="audio" role="tabpanel" aria-labelledby="audio-tab">
            @include('vendor.dropzone.basic_audio_upload', [
                'form_id' => 'frm_userReview',
                'dropzone_id' => 'basic-audio-dropzone',
                'disk' => $entity['disk'],
                'documents' => old('basic_audio', []),
                'maxFiles' => 1,
                'acceptedFileType' => 'audio',
                'name' => 'basic_audio',
                'filetype' => 'audio',
                'link_text' => 'Upload Audio  (file size 1 MB only)&nbsp;<small class="red">*</small>',
            ])
        </div>
        <div class="tab-pane fade" id="image" role="tabpanel" aria-labelledby="image-tab">
            @include('vendor.image_upload.basic_upload', [
                'id' => 'basic_review_image',
                'class' => 'mx-0',
                'name' => 'basic_review_image',
                'height' => '250px',
                'width' => '250px',
                'document_type' => config('constants.document_type.image', 2),
                'multiple' => true,
                'limit' => 1,
                'link_text' => 'Upload Image  (file size 1 MB only)&nbsp;<small class="red">*</small>'
            ])

            {{-- <div class="input-group">

                <input type="file" class="custom-file-input" name="basic_image" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01">
                <label class="custom-file-label" for="inputGroupFile01">Choose file</label>

            </div> --}}
        </div>
    </div>
</div>
<div class="inner_box pt-30">
    <div class="d-flex align-items-center flex-wrap">
        {!! Form::checkbox('basic_anonymous') !!}
        <span class="section_title font-16">Submit as an Anonymous</span>
    </div>
</div>

