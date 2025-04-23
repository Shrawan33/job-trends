<div id="{{ $dropzone_id }}">
    <div class="form-group position-relative">
        <ul class="list-unstyled" id="{{ $dropzone_id }}-preview">
            <li class="border-bottom py-2 d-flex justify-content-between file-row" id="{{ $dropzone_id }}-template">
                <div class="text-primary font-weight-medium">
                    <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 30 30"
                        fill="none">
                        <path fill-rule="evenodd" clip-rule="evenodd"
                            d="M7.68727 0H17.7173L26.218 8.86058V26.0945C26.218 28.2534 24.4714 30 22.3199 30H7.68727C5.52836 30 3.78174 28.2534 3.78174 26.0945V3.90553C3.7817 1.74662 5.52832 0 7.68727 0Z"
                            fill="#E5252A" />
                        <path opacity="0.302" fill-rule="evenodd" clip-rule="evenodd"
                            d="M17.71 0V8.79311H26.2182L17.71 0Z" fill="white" />
                        <path
                            d="M8.12207 22.3836V16.9038H10.4534C11.0306 16.9038 11.4879 17.0612 11.8327 17.3836C12.1776 17.6984 12.35 18.1257 12.35 18.6579C12.35 19.1902 12.1776 19.6175 11.8327 19.9323C11.4879 20.2546 11.0306 20.4121 10.4534 20.4121H9.52387V22.3836H8.12207ZM9.52387 19.2202H10.296C10.5059 19.2202 10.6708 19.1752 10.7833 19.0703C10.8957 18.9728 10.9557 18.8379 10.9557 18.658C10.9557 18.4781 10.8957 18.3431 10.7833 18.2457C10.6708 18.1407 10.5059 18.0958 10.296 18.0958H9.52387V19.2202ZM12.9272 22.3836V16.9038H14.8687C15.251 16.9038 15.6108 16.9563 15.9481 17.0687C16.2855 17.1812 16.5928 17.3386 16.8627 17.556C17.1326 17.7659 17.3499 18.0507 17.5074 18.4106C17.6573 18.7704 17.7398 19.1827 17.7398 19.6474C17.7398 20.1047 17.6573 20.517 17.5074 20.8768C17.3499 21.2366 17.1326 21.5215 16.8627 21.7314C16.5928 21.9488 16.2855 22.1062 15.9481 22.2186C15.6108 22.3311 15.251 22.3836 14.8687 22.3836H12.9272ZM14.299 21.1917H14.7038C14.9212 21.1917 15.1236 21.1692 15.311 21.1167C15.4909 21.0643 15.6633 20.9818 15.8282 20.8693C15.9856 20.7569 16.1131 20.5995 16.203 20.3896C16.293 20.1797 16.338 19.9323 16.338 19.6474C16.338 19.3551 16.293 19.1077 16.203 18.8978C16.1131 18.688 15.9856 18.5305 15.8282 18.4181C15.6633 18.3056 15.4909 18.2232 15.311 18.1707C15.1236 18.1182 14.9212 18.0957 14.7038 18.0957H14.299V21.1917ZM18.4444 22.3836V16.9038H22.3425V18.0957H19.8462V18.9728H21.8402V20.1572H19.8462V22.3836H18.4444Z"
                            fill="white" />
                    </svg>
                    <span class="name" data-dz-name></span>
                    <strong class="error text-danger" data-dz-errormessage></strong>
                </div>
                <a href="javascript:void(0)" data-dz-remove class="delete d-none">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="20" viewBox="0 0 18 20"
                        fill="none" class="mr-2">
                        <path
                            d="M12.5556 4.6V3.88C12.5556 2.87191 12.5556 2.36786 12.3618 1.98282C12.1913 1.64413 11.9194 1.36876 11.5849 1.19619C11.2046 1 10.7068 1 9.71111 1H8.28889C7.29324 1 6.79542 1 6.41513 1.19619C6.08062 1.36876 5.80865 1.64413 5.63821 1.98282C5.44444 2.36786 5.44444 2.87191 5.44444 3.88V4.6M7.22222 9.55V14.05M10.7778 9.55V14.05M1 4.6H17M15.2222 4.6V14.68C15.2222 16.1921 15.2222 16.9482 14.9316 17.5258C14.6759 18.0338 14.268 18.4469 13.7662 18.7057C13.1958 19 12.449 19 10.9556 19H7.04445C5.55097 19 4.80423 19 4.2338 18.7057C3.73204 18.4469 3.32409 18.0338 3.06843 17.5258C2.77778 16.9482 2.77778 16.1921 2.77778 14.68V4.6"
                            stroke="#F00404" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                    </svg>
                </a>
                <span class="inline-loader"><img src="{{ asset('img/inline-loading.png') }}" /></span>
            </li>
        </ul>
    </div>

    <div class="form-group position-relative file-upload">
        <label for=""
            class="mx-auto d-flex align-items-center flex-column justify-content-center px-3 py-2 fileinput-button-advance-audio dz-clickable"><svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" viewBox="0 0 50 50" fill="none">
                <path d="M32.8125 32.8264H40.2344C44.549 32.8264 48.0469 29.3285 48.0469 25.0139C48.0469 20.6989 44.9396 17.2014 40.625 17.2014C40.625 12.8864 37.1271 9.38885 32.8125 9.38885C31.8822 9.38885 31.0021 9.57909 30.1746 9.87762C28.0262 7.21786 24.779 5.4826 21.0938 5.4826C14.6217 5.4826 9.375 10.7293 9.375 17.2014C5.06035 17.2014 1.95312 20.6989 1.95312 25.0139C1.95312 29.3285 5.45098 32.8264 9.76562 32.8264H17.1875" stroke="#357DE8" stroke-width="2" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                <path d="M32.8125 32.8264H40.2344C44.549 32.8264 48.0469 29.3285 48.0469 25.0139C48.0469 20.6989 44.9396 17.2014 40.625 17.2014C40.625 12.8864 37.1271 9.38885 32.8125 9.38885C31.8822 9.38885 31.0021 9.57909 30.1746 9.87762C28.0262 7.21786 24.779 5.4826 21.0938 5.4826C14.6217 5.4826 9.375 10.7293 9.375 17.2014C5.06035 17.2014 1.95312 20.6989 1.95312 25.0139C1.95312 29.3285 5.45098 32.8264 9.76562 32.8264H17.1875" stroke="#357DE8" stroke-width="2" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                <path d="M25 44.5174V21.1081" stroke="#357DE8" stroke-width="2" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                <path d="M19.1406 26.158L23.6189 21.6797C24.3816 20.917 25.6184 20.917 26.3811 21.6797L30.8594 26.158" stroke="#357DE8" stroke-width="2" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
              </svg></label>
            <label for="" class="text-primary font-weight-bold py-2 mb-0 fileinput-button-advance-audio dz-clickable"><?php echo $link_text ??
                trans('label.attach_additional_document') ?> @if(isset($acceptedFileType))<i class="fa fa-info"
                    data-toggle="tooltip" data-placement="top"
                    title="{{ trans('label.allowed_file_types', ['types'=> config("constants.document_mime.{$acceptedFileType}", null)]) }}"></i>@endif</label>
            {{-- <label for="" class="mb-0 text">{!! __('label.pdf') !!}{{ config("constants.dropzone.maxFilesize.pdf") }} MB</label> --}}
            {{-- <label for="" class="mb-0 text">Upload PDF smaller than 1MB</label> --}}

        {{-- <input type="file" id="myfile" name="myfile" class="form-group file-upload-input"> --}}
    </div>
</div>
@push('page_scripts')
    <script>
        var uploadedDocumentMap = {}
        Dropzone.autoDiscover = false;
        // Dropzone.prototype.defaultOptions.dictRemoveFile = "Remove";

        var previewNode = document.querySelector("#{{ $dropzone_id }}-template");
        previewNode.id = "";
        var previewTemplate = previewNode.parentNode.innerHTML;
        previewNode.parentNode.removeChild(previewNode);

        $(document).ready(function() {
            $("div#{{ $dropzone_id }}").dropzone({
                url: '{{ isset($filetype) ? route("$filetype.create") : route('documents.create') }}',
                paramName: "file_name",
                maxFiles: "{{ $maxFiles ?? config('constants.dropzone.maxFiles') }}",
                maxFilesize: 1, // MB
                acceptedFiles: '{{ isset($acceptedFileType) ? config("constants.dropzone.acceptedFiles.$acceptedFileType") : config('constants.dropzone.acceptedFiles.documents') }}',
                previewTemplate: previewTemplate,
                previewsContainer: "#{{ $dropzone_id }}-preview",
                clickable: ".fileinput-button-advance-audio",
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                },
                success: function(file, response) {
                    if (response.name !== undefined) {
                        // $('form#{{ $form_id }}').append('<input type="hidden" name="{{ $name ?? 'document[]' }}" value="' + response.name + '">')
                        var count_elem_name =
                            '{{ isset($name) ? $name . '_count' : 'document_count' }}';
                        var total_files = getDocumentCount(count_elem_name);

                        var elem = '{!! $name ?? 'document' !!}'
                        response.presigned_url = response.url;
                        file.file_path = response.file_path;

                        // appends file elements
                        appendFileElements(file, elem + '[' + total_files + ']', response);

                        // set file counts
                        if (total_files != undefined) {
                            total_files = parseInt(total_files) + 1;
                        } else {
                            total_files = 0;
                        }
                        // set file counts
                        setDocumentCount(count_elem_name, total_files);
                        $(file.previewElement).find('.delete').removeClass('d-none')
                        $(file.previewElement).find('.inline-loader').addClass('d-none')
                        // uploadedDocumentMap[file.name] = response.name
                    }
                },
                removedfile: function(file) {
                    $(file.previewElement).find('.delete').addClass('d-none')

                    var name = '';
                    var dropzone = this;

                    var count_elem_name = '{{ isset($name) ? $name . '_count' : 'document_count' }}';
                    var total_files = getDocumentCount(count_elem_name);

                    // manipulate file counts
                    if (total_files != undefined) {
                        total_files = parseInt(total_files) - 1;
                    } else {
                        total_files = 0;
                    }
                    // console.log('remove',file);
                    if (typeof file.file_name !== 'undefined') {
                        name = file.file_name;
                    } else {
                        name = uploadedDocumentMap[file.name];
                    }
                    if (file.file_path.includes('tmp/')) {
                        $.ajax({
                            method: 'POST',
                            url: "{{ route('documents.delete') }}",
                            beforeSend: function() {
                                $(file.previewElement).find('.inline-loader').removeClass(
                                    'd-none')
                            },
                            data: {
                                'file_name': name,
                                'disk': "{{ $disk }}"
                            },
                            success: function(response) {
                                if (response.success == true) {
                                    file.previewElement.remove();
                                    // $('form#{{ $form_id }}').find('input[name="{{ $name ?? 'document[]' }}"][value="' + name + '"]').remove()
                                    // document.getElementById("{{ $dropzone_id }}").classList.remove('dz-max-files-reached');
                                    // set file counts
                                    setDocumentCount(count_elem_name, total_files);
                                }
                            }
                        });
                    } else {
                        file.previewElement.remove();
                        // $('form#{{ $form_id }}').find('input[name="{{ $name ?? 'document[]' }}"][value="' + file.name + '"]').remove()
                        // document.getElementById("{{ $dropzone_id }}").classList.remove('dz-max-files-reached');
                        // set file counts
                        setDocumentCount(count_elem_name, total_files);
                    }
                },
                init: function() {
                    // handled error
                    this.on("error", function(file, error) {
                        if (error.hasOwnProperty('errors') && error.errors.hasOwnProperty(
                                'file_name')) {
                            this.files = without(this.files, file);
                            file.previewElement.remove()
                            toastr.error(error.errors.file_name)
                            if (this.files.length === 0) {
                                return this.emit("reset");
                            }
                        }
                    });

                    // remove uploaded file on exceed
                    this.on("maxfilesexceeded", function(file) {
                        file.previewElement.remove()
                        toastr.error(
                            "You are allowed to upload maximum {{ $maxFiles ?? config('constants.dropzone.maxFiles') }} file(s)"
                        );
                    });

                    // while sending request
                    this.on("sending", function(file, xhr, formData) {
                        formData.append('disk', "{{ $disk }}");
                    });

                    this.on("addedfile", function(file) {
                        if (file.size > this.options.maxFilesize * 1024 * 1024) {
                            // alert("hello")
                            file.previewElement.remove()
                            // alert("File size exceeds the maximum limit of " + this.options
                            // .maxFilesize + "MB");
                            toastr.error(
                                "File size exceeds the maximum limit of " + this.options
                                .maxFilesize + "MB"
                            );
                        }
                    });

                    // init count elements
                    var count_elem_name = '{{ isset($name) ? $name . '_count' : 'document_count' }}';
                    var count_input = getHiddenElement(count_elem_name, 0);
                    $('form#{{ $form_id }}').append(count_input.outerHTML);

                    // load to dropzone
                    @if (isset($documents) && $documents)
                        var existingfiles = {!! json_encode($documents) !!};

                        // set file counts
                        setDocumentCount(count_elem_name, existingfiles.length);

                        for (var i in existingfiles) {

                            var file = {
                                'name': existingfiles[i].name,
                                'size': existingfiles[i].size,
                                'type': existingfiles[i].mime_type,
                                'accepted': true
                            };
                            existingfiles[i].url = existingfiles[i].presigned_url;
                            file.file_path = existingfiles[i].file_path;
                            this.files.push(file);
                            this.options.addedfile.call(this, file);
                            // console.log(file);
                            if (file.type.includes('image')) {
                                file.url = existingfiles[i].presigned_url;
                                this.options.thumbnail.call(this, file, existingfiles[i].presigned_url)
                            }
                            file.previewElement.classList.add('dz-complete');
                            $(file.previewElement).find('.delete').removeClass('d-none')
                            $(file.previewElement).find('.inline-loader').addClass('d-none')

                            var elem = '{!! $name ?? 'document' !!}';

                            // appends file elements
                            appendFileElements(file, elem + '[' + i + ']', existingfiles[i]);
                        }
                    @endif
                    // console.log('total files length -> ',this.files.length)
                    // console.log('accepted files length -> ',this.getAcceptedFiles().length)
                    // console.log('rejected files length -> ',this.getRejectedFiles().length)
                    // console.log('queued files length -> ',this.getQueuedFiles().length)
                    // console.log('upload files length -> ',this.getUploadingFiles().length)
                },
                error: function(x, y, z) {}
            });
        });

        function appendFileElements(file, name, response) {

            // appends download link
            // file.previewTemplate.appendChild(setDownloadLink(response.presigned_url));

            // appends hidden element id
            file.previewTemplate.appendChild(getHiddenElement(name + '[id]', response.id));

            // appends hidden element file_name
            file.previewTemplate.appendChild(getHiddenElement(name + '[file_name]', response.name));

            // appends hidden element size
            file.previewTemplate.appendChild(getHiddenElement(name + '[size]', response.size));

            // appends hidden element mime_type
            file.previewTemplate.appendChild(getHiddenElement(name + '[mime_type]', response.mime_type));

            // appends hidden element file_path
            file.previewTemplate.appendChild(getHiddenElement(name + '[file_path]', response.file_path));

            // appends hidden element presigned_url
            file.previewTemplate.appendChild(getHiddenElement(name + '[presigned_url]', response.presigned_url));

            uploadedDocumentMap[file.name] = response.file_name;

            return file;
        }

        function setDocumentCount(name, value) {
            $('form#{{ $form_id }}').find('[name="' + name + '"]').val(value);
            // console.log(value);
            if (value >= {{ $maxFiles ?? config('constants.dropzone.maxFiles') }}) {
                $('.file-upload', $('#{{ $dropzone_id }}')).addClass('d-none');
            } else {
                $('.file-upload', $('#{{ $dropzone_id }}')).removeClass('d-none');
            }
        }

        function getDocumentCount(name) {
            return $('form#{{ $form_id }}').find('[name="' + name + '"]').val();
        }

        function getHiddenElement(name, value) {
            var input = document.createElement("input");
            input.setAttribute("type", "hidden");
            input.setAttribute("name", name);
            input.setAttribute("value", value);
            return input;
        }

        function setDownloadLink(url) {
            var a = document.createElement('a');
            a.setAttribute('href', url);
            a.classList.add('dz-download');
            a.target = 'blank';
            a.innerHTML = "Download";
            return a;
        }
    </script>
@endpush
