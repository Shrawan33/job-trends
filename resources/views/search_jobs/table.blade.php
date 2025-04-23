@section('third_party_stylesheets')
    @include('layouts.datatables_css')
@endsection

{{-- <div class="row job_listing">
    <div class="col-md-5 left_side p-3 border-right">
        <div class="d-flex align-items-center justify-content-between mb-3">
            <p class="mb-2 mb-md-0">Showing 1-10 of 38 results</p>
            <form>
                <div class="form-group mb-0">
                    <select class="form-control no-select2 py-2" name="message_type">
                        <option value="1" selected="selected">Newest</option>
                        <option value="2">Oldest</option>
                    </select>
                </div>
            </form>
        </div>
        <div class="mb-3">
            <a href="#" class="btn btn-primary ">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="12" viewBox="0 0 16 12" fill="none">
                    <path d="M14.3333 10L9.90477 6.00002M6.09525 6.00002L1.6667 10M1.33334 2.66669L6.77662 6.47698C7.2174 6.78553 7.43779 6.9398 7.67752 6.99956C7.88927 7.05234 8.11075 7.05234 8.3225 6.99956C8.56223 6.9398 8.78262 6.78553 9.2234 6.47698L14.6667 2.66669M4.53334 11.3334H11.4667C12.5868 11.3334 13.1468 11.3334 13.5747 11.1154C13.951 10.9236 14.2569 10.6177 14.4487 10.2413C14.6667 9.81351 14.6667 9.25346 14.6667 8.13335V3.86669C14.6667 2.74658 14.6667 2.18653 14.4487 1.75871C14.2569 1.38238 13.951 1.07642 13.5747 0.884674C13.1468 0.666687 12.5868 0.666687 11.4667 0.666687H4.53334C3.41324 0.666687 2.85319 0.666687 2.42536 0.884674C2.04904 1.07642 1.74308 1.38238 1.55133 1.75871C1.33334 2.18653 1.33334 2.74658 1.33334 3.86669V8.13335C1.33334 9.25346 1.33334 9.81351 1.55133 10.2413C1.74308 10.6177 2.04904 10.9236 2.42536 11.1154C2.85319 11.3334 3.41324 11.3334 4.53334 11.3334Z" stroke="#FFF" stroke-linecap="round" stroke-linejoin="round"></path>
                </svg>
                Get Jobs Alerts</a>
        </div>
        <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
            <button class="nav-link active" id="v-pills-home-tab" data-toggle="pill" data-target="#v-pills-home" type="button" role="tab" aria-controls="v-pills-home" aria-selected="true">
                <img src="{{ asset('images/favicon.png') }}" alt="fea_img" width="50px" class="place_logo">
                <div class="ml-3">
                    <h3>Human Resource Admin</h3>
                    <h4 class="post_info">Posted by <span class=""><a href="">Brurecruit</a></span> • a day ago</h4>
                    <p class="package mb-0">1200 / Monthly</p>
                </div>
                <svg xmlns="http://www.w3.org/2000/svg" width="8" height="14" viewBox="0 0 8 14" fill="none" class="right_arrow">
                    <path d="M1 13L7 7L1 1" stroke="#357de8" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                </svg>
            </button>
            <button class="nav-link" id="v-pills-profile-tab" data-toggle="pill" data-target="#v-pills-profile" type="button" role="tab" aria-controls="v-pills-profile" aria-selected="false">
                <img src="{{ asset('images/favicon.png') }}" alt="fea_img" width="50px" class="place_logo">
                <div class="ml-3">
                    <h3>Senior Liaison Officer</h3>
                    <h4 class="post_info">Posted by <span class=""><a href="">Brurecruit</a></span> • a day ago</h4>
                    <p class="package mb-0">1200 / Monthly</p>
                </div>
                <svg xmlns="http://www.w3.org/2000/svg" width="8" height="14" viewBox="0 0 8 14" fill="none" class="right_arrow">
                    <path d="M1 13L7 7L1 1" stroke="#357de8" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                </svg>
            </button>
            <button class="nav-link" id="v-pills-messages-tab" data-toggle="pill" data-target="#v-pills-messages" type="button" role="tab" aria-controls="v-pills-messages" aria-selected="false">
                <img src="{{ asset('images/favicon.png') }}" alt="fea_img" width="50px" class="place_logo">
                <div class="ml-3">
                    <h3>HSE Coordinator</h3>
                    <h4 class="post_info">Posted by <span class=""><a href="">Brurecruit</a></span> • a day ago</h4>
                    <p class="package mb-0">1200 / Monthly</p>
                </div>
                <svg xmlns="http://www.w3.org/2000/svg" width="8" height="14" viewBox="0 0 8 14" fill="none" class="right_arrow">
                    <path d="M1 13L7 7L1 1" stroke="#357de8" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                </svg>
            </button>
            <button class="nav-link" id="v-pills-settings-tab" data-toggle="pill" data-target="#v-pills-settings" type="button" role="tab" aria-controls="v-pills-settings" aria-selected="false">
                <img src="{{ asset('images/favicon.png') }}" alt="fea_img" width="50px" class="place_logo">
                <div class="ml-3">
                    <h3>HR Officer</h3>
                    <h4 class="post_info">Posted by <span class=""><a href="">Brurecruit</a></span> • a day ago</h4>
                    <p class="package mb-0">1200 / Monthly</p>
                </div>
                <svg xmlns="http://www.w3.org/2000/svg" width="8" height="14" viewBox="0 0 8 14" fill="none" class="right_arrow">
                    <path d="M1 13L7 7L1 1" stroke="#357de8" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                </svg>
            </button>
        </div>
    </div>
    <div class="col-md-7 right_side p-3">
        <div class="tab-content" id="v-pills-tabContent">
            <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
                <div class="d-flex align-items-center justify-content-between mb-4 flex-wrap">
                    <div>
                        <h3>HR Officer</h3>
                        <h4 class="post_info">Posted by <span class=""><a href="">Brurecruit</a></span> • a day ago</h4>
                    </div>
                    <div class="d-flex mt-3 mt-lg-0">
                        <a href="#" class="social_btn">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="18" viewBox="0 0 20 18" fill="none">
                                <path d="M13.4253 1.5C16.3605 1.5 18.3327 4.29375 18.3327 6.9C18.3327 12.1781 10.1475 16.5 9.99935 16.5C9.8512 16.5 1.66602 12.1781 1.66602 6.9C1.66602 4.29375 3.63824 1.5 6.57342 1.5C8.25861 1.5 9.36046 2.35312 9.99935 3.10312C10.6382 2.35312 11.7401 1.5 13.4253 1.5Z" stroke="#717884" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </a>
                        <a href="#" class="btn btn-primary ml-2 btn-sm">View Detail</a>
                    </div>
                </div>
                <div class="detail_info_box p-3 border">
                    <div class="row">
                        <div class="col-6 col-lg-3 mb-3">
                            <span>Location</span>
                            <p>KB City</p>
                        </div>
                        <div class="col-6 col-lg-3 mb-3">
                            <span>Salary Offered</span>
                            <p>1200 / Monthly</p>
                        </div>
                        <div class="col-6 col-lg-3 mb-3">
                            <span>Urgency</span>
                            <p>Within a month</p>
                        </div>
                        <div class="col-6 col-lg-3 mb-3">
                            <span>Experience</span>
                            <p>2-3</p>
                        </div>
                        <div class="col-6 col-lg-3 mb-3 mb-lg-0">
                            <span>Work Type</span>
                            <p>Contract</p>
                        </div>
                        <div class="col-6 col-lg-3 mb-3 mb-lg-0">
                            <span>Category</span>
                            <p>Transport</p>
                        </div>
                        <div class="col-6 col-lg-3 mb-3 mb-lg-0">
                            <span>No. Of Opening</span>
                            <p>1</p>
                        </div>
                        <div class="col-6 col-lg-3 mb-3 mb-lg-0">
                            <span>Expiration Date</span>
                            <p>28/02/2023</p>
                        </div>
                    </div>
                </div>
                <div class="inner_box border-bottom pt-4 pb-2">
                    <h3>Job Description</h3>
                    <ul class="pl-4">
                        <li>Preparing job descriptions, advertising vacant positions, and managing the employment process.</li>
                        <li>Orientating new employees and training existing employees.</li>
                        <li>Monitoring employee performance.</li>
                        <li>Ensuring that all employees are organized and satisfied in their work environment.</li>
                        <li>Overseeing the health and safety of all employees.</li>
                        <li>Implementing systematic staff development procedures.</li>
                        <li>Providing counseling on policies and procedures.</li>
                        <li>Ensuring meticulous implementation of payroll and benefits administration.</li>
                    </ul>
                </div>
                <div class="inner_box border-bottom pt-4 pb-2">
                    <h3>Other requirements</h3>
                    <ul class="pl-4">
                        <li>Overseeing the health and safety of all employees.</li>
                        <li>Implementing systematic staff development procedures.</li>
                        <li>Providing counseling on policies and procedures.</li>
                        <li>Ensuring meticulous implementation of payroll and benefits administration.</li>
                    </ul>
                </div>
                <div class="inner_box border-bottom pt-4 pb-2">
                    <h3>Skills</h3>
                    <ul class="pl-4">
                        <li>administration skill</li>
                        <li>interpersonal skill</li>
                        <li>People Skill</li>
                        <li>communication skill</li>
                    </ul>
                </div>
                <div class="inner_box border-bottom pt-4 pb-2">
                    <h3>Education</h3>
                    <ul class="pl-4">
                        <li>Diploma </li>
                        <li>degree</li>
                    </ul>
                </div>
                <div class="inner_box border-bottom pt-4 pb-2">
                    <h3>Training & Certificates</h3>
                    <ul class="pl-4">
                        <li>tisaf</li>
                    </ul>
                </div>
                <div class="inner_box border-bottom pt-4 pb-2">
                    <h3>Additional Compensation</h3>
                    <ul class="pl-4">
                        <li>Performance Bonus</li>
                        <li>Yearly Bonus</li>
                    </ul>
                </div>
                <div class="inner_box pt-4 pb-2">
                    <h3>Additional Benefits</h3>
                    <ul class="pl-4">
                        <li>Work From Home</li>
                    </ul>
                </div>
            </div>
            <div class="tab-pane fade" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">ghfjhjj</div>
            <div class="tab-pane fade" id="v-pills-messages" role="tabpanel" aria-labelledby="v-pills-messages-tab">tyuyiui</div>
            <div class="tab-pane fade" id="v-pills-settings" role="tabpanel" aria-labelledby="v-pills-settings-tab">jhkkhj</div>
          </div>
    </div>
</div> --}}



<div class="row job_listing job-list" id="load">
    {{-- <div class="col-md-3 border-right filter-list">
        @includeFirst([$entity['view'].'.refine_search', 'components.search'], ['form_id' => isset($entity['targetModel']) ? "search-{$entity['targetModel']}" : 'search-form'])
    </div> --}}


    @include('search_jobs.list-job')

    @section('third_party_scripts')
        @include('vendor.job.search', ['id' => isset($entity['targetModel']) ? "{$entity['targetModel']}-datatable" : 'dataTableBuilder', 'form_id' => isset($entity['targetModel']) ? "search-{$entity['targetModel']}" : 'search-form',])
    @endsection

