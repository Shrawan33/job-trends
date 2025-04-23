

@extends('layouts.front')
@section('third_party_stylesheets')
    @include('vendor.richtexteditor.style')
    @include('vendor.image_upload.style')
    @include('vendor.dropzone.style')
@endsection
@section('content')

{!! Form::open(['route' => "cart.process.payment", 'id' => 'frm_jobseeker', 'class' => 'personal_detail_form']) !!}
{!! Form::hidden('user_id', $user->id) !!}
{!! Form::hidden('payment_status', 0) !!}
{!! Form::hidden('order_process_status', 0) !!}
{!! Form::hidden('cart_id', $cartId) !!}
{!! Form::hidden('total_amount', $cartTotal) !!}

{{-- {!! Form::hidden('cart_id', $cart) !!} --}}
{{-- @dd($cart) --}}

<div class="cart_page_main_wraper checkout_page mb-60">
    <div class="container">
        <div class="row pt-20">
            <div class="col-md-4 col-xl-7 pr-xl-80">
                <h1 class="title mb-40">Personal Details</h1>

                    <div class="row">
                        <div class="col-xl-6">
                            <div class="form-group mb-30">
                                <label for="">{{ trans('label.first_name') }}<span class="text-danger">*</span></label>
                                <input type="text" name="first_name" class="form-control @error('first_name') is-invalid @enderror" value="{{ old('first_name', $user->first_name ?? null) }}" placeholder="{{ trans('label.first_name') }}">
                                @error('first_name')
                                    <span class="error invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-xl-6">
                            <div class="form-group mb-30">
                                <label for="">{{ trans('label.last_name') }}<span class="text-danger">*</span></label>
                                <input type="text" name="last_name" class="form-control @error('last_name') is-invalid @enderror" value="{{ old('last_name', $user->last_name ?? null) }}" placeholder="{{ trans('label.last_name') }}">
                                @error('last_name')
                                    <span class="error invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-xl-6">
                            <div class="form-group mb-30 email_field">
                                <label for="">{{ trans('label.email') }}<span class="text-danger">*</span></label>
                                <input type="email" name="email" value="{{ old('email', $user->email ?? null) }}" class="form-control @error('email') is-invalid @enderror" placeholder="{{ trans('label.email') }}">
                                @error('email')
                                    <span class="error invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-xl-6">
                            <div class="form-group mb-30">
                                <label for="">{{ trans('label.phone_number') }}<span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <input type="text" name="phone_number" class="form-control @error('phone_number') is-invalid @enderror" value="{{ old('phone_number', $user->phone_number ?? null) }}" placeholder="{{ trans('label.phone_number') }}">
                                </div>
                                @error('phone_number')
                                    <span class="error invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        {{-- @dd($seekerDetail->state_id); --}}
                        <div class="form-group mb-4 col-md-6 col-lg-4">
                            <label for="">{{ trans('label.state') }}</label><span class="text-danger">*</span>
                            @include('components.state', ['states' => $states, 'selected' => $seekerDetail->state_id])
                            @error('state_id')
                                <span class="error invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group mb-4 col-md-6 col-lg-4">
                            <label for="">{{ trans('label.city') }}</label><span class="text-danger">*</span>
                            @include('components.location', [
                                'locations' => $locations,
                                'selected' => $seekerDetail->location_id,
                                'required' => $required ?? false,
                            ])
                            @error('location_id')
                                <span class="error invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-xl-4">
                            <div class="form-group mb-30">
                                <label for="">Postal Code</label>
                                <input type="text" name="postal_code" class="form-control @error('postal_code') is-invalid @enderror" value="">
                                @error('postal_code')
                                    <span class="error invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        {{-- <div class="col-12">
                            <div class="form-group mb-30 term_condition">
                                <input type="checkbox" name="author" id="author" value="1" class="" placeholder="tc_checkbox">
                                <label for="author">Create Another</label>
                            </div>
                        </div> --}}
                    </div>

            </div>
            <div class="col-md-8 col-xl-5">
                <div class="info_inner_box py-25 py-lg-40">
                    <h1 class="title mb-30 px-25 px-lg-40">Package Information</h1>
                    <div class="d-flex align-items-center justify-content-between pb-20 border-bottom px-25 px-lg-40">
                        <span>Package</span>
                        <span>Total</span>
                    </div>
                    <div class="content px-25 px-lg-40 border-bottom">
                        @if ($cart)
                            <div class="content px-25 px-lg-40 border-bottom">
                                @foreach ($cart as $item)
                                    <div class="items d-flex justify-content-between py-30">
                                        <div>
                                            <p class="mb-10">{{$item['title']}} <span>(× {{$item['quantity']}})</span></p>
                                            <span class="exp">{{$item['package_info']['description']}}</span>
                                        </div>
                                        <p class="mb-0">{{$item['price']}}</p>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>
                    <div class="total_wraper px-25 px-lg-40">

                        <div class="d-flex justify-content-between my-20">
                            <p class="mb-0">Sub Total</p>
                            <p class="mb-0 price text-secondary font-weight-bold">₹ {{$cartTotal}}</p>
                        </div>
                        <div class="d-flex justify-content-between mb-40">
                            <p class="mb-0 font-weight-bold">Total (Including of all taxes)</p>
                            <p class="mb-0 price text-secondary font-weight-bold">₹ {{$cartTotal}}</p>
                        </div>

                        @if ($user_type == 'jobseekers' && $product_type != 2)
                            <form>
                                <div class="form-group mb-30">
                                    <label for="">{{ trans('label.payment_comment') }}</label>
                                    <textarea class="form-control @error('comment') is-invalid @enderror" rows="1" name="comment" cols="50"></textarea>
                                    @error('comment')
                                        <div class="error invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group mb-40">
                                    <label class="mb-0" for="">{{ trans('label.resume_attchments') }}</label>
                                    @include('vendor.dropzone.upload', [
                                        'form_id' => 'frm_jobseeker',
                                        'dropzone_id' => 'resume-document-dropzone',
                                        'disk' => $entity['disk'],
                                        'documents' => old(
                                            'document',
                                            isset($orderDetail) && $orderDetail->orderDocuments ? $orderDetail->orderDocuments->toArray() : []),
                                        'maxFiles' => 1,
                                        'acceptedFileType' => 'pdf',
                                        'link_text' => 'Upload Resume  (file size 1 MB only)&nbsp;<small class="red">*</small>',
                                    ])
                                </div>
                            </form>
                        @endif

                        <div class="form-group mb-25 term_condition">
                            <input type="checkbox" name="tc_checkbox" id="tc_checkbox" value="1" class="form-control @error('tc_checkbox') is-invalid @enderror" placeholder="tc_checkbox">
                            <label for="tc_checkbox">
                                By checking this box you are agree with our <a class="open-form" href="javascript:void(0)" data-mode="show" data-modal-size="modal-lg" data-model="employerJobs" data-url="https://jobi.thatsmytask.com/job-trends/public/terms-condition" title="">Terms &amp;
                                    Conditions</a>
                            </label>
                            @error('tc_checkbox')
                                <div class="error invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <button class="btn btn-primary w-100 text-center">Pay Now</button>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
</form>
@section('third_party_scripts')
    @include('vendor.richtexteditor.script')
    @include('vendor.image_upload.script')
    @include('vendor.dropzone.script')
@endsection
<script>
    $(".custom-file-input").on("change", function() {
        var fileName = $(this).val().split("\\").pop();
        $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
    });
    // document.addEventListener("contextmenu", function (e) {
    //     e.preventDefault(); // Prevent the default right-click behavior
    // });
</script>
@endsection
