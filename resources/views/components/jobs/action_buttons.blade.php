<ul class="list-inline d-flex justify-content-end mb-0">
    <li class="list-inline-item">@include('components.apply-job-buttons', ['id'=>$job->id,'slug' => $job->slug,'entityData' =>$job??[]])</li>
    @role('jobseeker')
    <li class="list-inline-item">@include('components.favourit-job-buttons', ['id'=>$job->id,'entityData' =>$job??[]])</li>
    @endrole
    <li class="list-inline-item">@include('components.share-job-buttons', ['id'=>$job->id,'entityData' =>$job??[]])</li>
    @role('jobseeker')
    <li class="list-inline-item">@include('components.report_button', ['id'=>$job->id,'entityData' =>$job??[], 'entity' => 'employerJob'])</li>
    @endrole



</ul>
