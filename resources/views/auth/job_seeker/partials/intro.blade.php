@section('third_party_stylesheets')
    @include('vendor.richtexteditor.style')

    @include('vendor.image_upload.style')
    @include('vendor.dropzone.style')
@endsection

<div class="row mx-0 dotted_border_bottom w-100">
    <div class="col-sm-12 text-left profile_box">
        <h3>{{ trans('label.personal_info') }}</h3>
    </div>
    {!! Form::hidden('user_id', $user->id ?? null, ['class' => 'form-control']) !!}
    {!! Form::hidden('primary_account', 1, ['class' => 'form-control']) !!}
    {!! Form::hidden('form_title', $main_title ?? null, ['class' => 'form-control']) !!}
    {!! Form::hidden('total_experience', $seekerDetail->total_experience ?? null, ['class' => 'form-control']) !!}

    <div class="form-group col-md-2 mb-4">
        <label for="">{{ trans('label.profile_picture') }}</label>
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

    <div class="form-group col-md-9 col-lg-6 mb-4 social_profile_banner_image">
        <label for="">{{ trans('label.profile_banner') }}</label>
        @include('vendor.image_upload.upload', [
            'id' => 'jobseeker_banner',
            'name' => 'jobseeker_banner',
            'height' => '80px',
            'width' => '80px',
            'document_type' => config('constants.document_type.cropped_images', 2),
            'multiple' => true,
            'limit' => 1,
        ])
    </div>
</div>

<div class="row mx-0 border-bottom py-4">
    <div class="form-group mb-4 col-md-6 col-lg-4">

        <label for="">{{ trans('label.first_name') }}<span class="text-danger">*</span></label>
        <input type="text" name="first_name" class="form-control @error('first_name') is-invalid @enderror"
            value="{{ old('first_name', $user->first_name ?? null) }}" placeholder="{{ trans('label.first_name') }}">

        @error('first_name')
            <span class="error invalid-feedback">{{ $message }}</span>
        @enderror
    </div>
    {{-- <div class="form-group mb-4 col-md-6 col-lg-4">
        <label for="">{{ trans('label.parent_name') }}</label>
        {!! Form::text('parent_name', old('parent_name', $user->parent_name ?? null), [
            'class' => 'form-control',
            'placeholder' => trans('label.parent_name'),
        ]) !!}
        @error('parent_name')
            <span class="error invalid-feedback">{{ $message }}</span>
        @enderror
    </div> --}}
    <div class="form-group mb-4 col-md-6 col-lg-4">
        <label for="">{{ trans('label.last_name') }}<span class="text-danger">*</span></label>
        <input type="text" name="last_name" class="form-control @error('last_name') is-invalid @enderror"
            value="{{ old('last_name', $user->last_name ?? null) }}" placeholder="{{ trans('label.last_name') }}">
        @error('last_name')
            <span class="error invalid-feedback">{{ $message }}</span>
        @enderror
    </div>

    <div class="form-group mb-4 col-md-6 col-lg-4">
        <label for="">{{ trans('label.company_email') }}</label>
        <input type="text" class="form-control" value="{{ optional($user)->email ? strtolower($user->email) : '' }}"
            readonly>
    </div>
    <div class="form-group mb-4 col-md-6 col-lg-4">
        <label for="">{{ trans('label.mobile') }}</label>
        {!! Form::text('mobile_number', $seekerDetail->mobile_number ?? null, ['class' => 'form-control']) !!}
    </div>
    <div class="form-group mb-4 col-md-6 col-lg-4">
        <label for="">{{ trans('label.phone_number') }}</label>
        {!! Form::text('phone_number', $user->phone_number ?? null, ['class' => 'form-control']) !!}
    </div>

    <div class="form-group mb-4 col-md-6 col-lg-4">
        <label for="">{{ trans('label.age') }}</label>
        {!! Form::text('age', $seekerDetail->age ?? null, ['class' => 'form-control']) !!}
    </div>
    <div class="form-group mb-4 col-md-6 col-lg-4">
        <label for="">{{ trans('label.gender') }}<span class="text-danger">*</span></label>
        {!! Form::select('gender', $gender, $seekerDetail->gender ?? null, [
            'class' => 'form-control ' . (isset($errors) && $errors->has('gender') ? 'is-invalid' : ''),
            'data-placeholder' => trans('label.gender'),
        ]) !!}
        @error('gender')
            <span class="error invalid-feedback">{{ $message }}</span>
        @enderror
    </div>
    <div class="form-group col-md-6 col-lg-4 mb-4 dob_select">
        <label for="" class="text-transform-none">{{ trans('label.dob') }}</label>
        <div class="input-group">
            {!! Form::text('dob', $seekerDetail->dob ?? null, [
                'class' => 'form-control datepicker' . (isset($errors) && $errors->has('dob') ? 'is-invalid' : ''),
                'id' => 'dob',
                'placeholder' => trans('label.dob'),
            ]) !!}
            <svg class="calander_icon" xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                viewBox="0 0 20 20" fill="none">
                <path
                    d="M16.6663 8.5H3.33301M12.9626 2.5V5.5M7.03671 2.5V5.5M6.88856 17.5H13.1108C14.3553 17.5 14.9776 17.5 15.453 17.2548C15.8711 17.039 16.2111 16.6948 16.4241 16.2715C16.6663 15.7902 16.6663 15.1601 16.6663 13.9V7.6C16.6663 6.33988 16.6663 5.70982 16.4241 5.22852C16.2111 4.80516 15.8711 4.46095 15.453 4.24524C14.9776 4 14.3553 4 13.1108 4H6.88856C5.644 4 5.02172 4 4.54636 4.24524C4.12822 4.46095 3.78827 4.80516 3.57522 5.22852C3.33301 5.70982 3.33301 6.33988 3.33301 7.6V13.9C3.33301 15.1601 3.33301 15.7902 3.57522 16.2715C3.78827 16.6948 4.12822 17.039 4.54636 17.2548C5.02172 17.5 5.644 17.5 6.88856 17.5Z"
                    stroke="#717884" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
            </svg>
            <span class="input-group-addon">
                <span class="glyphicon glyphicon-calendar"></span>
            </span>
        </div>
        @error('dob')
            <span class="error invalid-feedback">{{ $message }}</span>
        @enderror
    </div>
    {{-- <div class="form-group col-md-6 col-lg-4 mb-4">
        <label for="">{{ trans('label.language_known') }}</label>
        {!! Form::textarea('language_known', $seekerDetail->language_known ?? null, [
            'class' => 'form-control ' . (isset($errors) && $errors->has('language_known') ? 'is-invalid' : ''),
            'placeholder' => trans('label.language_known'),
            'rows' => 2,
        ]) !!}
        @error('language_known')
            <span class="error invalid-feedback">{{ $message }}</span>
        @enderror
    </div> --}}

    <div class="form-group mb-4 col-md-6 col-lg-4">
        <label for="">{{ trans('label.place_of_birth') }}</label>
        {!! Form::text('place_of_birth', old('place_of_birth', $seekerDetail->place_of_birth ?? null), [
            'class' => 'form-control',
            'placeholder' => trans('label.place_of_birth'),
        ]) !!}
        @error('place_of_birth')
            <span class="error invalid-feedback">{{ $message }}</span>
        @enderror
    </div>

    <div class="form-group mb-4 col-md-6 col-lg-4">
        <label for="">{{ trans('Marital Status') }}</label>
        {!! Form::select('marital_status', $marital_status, $seekerDetail->marital_status ?? null, [
            'class' => 'form-control ' . (isset($errors) && $errors->has('marital_status') ? 'is-invalid' : ''),
            'data-placeholder' => trans('label.marital_status'),
        ]) !!}
        @error('marital_status')
            <span class="error invalid-feedback">{{ $message }}</span>
        @enderror
    </div>

    <div class="form-group mb-4 col-md-6 col-lg-4">
        <label for="">{{ trans('Religion') }}</label>
        {!! Form::select('Religion', $religion, $seekerDetail->Religion ?? null, [
            'class' => 'form-control ' . (isset($errors) && $errors->has('Religion') ? 'is-invalid' : ''),
            'data-placeholder' => trans('label.Religion'),
        ]) !!}
        @error('Religion')
            <span class="error invalid-feedback">{{ $message }}</span>
        @enderror
    </div>
    <div class="form-group mb-4 col-md-6 col-lg-4">
        <label for="">{{ trans('label.currently_staying_in') }}</label>
        {!! Form::text(
            'currently_staying_in',
            old('currently_staying_in', $seekerDetail->currently_staying_in ?? null),
            [
                'class' => 'form-control',
                'placeholder' => trans('label.currently_staying_in'),
            ],
        ) !!}
        @error('currently_staying_in')
            <span class="error invalid-feedback">{{ $message }}</span>
        @enderror
    </div>
    <div class="form-group col-md-6 col-lg-4 mb-4">
        <label for="">Visa Status</label>
        <div class="">
            @foreach (config('constants.visa_status.data') as $key => $value)
                {!! Form::radio(
                    'visa_status',
                    $key,
                    $key == ($seekerDetail->visa_status ?? config('constants.visa_status.default', 1)),
                    [
                        'id' => "visa_status_$key",
                        'label' => trans("label.visa_status.$key"),
                        'wrapper-class' => 'form-check form-check-inline',
                    ],
                ) !!}
            @endforeach
            @error('visa_status')
                <span class="error invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

    </div>
    <div class="form-group col-md-6 col-lg-4 mb-4">
        <!-- Title Field -->
        {!! Form::label('Relocation', trans('label.Relocation')) !!}

        <div class="form-group mb-4 d-flex pl-1 align-items-center">
            {!! Form::checkbox('Relocation', 1, $seekerDetail->Relocation ?? 0, [
                'class' => ' ' . ($errors->has('Relocation') ? 'is-invalid' : ''),
            ]) !!}
            {!! Form::label('Relocation', trans('label.Relocation')) !!}
            @error('Relocation')
                <span class="error invalid-feedback">{{ $message }}</span>
            @enderror

        </div>
    </div>
    <div class="form-group col-md-6 col-lg-4 mb-4">
        <label for="">{{ trans('label.profile_visibility') }}</label>
        <div class="">
            @foreach (config('constants.public_choices.data') as $key => $value)
                {!! Form::radio(
                    'is_public_profile',
                    $key,
                    $key == ($seekerDetail->is_public_profile ?? config('constants.public_choices.default', 1)),
                    [
                        'id' => "is_public_profile_$key",
                        'label' => trans("label.public_choices.$key"),
                        'wrapper-class' => 'form-check form-check-inline',
                    ],
                ) !!}
            @endforeach
            @error('is_public_profile')
                <span class="error invalid-feedback">{{ $message }}</span>
            @enderror
        </div>
    </div>

    <div class="row mx-0 border-bottom py-30 w-100">
        <div class="col-sm-12 text-left profile_box">
            <h3>Job Application</h3>
        </div>
        <div class="form-group col-md-6">
            <label for="">{{ trans('label.professional_manner') }}<span class="text-danger">*</span></label>
            {!! Form::textarea('professional_manner', $seekerDetail->professional_manner ?? null, [
                'id' => 'professional_manner',
                'class' => 'form-control ' . ($errors->has('professional_manner') ? 'is-invalid' : ''),
                'placeholder' => trans('message.professional_manner'),
                'rows' => 3
            ]) !!}
            @error('professional_manner')
                <span class="error invalid-feedback">{{ $message }}</span>
            @enderror
        </div>
        {{-- <div class="form-group mb-4 col-md-6 col-lg-3">
            <label for="">{{ trans('label.Job_preference') }}</label>
            <input type="text" name="Job_preference"
                class="form-control @error('Job_preference') is-invalid @enderror"
                value="{{ old('Job_preference', $seekerDetail->Job_preference ?? null) }}"
                placeholder="{{ trans('label.Job_preference') }}">
            @error('Job_preference')
                <span class="error invalid-feedback">{{ $message }}</span>
            @enderror
        </div> --}}

        <div class="form-group col-md-6">
            <label for="">
                {{ trans('label.my_core_competencies') }}
            </label>
            {!! Form::textarea('my_core_competencies', $seekerDetail->my_core_competencies ?? null, [
                'class' => 'form-control ' . (isset($errors) && $errors->has('my_core_competencies') ? 'is-invalid' : ''),
                'placeholder' => trans('message.my_core_competencies'),
                'rows' => 3,
            ]) !!}
            @error('my_core_competencies')
                <span class="error invalid-feedback">{{ $message }}</span>
            @enderror
        </div>


        <div class="form-group mb-4 col-md-6 col-lg-3">
            <label for="">{{ trans('label.current_position') }}</label>
            {!! Form::text('current_position', old('current_position', $seekerDetail->current_position ?? null), [
                'class' => 'form-control',
                'placeholder' => trans('label.current_position'),
            ]) !!}
            @error('current_position')
                <span class="error invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group mb-4 col-md-6 col-lg-3">
            <label for="">{{ trans('label.current_company') }}</label>
            {!! Form::text('current_company', old('current_company', $seekerDetail->current_company ?? null), [
                'class' => 'form-control',
                'placeholder' => trans('label.current_company'),
            ]) !!}
            @error('current_company')
                <span class="error invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group mb-4 col-md-6 col-lg-3">
            {{-- <label for="">category</label> --}}
            {!! Form::label('category', trans('label.category')) !!}
            @include('components.categories', [
                'category' => $category,
                'selected' => $seekerDetail->category_id ?? null,
            ])
            @error('category_id')
                <span class="error invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group mb-4 col-md-6 col-lg-3">
            <label for="">{{ trans('label.preferred_position') }}</label>
            {!! Form::text('preferred_position', old('preferred_position', $seekerDetail->preferred_position ?? null), [
                'class' => 'form-control',
                'placeholder' => trans('label.preferred_position'),
            ]) !!}
            @error('preferred_position')
                <span class="error invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group mb-4 col-md-6 col-lg-3">
            <label for="">{{ trans('label.current_salary') }}</label>
            <input type="text" name="current_salary" pattern="[0-9]+(\.[0-9]+)?"
                class="form-control @error('current_salary') is-invalid @enderror"
                value="{{ old('current_salary', $seekerDetail->current_salary ?? null) }}"
                placeholder="{{ trans('label.current_salary') }}">
            @error('current_salary')
                <span class="error invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group mb-4 col-md-6 col-lg-3">
            <label for="">{{ trans('label.expected_salary') }}</label>
            <input type="text" name="expected_salary" pattern="[0-9]+(\.[0-9]+)?"
                class="form-control @error('expected_salary') is-invalid @enderror"
                value="{{ old('expected_salary', $seekerDetail->expected_salary ?? null) }}"
                placeholder="{{ trans('label.expected_salary') }}">
            @error('expected_salary')
                <span class="error invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group mb-4 col-md-6 col-lg-3">
            <label for="">{{ trans('Currency') }}</label>
            {!! Form::select('currency', $currency, $seekerDetail->currency ?? null, [
                'class' => 'form-control ' . (isset($errors) && $errors->has('currency') ? 'is-invalid' : ''),
                'data-placeholder' => trans('Currency'),
            ]) !!}
            @error('currency')
                <span class="error invalid-feedback">{{ $message }}</span>
            @enderror
        </div>
        <div class="form-group mb-4 col-md-6 col-lg-3">
            <label for="">{{ trans('label.city_preference') }}</label>
            @include('components.city_preference', [
                'city_preference' => $city_preference,
                'selected' => is_array($seekerDetail->city_preference)
                    ? $seekerDetail->city_preference
                    : json_decode($seekerDetail->city_preference, true),
                'multiple' => true,
            ])

            @error('city_preference')
                <span class="error invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

    </div>

    <div class="row mx-0 border-bottom py-30 w-100">
        <div class="col-sm-12 text-left profile_box">
            <h3>Contact Information</h3>
        </div>
        <div class="form-group mb-4 col-md-6 col-lg-4">
            <label for="">Country</label><span class="text-danger">*</span>
            @include('components.country', [
                'countries' => $countries,
                'selected' => $seekerDetail->country_id,
            ])
            @error('country_id')
                <span class="error invalid-feedback">{{ $message }}</span>
            @enderror
        </div>
        <div class="form-group mb-4 col-md-6 col-lg-4">
            <label for="">{{ trans('label.state') }}</label><span class="text-danger">*</span>
            @include('components.state', ['states' => $states, 'selected' => $seekerDetail->state_id])
            @error('state_id')
                <span class="error invalid-feedback">{{ $message }}</span>
            @enderror
        </div>
        <div class="form-group mb-4 col-md-6 col-lg-4">
            <label for="">{{ trans('label.city') }}</label><span class="text-danger">*</span>
            @include('components.location', [
                'locations' => $locations,
                'selected' => $seekerDetail->location_id,
                'required' => $required ?? false,
            ])
            @error('location_id')
                <span class="error invalid-feedback">{{ $message }}</span>
            @enderror
        </div>
        <div class="form-group col-md-6 col-lg-4 mb-4 mb-lg-0">
            <label for="">{{ trans('label.permanent_address') }}</label>
            {!! Form::textarea('permanent_address', $seekerDetail->permanent_address ?? null, [
                'class' => 'form-control ' . (isset($errors) && $errors->has('permanent_address') ? 'is-invalid' : ''),
                'placeholder' => trans('label.permanent_address'),
                'rows' => 3,
            ]) !!}
            @error('permanent_address')
                <span class="error invalid-feedback">{{ $message }}</span>
            @enderror
        </div>
        <div class="form-group col-md-6 col-lg-4 mb-4 mb-lg-0">
            <label for="">Nationality</label>
            <div class="mt-3">
                @foreach (config('constants.nationality_choices.data') as $key => $value)
                    {!! Form::radio(
                        'nationality',
                        $key,
                        $key == ($seekerDetail->nationality ?? config('constants.nationality_choices.default', 1)),
                        [
                            'id' => "nationality_$key",
                            'label' => trans("label.nationality_choices.$key"),
                            'wrapper-class' => 'form-check form-check-inline',
                        ],
                    ) !!}
                @endforeach
                @error('nationality')
                    <span class="error invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
        </div>
    </div>

    <div class="row mx-0 border-bottom py-4 w-100 border-top">
        <div class="col-sm-12 text-left profile_box">
            <h3>Social Links</h3>
        </div>
        {{-- <div class="form-group mb-4 col-md-6 col-lg-3">
            <label for="">{{ trans('label.facebook_url') }}</label>
            <input type="text" name="facebook_url" class="form-control @error('facebook_url') is-invalid @enderror"
                value="{{ old('facebook_url', $candidate->seekerDetail->facebook_url ?? null) }}"
                placeholder="{{ trans('label.facebook_url') }}">
            @error('facebook_url')
                <span class="error invalid-feedback">{{ $message }}</span>
            @enderror
        </div> --}}
        <div class="form-group mb-4 col-md-6 col-lg-3">
            <label for="">{{ trans('label.facebook_url') }}</label>
            {!! Form::text('facebook_url', old('facebook_url', $seekerDetail->facebook_url ?? null), [
                'class' => 'form-control' . ($errors->has('facebook_url') ? ' is-invalid' : ''),
                'placeholder' => trans('label.facebook_url'),
            ]) !!}
            @error('facebook_url')
                <span class="error invalid-feedback">{{ $message }}</span>
            @enderror
        </div>
        {{-- <div class="form-group mb-4 col-md-6 col-lg-3">
            <label for="">{{ trans('label.instagram_url') }}</label>
            <input type="text" name="instagram_url" class="form-control @error('instagram_url') is-invalid @enderror"
                value="{{ old('instagram_url', $candidate->seekerDetail->instagram_url ?? null) }}"
                placeholder="{{ trans('label.instagram_url') }}">
            @error('instagram_url')
                <span class="error invalid-feedback">{{ $message }}</span>
            @enderror
        </div> --}}
        {{-- @dd($seekerDetail) --}}
        <div class="form-group mb-4 col-md-6 col-lg-3">
            <label for="">{{ trans('label.instagram_url') }}</label>
            {!! Form::text('instagram_url', old('instagram_url', $seekerDetail->instagram_url ?? null), [
                'class' => 'form-control' . ($errors->has('instagram_url') ? ' is-invalid' : ''),
                'placeholder' => trans('label.instagram_url'),
            ]) !!}
            @error('instagram_url')
                <span class="error invalid-feedback">{{ $message }}</span>
            @enderror
        </div>
        {{-- <div class="form-group mb-4 col-md-6 col-lg-3">
            <label for="">{{ trans('label.blog_url') }}</label>
            <input type="text" name="blog_url" class="form-control @error('blog_url') is-invalid @enderror"
                value="{{ old('blog_url', $candidate->seekerDetail->blog_url ?? null) }}"
                placeholder="{{ trans('label.blog_url') }}">
            @error('blog_url')
                <span class="error invalid-feedback">{{ $message }}</span>
            @enderror
        </div> --}}
        <div class="form-group mb-4 col-md-6 col-lg-3">
            <label for="">{{ trans('label.blog_url') }}</label>
            {!! Form::text('blog_url', old('blog_url', $seekerDetail->blog_url ?? null), [
                'class' => 'form-control' . ($errors->has('blog_url') ? ' is-invalid' : ''),
                'placeholder' => trans('label.blog_url'),
            ]) !!}
            @error('blog_url')
                <span class="error invalid-feedback">{{ $message }}</span>
            @enderror
        </div>
        {{-- <div class="form-group mb-4 col-md-6 col-lg-3">
            <label for="">{{ trans('label.linkedin_url') }}</label>
            <input type="text" name="linkedin_url"
                class="form-control @error('linkedin_url') is-invalid @enderror"
                value="{{ old('linkedin_url', $candidate->seekerDetail->linkedin_url ?? null) }}"
                placeholder="{{ trans('label.linkedin_url') }}">
            @error('linkedin_url')
                <span class="error invalid-feedback">{{ $message }}</span>
            @enderror
        </div> --}}
        <div class="form-group mb-4 col-md-6 col-lg-3">
            <label for="">{{ trans('label.linkedin_url') }}</label>
            {!! Form::text('linkedin_url', old('linkedin_url', $seekerDetail->linkedin_url ?? null), [
                'class' => 'form-control' . ($errors->has('linkedin_url') ? ' is-invalid' : ''),
                'placeholder' => trans('label.linkedin_url'),
            ]) !!}
            @error('linkedin_url')
                <span class="error invalid-feedback">{{ $message }}</span>
            @enderror
        </div>
    </div>



    <!-- Professional Information -->
    <div class="row mx-0 border-bottom py-30 w-100">
        <div class="col-sm-12 text-left profile_box">
            <h3>{{ trans('label.professional_information') }}</h3>
        </div>
        <div class="form-group mb-4 col-md-6 col-lg-3">
            <label for="">{{ trans('label.work_types') }}</label>
            {!! Form::select('work_type_id[]', $workTypes ?? null, $workTypesids, [
                'class' => 'form-control ' . (isset($errors) && $errors->has('work_type_id') ? 'is-invalid' : ''),
                'data-placeholder' => trans('label.candidate.work_type'),
                'multiple' => true,
            ]) !!}
            @error('work_type_id')
                <span class="error invalid-feedback">{{ $message }}</span>
            @enderror

        </div>
        <div class="form-group mb-4 col-md-6 col-lg-3">
            <label for="">{{ trans('label.candidate_profile_title') }}<span
                    class="text-danger">*</span></label>
            <input type="text" name="title" class="form-control @error('title') is-invalid @enderror"
                value="{{ old('title', $seekerDetail->title ?? null) }}"
                placeholder="{{ trans('label.candidate_profile_title') }}">

            @error('title')
                <span class="error invalid-feedback">{{ $message }}</span>
            @enderror
        </div>
        {{-- <div class="form-group col-md-6 col-lg-3 mb-4">
            <!-- Title Field -->
            {!! Form::label('is_fresher', trans('label.is_fresher')) !!}

            <div class="form-group mb-4 d-flex pl-1 align-items-center">
                {!! Form::checkbox('is_fresher', 1, $seekerDetail->is_fresher ?? 0, [
                    'class' => ' ' . ($errors->has('is_fresher') ? 'is-invalid' : ''),
                ]) !!}
                {!! Form::label('is_fresher', trans('label.is_fresher')) !!}
                @error('is_fresher')
                    <span class="error invalid-feedback">{{ $message }}</span>
                @enderror

            </div>
        </div>
        <div class="form-group col-md-6 col-lg-3 mb-4">
            <label for="">{{ trans('label.total_experience') }}</label>
            <div class="form-group mb-4 d-flex pl-1 align-items-center">
                {!! Form::selectRange('total_experience', 0, 99, old('total_experience', $seekerDetail->total_experience ?? 0), [
                    'class' => 'form-control input-group-select',
                    'data-placeholder' => trans('label.total_experience'),
                ]) !!}
            </div>
        </div> --}}

        <div class="form-group col-md-6 col-lg-3 mb-4 total-experience-field">
            <label for="">{{ trans('label.total_experience') }}</label>
            <div class="form-group mb-0 d-flex pl-1 align-items-center">
                {!! Form::selectRange('total_experience', 0, 99, old('total_experience', $seekerDetail->total_experience ?? 0), [
                    'class' => 'form-control input-group-select',
                    'data-placeholder' => trans('label.total_experience'),
                ]) !!}
            </div>
        </div>

        <div class="form-group col-md-6 col-lg-3 mb-4">
            <!-- Title Field -->
            {!! Form::label('is_fresher', trans('label.is_fresher')) !!}

            <div class="form-group mb-4 d-flex pl-1 align-items-center">
                {!! Form::checkbox('is_fresher', 1, $seekerDetail->is_fresher ?? 0, [
                    'class' => 'is-fresher-checkbox ' . ($errors->has('is_fresher') ? 'is-invalid' : ''),
                ]) !!}
                {!! Form::label('is_fresher', trans('label.is_fresher')) !!}
                @error('is_fresher')
                    <span class="error invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
        </div>


        {{-- <div class="form-group col-12 col-lg-6 mb-4">
            <label for="">{{ trans('label.description') }}<span class="text-danger">*</span></label>

            {!! Form::textarea('description', $user->seekerDetail->description ?? null, [
                'id' => 'description',
                'richtexteditor' => true,
                'class' => 'form-control ' . ($errors->has('description') ? 'is-invalid' : ''),
                'placeholder' => trans('label.description'),
                'rows' => 5,
                'required' => 'required',
            ]) !!}
            @error('description')
                <div class="error invalid-feedback">{{ $message }}</div>
            @enderror

        </div> --}}
        <div class="col-lg-6 mb-40 d-none" id="open-ai-wrapper">
            <div class="ai_main_wraper mt-25 position-relative">
                <img src="{{ asset('images/ai_bg.png') }}" class="ai_wraper_img d-none d-lg-block" alt="your_image"
                    width="100%">
                <div class="header_wraper d-flex align-items-center mb-22">
                    <svg xmlns="http://www.w3.org/2000/svg" width="42" height="42" viewBox="0 0 42 42"
                        fill="none">
                        <g clip-path="url(#clip0_1232_1218)">
                            <path
                                d="M21.0177 1.14288e-05C13.7258 -0.0095042 7.7841 5.92423 7.78418 13.2161C7.78426 18.0636 10.3945 22.3009 14.2858 24.6006C14.9768 25.009 15.395 25.7574 15.395 26.5601V29.7792C15.5229 29.7257 15.6633 29.696 15.8105 29.696H26.1898C26.3371 29.696 26.4774 29.7257 26.6053 29.7792V26.56C26.6053 25.7479 27.0391 25.0017 27.7375 24.5871C31.6161 22.2841 34.216 18.0541 34.216 13.2161C34.2161 5.92283 28.3086 0.00952705 21.0177 1.14288e-05Z"
                                fill="#FFE181" />
                            <path
                                d="M18.8879 26.5601C18.8879 25.7575 18.4697 25.009 17.7787 24.6006C13.8874 22.3008 11.2772 18.0636 11.2771 13.2161C11.277 6.52109 16.2861 0.971754 22.75 0.115347C22.183 0.0403708 21.605 0.000831741 21.0178 1.1429e-05C13.7259 -0.0095042 7.7841 5.92414 7.78418 13.2161C7.78426 18.0636 10.3945 22.3009 14.2858 24.6006C14.9768 25.009 15.395 25.7575 15.395 26.5601V29.7792C15.5229 29.7257 15.6633 29.696 15.8105 29.696H18.8879V26.5601Z"
                                fill="#FEC458" />
                            <path
                                d="M22.6553 30.3297C22.3052 30.3297 22.0215 30.046 22.0215 29.696V24.0238C22.0215 23.4538 22.2134 22.8915 22.5618 22.4403L23.4688 21.2661C23.6467 21.0357 23.7447 20.7486 23.7447 20.4574V14.5381C23.7447 14.188 24.0285 13.9043 24.3785 13.9043C24.7285 13.9043 25.0123 14.188 25.0123 14.5381V20.4574C25.0123 21.0275 24.8203 21.5898 24.4719 22.041L23.565 23.2152C23.387 23.4456 23.289 23.7327 23.289 24.0238V29.696C23.289 30.046 23.0053 30.3297 22.6553 30.3297Z"
                                fill="#FFB640" />
                            <path
                                d="M19.3444 30.3297C18.9944 30.3297 18.7106 30.046 18.7106 29.696V24.0238C18.7106 23.7328 18.6126 23.4456 18.4347 23.2152L17.5276 22.041C17.1793 21.5899 16.9873 21.0275 16.9873 20.4574V14.5381C16.9873 14.188 17.2711 13.9043 17.6211 13.9043C17.9711 13.9043 18.2549 14.188 18.2549 14.5381V20.4574C18.2549 20.7486 18.3529 21.0357 18.5308 21.266L19.4378 22.4402C19.7863 22.8914 19.9782 23.4538 19.9782 24.0238V29.6959C19.9782 30.046 19.6944 30.3297 19.3444 30.3297Z"
                                fill="#FFB640" />
                            <path
                                d="M30.2195 10.6285C29.5337 8.07266 27.7716 5.93558 25.3852 4.7654C25.0709 4.61127 24.9411 4.23154 25.0951 3.91737C25.2492 3.6031 25.6291 3.47333 25.9431 3.6273C28.6581 4.95859 30.6631 7.39073 31.4438 10.3C31.5345 10.638 31.3339 10.9857 30.9959 11.0764C30.6581 11.1671 30.3102 10.9668 30.2195 10.6285Z"
                                fill="#FFEAC8" />
                            <path
                                d="M18.4404 38.9766V39.4409C18.4404 40.8485 19.5921 42.0003 20.9998 42.0003C22.4075 42.0003 23.5592 40.8486 23.5592 39.4409V38.9766H18.4404Z"
                                fill="#8479C2" />
                            <path
                                d="M20.7316 39.4409V38.9766H18.4404V39.4409C18.4404 40.8485 19.5921 42.0003 20.9998 42.0003C21.411 42.0003 21.8001 41.9015 22.1454 41.7272C21.309 41.3049 20.7316 40.4373 20.7316 39.4409Z"
                                fill="#6E60B8" />
                            <path
                                d="M25.0115 15.875H16.9873C16.6373 15.875 16.3535 15.5912 16.3535 15.2412C16.3535 14.8912 16.6373 14.6074 16.9873 14.6074H25.0115C25.3615 14.6074 25.6453 14.8912 25.6453 15.2412C25.6453 15.5912 25.3615 15.875 25.0115 15.875Z"
                                fill="#FEC458" />
                            <path
                                d="M4.70959 13.5117H2.52928C2.17925 13.5117 1.89551 13.2279 1.89551 12.8779C1.89551 12.5279 2.17925 12.2441 2.52928 12.2441H4.70959C5.05962 12.2441 5.34336 12.5279 5.34336 12.8779C5.34336 13.2279 5.05962 13.5117 4.70959 13.5117Z"
                                fill="#FEC458" />
                            <path
                                d="M5.33133 9.48934L3.29286 8.7157C2.96564 8.59151 2.801 8.22548 2.92519 7.89826C3.04947 7.57104 3.41533 7.40656 3.74264 7.5306L5.78111 8.30423C6.10833 8.42843 6.27297 8.79445 6.14878 9.12167C6.02466 9.44865 5.65897 9.61345 5.33133 9.48934Z"
                                fill="#FEC458" />
                            <path
                                d="M2.92519 17.8571C2.801 17.5299 2.96564 17.1639 3.29286 17.0397L5.33133 16.266C5.65839 16.1418 6.02458 16.3064 6.14878 16.6337C6.27297 16.9609 6.10833 17.3269 5.78111 17.4511L3.74264 18.2248C3.41533 18.349 3.04947 18.1844 2.92519 17.8571Z"
                                fill="#FEC458" />
                            <path
                                d="M39.4703 13.5117H37.29C36.94 13.5117 36.6562 13.2279 36.6562 12.8779C36.6562 12.5279 36.94 12.2441 37.29 12.2441H39.4703C39.8204 12.2441 40.1041 12.5279 40.1041 12.8779C40.1041 13.2279 39.8204 13.5117 39.4703 13.5117Z"
                                fill="#FEC458" />
                            <path
                                d="M35.85 9.12172C35.7258 8.79449 35.8904 8.42847 36.2177 8.30428L38.2561 7.53064C38.5832 7.40653 38.9494 7.571 39.0736 7.8983C39.1978 8.22553 39.0331 8.59155 38.7059 8.71574L36.6675 9.48946C36.3401 9.61358 35.9743 9.44902 35.85 9.12172Z"
                                fill="#FEC458" />
                            <path
                                d="M38.2561 18.2248L36.2177 17.4511C35.8904 17.3269 35.7258 16.9609 35.85 16.6337C35.9743 16.3065 36.3401 16.1418 36.6674 16.266L38.7059 17.0397C39.0331 17.1638 39.1978 17.5299 39.0736 17.8571C38.9494 18.1841 38.5837 18.3489 38.2561 18.2248Z"
                                fill="#FEC458" />
                            <path
                                d="M25.3445 35.8613H16.6545C16.048 35.8613 15.5547 36.3547 15.5547 36.961V37.8972C15.5547 38.5036 16.048 38.9969 16.6545 38.9969H25.3446C25.951 38.9969 26.4443 38.5036 26.4443 37.8972V36.961C26.4443 36.3547 25.951 35.8613 25.3445 35.8613Z"
                                fill="#EFECEF" />
                            <path
                                d="M25.3445 37.4294H16.6545C16.1579 37.4294 15.7375 37.0983 15.6014 36.6455C15.5713 36.7457 15.5547 36.8516 15.5547 36.9613V37.8975C15.5547 38.5038 16.048 38.9972 16.6545 38.9972H25.3446C25.951 38.9972 26.4443 38.5038 26.4443 37.8975V36.9613C26.4443 36.8515 26.4277 36.7456 26.3976 36.6455C26.2615 37.0983 25.8412 37.4294 25.3445 37.4294Z"
                                fill="#E2DFE2" />
                            <path
                                d="M26.189 32.7686H15.8097C15.2033 32.7686 14.71 33.2619 14.71 33.8683V34.8044C14.71 35.4109 15.2033 35.9042 15.8097 35.9042H26.189C26.7955 35.9042 27.2888 35.4109 27.2888 34.8044V33.8683C27.2888 33.2619 26.7955 32.7686 26.189 32.7686Z"
                                fill="#EFECEF" />
                            <path
                                d="M26.1891 34.3357H15.8098C15.3131 34.3357 14.8928 34.0047 14.7567 33.5518C14.7266 33.6519 14.71 33.7578 14.71 33.8676V34.8037C14.71 35.4102 15.2033 35.9035 15.8097 35.9035H26.189C26.7955 35.9035 27.2888 35.4102 27.2888 34.8037V33.8676C27.2888 33.7577 27.2721 33.6519 27.242 33.5518C27.106 34.0047 26.6857 34.3357 26.1891 34.3357Z"
                                fill="#E2DFE2" />
                            <path
                                d="M26.189 29.6748H15.8097C15.2033 29.6748 14.71 30.1681 14.71 30.7746V31.7107C14.71 32.3171 15.2033 32.8104 15.8097 32.8104H26.189C26.7955 32.8104 27.2888 32.3171 27.2888 31.7107V30.7746C27.2888 30.1681 26.7955 29.6748 26.189 29.6748Z"
                                fill="#EFECEF" />
                            <path
                                d="M26.1891 31.2429H15.8098C15.3131 31.2429 14.8928 30.9118 14.7567 30.459C14.7266 30.5591 14.71 30.665 14.71 30.7748V31.7109C14.71 32.3173 15.2033 32.8107 15.8097 32.8107H26.189C26.7955 32.8107 27.2888 32.3173 27.2888 31.7109V30.7748C27.2888 30.665 27.2721 30.5591 27.242 30.459C27.106 30.9118 26.6857 31.2429 26.1891 31.2429Z"
                                fill="#E2DFE2" />
                        </g>
                        <defs>
                            <clipPath id="clip0_1232_1218">
                                <rect width="42" height="42" fill="white" />
                            </clipPath>
                        </defs>
                    </svg>
                    <div class="ml-3">
                        <h3 class="name m-0">Hi {{ $user->first_name }}</h3>
                        <p class="mb-0">Here is better alternative option for your description</p>
                    </div>
                </div>
                <div id="open-ai-content" class="open-ai-content">

                </div>
                <div class="footer_wraper d-flex align-items-center">
                    <button type="button" id="copy-description" class="use_this_btn btn w-100 py-lg-30">Use this
                        content</button>
                    <button type="button" id="regenerate-description"
                        class="ai_description btn regenerate_btn w-100 py-lg-30">Regenerate</button>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-3 mb-4 mb-lg-0">
            <div class="form-group">
                <label class="mb-0" for="">{{ trans('label.resume_attchments') }}</label>
                @include('vendor.dropzone.upload', [
                    'form_id' => 'frm_jobseeker',
                    'dropzone_id' => 'resume-document-dropzone',
                    'disk' => $entity['disk'],
                    'name' => 'document',
                    'documents' => old(
                        'document',
                        isset($seekerDetail) && $seekerDetail->documents
                            ? $seekerDetail->documents->toArray()
                            : []),
                    'maxFiles' => 1,
                    'acceptedFileType' => 'documents',
                    'link_text' => 'Upload Resume  (file size 1 MB only)&nbsp;<small class="red">*</small>',
                ])
            </div>
        </div>
        <div class="col-md-6 col-lg-3">
            <div class="form-group">
                <label class="mb-0" for="">{{ trans('label.cover_letter') }}</label>
                @include('vendor.dropzone.cover_letter', [
                    'form_id' => 'frm_jobseeker1',
                    'dropzone_id' => 'cover-letter-dropzone',
                    'disk' => $entity['disk'],
                    'name' => 'cover_letter',
                    'documents' => old(
                        'cover_letter',
                        isset($seekerDetail) && $seekerDetail->coverDocuments
                            ? $seekerDetail->coverDocuments->toArray()
                            : []),
                    'maxFiles' => 1,
                    'acceptedFileType' => 'word',
                    'link_text' => 'Cover Letter  (file size 1 MB only)&nbsp;<small class="red">*</small>',
                ])
            </div>
        </div>

    </div>

    <div class="row mx-0 border-bottom  py-30 w-100">
        {{-- <div class="col-sm-12 text-left profile_box">
            <h3>{{ trans('label.experience') }}</h3>
        </div> --}}
        @include('auth.job_seeker.partials.experience')
    </div>



    <div class="row mx-0 border-bottom  py-30 w-100">
        @include('auth.job_seeker.partials.education')
    </div>
    <div class="row mx-0 border-bottom  py-30 w-100">
        @include('auth.job_seeker.partials.licenses')
    </div>
    <div class="row mx-0 border-bottom  py-30 w-100">
        <div class="col-sm-12 pd-0 text-left profile_box">
            <h3>{{ trans('label.trainings') }}</h3>
        </div>

        <div class="form-group mb-4 col-md-6 col-lg-3">
            <label for="">{{ trans('label.training_name') }}</label>
            {!! Form::text('training_name', old('training_name', $seekerDetail->training_name ?? null), [
                'class' => 'form-control',
                'placeholder' => trans('label.training_name'),
            ]) !!}
            @error('training_name')
                <span class="error invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group mb-4 col-md-6 col-lg-3">
            <label for="" class="text-transform-none">{{ trans('label.attended_at_company') }}</label>
            {!! Form::text('attended_at_company', old('attended_at_company', $seekerDetail->attended_at_company ?? null), [
                'class' => 'form-control',
                'placeholder' => trans('label.attended_at_company'),
            ]) !!}
            @error('attended_at_company')
                <span class="error invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

        <div class="col-md-6 col-lg-3">
            @include('auth.job_seeker.partials.duration_year', [
                'key' => $key,
                'value' => $seekerDetail->year,
            ])
        </div>
    </div>
    <div class="row mx-0 border-bottom  py-30 w-100">
        @include('auth.job_seeker.partials.language_skill')
    </div>
    <div class="row mx-0 border-bottom  py-30 w-100">
        {{-- @include('auth.job_seeker.partials.skill') --}}
        <div class="col-md-6  mb-4">
            <div class="profile_box col-12 p-0">
                {{-- <h3 class="mb-4">{{trans('label.skills')}}*</h3> --}}
                <h3 class="mb-4" style="display: flex;">{{trans('label.skills')}}<span style="color: red;">*</span></h3>

            </div>

            {!! Form::select('skill_id[]', $skills ?? null, $skillsData, [
                    'class' => 'form-control select-with-tag' . (isset($errors) && $errors->has('skill_id') ? 'is-invalid' : ''),
                    'data-placeholder' => trans('label.choose_one'),
                    'multiple' => true,
                ])
            !!}
        </div>
    </div>
    <div class="row py-30 w-100">
        <div class="col-sm-12 text-left profile_box">
            <h3>{{ trans('label.personal_statement') }}</h3>
        </div>
{{-- @dd($seekerDetail->seekerLicense) --}}
        <div class="form-group col-12 col-lg-9 mb-0">
            <label for="">{{ trans('label.personal_statement') }}</label>
            {{-- {!! Form::label('description', trans('label.description') . '<span class="text-danger">*</span>') !!} --}}
            {!! Form::textarea('personal_statement', $seekerDetail->personal_statement ?? null, [
                'id' => 'personal_statement',
                'richtexteditor' => true,
                'class' => 'form-control ' . ($errors->has('personal_statement') ? 'is-invalid' : ''),
                'placeholder' => trans('label.personal_statement'),
                'rows' => 5,
                'required' => 'required',
            ]) !!}
            @error('personal_statement')
                <div class="error invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>
</div>

@include('imagecropper.croppermodal')

@section('third_party_scripts')
    @include('vendor.richtexteditor.script')
    @include('vendor.image_upload.script')
    @include('vendor.dropzone.script')
@endsection



@push('page_scripts')
    <script>
        var m = moment(new Date());
        var date = new Date();
        var threemonthafter = date.setMonth(date.getMonth() + 3);
        $('#licence_validity').datetimepicker({
            format: "{{ config('constants.format.moment_date') }}"
        });

        CKEDITOR.replace('description', {
            placeholder: 'Type your content here...'
        });
    </script>
@endpush


@push('page_scripts')
    <script>
        $(document).ready(function() {
            // Wait for the document to be fully loaded before attaching the event handler
            $(".ai_description").on("click", function() {
                // var $data = JSON.stringify({
                //     product_id: package_id,
                //     quantity: quantity
                // });
                // const form = document.querySelector('form');
                // const data = new FormData(form);
                var formData = $("#frm_jobseeker").serialize();
                var data = JSON.stringify(formData);
                console.log(data);

                processAjaxOperation("{{ route('generate.cv') }}", 'POST', data, 'applicaion/json');
                $('#open-ai-wrapper').removeClass("d-none");
            });
            $("#copy-description").on("click", function() {
                var content = $('#open-ai-content').html();

                CKEDITOR.replace('description');
                CKEDITOR.instances.description.setData(content);
            });

        });
    </script>

{{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> --}}
@endpush

@if (isset($seekerDetail->licence_validity))
    @include('vendor.moment.datetimepicker', [
        'dateFields' => ['licence_validity' => $user->seekerDetail->licence_validity],
    ])
@endif
@if (isset($seekerDetail->dob))
    @include('vendor.moment.datetimepicker', ['dateFields' => ['dob' => $seekerDetail->dob]])
@endif

