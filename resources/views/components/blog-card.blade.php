<div class="col-md-4 mb-4">
    <div class="blog-item p-2">
        <a href="{{route('blog.detail',$blog->id)}}" title="{{$blog->title??'blog-detail'}}">
        @if(!empty($blog->image))
        <img src="{{ $blog->image->presigned_url }} " alt="" class="img-fluid mb-4">
        @else
            <img src="{{ asset('img/main-logo.svg') }}" alt="" class="img-fluid mb-4">
        @endif

        <h4 class="font-weight-bold mb-3">{{$blog->title??''}}</h4></a>
        <p>{{__('label.by')}} {{$blog->createdBy??''}} <span class="mx-3">| </span> {{date('d M Y',strtotime($blog->createdDate))??''}} </p>
    </div>
</div>
