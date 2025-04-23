{{-- <div class="col-lg-4 col-6">
    @widget('DashboardList', [
        'module' => 'sales',
        'heading' => 'Sales',
        'icon' => '<i class="fa fa-dollar-sign"></i>',
        'sign' => '$',
        'color' => 'teal'
    ])
</div> --}}
<div class="col-lg-4 col-6">
    @widget('DashboardList', [
        'module' => 'employerJob',
        'heading' => 'Jobs Posted',
        'icon' => ' <i class="fa fa-briefcase"></i>',
        'sign' => '',
        'color' => 'green'
    ])
</div>
<div class="col-lg-4 col-6">
    @widget('DashboardList', [
        'module' => 'employer',
        'heading' => 'Employer Registered',
        'icon' => '<i class="fa fa-user-tie"></i>',
        'sign' => '',
        'color' => 'purple'
    ])
</div>

<div class="col-lg-4 col-6">
    @widget('DashboardList', [
        'module' => 'jobseeker',
        'heading' => 'Jobseeker Registered',
        'icon' => '<i class="fa fa-user"></i>',
        'sign' => '',
        'color' => 'red'
    ])
</div>

<div class="col-lg-4 col-6">
    @widget('DashboardList', [
        'module' => 'applyJob',
        'heading' => 'Application Sent',
        'icon' => ' <i class="fa fa-paper-plane"></i>',
        'sign' => '',
        'color' => 'blue'
    ])
</div>

<div class="col-lg-4 col-6">
    @widget('DashboardList', [
        'module' => 'jobAlert',
        'heading' => 'Job Alerts Created',
        'icon' => '<i class="fa fa-envelope"></i>',
        'sign' => '',
        'color' => 'orange'
    ])
</div>
