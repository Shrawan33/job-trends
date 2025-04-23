<div class="testimonial-item active">
    <div class="row mx-0">
        <div class="col-md-4 p-0">
            {{-- <img src="{{ asset('images/test_2.png') }}" alt="test_img" width="100%"> --}}
            @include('vendor.image_upload.display', [
                        'wrapper_class' => 'w-100',
                        'document_type' => config('constants.document_type.image', 0),
                        'imageModel' => $testimonial,
                        ])
        </div>
        <div class="col-md-8 content">
            <h3>{{$testimonial->title??''}}</h3>
            <div class="description"><p class="mb-0">{{$testimonial->description??''}}</p></div>
            <p class="name">{{$testimonial->client??''}}</p>
            <p class="location mb-0">{{$testimonial->location??''}}</p>
        </div>
    </div>
</div>
