{{-- @section('third_party_stylesheets')
    @include('vendor.richtexteditor.style')
    @include('vendor.dropzone.style')
@endsection --}}
{!! Form::hidden('user_id', $user->id ?? '', ['class' => 'form-control']) !!}
{!! Form::hidden('form_title', $main_title ?? '', ['class' => 'form-control']) !!}
@csrf

<div class="experience-field-wrapper">
    <div class="d-flex mb-4 align-items-center justify-content-between profile_box">
        <h3 class="mb-0">{{ trans('label.experience_detail') }}</h3>
        <button type="button" class="exp-add-field btn btn-primary text-white p-3">
            <svg
                xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                <path d="M7.99998 1.58331V14.4166M1.58331 7.99998H14.4166" stroke="#fff" stroke-width="1.5"
                    stroke-linecap="round" stroke-linejoin="round"></path>
            </svg>
            {{ trans('label.add_more') }}
        </button>
    </div>
    <div class="form-group col-md-6 pl-md-0">
        <label for="">
            {{ trans('label.profile_summary') }}
        </label>
        {!! Form::textarea('profile_summary', $seekerDetail->profile_summary ?? null, [
            'class' => 'form-control ' . (isset($errors) && $errors->has('profile_summary') ? 'is-invalid' : ''),
            'placeholder' => trans('message.profile_summary'),
            'rows' => 5,
        ]) !!}
        @error('profile_summary')
            <span class="error invalid-feedback">{{ $message }}</span>
        @enderror
    </div>
    <div class="experience-fields">
        @if (!empty($experiencesData) && is_iterable($experiencesData))
            @foreach ($experiencesData as $key => $value)
                <div class="row experience-field">

                    {!! Form::hidden("exp_id[$key]", old("exp_id.$key", $value->id ?? 0), ['class' => 'form-control']) !!}
                    <div class="d-flex mb-4 align-items-center justify-content-end col-12">
                        <button type="button" id="remove-button"
                            class="edit_btn_link @if ($key == 0) d-none @endif exp-remove-field text-danger justify-content-end border-0 p-0">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="18" viewBox="0 0 18 20"
                                fill="none">
                                <path
                                    d="M12.5556 4.6V3.88C12.5556 2.87191 12.5556 2.36786 12.3618 1.98282C12.1913 1.64413 11.9194 1.36876 11.5849 1.19619C11.2046 1 10.7068 1 9.71111 1H8.28889C7.29324 1 6.79542 1 6.41513 1.19619C6.08062 1.36876 5.80865 1.64413 5.63821 1.98282C5.44444 2.36786 5.44444 2.87191 5.44444 3.88V4.6M7.22222 9.55V14.05M10.7778 9.55V14.05M1 4.6H17M15.2222 4.6V14.68C15.2222 16.1921 15.2222 16.9482 14.9316 17.5258C14.6759 18.0338 14.268 18.4469 13.7662 18.7057C13.1958 19 12.449 19 10.9556 19H7.04445C5.55097 19 4.80423 19 4.2338 18.7057C3.73204 18.4469 3.32409 18.0338 3.06843 17.5258C2.77778 16.9482 2.77778 16.1921 2.77778 14.68V4.6"
                                    stroke="#ff7d57" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                                </path>
                            </svg>{{ trans('label.delete') }}
                        </button>
                    </div>
                    <div class="row w-100 mx-0">
                        <div class="col-lg-7">
                            <div class="row">
                                <div class="form-group col-md-6 mb-4">
                                    <label for="">{{ trans('label.company_name') }}</label>
                                    {!! Form::text("company[$key]", old("company.$key", $value->company ?? null), [
                                        'class' => 'form-control ' . ($errors->has("company.$key") ? 'is-invalid' : ''),
                                        'placeholder' => trans('label.company_name'),
                                    ]) !!}
                                    @error('company.' . $key)
                                        <span class="error invalid-feedback">{{ $message }}</span>
                                    @enderror

                                </div>

                                <div class="form-group mb-4 col-md-6">
                                    <label for="">{{ trans('label.designation') }}</label>
                                    {!! Form::text("role[$key]", old("role.$key", $value->role ?? null), [
                                        'class' => 'form-control',
                                        'placeholder' => trans('label.designation'),
                                    ]) !!}
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-5 form-group mb-4 col-md-6">
                            <label for="">{{ trans('label.employer_view.location') }}</label>
                            {!! Form::text("location[$key]", old("location.$key", $value->location ?? null), [
                                'class' => 'form-control',
                                'placeholder' => trans('label.employer_view.location'),
                            ]) !!}
                        </div>
                    </div>

                    <div class="col-md-6 col-lg-7 mb-4">
                        @include('auth.job_seeker.partials.duration', ['key' => $key, 'value' => $value])
                        <label for="" class="mb-3 ">
                            <input type="checkbox" id="currently_working" class="mr-1 currently_working"
                                name="currently_working[{{$key}}]" value="1" {{($value->currently_working ?? 0) == 1 ?
                            "checked":''}} />{{trans('label.currently_working')}}
                        </label>
                        <div class="row form-group">
                            <div class="form-group col-md-6 mb-4">
                                <label for="">{{ trans('label.reference_name') }}</label>
                                {!! Form::text("reference_name[$key]", old("reference_name.$key", $value->reference_name ?? null), [
                                    'class' => "form-control " . ($errors->has("reference_name.$key") ? 'is-invalid' : ''),
                                    'placeholder' => trans('label.reference_name'),
                                ]) !!}
                                @error('reference_name.' . $key)
                                    <span class="error invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group col-md-6 mb-4">
                                <label for="">{{ trans('label.reference_phone_number') }}</label>
                                {!! Form::text("reference_phone_number[$key]", old("reference_phone_number.$key", $value->reference_phone_number ?? null), [
                                    'class' => "form-control " . ($errors->has("reference_phone_number.$key") ? 'is-invalid' : ''),
                                    'placeholder' => trans('label.reference_phone_number'),
                                ]) !!}
                                @error('reference_phone_number.' . $key)
                                    <span class="error invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group col-md-6 mb-4">
                                <label for="">{{ trans('label.reference_position') }}</label>
                                {!! Form::text("reference_position[$key]", old("reference_position.$key", $value->reference_position ?? null), [
                                    'class' => "form-control " . ($errors->has("reference_position.$key") ? 'is-invalid' : ''),
                                    'placeholder' => trans('label.reference_position'),
                                ]) !!}
                                @error('reference_position.' . $key)
                                    <span class="error invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group col-md-6 mb-4">
                                <label for="">{{ trans('label.years_known') }}</label>
                                {!! Form::text("years_known[$key]", old("years_known.$key", $value->years_known ?? null), [
                                    'class' => "form-control " . ($errors->has("years_known.$key") ? 'is-invalid' : ''),
                                    'placeholder' => trans('label.years_known'),
                                ]) !!}
                                @error('years_known.' . $key)
                                    <span class="error invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                    </div>


                    <div class="form-group mb-4 col-md-6 col-lg-5">
                        <label for="">{{ trans('label.roles_achievements') }}</label>
                        {!! Form::textarea("description[$key]", old("description.$key", $value->description ?? null), [
                            'rows' => 4,
                            'class' => 'form-control',
                            'placeholder' => trans('label.roles_achievements'),
                            'richtexteditor' => true,
                            'id' => 'description',
                        ]) !!}
                    </div>

                </div>
            @endforeach
        @else
            @empty($experiencesData)
                <div class="row experience-field">
                    <div class="d-flex mb-4 align-items-center justify-content-end col-12 mt-4">
                        <button type="button" id="remove-button"
                            class="edit_btn_link d-none exp-remove-field text-danger justify-content-end border-0 p-0">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="18" viewBox="0 0 18 20"
                                fill="none">
                                <path
                                    d="M12.5556 4.6V3.88C12.5556 2.87191 12.5556 2.36786 12.3618 1.98282C12.1913 1.64413 11.9194 1.36876 11.5849 1.19619C11.2046 1 10.7068 1 9.71111 1H8.28889C7.29324 1 6.79542 1 6.41513 1.19619C6.08062 1.36876 5.80865 1.64413 5.63821 1.98282C5.44444 2.36786 5.44444 2.87191 5.44444 3.88V4.6M7.22222 9.55V14.05M10.7778 9.55V14.05M1 4.6H17M15.2222 4.6V14.68C15.2222 16.1921 15.2222 16.9482 14.9316 17.5258C14.6759 18.0338 14.268 18.4469 13.7662 18.7057C13.1958 19 12.449 19 10.9556 19H7.04445C5.55097 19 4.80423 19 4.2338 18.7057C3.73204 18.4469 3.32409 18.0338 3.06843 17.5258C2.77778 16.9482 2.77778 16.1921 2.77778 14.68V4.6"
                                    stroke="#ff7d57" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                                </path>
                            </svg>{{ trans('label.delete') }}
                        </button>
                    </div>
                    {!! Form::hidden('exp_id[]', 0, ['class' => 'form-control']) !!}
                    <div class="form-group col-md-6 col-lg-4 mb-4">
                        <label for="">{{ trans('label.company_name') }}</label>
                        {!! Form::text('company[]', null, ['class' => 'form-control', 'placeholder' => trans('label.company_name')]) !!}

                    </div>
                    <div class="form-group mb-4 col-md-6 col-lg-4">
                        <label for="">{{ trans('label.designation') }}</label>
                        {!! Form::text('role[]', null, ['class' => 'form-control', 'placeholder' => trans('label.designation')]) !!}

                    </div>
                    <div class="form-group mb-4 col-md-6 col-lg-4">
                        <label for="">{{ trans('label.employer_view.location') }}</label>
                        {!! Form::text('location[]', null, [
                            'class' => 'form-control',
                            'placeholder' => trans('label.employer_view.location'),
                        ]) !!}

                    </div>
                    <div class="col-md-6 col-lg-6 mb-4">
                        @include('auth.job_seeker.partials.duration', ['key' => 0])
                        <label for="" class="mb-3 ">
                            <input type="checkbox" class="mr-1 currently_working" name="currently_working[]"
                                {{($value->currently_working ?? 0) == 1 ? "checked":''}}
                            value="1" />{{trans('label.currently_working')}}
                        </label>
                        <div class="row">
                        <div class="form-group col-md-6 mb-4">
                            <label for="">{{ trans('label.reference_name') }}</label>
                            {!! Form::text('reference_name[]', null, ['class' => 'form-control', 'placeholder' => trans('label.reference_name')]) !!}
                        </div>
                        <div class="form-group col-md-6 mb-4">
                            <label for="">{{ trans('label.reference_phone_number') }}</label>
                            {!! Form::text('reference_phone_number[]', null, ['class' => 'form-control', 'placeholder' => trans('label.reference_phone_number')]) !!}
                        </div>
                        <div class="form-group col-md-6 mb-4">
                            <label for="">{{ trans('label.reference_position') }}</label>
                            {!! Form::text('reference_position[]', null, ['class' => 'form-control', 'placeholder' => trans('label.reference_position')]) !!}
                        </div>
                        <div class="form-group col-md-6 mb-4">
                            <label for="">{{ trans('label.years_known') }}</label>
                            {!! Form::text('years_known[]', null, ['class' => 'form-control', 'placeholder' => trans('label.years_known')]) !!}
                        </div>
                        </div>
                    </div>
                    <div class="form-group mb-4 col-md-6">
                        <label for="">{{ trans('label.roles_achievements') }}</label>
                        {{-- @dd("hello") --}}
                        {!! Form::textarea('description[]', null, [
                            'richtexteditor' => true,
                            'rows' => 4,
                            'class' => 'form-control',
                            'placeholder' => trans('label.roles_achievements'),
                            'id' => 'description-0', // Assign a unique ID to the textarea
                        ]) !!}
                    </div>
                </div>
            @endempty
        @endif


    </div>


</div>

{{-- @section('third_party_scripts')
    @include('vendor.richtexteditor.script')
    @include('vendor.dropzone.script')
@endsection --}}

@push('page_scripts')
    <script type="text/javascript">
        $(function() {
            // Dynamically add/remove inputs for any field[]'s
            $('.experience-field-wrapper').each(function() {
                var $wrapper = $('.experience-fields', this);
                // Add button

                $(".exp-add-field", $(this)).click(function(e) {
                    var data = [];
                    var cloned_content = $('.experience-field:first-child', $wrapper).clone(true)
                        .appendTo($wrapper);
                    cloned_content.find('input, select, textarea').val('');
                    // alert("hello")
                    cloned_content.find('input[type!=hidden]:first').focus();
                    cloned_content.find('#remove-button').removeClass('d-none');
                    var namekey = $('.experience-field').length - 1;
                    cloned_content.find('input, select').each(function() {
                        stringtoreplace = $(this).attr('name');
                        $(this).attr('name', stringtoreplace.replace("[0]", "[" + namekey +
                            "]"));
                    });

                    cloned_content.find('textarea').each(function() {
                        stringtoreplace = $(this).attr('name');
                        var editor = CKEDITOR.instances[stringtoreplace];
                        if (editor) {
                            editor.destroy(true);
                        }
                        $(this).next().remove();
                        $(this).attr('name', stringtoreplace.replace("[0]", "[" + namekey +
                            "]"));
                        var textareaId = 'description-' + namekey;
                        $(this).attr('id', textareaId);
                        CKEDITOR.replace(textareaId);
                        var editor = CKEDITOR.instances[textareaId];
                        editor.setData(data[stringtoreplace]);
                    });
                });

                // Remove buttons
                $('.experience-field .exp-remove-field', $wrapper).click(function() {
                    if ($('.experience-field', $wrapper).length > 1) {
                        $(this).parents('.experience-field').remove();
                    }
                });

                // Initialize CKEditor for the initial description textarea
                var textareaId = 'description-0';
                CKEDITOR.replace(textareaId);
            });

        });
        $(document).ready(function() {
            $('.currently_working').on('change', function() {

            $('.currently_working').not(this).prop('checked', false);
                if (this.checked) {
                    $(this).closest('div').find('.to_duration').hide();
                } else{
                    $(this).closest('div').find('.to_duration').show();
                }
            });
        });
    </script>
@endpush
