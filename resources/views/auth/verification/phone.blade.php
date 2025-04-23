@include('auth.verification.common', [
    'headingOne' => !empty($otp) ? trans('label.otp') : trans('label.phone_verification'),
    'paragraphText' => !empty($otp) ? '' : trans('label.phone_text'). ' ' . $user->phone_number,
    'headingTwo' => trans('label.phone_code_text')
])