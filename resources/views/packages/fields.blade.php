<div class="row">
    <div class="col-sm-6">
        <div class="row">

            <div class="form-group col-sm-12">
				{!! Form::label('role_type', trans('Role Type')) !!}
				<select class="form-control" name="role_type" id="role_type" required>

				  <option value="">Select Role</option>

				  @foreach ($roles as $key => $value)
					<option value="{{ $key }}" <?php if(Request::url() != route($entity['url'].'.create')) if($package->role_type == $key) echo 'selected = "selected"'; ?>>
						{{ $value }}
					</option>
				  @endforeach
				</select>
			</div>
            <div class="form-group col-sm-12 jobseeker-fields d-none" id="packagetype">
				{!! Form::label('package_type', trans('Package Type')) !!}
                {!! Form::select('package_type', $package_type_list, old('package_type', null), ['class' => 'form-control select2'. (isset($errors) && $errors->has('package_type') ? ' is-invalid' : ''), 'data-placeholder'=> trans('label.package_type'), 'multiple' => false,'id' =>'package_type']) !!}

			</div>

            <div class="form-group col-sm-12 employer-fields d-none" id="packagetype">
				{!! Form::label('employer_package_type', trans('Employer Package Type')) !!}
                {!! Form::select('employer_package_type', $employer_package_type_list??[], old('employer_package_type', null), ['class' => 'form-control select2'. (isset($errors) && $errors->has('employer_package_type') ? ' is-invalid' : ''), 'data-placeholder'=> trans('label.package_type'), 'multiple' => false,'id' =>'package_type']) !!}

			</div>
            <div class="row our-expertise d-none">
                <div class="form-group col-sm-12">
                    <!-- apply default Field -->
                    {!! Form::hidden('is_addon', 0) !!}
                    {!! Form::checkbox('is_addon', 1, null, ['label' => trans('label.is_addon')]) !!}
                </div>

                <div class="form-group col-sm-12 addon-fields d-none" id="packagetype">
                    {!! Form::label('parent_package_id', trans('Package')) !!}
                    {!! Form::select('parent_package_id', $seekerProducts??null, old('parent_package_id', null), ['class' => 'form-control select2'. (isset($errors) && $errors->has('parent_package_id') ? ' is-invalid' : ''), 'data-placeholder'=> trans('label.package'), 'multiple' => false,'id' =>'parent_package_id']) !!}
                </div>

                <div id="recordContainer">
                    <!-- Records will be displayed here -->
                </div>

            </div>

            <!-- Title Field -->
            <div class="form-group col-sm-12">
                {!! Form::label('title', trans('label.title')) !!}
                {!! Form::text('title', null, ['class' => 'form-control '. ($errors->has('title') ? 'is-invalid' : '')]) !!}
                @error('title')
                <span class="error invalid-feedback">{{ $message }}</span>
                @enderror
            </div>

            <!-- Price Field -->
            <div class="form-group col-sm-4">
                {!! Form::label('price', trans('label.price')) !!}
                {!! Form::number('price', null, ['class' => 'form-control']) !!}
                @error('price')
                <span class="error invalid-feedback">{{ $message }}</span>
                @enderror
            </div>

            <div class="row col-sm-8 employer-fields d-none">
                <!-- Duration Field -->
                <div class="form-group col-sm-4">
                    {!! Form::label('duration', trans('label.duration').' ('.trans('label.in_days').')') !!}
                    {!! Form::number('duration', null, ['class' => 'form-control']) !!}
                    @error('duration')
                    <span class="error invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Grace Period Field -->
                <div class="form-group col-sm-4">
                    {!! Form::label('grace_period', trans('label.grace_period').' ('.trans('label.in_days').')') !!}
                    {!! Form::number('grace_period', null, ['class' => 'form-control']) !!}
                    @error('grace_period')
                    <span class="error invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
            </div>
        </div>
    </div>

    <div class="col-sm-6">
        <div class="row employer-fields d-none">
            @foreach (config('constants.credit_fields') as $field)
                <div class="form-group col-sm-6">
                    {!! Form::label("credits[$field]", trans("label.{$field}_credits")) !!}
                    {!! Form::number("credits[$field]", null, ['class' => 'form-control '. ($errors->has($field) ? 'is-invalid' : '')]) !!}
                    @error($field)
                    <span class="error invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group col-sm-6">
                    {!! Form::label("deduction[$field]", trans("label.{$field}_deduction")) !!}
                    {!! Form::number("deduction[$field]", 1, ['class' => 'form-control '. ($errors->has($field) ? 'is-invalid' : '')]) !!}
                    @error($field)
                    <span class="error invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
            @endforeach

            {{-- <!-- Profile Unlock Credits Field -->
            <div class="form-group col-sm-6">
                {!! Form::label('profile', trans('label.profile_unlock_credits')) !!}
                {!! Form::number('profile', null, ['class' => 'form-control '. ($errors->has('profile') ? 'is-invalid' : '')]) !!}
                @error('profile')
                <span class="error invalid-feedback">{{ $message }}</span>
                @enderror
            </div>

            <!-- Profile Unlock Credits Deduction Field -->
            <div class="form-group col-sm-6">
                {!! Form::label('profile_deduction', trans('label.profile_unlock_credits_deduction')) !!}
                {!! Form::number('profile_deduction', null, ['class' => 'form-control '. ($errors->has('profile_deduction') ? 'is-invalid' : '')]) !!}
                @error('profile_deduction')
                <span class="error invalid-feedback">{{ $message }}</span>
                @enderror
            </div>

            <!-- No Of Job Posts Field -->
            <div class="form-group col-sm-6">
                {!! Form::label('job_posts', trans('label.no_job_post')) !!}
                {!! Form::number('job_posts', null, ['class' => 'form-control '. ($errors->has('job_posts') ? 'is-invalid' : '')]) !!}
                @error('job_posts')
                <span class="error invalid-feedback">{{ $message }}</span>
                @enderror
            </div>

            <!-- No Of Job Posts Deduction Field -->
            <div class="form-group col-sm-6">
                {!! Form::label('job_posts_deduction', trans('label.no_job_post_deduction')) !!}
                {!! Form::number('job_posts_deduction', null, ['class' => 'form-control '. ($errors->has('job_posts_deduction') ? 'is-invalid' : '')]) !!}
                @error('job_posts_deduction')
                <span class="error invalid-feedback">{{ $message }}</span>
                @enderror
            </div>

            <!-- No Of Sms Field -->
            <div class="form-group col-sm-6">
                {!! Form::label('sms', trans('label.no_of_sms')) !!}
                {!! Form::number('sms', null, ['class' => 'form-control '. ($errors->has('sms') ? 'is-invalid' : '')]) !!}
                @error('sms')
                <span class="error invalid-feedback">{{ $message }}</span>
                @enderror
            </div>

            <!-- No Of Sms Deduction Field -->
            <div class="form-group col-sm-6">
                {!! Form::label('sms_deduction', trans('label.no_of_sms_deduction')) !!}
                {!! Form::number('sms_deduction', null, ['class' => 'form-control '. ($errors->has('sms_deduction') ? 'is-invalid' : '')]) !!}
                @error('sms_deduction')
                <span class="error invalid-feedback">{{ $message }}</span>
                @enderror
            </div> --}}
        </div>
        <div class="row jobseeker-fields d-none">
            @foreach (config('constants.jobseeker_credit_fields') as $field)
                <div class="form-group col-sm-6">
                    {!! Form::label("credits[$field]", trans("label.{$field}_credits")) !!}
                    {!! Form::number("credits[$field]", null, ['class' => 'form-control '. ($errors->has($field) ? 'is-invalid' : '')]) !!}
                    @error($field)
                    <span class="error invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group col-sm-6">
                    {!! Form::label("deduction[$field]", trans("label.{$field}_deduction")) !!}
                    {!! Form::number("deduction[$field]", 1, ['class' => 'form-control '. ($errors->has($field) ? 'is-invalid' : '')]) !!}
                    @error($field)
                    <span class="error invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
            @endforeach
        </div>
    </div>
</div>

<div class="row">
    <!-- Description Field -->
    <div class="form-group col-sm-12 col-lg-12">
        {!! Form::label('description', trans('label.description')) !!}
        {!! Form::textarea('description', null, ['class' => 'form-control', 'rows' => 5]) !!}
        @error('description')
        <span class="error invalid-feedback">{{ $message }}</span>
        @enderror
    </div>
</div>

<div class="row">
    <div class="ml-auto">



        <div class="employer-fields d-none">
            <!-- apply default Field -->
            {!! Form::hidden('is_default', 0) !!}
            {!! Form::checkbox('is_default', 1, null, ['label' => trans('label.is_default')]) !!}
            <!-- is contact sales Field -->
            {!! Form::hidden('is_contact_sales', 0) !!}
            {!! Form::checkbox('is_contact_sales', 1, null, ['label' => trans('label.is_contact_sales')]) !!}
            <!-- is best selling Field -->
            {!! Form::hidden('is_best_selling', 0) !!}
            {!! Form::checkbox('is_best_selling', 1, null, ['label' => trans('label.is_best_selling')]) !!}
        </div>
    </div>
</div>
@push('page_scripts')
    <script type="text/javascript">
        $(document).ready(function () {
            function toggleFields() {
                if ($('#role_type').val() === 'jobseekers') {
                    $(".jobseeker-fields").removeClass("d-none");
                    $(".employer-fields").addClass("d-none");
                } else if ($('#role_type').val() === 'employers') {
                    $(".employer-fields").removeClass("d-none");
                    $(".jobseeker-fields").addClass("d-none");
                } else {
                    $(".employer-fields").addClass("d-none");
                    $(".jobseeker-fields").addClass("d-none");
                }
            }

            function toggleExpertisefields() {
                if ($('#package_type').val() === '1') {
                    $(".our-expertise").removeClass("d-none");
                } else if ($('#role_type').val() === '2') {
                    $(".our-expertise").addClass("d-none");
                } else {
                    $(".our-expertise").addClass("d-none");
                }
            }

            function toggleAddonfields() {
                if ($('#is_addon').is(':checked')) {
                    $(".addon-fields").removeClass("d-none");
                } else {
                    $(".addon-fields").addClass("d-none");
                }
            }

            function fetchRecords(category, url) {
                // Make an AJAX request
                $.ajax({
                    type: "GET",
                    url: url, // Replace with your API endpoint
                    data: { category: category },
                    success: function(response) {
                        console.log(response, 123);
                        //alert("sds");
                        // Assuming the API returns data in JSON format
                        // Clear the previous records
                        $('#recordContainer').html('');
                        $('#recordContainer').html(response);
                    },
                    error: function(error) {
                        console.error("Error fetching records: " + error);
                    }
                });
            }

            // Call the function on document ready
            toggleFields();
            toggleExpertisefields();
            toggleAddonfields();
            // Attach the function to the change event
            $('#role_type').on('change', toggleFields);
            $('#package_type').on('change', toggleExpertisefields);

            $('#is_addon').on('change', toggleAddonfields);

            $("#package_category_id").change(function() {
                var package_category_id = $(this).val();

                var url = "{{ route('package.getAddonList', ':package_category_id') }}";
                url = url.replace(':package_category_id', package_category_id);

                fetchRecords(package_category_id, url);
                //processAjaxOperation(url, 'POST', 'applicaion/json')
            });

        });
    </script>
@endpush
