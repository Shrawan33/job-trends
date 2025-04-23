<div class="row">
    <!-- Role Field -->
    <div class="form-group col-sm-12">
        {!! Form::select('role', $roleItems, null, [
            'class' => 'form-control',
            'data-placeholder' => 'Select Role',
            'id' => 'select_role',
        ]) !!}
        <span class="help-block"></span>
    </div>

    <!-- Institute Field -->
    <div class="form-group col-sm-12" id="company_name"
        style="{{ old('role', isset($user) && $user->roles()->first()->name == 'employer' ? 'display: block' : 'display: none') }}">
        {!! Form::text('company_name', null, [
            'class' => 'form-control',
            'placeholder' => trans('label.institute_name'),
        ]) !!}
        <span class="help-block"></span>
    </div>

    <!-- Name Field -->
    <div class="form-group col-sm-6" id="first_name"
        style="{{ old('role', (isset($user) && $user->roles()->first()->name == 'jobseeker') || (isset($user) && $user->roles()->first()->name == 'admin') || (isset($user) && $user->roles()->first()->name == 'mentor') || (isset($user) && $user->roles()->first()->name == 'account') ? 'display: block' : 'display: none') }}">
        {!! Form::text('first_name', null, ['class' => 'form-control', 'placeholder' => trans('label.first_name')]) !!}
        <span class="help-block"></span>
    </div>

    <div class="form-group col-sm-6" id="last_name"
        style="{{ old('role', (isset($user) && $user->roles()->first()->name == 'jobseeker') || (isset($user) && $user->roles()->first()->name == 'admin') || (isset($user) && $user->roles()->first()->name == 'mentor') || (isset($user) && $user->roles()->first()->name == 'account') ? 'display: block' : 'display: none') }}">
        {!! Form::text('last_name', null, ['class' => 'form-control', 'placeholder' => trans('label.last_name')]) !!}
        <span class="help-block"></span>
    </div>

    <!-- Email Field -->
    <div class="form-group col-sm-12">
        {!! Form::email('email', null, ['class' => 'form-control', 'placeholder' => trans('label.company_email')]) !!}
        <span class="help-block"></span>
    </div>


    <!-- Phone Field -->
    <div class="form-group col-sm-12">
        <div class="input-group-prepend">
            {{-- <span class="input-group-text bg-transparent">
                {{ config('constants.phone_prefix') }}
            </span> --}}
            {!! Form::text('phone_number', Str::removePhonePrefix(old('phone_number', $user->phone_number ?? null)), [
                'class' => 'form-control',
                'placeholder' => trans('label.phone_number'),
            ]) !!}
        </div>

        <span class="help-block"></span>
    </div>

    <!-- Password Field -->
    {{-- <div class="form-group col-sm-12" style="display: none;">
        {!! Form::password('password', ['class' => 'form-control', 'placeholder' => trans('label.password')]) !!}
        <span class="help-block"></span>
    </div>
    <!-- Confirmation Password Field -->
    <div class="form-group col-sm-12" style="display: none;">
        {!! Form::password('password_confirmation', [
            'class' => 'form-control',
            'placeholder' => trans('label.confirm_password'),
        ]) !!}
        <span class="help-block"></span>
    </div> --}}

    @if (isset($user))
        <div class="form-group col-sm-12">
            {!! Form::password('password', [
                'class' => 'form-control',
                'placeholder' => trans('label.password'),
            ]) !!}
            <span class="help-block"></span>
        </div>

        <!-- Confirmation Password Field -->
        <div class="form-group col-sm-12">
            {!! Form::password('password_confirmation', [
                'class' => 'form-control',
                'placeholder' => trans('label.confirm_password'),
            ]) !!}
            <span class="help-block"></span>
        </div>
    @endif
    <!-- featured checkbox -->
    <div class="form-group col-sm-12">
        {!! Form::checkbox('featured', 1, null, ['label' => 'Featured']) !!}

    </div>

    <!-- mobile_verified_at checkbox -->
    <div class="form-group col-sm-6" style="display: none;">
        {!! Form::checkbox('mobile_verified_at', 1, null, ['label' => 'Mobile Verification']) !!}
    </div>


    {{-- <!-- email_verified_at checkbox -->
    <div class="form-group col-sm-6">
        {!! Form::checkbox('email_verified_at',1,true, ['label' => 'Email Verification']) !!}

    </div> --}}
    <!-- email_verified_at checkbox -->

    <!-- email_verified_at checkbox -->
    {{-- <div class="form-group col-sm-6" style="{{ isset($user) ? '' : 'display: none;' }}">
        {!! Form::checkbox('email_verified_at', 1, isset($user) ? $user->email_verified_at : true, [
            'label' => 'Email Verification',
        ]) !!}
    </div> --}}


    <div class="form-group col-sm-6" style="{{ isset($user) ? '' : 'display: none;' }}">
        {!! Form::hidden('email_verified_at', 0) !!}
        {!! Form::checkbox('email_verified_at', 1, isset($user) ? $user->email_verified_at : false, [
            'label' => 'Email Verification',
        ]) !!}
    </div>




    {!! Form::hidden('tc_checkbox', 1, [
        'class' => 'form-control',
        'label' => 'I agree to the terms &
                                    Conditions',
    ]) !!}

</div>

@push('page_scripts')
    <script>
        $(document).ready(function() {

            $('#select_role').on('change', function() {
                let selectedVal = $(this).val();
                if (selectedVal != "") {
                    if (selectedVal == 'employer') {
                        $('#first_name').hide();
                        $('#last_name').hide();
                        $('#company_name').show();
                        $('input[name="first_name"]').val('');
                        $('input[name="last_name"]').val('');

                    } else {
                        $('#first_name').show();
                        $('#last_name').show();
                        $('#company_name').hide();
                        $('input[name="company_name"]').val('');

                    }

                }
            });
        });
    </script>
    <script>
        // Wait for the document to be ready
        $(document).ready(function() {
            // Listen for changes on the checkbox
            $('#email-verification-checkbox').change(function() {
                if (!$(this).is(':checked')) {
                    // If the checkbox is unchecked, prevent form submission
                    $('form').submit(function(event) {
                        event.preventDefault();
                    });
                }
            });
        });
    </script>
@endpush
