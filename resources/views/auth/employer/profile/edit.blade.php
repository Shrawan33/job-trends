@section('third_party_stylesheets')
    @include('vendor.image_upload.style')
    @include('vendor.richtexteditor.style')
@endsection
@extends('layouts.front')

@section('content')
    <div class="container">
        <h1 class="inner_page_heading">
            {{-- <a href="{{ route('users.profile') }}" class="text-body"><i class="fi flaticon-left-arrow mr-2"></i></a> --}}
            {{ trans('label.edit') }} {{ trans('label.employer_profile') }}
        </h1>
        <div class="profile_box">
            <h3 class="mb-30">@lang('label.employer_info')</h3>
        </div>
        <form method="post" action="{{ route('users.update.profile') }}" enctype="multipart/form-data">
            <input type="hidden" name="user_id" value="{{ $user->id ?? '' }}" />
            {!! Form::hidden('country_id', config('constants.default_country_id')) !!}
            @csrf
            <div class="row">
                <div class="col-12 border-bottom pb-40">
                    <label for="">{{ trans('label.profile_picture') }}</label>
                    @include('vendor.image_upload.upload', [
                        'id' => 'employer_logo',
                        'name' => 'employer_logo',
                        'height' => '80px',
                        'width' => '80px',
                        'document_type' => config('constants.document_type.image', 0),
                        'multiple' => true,
                        'limit' => 1,
                    ])
                </div>
            </div>
            <div class="row mt-4 border-bottom pb-4 mb-4 ">
                <div class="col-12 ">
                    <div class="profile_box">
                    </div>
                    <div class="row border-bottom pb-40">
                        <div class="form-group mb-30 user-id d-none">
                            {!! Form::label('user_code', $user->user_code ?? null, [
                                'class' => 'form-control text-center',
                                'readonly' => true,
                            ]) !!}
                            <span>{{ trans('label.employer_number') }}</span>
                            {{-- <input type="text" readonly="readonly" name="user_code"
                            value="{{ old('user_code', $user->user_code ?? null) }}"
                            class="form-control text-center @error('user_code') is-invalid @enderror"
                            placeholder="{{ trans('label.employer_number') }}" />
                        <span>{{ trans('label.employer_number') }}</span>
                        @error('user_code')
                        <span class="error invalid-feedback">{{ $message }}</span>
                        @enderror --}}
                        </div>

                        <div class="form-group mb-3 col-md-4 col-lg-3">
                            <label for="">{{ trans('label.company_name') }}</label>
                            <input type="text" name="company_name"
                                value="{{ old('company_name', $user->company_name ?? null) }}"
                                class="form-control @error('company_name') is-invalid @enderror"
                                placeholder="{{ trans('label.company_name') }}">
                            @error('company_name')
                                <span class="error invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group mb-3 col-md-4 col-lg-3">
                            <label for="">{{ trans('label.state') }}</label>
                            @include('components.state', [
                                'states' => $states,
                                'selected' => $user->usersProfile->state_id ?? '',
                            ])
                            @error('state_id')
                                <span class="error invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group mb-3 col-md-4 col-lg-3">
                            <label for="">{{ trans('label.city') }}</label>
                            @include('components.location', [
                                'locations' => $locations,
                                'selected' => $user->usersProfile->location_id ?? '',
                            ])
                            @error('location_id')
                                <span class="error invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        {{-- <div class="form-group mb-3 col-md-4">
                        <label for="">{{ trans('label.qec') }}</label>
                        <input type="number" name="qec" min="1" max="63" value="{{ old('qec', $user->usersProfile->qec ?? null) }}" class="form-control @error('qec') is-invalid @enderror" placeholder="{{ trans('label.qec') }}">
                        @error('qec')
                            <span class="error invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div> --}}


                        {{-- <div class="form-group mb-3 col-lg-3 col-md-4">
                            <label for="">{{ trans('label.qec') }}</label>
                            <select name="qec" class="form-control @error('qec') is-invalid @enderror">
                                <option value="">Select a value</option>
                                @for ($i = 1; $i <= 63; $i++)
                                    <option value="{{ $i }}"
                                        {{ old('qec', $user->usersProfile->qec ?? null) == $i ? 'selected' : '' }}>
                                        {{ $i }}
                                    </option>
                                @endfor
                            </select>
                            @error('qec')
                                <span class="error invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div> --}}


                        <div class="form-group mb-3 col-md-4 col-lg-3">
                            <label for="">{{ trans('label.community') }}</label>
                            <textarea name="address" class="form-control @error('address') is-invalid @enderror"
                                placeholder="{{ trans('label.community') }}">{{ old('address', $user->usersProfile->address ?? '') }}</textarea>
                            @error('address')
                                <span class="error invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group mb-3 col-md-4 col-lg-12">
                            {{-- <label for="">{{ trans('label.company_profile') }}</label> --}}
                            {{-- <textarea name="company_profile" class="form-control @error('company_profile') is-invalid @enderror"
                            placeholder="{{ trans('label.company_profile') }}">{{ old('company_profile', $user->usersProfile->company_profile ?? null) }}</textarea> --}}
                            {{-- <div class="form-group">
                            {{-- {!! Form::label('description', trans('label.description'), ['class' => 'required-label']) !!}
                            {!! Form::textarea('company_profile', null, [

                                'class' => 'form-control ' . ($errors->has('company_profile') ? 'is-invalid' : ''),
                                'placeholder' => trans('label.company_profile'),
                                'richtexteditor' => true
                            ]) !!}
                            @if ($errors->has('company_profile'))
                                <span class="text-danger">{{ $errors->first('company_profile') }}</span>
                            @endif
                        </div> --}}
                            <div class="form-group">
                                {!! Form::label('description', trans('label.about_company')) !!}
                                {!! Form::textarea('company_profile', old('company_profile', $user->usersProfile->company_profile ?? null), [
                                    'class' => 'form-control ' . ($errors->has('company_profile') ? 'is-invalid' : ''),
                                    'placeholder' => trans('label.company_profile'),
                                    'richtexteditor' => true,
                                ]) !!}
                                @if ($errors->has('company_profile'))
                                    <span class="text-danger">{{ $errors->first('company_profile') }}</span>
                                @endif
                            </div>


                            @error('company_profile')
                                <span class="error invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                    </div>
                    <div class="profile_box pt-4">
                        <h3 class="mb-30">@lang('label.contact_information')</h3>
                    </div>
                    <div class="row mt-4 border-bottom pb-4 mb-4 profile_box">

                        <div class="col-md-4 col-lg-3">
                            <div class="form-group mb-3">
                                <label for="">{{ trans('label.contact_person') }}</label>
                                <input type="text" name="first_name"
                                    class="form-control @error('first_name') is-invalid @enderror"
                                    value="{{ old('first_name', $user->first_name . ' ' .$user->last_name ?? null) }}"
                                    placeholder="{{ trans('label.first_name') }}">
                                @error('first_name')
                                    <span class="error invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        {{-- <div class="col-md-4 col-lg-3">
                            <div class="form-group mb-3">
                                <label for="">{{ trans('label.last_name') }}</label>
                                <input type="text" name="last_name"
                                    class="form-control @error('last_name') is-invalid @enderror"
                                    value="{{ old('last_name', $user->last_name ?? null) }}"
                                    placeholder="{{ trans('label.last_name') }}">
                                @error('last_name')
                                    <span class="error invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div> --}}
                        <div class="form-group mb-3 col-md-4 col-lg-3">
                            <label for="">{{ trans('label.company_email_address') }}</label>
                            {!! Form::label('email', $user->email ?? null, ['class' => 'form-control text-lowercase', 'readonly' => true]) !!}
                            {{-- <input type="email" name="email" readonly="readonly" value="{{ old('email', $user->email ?? null) }}"
                            class="form-control @error('email') is-invalid @enderror" placeholder="Email Address">
                        @error('email')
                        <span class="error invalid-feedback">{{ $message }}</span>
                        @enderror --}}
                        </div>

                        <div class="form-group mb-3 col-lg-3 col-md-4">
                            <label for="">{{ trans('label.company_phone_number') }}</label>
                            {!! Form::label('phone_number', $user->phone_number ?? null, ['class' => 'form-control', 'readonly' => true]) !!}
                            {{-- <input type="text" name="phone_number"
                            value="{{ old('phone_number', $user->phone_number ?? null) }}"
                            class="form-control @error('phone_number') is-invalid @enderror" placeholder="Phone Number">
                        @error('phone_number')
                        <span class="error invalid-feedback">{{ $message }}</span>
                        @enderror --}}
                        </div>

                        <div class="form-group col-md-4 mb-3 col-lg-3">
                            <label for="">{{ trans('label.company_website') }}</label>
                            <input type="text" name="company_website"
                                value="{{ old('company_website', $user->usersProfile->company_website ?? null) }}"
                                class="form-control @error('company_website') is-invalid @enderror"
                                placeholder="{{ trans('label.company_website') }}">
                            @error('company_website')
                                <span class="error invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        {{-- <div class="form-group mb-30 col-md-4">
                        <label for="">{{ trans('label.video_link') }}</label>
                        <div class="input-group mb-3">
                            <input type="text" name="video_link"
                            value="{{ old('video_link', $user->usersProfile->video_link ?? null) }}"
                            class="form-control @error('video_link') is-invalid @enderror"
                            placeholder="{{ trans('label.video_link') }}">
                            <div class="input-group-append" data-toggle="tooltip" data-placement="top" title="{!! __('label.video_url_hint')!!}">
                                <span class="input-group-text" id="basic-addon1">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none">
                                        <path d="M9.09 9C9.3251 8.33167 9.78915 7.76811 10.4 7.40913C11.0108 7.05016 11.7289 6.91894 12.4272 7.03871C13.1255 7.15849 13.7588 7.52152 14.2151 8.06353C14.6713 8.60553 14.9211 9.29152 14.92 10C14.92 12 11.92 13 11.92 13M12 17H12.01M22 12C22 17.5228 17.5228 22 12 22C6.47715 22 2 17.5228 2 12C2 6.47715 6.47715 2 12 2C17.5228 2 22 6.47715 22 12Z" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                        </svg>
                                </span>
                            </div>
                        </div>

                        @error('video_link')
                        <span class="error invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div> --}}
                    </div>
                    <div class="row">
                        <div class="col-lg-6 profile_box location_box">
                            <h3 class="mb-3 col-12 pl-0">{{ trans('label.location') }}</h3>
                            {{-- <div class="map-location form-group col-md-6"> --}}
                            {{-- <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d13382331.73055002!2d-115.01212632107675!3d35.02745595714107!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x866f968670554735%3A0x121b333a0fd836de!2sMcDonald&#39;s!5e0!3m2!1sen!2sin!4v1675249399566!5m2!1sen!2sin" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe> --}}
                            {{-- </div> --}}
                            <div class="col-12 px-0">
                                <div class="map-location form-group">
                                    {!! $user->usersProfile->location ?? '' !!}
                                </div>

                                {{-- {!! Form::label('map', trans('label.search_location')) !!} --}}
                                <div class="form-group mb-3">
                                    <div class="input-group mb-3">
                                        <input type="text" name="location"
                                            class="form-control @error('location') is-invalid @enderror"
                                            placeholder="{{ trans('label.add_location') }}"
                                            value="{{ old('location', $user->usersProfile->location ?? null) }}">
                                        <div class="input-group-append" data-toggle="tooltip" data-placement="top"
                                            title="{!! __('label.location_url_hint') !!}">
                                            <span class="input-group-text" id="basic-addon1">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                                    viewBox="0 0 24 24" fill="none">
                                                    <path
                                                        d="M9.09 9C9.3251 8.33167 9.78915 7.76811 10.4 7.40913C11.0108 7.05016 11.7289 6.91894 12.4272 7.03871C13.1255 7.15849 13.7588 7.52152 14.2151 8.06353C14.6713 8.60553 14.9211 9.29152 14.92 10C14.92 12 11.92 13 11.92 13M12 17H12.01M22 12C22 17.5228 17.5228 22 12 22C6.47715 22 2 17.5228 2 12C2 6.47715 6.47715 2 12 2C17.5228 2 22 6.47715 22 12Z"
                                                        stroke="black" stroke-width="1.5" stroke-linecap="round"
                                                        stroke-linejoin="round" />
                                                </svg>
                                            </span>
                                        </div>
                                    </div>
                                    <span><small style="font-size: 14px;">{!! __('label.location_url_hint') !!}</small></span>
                                    @error('location')
                                        <span class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 profile_box location_box">
                            <h3 class="mb-3 col-12 pl-0">{{ trans('label.video_link') }}</h3>
                            <div class="col-12 px-0">
                                <div class="map-location form-group">
                                    {!! $user->usersProfile->video_link ?? null !!}
                                </div>

                                <div class="input-group mb-3">
                                    <input type="text" name="video_link"
                                        value="{{ old('video_link', $user->usersProfile->video_link ?? null) }}"
                                        class="form-control @error('video_link') is-invalid @enderror"
                                        placeholder="{{ trans('label.video_link') }}">
                                    <div class="input-group-append" data-toggle="tooltip" data-placement="top"
                                        title="{!! __('label.video_url_hint') !!}">
                                        <span class="input-group-text" id="basic-addon1">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                                viewBox="0 0 24 24" fill="none">
                                                <path
                                                    d="M9.09 9C9.3251 8.33167 9.78915 7.76811 10.4 7.40913C11.0108 7.05016 11.7289 6.91894 12.4272 7.03871C13.1255 7.15849 13.7588 7.52152 14.2151 8.06353C14.6713 8.60553 14.9211 9.29152 14.92 10C14.92 12 11.92 13 11.92 13M12 17H12.01M22 12C22 17.5228 17.5228 22 12 22C6.47715 22 2 17.5228 2 12C2 6.47715 6.47715 2 12 2C17.5228 2 22 6.47715 22 12Z"
                                                    stroke="black" stroke-width="1.5" stroke-linecap="round"
                                                    stroke-linejoin="round" />
                                            </svg>
                                        </span>
                                    </div>
                                </div>
                                <span><small style="font-size: 14px;">{!! __('label.video_url_hint') !!}</small></span>
                                @error('video_link')
                                    <span class="error invalid-feedback">{{ $message }}</span>
                                @enderror

                            </div>
                        </div>
                    </div>
                </div>
            </div>


                <div class="col-12 mb-4 profile_box gallery_box edit_profile_img_gallery_box py-40 pl-0">
                    <h3 class="mb-3">{{ trans('label.gallery') }}</h3>
                    @include('vendor.image_upload.upload', [
                        'id' => 'employer_image',
                        'class' => 'mx-0',
                        'name' => 'employer_images',
                        'height' => '250px',
                        'width' => '250px',
                        'document_type' => config('constants.document_type.cropped_images', 2),
                        'multiple' => true,
                        'limit' => 5,
                    ])
                </div>



                <div class="col-12 my-50 d-flex align-items-center justify-content-end">
                    <a href="{{ route('users.profile') }}" class="btn btn-default">{{ trans('label.cancel') }}</a>
                    <button type="submit" class="btn btn-primary ml-3">{{ trans('label.save') }}</button>
                </div>

        </form>
    </div>
    @include('imagecropper.croppermodal')
@endsection
@section('third_party_scripts')
    @include('vendor.image_upload.script')
    @include('vendor.richtexteditor.script')
@endsection

@push('page_scripts')
    <script>
        $(document).ready(function() {
            $('[name="location"]').on('change', function(e) {
                $('#location_frame').attr('src', this.value);
            })
        })
    </script>
@endpush
