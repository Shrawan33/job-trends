{!! Form::hidden('step', $step) !!}
<fieldset id="step1" class="job_steps_common">
    {{--
    <fieldset id="step1" class="job_steps_common"> --}}

    <h2>Basic Information</h2>
    <p class="mb-40">{{ trans('message.resume_builder_text') }}</p>
    <!-- Add this line to hide the user_id field -->
    <input type="hidden" name="user_id" value="{{ Auth::id() }}">
    <div class="form-group col-md-2 mb-4 p-0">
        <label for="">{{ trans('label.upload_photo') }}</label>
        @include('vendor.image_upload.upload', [
            'id' => 'jobseeker_logo',
            'name' => 'jobseeker_logo',
            'height' => '80px',
            'width' => '80px',
            'document_type' => config('constants.document_type.image', 0),
            'multiple' => true,
            'limit' => 1,
        ])

    </div>
    <div class="row mkj-form-text">
        <div class="col-lg-4 col-md-6">
            <!-- First Name Field -->
            <div class="form-group mb-4">
                {!! html_entity_decode(
                    Form::label(
                        'first_name',
                        trans('label.first_name') .
                            '<span style="color: red">*</span>',
                        ['class' => 'required-label',],
                    ),
                ) !!}
                {!! Form::text('first_name', null, [
                    'class' => 'form-control ' . ($errors->has('first_name') ? 'is-invalid' : ''),
                    'placeholder' => trans('label.first_name'),
                ]) !!}
                @if ($errors->has('first_name'))

                    <span class="text-danger">{{ $errors->first('first_name') }}</span>
                @endif

            </div>
        </div>
        <div class="col-lg-4 col-md-6">
            <!-- Middle Name Field -->
            <div class="form-group mb-4">
                {!! html_entity_decode(
                    Form::label(
                        'middle_name',
                        trans('label.middle_name') .
                            '<span style="color: red"></span>',
                        ['class' => 'required-label',],
                    ),
                ) !!}
                {!! Form::text('middle_name', null, [
                    'class' => 'form-control ' . ($errors->has('middle_name') ? 'is-invalid' : ''),
                    'placeholder' => trans('label.middle_name'),
                ]) !!}
                @if ($errors->has('middle_name'))
                    <span class="text-danger">{{ $errors->first('middle_name') }}</span>
                @endif

            </div>
        </div>
        <div class="col-lg-4 col-md-6">
            <!-- Last Name Field -->
            <div class="form-group mb-4">
                {!! html_entity_decode(
                    Form::label(
                        'last_name',
                        trans('label.last_name') .
                            '<span style="color: red">*</span>',
                        ['class' => 'required-label',],
                    ),
                ) !!}
                {!! Form::text('last_name', null, [
                    'class' => 'form-control ' . ($errors->has('last_name') ? 'is-invalid' : ''),
                    'placeholder' => trans('label.last_name'),
                ]) !!}
                @if ($errors->has('last_name'))

                    <span class="text-danger">{{ $errors->first('last_name') }}</span>
                @endif

            </div>
        </div>
        <div class="col-md-6">
            <!-- Email Field -->
            <div class="form-group mb-4">
                {!! html_entity_decode(
                    Form::label(
                        'email',
                        trans('label.email') .
                            '<span style="color: red">*</span>',
                        ['class' => 'required-label'],
                    ),
                ) !!}
                {!! Form::text('email', null, [
                    'class' => 'form-control ' . ($errors->has('email') ? 'is-invalid' : ''),
                    'placeholder' => trans('label.email'),
                ]) !!}
                @if ($errors->has('email'))
                    <span class="text-danger">{{ $errors->first('email') }}</span>
                @endif

            </div>
        </div>
        <div class="col-md-6">
            <!-- Phone Field -->
            <div class="form-group mb-4">
                {!! html_entity_decode(
                    Form::label(
                        'phone',
                        trans('label.phone') .
                            '<span style="color: red">*</span>',
                        ['class' => 'required-label'],
                    ),
                ) !!}
                {!! Form::text('phone', null, [
                    'class' => 'form-control ' . ($errors->has('phone') ? 'is-invalid' : ''),
                    'placeholder' => trans('label.phone'),
                ]) !!}
                @if ($errors->has('phone'))
                    <span class="text-danger">{{ $errors->first('phone') }}</span>
                @endif

            </div>
        </div>
         {{-- <div class="col-md-6 mb-4">
            <label for="">Country</label>
            <span class="text-danger">*</span>
            @include('components.country', [
                'countries' => $countries ?? [],
                'selected' => $seekerDetails->country_id ?? '356',
            ])
            @error('country_id')
                <span class="error invalid-feedback">{{ $message }}</span>
            @enderror

        </div> --}}

        <div class="col-md-6 mb-4">
            <label for="">{{ trans('label.state') }}</label>
            <span class="text-danger">*</span>
            @include('components.state', [
                'states' => $states ?? [],
                'selected' => $seekerDetails->state_id ?? '',
            ])
            @error('state_id')
                <span class="error invalid-feedback">{{ $message }}</span>
            @enderror

        </div>
        <div class="col-md-6 mb-4">
            <label for="">{{ trans('label.city') }}</label>
            <span class="text-danger">*</span>
            @include('components.location', [
                'locations' => $locations ?? [],
                'selected' => $seekerDetails->location_id ?? '',
                'required' => $required ?? false,
            ])
            @error('location_id')
                <span class="error invalid-feedback">{{ $message }}</span>
            @enderror

        </div>
        <div class="col-md-6 mb-4">
            <label for="">{{ trans('label.linkedin_url') }}</label>
            {!! Form::text('linkedin_url', old('linkedin_url', $seekerDetails->linkedin_url ?? null), [
                'class' => 'form-control' . ($errors->has('linkedin_url') ? ' is-invalid' : ''),
                'placeholder' => trans('label.linkedin_url'),
            ]) !!}
            @error('linkedin_url')
                <span class="error invalid-feedback">{{ $message }}</span>
            @enderror

        </div>
        <div class="col-md-6 mb-4">
            <label for="">{{ trans('label.blog_url') }}</label>
            {!! Form::text('blog_url', old('blog_url', $seekerDetails->blog_url ?? null), [
                'class' => 'form-control' . ($errors->has('blog_url') ? ' is-invalid' : ''),
                'placeholder' => trans('label.blog_url'),
            ]) !!}
            @error('blog_url')
                <span class="error invalid-feedback">{{ $message }}</span>
            @enderror

        </div>
        <div class="col-md-6 mb-4">
            <label for="">{{ trans('label.social_links') }}</label>
            {!! Form::text('social_links', old('social_links', $seekerDetails->social_links ?? null), [
                'class' => 'form-control' . ($errors->has('social_links') ? ' is-invalid' : ''),
                'placeholder' => trans('label.social_links'),
            ]) !!}
            @error('social_links')
                <span class="error invalid-feedback">{{ $message }}</span>
            @enderror

        </div>

        <div class="col-md-12">
            <label for="">{{ trans('label.who_are_you') }}</label>
            <span class="text-danger">*</span>
            {!! Form::textarea('who_are_you', $seekerDetails->who_are_you ?? null, [
                'class' => 'form-control ' . (isset($errors) && $errors->has('who_are_you') ? 'is-invalid' : ''),
                'placeholder' => trans('message.who_are_you_message'),
                'rows' => 3,
            ]) !!}
            @error('who_are_you')
                <span class="error invalid-feedback">{{ $message }}</span>
            @enderror

        </div>
    </div>
    <div class="d-flex justify-content-end mt-50 pt-50 border-top">
        {{-- @dd($entity['url']) --}}
        {{--
                <input type="button" id="stepone" name="next" class="next btn btn-primary" value="Next" /> --}}
        {{--
                <button type="button" id="stepOneNext" class="next btn btn-primary">Next</button> --}}

        <form method="POST" action="{{ route('resume-builder.store') }}">
            @csrf
            <!-- Add CSRF token for security -->
            <!-- Your other form fields here -->
            <a href="{{ route('resume-builder.index') }}" class="btn btn-default mr-30">{!! __('label.cancel') !!}</a>
            <button type="submit" id="stepOneNext" class="next btn btn-primary">Next <svg style="margin-right: 0; margin-left: 5px;" xmlns="http://www.w3.org/2000/svg" width="23" height="22" viewBox="0 0 23 22" fill="none">
                <path d="M8.75 16.5L14.25 11L8.75 5.5" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
              </svg></button>
        </form>
    </div>
    <div class="d-flex justify-content-between">
        <!-- Navigation buttons -->
    </div>
</fieldset>
