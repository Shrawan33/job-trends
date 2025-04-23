<div class="container-{{$id??'image'}} {{$class??'image'}}">
    @if(!empty($images['image']))
        @foreach ($images['image'] as $index => $item)
            <div class="img-thumb-item">
                <input type="hidden" name="{{ $multiple ? ($name??'image').'[id][]' : $name??'image' }}" value="{!!$images['id'][$index]!!}">
                <input type="hidden" name="{{ $multiple ? ($name??'image').'[image][]' : $name??'image' }}" value="{!!$item!!}">
                <div class="img-preview {!! $document_type != 0 ? 'img-200' : 'img-thumb-img' !!}">
                    <img src="{!!$item!!}" alt="Image Loading" />
                </div>
                <a href="javascript:void(0)" data-input_name="{{$id??'image'}}_file" class="remove-image-container" >
                    <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 18 18" fill="none">
                        <path d="M16.5 1.5L1.5 16.5M1.5 1.5L16.5 16.5" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </a>
            </div>
        @endforeach
    @endif
    <div class="d-none to-clone img-thumb-item">
        <input type="hidden" for="idName" name="" value="">
        <input type="hidden" for="image" name="" value="">
        <div class="img-preview {!! $document_type != 0 ? 'img-200' : 'img-thumb-img' !!}"></div>
        <a href="javascript:void(0)" data-input_name="{{$id??'image'}}_file" class="remove-image-container" >
            <!-- {!!__('label.remove_image')!!} -->
            <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 18 18" fill="none">
                <path d="M16.5 1.5L1.5 16.5M1.5 1.5L16.5 16.5" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
        </a>
    </div>
</div>

<div class="add-image custom_file_input text-center py-25 position-relative file-upload mb-0">
        <input
            type="file"
            class="form-control image-file"
            id="{{$id??'image'}}"
            name="{{$id??'image'}}_file"
            placeholder="{{$placeholder??__('label.image')}}"
            data-limit="1"
            data-container="container-{{$id??'image'}}"
            data-idName="{{ $multiple ? ($name??'image').'[id][]' : $name??'image' }}"
            data-name="{{ $multiple ? ($name??'image').'[image][]' : $name??'image' }}"
            data-height="{{$height??'280px'}}"
            data-width="{{$width??'280px'}}",
            accept="{{ implode(",", config('constants.image_mime', [])) }}">
            <label for="{{$id??'image'}}_file" class="custom_file_label text-primary font-weight-bold py-2 mb-0">
                <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" viewBox="0 0 50 50" fill="none">
                    <path d="M32.8125 32.8264H40.2344C44.549 32.8264 48.0469 29.3285 48.0469 25.0139C48.0469 20.6989 44.9396 17.2014 40.625 17.2014C40.625 12.8864 37.1271 9.38885 32.8125 9.38885C31.8822 9.38885 31.0021 9.57909 30.1746 9.87762C28.0262 7.21786 24.779 5.4826 21.0938 5.4826C14.6217 5.4826 9.375 10.7293 9.375 17.2014C5.06035 17.2014 1.95312 20.6989 1.95312 25.0139C1.95312 29.3285 5.45098 32.8264 9.76562 32.8264H17.1875" stroke="#357DE8" stroke-width="2" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"></path>
                    <path d="M32.8125 32.8264H40.2344C44.549 32.8264 48.0469 29.3285 48.0469 25.0139C48.0469 20.6989 44.9396 17.2014 40.625 17.2014C40.625 12.8864 37.1271 9.38885 32.8125 9.38885C31.8822 9.38885 31.0021 9.57909 30.1746 9.87762C28.0262 7.21786 24.779 5.4826 21.0938 5.4826C14.6217 5.4826 9.375 10.7293 9.375 17.2014C5.06035 17.2014 1.95312 20.6989 1.95312 25.0139C1.95312 29.3285 5.45098 32.8264 9.76562 32.8264H17.1875" stroke="#357DE8" stroke-width="2" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"></path>
                    <path d="M25 44.5174V21.1081" stroke="#357DE8" stroke-width="2" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"></path>
                    <path d="M19.1406 26.158L23.6189 21.6797C24.3816 20.917 25.6184 20.917 26.3811 21.6797L30.8594 26.158" stroke="#357DE8" stroke-width="2" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"></path>
                </svg>
                <span>Choose a file…</span>
            </label>

    </div>

    @push('page_scripts')

<script>
    var parentElement = {{$parent??"document"}};
    $('document').ready(function(){
        $(parentElement).on('click', "#add-container-{{$id??'image'}}", function(){
            $(this).prev('.image-file-upload').trigger('click');
        });
        $('.image-file').each(function () {
            var input = $(this);
            var label = input.next();
            var labelVal = label.html();

            input.on('change', function (e) {
                var fileName = '';
                if (this.files && this.files.length > 1)
                    fileName = (input.data('multiple-caption') || '').replace('{count}', this.files.length);
                else
                    fileName = e.target.value.split('\\').pop();

                if (fileName)
                    label.find('span').html(fileName);
                else
                    label.html(labelVal);
            });
        });
    });
</script>
@endpush
