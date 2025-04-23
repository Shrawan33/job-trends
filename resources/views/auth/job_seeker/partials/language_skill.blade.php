{{-- @section('third_party_stylesheets')
    @include('vendor.richtexteditor.style')
    @include('vendor.dropzone.style')
@endsection --}}
{!! Form::hidden('user_id', $user->id ?? '', ['class' => 'form-control']) !!}
{!! Form::hidden('form_title', $main_title ?? '', ['class' => 'form-control']) !!}
@csrf


<div class="col-12 p-0 language-field-wrapper">
    <div class="d-flex mb-4 align-items-center justify-content-between profile_box">
        <h3 class="mb-0">{{ trans('label.language_skill') }}</h3>
        <button type="button" class="lang-add-field btn btn-primary text-white p-3">
            <svg
                xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                <path d="M7.99998 1.58331V14.4166M1.58331 7.99998H14.4166" stroke="#fff" stroke-width="1.5"
                    stroke-linecap="round" stroke-linejoin="round"></path>
            </svg>
            {{ trans('label.add_more') }}
        </button>
    </div>
    <div class="language-fields">
        @foreach ($language_skillData as $key => $value)
        {{-- @dd($value) --}}
            <div class="row language-field">

                {!! Form::hidden("lan_id[$key]", old("lan_id.$key", $value->id ?? 0), ['class' => 'form-control']) !!}
                <div class="d-flex mb-4 align-items-center justify-content-end col-12">
                    <button type="button" id="remove-button"
                        class="edit_btn_link @if ($key == 0) d-none @endif lang-remove-field text-danger justify-content-end border-0 p-0">
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
                    <label for="">{{trans('label.choose_language')}}</label>
                    {!! Form::select("language_id[$key]", $languages, old("language_id.$key",
                    $value->language_id ?? null), ['class' =>
                    'form-control no-select2','placeholder' => trans('label.choose_language')]) !!}
                </div>

                <div class="form-group col-md-6 col-lg-4 mb-4">
                    <label for="">{{trans('label.speaks')}}</label>
                    {!! Form::select("speak_id[$key]", $speaks, old("speak_id.$key",
                    $value->speak_id ?? null), ['class' =>
                    'form-control no-select2','placeholder' => trans('label.choose')]) !!}
                </div>

                <div class="form-group col-md-6 col-lg-4 mb-4">
                    <label for="">{{trans('label.read_write')}}</label>
                    {!! Form::select("read_write_id[$key]", $read_write, old("read_write_id.$key",
                    $value->read_write_id ?? null), ['class' =>
                    'form-control no-select2','placeholder' => trans('label.choose')]) !!}
                </div>
            </div>
        @endforeach
        @empty($language_skillData)
            <div class="row language-field">
                <div class="d-flex mb-4 align-items-center justify-content-end col-12 mt-4">
                    <button type="button" id="remove-button"
                        class="edit_btn_link d-none lang-remove-field text-danger justify-content-end border-0 p-0">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="18" viewBox="0 0 18 20"
                            fill="none">
                            <path
                                d="M12.5556 4.6V3.88C12.5556 2.87191 12.5556 2.36786 12.3618 1.98282C12.1913 1.64413 11.9194 1.36876 11.5849 1.19619C11.2046 1 10.7068 1 9.71111 1H8.28889C7.29324 1 6.79542 1 6.41513 1.19619C6.08062 1.36876 5.80865 1.64413 5.63821 1.98282C5.44444 2.36786 5.44444 2.87191 5.44444 3.88V4.6M7.22222 9.55V14.05M10.7778 9.55V14.05M1 4.6H17M15.2222 4.6V14.68C15.2222 16.1921 15.2222 16.9482 14.9316 17.5258C14.6759 18.0338 14.268 18.4469 13.7662 18.7057C13.1958 19 12.449 19 10.9556 19H7.04445C5.55097 19 4.80423 19 4.2338 18.7057C3.73204 18.4469 3.32409 18.0338 3.06843 17.5258C2.77778 16.9482 2.77778 16.1921 2.77778 14.68V4.6"
                                stroke="#ff7d57" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                            </path>
                        </svg>{{ trans('label.delete') }}
                    </button>
                </div>
                {!! Form::hidden('lan_id[]', 0, ['class' => 'form-control']) !!}

                <div class="form-group col-md-6 col-lg-4 mb-4">
                    <label for="">{{trans('label.choose_language')}}</label>
                        {!! Form::select('language_id[]', $languages, null, ['class' => 'form-control no-select2',
                        'placeholder' => trans('label.choose_language')]) !!}
                </div>

                <div class="form-group col-md-6 col-lg-4 mb-4">
                    <label for="">{{trans('label.speaks')}}</label>
                        {!! Form::select('speak_id[]', $speaks, null, ['class' => 'form-control no-select2',
                        'placeholder' => trans('label.choose')]) !!}
                </div>

                <div class="form-group col-md-6 col-lg-4 mb-4">
                    <label for="">{{trans('label.read_write')}}</label>
                        {!! Form::select('read_write_id[]', $read_write, null, ['class' => 'form-control no-select2',
                        'placeholder' => trans('label.choose')]) !!}
                </div>
            </div>
        @endempty
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
            $('.language-field-wrapper').each(function() {
                var $wrapper = $('.language-fields', this);
                // Add button

                $(".lang-add-field", $(this)).click(function(e) {
                    var data = [];
                    var cloned_content = $('.language-field:first-child', $wrapper).clone(true)
                        .appendTo($wrapper);
                    cloned_content.find('input, select, textarea').val('');
                    // alert("hello")
                    cloned_content.find('input[type!=hidden]:first').focus();
                    cloned_content.find('#remove-button').removeClass('d-none');
                    var namekey = $('.language-field').length - 1;
                    cloned_content.find('input, select').each(function() {
                        stringtoreplace = $(this).attr('name');
                        $(this).attr('name', stringtoreplace.replace("[0]", "[" + namekey +
                            "]"));
                    });


                });

                // Remove buttons
                $('.language-field .lang-remove-field', $wrapper).click(function() {
                    if ($('.language-field', $wrapper).length > 1) {
                        $(this).parents('.language-field').remove();
                    }
                });


            });

        });
    </script>
@endpush
