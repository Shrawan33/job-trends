{{-- @section('third_party_stylesheets')
    @include('vendor.richtexteditor.style')
    @include('vendor.dropzone.style')
@endsection --}}
{!! Form::hidden('user_id', $user->id ?? '', ['class' => 'form-control']) !!}
{!! Form::hidden('form_title', $main_title ?? '', ['class' => 'form-control']) !!}
@csrf


<div class="col-12 p-0 lienses-field-wrapper">
    <div class="d-flex mb-4 align-items-center justify-content-between profile_box">
        <h3 class="mb-0">{{ trans('label.job_detail_page.training_certificate') }}</h3>
        <button type="button" class="lic-add-field btn btn-primary text-white p-3">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                <path d="M7.99998 1.58331V14.4166M1.58331 7.99998H14.4166" stroke="#fff" stroke-width="1.5"
                    stroke-linecap="round" stroke-linejoin="round"></path>
            </svg>
            {{ trans('label.add_more') }}
        </button>
    </div>
    <div class="lienses-fields">
        @foreach ($licenseData as $key => $value)
            {{-- @dd($value) --}}
            <div class="row lienses-field">

                {!! Form::hidden("lic_id[$key]", old("lic_id.$key", $value->id ?? 0), ['class' => 'form-control']) !!}
                <div class="d-flex mb-4 align-items-center justify-content-end col-12">
                    <button type="button" id="remove-button"
                        class="edit_btn_link @if ($key == 0) d-none @endif lic-remove-field text-danger justify-content-end border-0 p-0">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="18" viewBox="0 0 18 20"
                            fill="none">
                            <path
                                d="M12.5556 4.6V3.88C12.5556 2.87191 12.5556 2.36786 12.3618 1.98282C12.1913 1.64413 11.9194 1.36876 11.5849 1.19619C11.2046 1 10.7068 1 9.71111 1H8.28889C7.29324 1 6.79542 1 6.41513 1.19619C6.08062 1.36876 5.80865 1.64413 5.63821 1.98282C5.44444 2.36786 5.44444 2.87191 5.44444 3.88V4.6M7.22222 9.55V14.05M10.7778 9.55V14.05M1 4.6H17M15.2222 4.6V14.68C15.2222 16.1921 15.2222 16.9482 14.9316 17.5258C14.6759 18.0338 14.268 18.4469 13.7662 18.7057C13.1958 19 12.449 19 10.9556 19H7.04445C5.55097 19 4.80423 19 4.2338 18.7057C3.73204 18.4469 3.32409 18.0338 3.06843 17.5258C2.77778 16.9482 2.77778 16.1921 2.77778 14.68V4.6"
                                stroke="#ff7d57" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                            </path>
                        </svg>{{ trans('label.delete') }}
                    </button>
                </div>
                {{-- @dd($value->language_id) --}}
                <div class="form-group col-md-6 col-lg-4 mb-4">
                    <label for="">{{ trans('label.certificate_name') }}</label>
                    {!! Form::text("certificate_name[$key]", old("certificate_name.$key", $value->certificate_name ?? null), [
                        'class' => 'form-control',
                        'placeholder' => trans('label.certificate_name'),
                    ]) !!}

                    @error("certificate_name.$key")
                        <span class="text-danger">{{ $message }}</span>
                    @enderror

                </div>

                <div class="form-group col-md-6 col-lg-4 mb-4">
                    <label for="">{{ trans('label.certifying_authority') }}</label>
                    {!! Form::text(
                        "certifying_authority[$key]",
                        old("certifying_authority.$key", $value->certifying_authority ?? null),
                        ['class' => 'form-control', 'placeholder' => trans('label.certifying_authority')],
                    ) !!}

                    @error("certifying_authority.$key")
                        <span class="text-danger">{{ $message }}</span>
                    @enderror

                </div>

                <div class="col-md-6 col-lg-4">
                    @include('auth.job_seeker.partials.month_year_duration', [
                        'key' => $key,
                        'value' => $value,
                    ])
                </div>
            </div>
        @endforeach
        @empty($licenseData)
            <div class="row lienses-field">
                <div class="d-flex mb-4 align-items-center justify-content-end col-12 mt-4">
                    <button type="button" id="remove-button"
                        class="edit_btn_link d-none lic-remove-field text-danger justify-content-end border-0 p-0">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="18" viewBox="0 0 18 20"
                            fill="none">
                            <path
                                d="M12.5556 4.6V3.88C12.5556 2.87191 12.5556 2.36786 12.3618 1.98282C12.1913 1.64413 11.9194 1.36876 11.5849 1.19619C11.2046 1 10.7068 1 9.71111 1H8.28889C7.29324 1 6.79542 1 6.41513 1.19619C6.08062 1.36876 5.80865 1.64413 5.63821 1.98282C5.44444 2.36786 5.44444 2.87191 5.44444 3.88V4.6M7.22222 9.55V14.05M10.7778 9.55V14.05M1 4.6H17M15.2222 4.6V14.68C15.2222 16.1921 15.2222 16.9482 14.9316 17.5258C14.6759 18.0338 14.268 18.4469 13.7662 18.7057C13.1958 19 12.449 19 10.9556 19H7.04445C5.55097 19 4.80423 19 4.2338 18.7057C3.73204 18.4469 3.32409 18.0338 3.06843 17.5258C2.77778 16.9482 2.77778 16.1921 2.77778 14.68V4.6"
                                stroke="#ff7d57" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                            </path>
                        </svg>{{ trans('label.delete') }}
                    </button>
                </div>
                {!! Form::hidden('lic_id[]', 0, ['class' => 'form-control']) !!}

                <div class="form-group col-md-6 col-lg-4 mb-4">
                    <label for="">{{ trans('label.certificate_name') }}</label>
                    {!! Form::text('certificate_name[]', null, [
                        'class' => 'form-control',
                        'placeholder' => trans('label.certificate_name'),
                    ]) !!}

                    @error("certificate_name")
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group col-md-6 col-lg-4 mb-4">
                    <label for="">{{ trans('label.certifying_authority') }}</label>
                    {!! Form::text('certifying_authority[]', null, [
                        'class' => 'form-control',
                        'placeholder' => trans('label.certifying_authority'),
                    ]) !!}

                    @error("certifying_authority")
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="col-md-6 col-lg-4">
                    @include('auth.job_seeker.partials.month_year_duration', ['key' => 0])
                </div>

            </div>
        @endempty
    </div>


</div>

{{-- @section('third_party_scripts')
    @include('vendor.richtexteditor.script')
    @include('vendor.dropzone.script')
@endsection --}}

{{-- @push('page_scripts')
    <script type="text/javascript">


        $(function() {
            // Dynamically add/remove inputs for any field[]'s
            $('.lienses-field-wrapper').each(function() {
                var $wrapper = $('.lienses-fields', this);
                // Add button

                $(".lic-add-field", $(this)).click(function(e) {
                    var data = [];
                    var cloned_content = $('.lienses-field:first-child', $wrapper).clone(true)
                        .appendTo($wrapper);
                    cloned_content.find('input, select, textarea').val('');
                    // alert("hello")
                    cloned_content.find('input[type!=hidden]:first').focus();
                    cloned_content.find('#remove-button').removeClass('d-none');
                    var namekey = $('.lienses-field').length - 1;
                    cloned_content.find('input, select').each(function() {
                        stringtoreplace = $(this).attr('name');
                        $(this).attr('name', stringtoreplace.replace("[0]", "[" + namekey +
                            "]"));
                    });


                });
                // Remove buttons
                $('.lienses-field .lic-remove-field', $wrapper).click(function() {
                    if ($('.lienses-field', $wrapper).length > 1) {
                        $(this).parents('.lienses-field').remove();
                    }
                });


            });

        });
    </script>
@endpush --}}
@push('page_scripts')
    <script type="text/javascript">
        $(function() {
            // Dynamically add/remove inputs for any field[]'s
            $('.lienses-field-wrapper').each(function() {
                var $wrapper = $('.lienses-fields', this);
                // Add button

                $(".lic-add-field", $(this)).click(function(e) {
                    var data = [];
                    var cloned_content = $('.lienses-field:first-child', $wrapper).clone(true)
                        .appendTo($wrapper);
                    cloned_content.find('input, select, textarea').val('');
                    // alert("hello")
                    cloned_content.find('input[type!=hidden]:first').focus();
                    cloned_content.find('#remove-button').removeClass('d-none');
                    var namekey = $('.lienses-field').length - 1;
                    cloned_content.find('input, select').each(function() {
                        stringtoreplace = $(this).attr('name');
                        $(this).attr('name', stringtoreplace.replace("[0]", "[" + namekey +
                            "]"));
                    });
                });

                // Remove buttons
                $('.lienses-field .lic-remove-field', $wrapper).click(function() {
                    if ($('.lienses-field', $wrapper).length > 1) {
                        $(this).parents('.lienses-field').remove();
                    }
                });

                // Initialize CKEditor for the initial description textarea

            });

        });
    </script>
@endpush
