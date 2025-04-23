<ol class="carousel-indicators">
    @foreach($banners as $key=>$banner)
    <li data-target="#carouselExampleIndicators" data-slide-to="{{$key}}" class="{{$key==0 ? 'active':''}}"></li>
    @endforeach
</ol>
<div class="carousel-inner home-banner">
    @foreach($banners as $key=>$banner)
    <div class="carousel-item {{$key==0 ?'active' : '' }}">
        @if(!empty($banner->image))
            <img class="d-block w-100 carousel-img" src="{{ $banner->image->presigned_url }} " alt="{{$banner->title??''}}">
        @else
            <img src="{{ asset('img/user-pp-placeholder.png') }}" alt="no-image" class="img-fluid mb-4">
        @endif
        <div class="carousel-caption">
            <div class="container">
                <h1 class="font-weight-bold display-4 ">{{$banner->title??''}}
                    <br class="d-none d-sm-block" />
                    {{$banner->tag_line??''}}
                </h1>
            </div>
        </div>
    </div>
    @endforeach


</div>
