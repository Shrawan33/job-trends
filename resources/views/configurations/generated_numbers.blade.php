<div class="row">
    <div class="col-md-12">
        <div class="card card-primary card-outline card-tabs">
            <div class="card-header p-0 pt-1 border-bottom-0">
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="pill" href="#tab_employerCode">{{trans('label.employer_no')}}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="pill" href="#tab_jobseekerCode">{{trans('label.jobseeker_no')}}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="pill" href="#tab_jobCode">{{trans('label.job_no')}}</a>
                    </li>
                </ul>
            </div>
            <div class="card-body">
                <div class="tab-content">
                    <div id="tab_employerCode" class="tab-pane fade in show active">
                        <div class="card-body">
                            @include('configurations.employer_number_fields')
                        </div>
                    </div>
                    <div id="tab_jobseekerCode" class="tab-pane fade">
                        <div class="card-body">
                            @include('configurations.jobseeker_number_fields')
                        </div>
                    </div>

                    <div id="tab_jobCode" class="tab-pane fade">
                        <div class="card-body">
                            @include('configurations.job_number_fields')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="d-none" id="modalContentForHelpToolTip">
    <div class="container" style="width: 100%; padding-bottom: 0px !important">
        <div class="card card-default">
            <div class="card-body">
                <p>{{trans('label.create_pattern')}}</p>
                <p>{{trans('label.available_var')}}</p>
                <ul id="helpModelUl">

                </ul>
                <p class="hide-client">{{trans('label.available_var')}}{{trans('label.for_ex')}} {$year}-{$counter} {{trans('label.would_be')}} {{ date('y') }}-0001</p>
            </div>
        </div>
    </div>
</div>
