@extends('layouts.front')


@section('content')
<div class="job_top_banner bg_frame position-relative">
    <img src="{{ asset('images/inner_banner.png') }}" alt="fea_img" width="100%" class="inner_banner">
    <h1 class="my-3 text-center position-relative text-secondary">Contact Us</h1> 
</div>
<section class="">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="form-group mb-4">
                    <select name="" id="" class="form-control">
                        <option value="employer">Employer</option>
                    </select>
                </div>
                <div class="form-group mb-4">
                    <input type="text" class="form-control" placeholder="Name">
                </div>
                <div class="form-group mb-4">
                    <input type="text" class="form-control" placeholder="Email">
                </div>
                <div class="form-group mb-4">
                    <input type="text" class="form-control" placeholder="Phone Number">
                </div>
                <div class="form-group mb-4">
                    <input type="text" class="form-control" placeholder="Location">
                </div>
                <div class="form-group mb-4">
                    <textarea name="" id="" cols="30" rows="4" class="form-control"
                        placeholder="Description"></textarea>
                </div>
                <div class="row justify-content-between align-items-center mb-4">
                    <div class="google-captcha col-md">

                    </div>
                    <div class="col-md-auto">
                        <input type="submit" class="btn btn-primary" value="submit" data-toggle="modal" data-target="#myModal">
                    </div>

                </div>

            </div>
            <div class="col-lg-6 pl-xl-5">
                <div class="item-box p-4 p-lg-5">
                    <h3 class="mb-4 mb-lg-5 font-weight-bold">Contact info</h3>
                    <p class="mb-4 mb-lg-5"> <span class="d-block mb-1"><i
                                class="fi flaticon-pin h2 text-primary"></i></span> 341 Uwuca Parkway, Jacksonville,
                        Bilbao.</p>
                    <p class="mb-4 mb-lg-5"> <span class="d-block mb-1"><i
                                class="fi flaticon-call h2 text-primary"></i></span> <a href="tel:+00(841)966-6618"
                            class="text-body">+00 (841) 966-6618</a></p>
                    <p class="mb-0"> <span class="d-block mb-1"><i class="fi flaticon-email h2 text-primary"></i></span>
                        <a href="mailto:info@Teachermount.com" class="text-body">info@Teachermount.com</a></p>
                </div>
            </div>

        </div>
    </div>
    <!-- The Modal -->
<div class="modal" id="myModal">
  <div class="modal-dialog modal-lg modal-dialog-centered theme-modal">
    <div class="modal-content">
 <!-- Modal body -->
      <div class="modal-body text-center py-5">
        <span class="d-block mb-4"><i class="fi flaticon-thumb-up display-1 text-primary contact-us-icon"></i></span>
        <h2 class="font-weight-bold mb-3 h1">THANK YOU!</h2>
        <p class="text-black mb-4">Thanks for contacting us. Our team will contact soon.</p>
        <button class="btn btn-primary">GO Back</button>
      </div>
    </div>
  </div>
</div>
    
</section>
@endsection
