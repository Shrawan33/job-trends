@push('page_scripts')
<script>
    CKEDITOR.replace('{{$name??"textarea"}}');
    {{--
    // CKEDITOR.replace('{{$name??"textarea"}}', {
    //     filebrowserUploadUrl: "{{route('documents.ckeditor.upload', ['_token' => csrf_token()])}}",
    //     filebrowserUploadMethod: 'form'
    // });
    --}}
</script>
@endpush
