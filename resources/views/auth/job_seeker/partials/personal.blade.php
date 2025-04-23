
<div class="row">
    <div class="col-sm-12 text-left profile_box">
        <h3 class="mb-4">{{trans('label.personal_details')}}</h3>
    </div>
    {!! Form::hidden('user_id', $user->id ?? null, ['class' => 'form-control']) !!}
    {!! Form::hidden('form_title', $main_title ?? null, ['class' => 'form-control']) !!}

    <div class="row mx-0">

            <div class="form-group mb-4 col-md-6 col-lg-4">
                <label for="">{{trans('label.parent_name')}}</label>
                {!! Form::text("parent_name", old("parent_name", $seekerDetail->parent_name??null),['class' => 'form-control', 'placeholder'=>trans('label.parent_name')])!!}
                @error('parent_name')
                <span class="error invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group col-md-6 col-lg-4 mb-4 dob_select">
                <label for="">{{trans('label.dob')}}</label>
                <div class="input-group">
                    {!! Form::text('dob', $seekerDetail->dob?? null, ['class' => 'form-control datepicker'. (isset($errors) && $errors->has('dob') ? 'is-invalid' : ''),'id'=>'dob','placeholder' => trans('label.dob')]) !!}
                    <svg class="calander_icon" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                        <path d="M16.6663 8.5H3.33301M12.9626 2.5V5.5M7.03671 2.5V5.5M6.88856 17.5H13.1108C14.3553 17.5 14.9776 17.5 15.453 17.2548C15.8711 17.039 16.2111 16.6948 16.4241 16.2715C16.6663 15.7902 16.6663 15.1601 16.6663 13.9V7.6C16.6663 6.33988 16.6663 5.70982 16.4241 5.22852C16.2111 4.80516 15.8711 4.46095 15.453 4.24524C14.9776 4 14.3553 4 13.1108 4H6.88856C5.644 4 5.02172 4 4.54636 4.24524C4.12822 4.46095 3.78827 4.80516 3.57522 5.22852C3.33301 5.70982 3.33301 6.33988 3.33301 7.6V13.9C3.33301 15.1601 3.33301 15.7902 3.57522 16.2715C3.78827 16.6948 4.12822 17.039 4.54636 17.2548C5.02172 17.5 5.644 17.5 6.88856 17.5Z" stroke="#717884" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    <span class="input-group-addon">
                            <span class="glyphicon glyphicon-calendar"></span>
                    </span>
                </div>
                @error('dob')
                <span class="error invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group col-md-6 col-lg-4 mb-4">
                <label for="">Nationality</label>
                <div class="mt-3">
                    @foreach (config('constants.nationality_choices.data') as $key => $value)
                    {!! Form::radio('nationality', $key, $key == ($seekerDetail->nationality??config('constants.nationality_choices.default', 1)), ['id' => "nationality_$key", 'label' => trans("label.nationality_choices.$key"), 'wrapper-class' => 'form-check form-check-inline']) !!}
                    @endforeach
                    @error('nationality')
                    <span class="error invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            {{-- <div class="form-group col-md-6 col-lg-4 mb-4">
                <label for="">{{trans('label.language_known')}}</label>
                {!! Form::textarea('language_known', $seekerDetail->language_known ?? null, ['class' => 'form-control '. (isset($errors) && $errors->has('language_known') ? 'is-invalid' : ''), 'placeholder' => trans('label.language_known'), 'rows' =>3]) !!}
                @error('language_known')
                <span class="error invalid-feedback">{{ $message }}</span>
                @enderror
            </div> --}}
            <div class="form-group col-md-6 col-lg-4 mb-4">
                <label for="">{{trans('label.permanent_address')}}</label>
                {!! Form::textarea('permanent_address', $seekerDetail->permanent_address ?? null, ['class' => 'form-control '. (isset($errors) && $errors->has('permanent_address') ? 'is-invalid' : ''), 'placeholder' => trans('label.permanent_address'), 'rows' => 3]) !!}
                @error('permanent_address')
                <span class="error invalid-feedback">{{ $message }}</span>
                @enderror
            </div>



            {{-- <div class="form-group mb-4">
                {!! Form::text('indentity_no', $seekerDetail->indentity_no ?? null, ['class' => 'form-control '. (isset($errors) && $errors->has('indentity_no') ? 'is-invalid' : ''), 'placeholder' => trans('label.aadhar_no')]) !!}
                @error('indentity_no')
                <span class="error invalid-feedback">{{ $message }}</span>
                @enderror
            </div> --}}

    </div>
</div>
@if (isset($seekerDetail->dob))
    @include('vendor.moment.datetimepicker', ['dateFields' => ['dob' => $seekerDetail->dob]])
@endif
