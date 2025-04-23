@section('third_party_stylesheets')
@include('vendor.dropzone.style')
@endsection
{!! Form::hidden('user_id', $user->id ?? null, ['class' => 'form-control']) !!}
{!! Form::hidden('form_title', $main_title ?? null, ['class' => 'form-control']) !!}
@include('vendor.dropzone.upload', [
    'form_id' => "frm_jobseeker",
    'dropzone_id' => 'covervideo-document-dropzone',
    'disk' => $entity['disk'],
    'documents' => old("document", isset($user) && $user->videos ? $user->videos->toArray() : []),
    'maxFiles' => 1,
    'filetype' => 'video',
    'acceptedFileType' => 'pdf'
])

@section('third_party_scripts')
@include('vendor.dropzone.script')
@endsection
