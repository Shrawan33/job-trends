@include('auth.verification.common', [
    'headingOne' => trans('label.email_verification'),
    'paragraphText' => trans('label.email_address_text'). ' ' . $user->email,
    'headingTwo' => trans('label.email_code_text')
])
