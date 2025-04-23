@extends('layouts.front')
@section('content')
<section class="bg-dark py-5">

    <div class="container">
        <div class="row my-5">
            <div class="col-12">
                <h1 class="font-weight-bold mb-0 display-4">
                    Frequently Asked Questions</h1>
            </div>
        </div>
    </div>
</section>
<section class="my-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-lg-10 px-xl-4">
                <div id="accordion">
                    <div class="faq-item border-bottom">
                        <div id="headingOne">
                            <h4 class="mb-0 cursor-pointer font-weight-medium lead-md py-4 " data-toggle="collapse" data-target="#collapseOne"
                                aria-expanded="true" aria-controls="collapseOne">
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas varius tortor nibh?
                            </h4>
                        </div>

                        <div id="collapseOne" class="collapse show" aria-labelledby="headingOne"
                            data-parent="#accordion">
                            <p class="text-primary font-weight-medium lead-md">
                            Nullam convallis ultricies fringilla. Aenean congue at est eu varius. Donec suscipit sapien efficitur, pulvinar quam in, tristique ex.?
                            </p>
                            <blockquote class="blockquote">
    <p class="mb-0">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas varius tortor nibh, sit amet tempor nibh finibus et. Aenean eu enim justo. Vestibulum aliquam hendrerit molestie. Mauris malesuada nisi sit amet augue accumsan tincidunt. Maecenas tincidunt, velit ac porttitor pulvinar, tortor eros facilisis libero, vitae commodo nunc quam et ligula. Ut nec ipsum sapien.</p>
</blockquote>
                        </div>
                    </div>
                    <div class="faq-item border-bottom">
                        <div  id="headingTwo">
                        <h4 class="mb-0 cursor-pointer font-weight-medium lead-md py-4 collapsed" data-toggle="collapse" data-target="#collapseTwo"
                                    aria-expanded="false" aria-controls="collapseTwo">
                                    Aenean ullamcorper urna tortor, ut elementum felis volutpat faucibus.?
                            </h4>
                        </div>
                        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
                        <p>
                                Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad
                                squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck
                                quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it
                                squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica,
                                craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur
                                butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth
                                nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                            </p>
                        </div>
                    </div>
                    <div class="faq-item border-bottom">
                        <div  id="headingThree">
                             <h4 class="mb-0 cursor-pointer font-weight-medium lead-md py-4 collapsed" data-toggle="collapse"
                                    data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                   Donec libero turpis, lacinia nec leo sit amet, dignissim dignissim lacus.
                                </button>
                            </h4>
                        </div>
                        <div id="collapseThree" class="collapse" aria-labelledby="headingThree"
                            data-parent="#accordion">
                            <p>
                                Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad
                                squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck
                                quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it
                                squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica,
                                craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur
                                butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth
                                nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
