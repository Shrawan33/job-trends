@extends('layouts.front')
@section('content')
<section class="bg-dark py-5">

    <div class="container">
        <div class="row my-5">
            <div class="col-12">
                <h1 class="font-weight-bold mb-0 display-4">
                    {{__('label.front_faq_title')}}</h1>
            </div>
        </div>
    </div>
</section>
<section class="my-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-lg-10 px-xl-4">
                <div id="accordion">
                    @foreach($faqs as $key => $val)
                    <div class="faq-item border-bottom">
                        <div id="heading{{$key}}">
                                <h4 class="mb-0 cursor-pointer font-weight-medium lead-md py-4 {{$key >0 ? "collapsed" : ''}}" data-toggle="collapse"  data-target="#collapse{{$key}}" aria-expanded="{{$key >0 ? "false" : 'true'}}" aria-controls="collapse{{$key}}">
                                    {{$val->question}}
                                </h4>
                        </div>

                        <div id="collapse{{$key}}" class="collapse {{$key >0 ? "" : 'show'}}" aria-labelledby="heading{{$key}}"
                            data-parent="#accordion">
                            {{-- <p class="text-primary font-weight-medium lead-md">
                            Nullam convallis ultricies fringilla. Aenean congue at est eu varius. Donec suscipit sapien efficitur, pulvinar quam in, tristique ex.?
                            </p> --}}
                            <blockquote class="blockquote">
                                <p class="mb-0"> {{$val->answer}}.</p>
                            </blockquote>
                        </div>
                    </div>
                    @endforeach


                </div>
            </div>
        </div>
    </div>
</section>
@endsection
