@extends('layouts.front')

@section('content')
    <div class="container mt-5 pb-xl-2 contact_benner">
        <div class="job_top_banner bg_frame position-relative">
            <img src="{{ asset('images/about_banner.png') }}" alt="fea_img" width="100%" class="inner_banner">
            <h1 class="my-3 my-lg-5 text-center position-relative text-secondary">Contact Us</h1>
            <div class="desktop_contact_img d-none d-xl-block">
                <img src="{{ asset('images/left-side.png') }}" alt="fea_img" class="left_side">
                <img src="{{ asset('images/right-side.png') }}" alt="fea_img" class="right_side">
            </div>
        </div>
    </div>
    <section class="my-5">
        <div class="container contact_us_wraper work_step_wraper mt-0">
            <div class="row">
                {{-- <div class="col-lg-6"> --}}
                    {{-- <div class="inner_wraper h-auto">
                        <span class="icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="60" height="60" viewBox="0 0 60 60"
                                fill="none">
                                <circle opacity="0.05" cx="30" cy="30" r="30" fill="#1934BD" />
                                <path
                                    d="M30 31.25C32.0711 31.25 33.75 29.5711 33.75 27.5C33.75 25.4289 32.0711 23.75 30 23.75C27.9289 23.75 26.25 25.4289 26.25 27.5C26.25 29.5711 27.9289 31.25 30 31.25Z"
                                    stroke="#357de8" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                <path
                                    d="M30 42.5C35 37.5 40 33.0228 40 27.5C40 21.9772 35.5228 17.5 30 17.5C24.4772 17.5 20 21.9772 20 27.5C20 33.0228 25 37.5 30 42.5Z"
                                    stroke="#357de8" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </span>
                        <div class="ml-4">
                            <h3>Location</h3>
                            <p class="mb-0">Ministry of Education and Youth <br class="d-none d-lg-block">
                                2-4 National Heroes Circle <br class="d-none d-lg-block">
                                Kingston 4</p>
                        </div>
                    </div> --}}
                    {{-- <div class="inner_wraper align-items-center h-auto">
                        <span class="icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="60" height="60" viewBox="0 0 60 60"
                                fill="none">
                                <circle opacity="0.05" cx="30" cy="30" r="30" fill="#1934BD" />
                                <path
                                    d="M17.5 23.75L27.7061 30.8943C28.5326 31.4728 28.9458 31.7621 29.3953 31.8741C29.7924 31.9731 30.2076 31.9731 30.6047 31.8741C31.0542 31.7621 31.4674 31.4728 32.2938 30.8943L42.5 23.75M23.5 40H36.5C38.6002 40 39.6503 40 40.4525 39.5913C41.1581 39.2317 41.7317 38.6581 42.0913 37.9525C42.5 37.1503 42.5 36.1002 42.5 34V26C42.5 23.8998 42.5 22.8497 42.0913 22.0475C41.7317 21.3419 41.1581 20.7683 40.4525 20.4087C39.6503 20 38.6002 20 36.5 20H23.5C21.3998 20 20.3497 20 19.5475 20.4087C18.8419 20.7683 18.2683 21.3419 17.9087 22.0475C17.5 22.8497 17.5 23.8998 17.5 26V34C17.5 36.1002 17.5 37.1503 17.9087 37.9525C18.2683 38.6581 18.8419 39.2317 19.5475 39.5913C20.3497 40 21.3998 40 23.5 40Z"
                                    stroke="#357de8" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </span>
                        <div class="ml-4">
                            <h3>E-mail</h3>
                            <a href="mailto:communications@moey.gov.jm" class="">info@jobtrendsindia.com</a>
                        </div>
                    </div>
                    <div class="inner_wraper align-items-center h-auto">
                        <span class="icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="60" height="60" viewBox="0 0 60 60"
                                fill="none">
                                <circle opacity="0.05" cx="30" cy="30" r="30" fill="#1934BD" />
                                <path
                                    d="M25.4753 26.0664C26.3453 27.8785 27.5313 29.5768 29.0333 31.0787C30.5353 32.5807 32.2336 33.7667 34.0456 34.6367C34.2015 34.7115 34.2794 34.749 34.378 34.7777C34.7284 34.8799 35.1588 34.8065 35.4556 34.594C35.5391 34.5342 35.6105 34.4627 35.7534 34.3198C36.1904 33.8828 36.4089 33.6643 36.6286 33.5215C37.4573 32.9827 38.5255 32.9827 39.3541 33.5215C39.5738 33.6643 39.7923 33.8828 40.2293 34.3198L40.4729 34.5634C41.1372 35.2277 41.4694 35.5599 41.6498 35.9166C42.0086 36.626 42.0086 37.4639 41.6498 38.1733C41.4694 38.5301 41.1372 38.8622 40.4729 39.5265L40.2759 39.7236C39.6138 40.3856 39.2828 40.7166 38.8328 40.9694C38.3334 41.2499 37.5578 41.4516 36.985 41.4499C36.4688 41.4484 36.1161 41.3483 35.4105 41.148C31.6188 40.0718 28.0408 38.0412 25.0558 35.0562C22.0708 32.0712 20.0403 28.4933 18.964 24.7015C18.7638 23.996 18.6637 23.6432 18.6621 23.127C18.6604 22.5543 18.8621 21.7786 19.1426 21.2793C19.3955 20.8292 19.7265 20.4982 20.3885 19.8362L20.5855 19.6391C21.2498 18.9748 21.582 18.6427 21.9387 18.4622C22.6482 18.1034 23.486 18.1034 24.1955 18.4622C24.5522 18.6427 24.8843 18.9748 25.5486 19.6391L25.7922 19.8827C26.2292 20.3197 26.4477 20.5382 26.5906 20.7579C27.1293 21.5866 27.1293 22.6548 26.5906 23.4834C26.4477 23.7031 26.2292 23.9216 25.7922 24.3586C25.6493 24.5015 25.5779 24.573 25.5181 24.6565C25.3056 24.9533 25.2322 25.3836 25.3343 25.734C25.3631 25.8327 25.4005 25.9106 25.4753 26.0664Z"
                                    stroke="#357de8" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </span>
                        <div class="ml-4">
                            <h3>Phone</h3>
                            <a href="tel:876 612-5700" class="">+91 835 594 6534</a>
                        </div>
                    </div> --}}
                {{-- </div> --}}
                <div class="col-lg-6">
                    <form name="contact-form" action="{{ route('contact-email') }}" method="get" id="frm-Inquiry">
                        @csrf
                        <div class="row mx-0">
                            <div class="col-md-12">
                                <div class="form-group mb-4">
                                    <label>{{ trans('label.who_are_you') }} <span style="color: red;">*</span></label>
                                    <select name="role" id="roleSelect" class="form-control">
                                        <option value="Jobseeker">{{ trans('label.jobseeker') }}</option>
                                        <option value="Employer">{{ trans('label.employers') }}</option>
                                        <option value="Other">{{ trans('label.other') }}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12" id="companyField" style="display: none;">
                                <div class="form-group mb-4">
                                    <label>{{ trans('label.company') }}<span style="color: red;">*</span></label>
                                    <input type="text" class="form-control" placeholder="{{ trans('label.company') }}"
                                        name="company">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group mb-4">
                                    <label>{{ trans('label.name') }}<span style="color: red;">*</span></label>
                                    <input type="text" class="form-control" placeholder="{{ trans('label.name') }}"
                                        name="name">
                                </div>
                            </div>
                            {{-- <div class="col-md-6">
                                <div class="form-group mb-4">
                                    <label>{{ trans('label.email') }}<span style="color: red;">*</span></label>
                                    <input type="text" class="form-control" placeholder="{{ trans('label.email') }}"
                                        name="email">
                                </div>
                            </div> --}}
                            <div class="col-md-6">
                                <div class="form-group mb-4">
                                    <label>{{ trans('label.email') }}<span style="color: red;">*</span></label>
                                    <input type="text" class="form-control" placeholder="{{ trans('label.email') }}" name="email" id="email">
                                    <div class="email-error"></div>
                                </div>
                            </div>
                            {{-- <div class="col-md-6">
                                <div class="form-group mb-4">
                                    <label>{{ trans('label.phone_number') }}<span style="color: red;">*</span></label>
                                    <input type="text" class="form-control"
                                        placeholder="{{ trans('label.phone_number') }}" name="phone">
                                </div>
                            </div> --}}
                            <div class="col-md-6">
                                <div class="form-group mb-4">
                                    <label>{{ trans('label.phone_number') }}<span style="color: red;">*</span></label>
                                    <input type="text" class="form-control" placeholder="{{ trans('label.phone_number') }}" name="phone" id="phone" required>
                                    <div class="phone-error"></div>
                                </div>
                            </div>

                            {{-- <div class="col-md-6">
                            <div class="form-group mb-4">
                                <input type="text" class="form-control" placeholder="{{trans('label.location')}}" name="location">
                            </div>
                        </div> --}}
                            <div class="col-md-12">
                                <div class="form-group mb-4">
                                    <label>{{ trans('label.description') }}<span style="color: red;">*</span></label>
                                    <textarea id="" cols="30" rows="4" class="form-control"
                                        placeholder="{{ trans('label.description') }}" name="description"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex justify-content-between align-items-center mb-4 px-3 flex-wrap">
                            <div id="captcha_element" class="google-captcha">

                            </div>
                            <span class="recaptcha-error text-danger"></span>
                            <div class="">
                                <input type="Submit" class="btn btn-primary" id="inquiry_btn" value="Submit">
                            </div>

                        </div>
                    </form>
                </div>

                {{-- <div class="col-lg-6 pl-xl-5">
                <div class="item-box p-4 p-lg-5">
                    <h3 class="mb-4 mb-lg-2 font-weight-bold">{{__('label.contact_info')}}</h3>
                    <p class=" ">{{$tagLine??''}}</p>
                    <p class="mb-4 mb-lg-5"> <span class="d-block mb-1"><i
                                class="fi flaticon-pin h2 text-primary"></i></span> {{$location??''}}</p>
                    <p class="mb-4 mb-lg-5"> <span class="d-block mb-1"><i
                                class="fi flaticon-call h2 text-primary"></i></span> <a href="tel:{{$location??''}}"
                            class="text-body">{{$phone??''}}</a></p>
                    <p class="mb-0"> <span class="d-block mb-1"><i class="fi flaticon-email h2 text-primary"></i></span>
                        <a href="mailto:{{$email??''}}" class="text-body">{{$email??''}}</a></p>
                </div>
            </div> --}}
            </div>
        </div>
    </section>
    <!-- The Modal -->
    <div class="modal" id="contactSuccess">
        <div class="modal-dialog modal-lg modal-dialog-centered theme-modal">
            <div class="modal-content">
                <!-- Modal body -->
                <div class="modal-body text-center py-50">
                    <span class="d-block mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" width="150" height="150" viewBox="0 0 150 150" fill="none">
                            <circle opacity="0.03" cx="75" cy="75" r="75" fill="#357DE8"/>
                            <circle opacity="0.03" cx="75" cy="75" r="60" fill="#357DE8"/>
                            <g clip-path="url(#clip0_739_2176)">
                            <path d="M89.6771 58.8057H86.7417C85.9305 58.8057 85.2739 59.4621 85.2739 60.2734C85.2739 61.0847 85.9304 61.7412 86.7417 61.7412H89.6771C90.4884 61.7412 91.1449 61.0848 91.1449 60.2734C91.1448 59.4621 90.4884 58.8057 89.6771 58.8057Z" fill="#357DE8"/>
                            <path d="M74.8451 53.746L73.3775 50.8105C73.012 50.0853 72.1333 49.7943 71.408 50.1541C70.6827 50.5167 70.3889 51.3982 70.7516 52.1235L72.2194 55.059C72.5815 55.7813 73.4586 56.0781 74.1888 55.7154C74.9139 55.3528 75.2077 54.4713 74.8451 53.746Z" fill="#357DE8"/>
                            <path d="M84.4626 50.1541C83.7402 49.7943 82.8559 50.0853 82.4932 50.8105L81.0254 53.746C80.6628 54.4713 80.9567 55.3527 81.6819 55.7154C82.4142 56.0791 83.2903 55.7789 83.6513 55.059L85.1191 52.1235C85.4817 51.3982 85.1878 50.5167 84.4626 50.1541Z" fill="#357DE8"/>
                            <path d="M69.1293 58.8057H66.1938C65.3826 58.8057 64.7261 59.4621 64.7261 60.2734C64.7261 61.0847 65.3825 61.7412 66.1938 61.7412H69.1293C69.9405 61.7412 70.5971 61.0848 70.5971 60.2734C70.5971 59.4621 69.9405 58.8057 69.1293 58.8057Z" fill="#357DE8"/>
                            <path d="M60.3226 73.5808H54.4517C53.6411 73.5808 52.9839 74.2379 52.9839 75.0486V98.5321C52.9839 99.3427 53.641 99.9999 54.4517 99.9999H60.3225C61.1331 99.9999 61.7903 99.3428 61.7903 98.5321V75.0485C61.7903 74.2379 61.1333 73.5808 60.3226 73.5808Z" fill="#357DE8"/>
                            <path d="M96.9869 77.4714C96.728 75.1946 94.6011 73.5808 92.3096 73.5808H80.8668C81.8392 71.8395 82.3612 66.9144 82.3381 64.9025C82.2997 61.5722 79.5418 58.9035 76.2114 58.9035H75.0003C74.189 58.9035 73.5325 59.5599 73.5325 60.3713C73.5325 63.7653 72.2109 69.8915 69.7184 72.384C68.0408 74.0617 66.6066 74.6696 64.7261 75.6094V97.6326C67.6053 98.5923 71.2609 100 76.8329 100H86.434C89.5976 100 92.0615 97.07 90.8356 93.9743C92.7033 93.4655 94.0806 91.7527 94.0806 89.7259C94.0806 89.1539 93.9703 88.6065 93.771 88.1033C96.9184 87.2458 98.0769 83.3596 95.8924 80.9195C96.695 80.0229 97.1375 78.7965 96.9869 77.4714Z" fill="#357DE8"/>
                            </g>
                            <defs>
                            <clipPath id="clip0_739_2176">
                            <rect width="50" height="50" fill="white" transform="translate(50 50)"/>
                            </clipPath>
                            </defs>
                        </svg>
                    </span>
                    <h2 class="font-weight-bold mb-3 h1">{{ __('label.thank_you') }}</h2>
                    <p class="text-black mb-4">{{ __('label.thanks') }}</p>
                    <button class="btn btn-primary mx-auto" data-dismiss="modal">{{ __('label.go_back') }}</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('page_scripts')
    <script>
        // $(document).ready(function() {
        //     $('#roleSelect').change(function() {
        //         var selectedOption = $(this).val();
        //         if (selectedOption === 'Employer') {
        //             $('#companyField').show();
        //         } else {
        //             $('#companyField').hide();
        //         }
        //     });
        // });
        $(document).ready(function() {
            $('#roleSelect').change(function() {
                var selectedOption = $(this).val();
                if (selectedOption === 'Employer') {
                    $('#companyField').show();
                    $('#companyField input').attr('required', true);
                } else {
                    $('#companyField').hide();
                    $('#companyField input').removeAttr('required');
                }
            });

            // Rest of your code...
        });
    </script>
    <script>
        $(document).ready(function() {
            if ("{{ old('success', null) }}" == "1") {
                $('#contactSuccess').modal("show")
            }
        });
    </script>
    <script src="{{ asset('js/validation/contact.js') }}"></script>
    @include('auth.verification.captcha_script')
@endpush
