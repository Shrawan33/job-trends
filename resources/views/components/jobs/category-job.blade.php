<div class="col-6 col-md-3 mb-5 mb-lg-0">
    @if($category->slug != null)<a href="{{ route('search-jobs.category.search',['slug' => $category->slug])}}">@else<a href="#">@endif
        <div class="img_wraper">
            @include('vendor.image_upload.display', [
                            'wrapper_class' => 'img-fluid user-90',
                            'document_type' => config('constants.document_type.image', 0),
                            'imageModel' => $category,
                        ])
        </div>
        <p>{{$category->title??null}}</p>
    </a>
</div>
