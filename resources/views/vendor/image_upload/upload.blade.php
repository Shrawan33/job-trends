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

<div class="add-image {!! $count == $limit??5 ? 'd-none' : 'test' !!}">
        <input
            type="file"
            class="form-control image-file-upload d-none"
            id="{{$id??'image'}}"
            name="{{$id??'image'}}_file"
            placeholder="{{$placeholder??__('label.image')}}"
            data-limit="{{($limit??5)-$count}}"
            data-container="container-{{$id??'image'}}"
            data-idName="{{ $multiple ? ($name??'image').'[id][]' : $name??'image' }}"
            data-name="{{ $multiple ? ($name??'image').'[image][]' : $name??'image' }}"
            data-height="{{$height??'280px'}}"
            data-width="{{$width??'280px'}}",
            accept="{{ implode(",", config('constants.image_mime', [])) }}">
        <a href="javascript:void(0)" id="add-container-{{$id??'image'}}" class="add-image-container file-upload">
            @if($document_type != 0)
            <div class="d-flex align-items-center justify-content-center flex-column px-3 py-2 add-gallery-image mx-auto">
                <h5 class="h2 m-0 font-weight-normal text-black">+</h5>
                {{-- <div class="ml-3">
                    <span class="d-block text-black">{{trans('label.add_more_photo')}}</span>
                    <span class="d-block small">{{trans('label.image_below')}}</span>
                </div> --}}

            </div>
            @else
            <div class="d-flex align-items-center flex-column justify-content-center px-3 py-2 add-gallery-image">
                <span class="h2 m-0 font-weight-normal text-black">+</span>
                <p class="text-black mb-0">{{trans('label.upload_edit')}}</p>
            </div>
            @endif
        </a>
    </div>

    @push('page_scripts')

<script>
    var parentElement = {{$parent??"document"}};
    $('document').ready(function(){
        $(parentElement).on('click', "#add-container-{{$id??'image'}}", function(){
            $(this).prev('.image-file-upload').trigger('click');
        });
    });
</script>
@endpush
