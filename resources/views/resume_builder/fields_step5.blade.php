{!! Form::hidden('step', $step) !!}
<div class="row mt-20">
    <div class="col-lg-10 mx-auto">
        <div class="congratulation_box_wrapper text-center">
            <span class="d-inline-block mb-40">
              <svg xmlns="http://www.w3.org/2000/svg" width="160" height="160" viewBox="0 0 160 160" fill="none">
                <path opacity="0.1" d="M80 0C35.8862 0 0 35.8862 0 80C0 124.114 35.8862 160 80 160C124.114 160 160 124.114 160 80C160 35.8862 124.114 0 80 0Z" fill="#357DE8"/>
                <path opacity="0.1" d="M80 20C46.9147 20 20 46.9147 20 80C20 113.085 46.9147 140 80 140C113.085 140 140 113.085 140 80C140 46.9147 113.085 20 80 20Z" fill="#357DE8"/>
                <path d="M80 40C57.9431 40 40 57.9431 40 80C40 102.057 57.9431 120 80 120C102.057 120 120 102.057 120 80C120 57.9431 102.057 40 80 40Z" fill="#357DE8"/>
                <path d="M101.002 71.6238L78.8749 93.0344C78.2111 93.6767 77.3397 94 76.4683 94C75.5969 94 74.7256 93.6767 74.0617 93.0344L62.9985 82.3291C61.6672 81.0413 61.6672 78.9593 62.9985 77.6715C64.3293 76.3832 66.4804 76.3832 67.8118 77.6715L76.4683 86.0481L96.1887 66.9662C97.5195 65.6779 99.6705 65.6779 101.002 66.9662C102.333 68.254 102.333 70.3354 101.002 71.6238Z" fill="#FAFAFA"/>
              </svg>
            </span>
            <h1 class="text-center mb-30">Congratulation! Your Smart Resume Created Successfully</h1>
        </div>
    </div>
</div>
<div class="row mt-60 mb-10">
  <div class="col-lg-3 col-md-6 col-12 mb-lg-0 mb-4">
    <div class="cong-box-wrapper p-3 h-100 d-flex flex-column">
        <span class="icon-wrap mb-25">
            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 30 30" fill="none">
                <path d="M24.1406 24.375C24.1406 25.6694 23.0913 26.7188 21.7969 26.7188H3.51562C2.22123 26.7188 1.17188 25.6694 1.17188 24.375V12.6562C1.17188 11.3619 2.22123 10.3125 3.51562 10.3125H21.7969C23.0913 10.3125 24.1406 11.3619 24.1406 12.6562V24.375Z" stroke="#FF7D57" stroke-width="2" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                <path d="M24.1406 15H1.17188" stroke="#FF7D57" stroke-width="2" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                <path d="M14.7656 22.0312H19.4531" stroke="#FF7D57" stroke-width="2" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                <path d="M5.85938 10.3125V5.625C5.85938 4.33061 6.90873 3.28125 8.20312 3.28125H26.4844C27.7788 3.28125 28.8281 4.33061 28.8281 5.625V17.3438C28.8281 18.6381 27.7788 19.6875 26.4844 19.6875H24.1406" stroke="#FF7D57" stroke-width="2" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
        </span>
        <h3 class="mb-25">I Need Professional<br> Writer's Help</h3>
        <a href="{{ route('subscription.service') }}" class="btn btn-primary w-100 mt-auto">Need Help?</a>
    </div>
  </div>
  {{-- <div class="col-lg-3 col-md-6 col-12 mb-lg-0 mb-4">
    <div class="cong-box-wrapper">
        <span class="icon-wrap mb-25">
            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 30 30" fill="none">
                <path d="M24.1406 24.375C24.1406 25.6694 23.0913 26.7188 21.7969 26.7188H3.51562C2.22123 26.7188 1.17188 25.6694 1.17188 24.375V12.6562C1.17188 11.3619 2.22123 10.3125 3.51562 10.3125H21.7969C23.0913 10.3125 24.1406 11.3619 24.1406 12.6562V24.375Z" stroke="#FF7D57" stroke-width="2" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                <path d="M24.1406 15H1.17188" stroke="#FF7D57" stroke-width="2" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                <path d="M14.7656 22.0312H19.4531" stroke="#FF7D57" stroke-width="2" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                <path d="M5.85938 10.3125V5.625C5.85938 4.33061 6.90873 3.28125 8.20312 3.28125H26.4844C27.7788 3.28125 28.8281 4.33061 28.8281 5.625V17.3438C28.8281 18.6381 27.7788 19.6875 26.4844 19.6875H24.1406" stroke="#FF7D57" stroke-width="2" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
        </span>
        <h3 class="mb-25">Set My Smart Resume As<br> My Profile</h3>
        <a href="{{ route('resume-builder.makePrimary', $userId ?? '') }}" class="btn btn-primary w-100">Set My Resume</a>
    </div>
  </div> --}}
  <div class="col-lg-3 col-md-6 col-12 mb-md-0 mb-4">
    <div class="cong-box-wrapper p-3 h-100 d-flex flex-column">
        <span class="icon-wrap mb-25">
            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 30 30" fill="none">
                <path d="M24.1406 24.375C24.1406 25.6694 23.0913 26.7188 21.7969 26.7188H3.51562C2.22123 26.7188 1.17188 25.6694 1.17188 24.375V12.6562C1.17188 11.3619 2.22123 10.3125 3.51562 10.3125H21.7969C23.0913 10.3125 24.1406 11.3619 24.1406 12.6562V24.375Z" stroke="#FF7D57" stroke-width="2" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                <path d="M24.1406 15H1.17188" stroke="#FF7D57" stroke-width="2" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                <path d="M14.7656 22.0312H19.4531" stroke="#FF7D57" stroke-width="2" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                <path d="M5.85938 10.3125V5.625C5.85938 4.33061 6.90873 3.28125 8.20312 3.28125H26.4844C27.7788 3.28125 28.8281 4.33061 28.8281 5.625V17.3438C28.8281 18.6381 27.7788 19.6875 26.4844 19.6875H24.1406" stroke="#FF7D57" stroke-width="2" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
        </span>
        <h3 class="mb-25">Preview My Smart Resume</h3>
        {{-- <a href="{{ route('resume-builder.editStep', ['userId' => $userId, 'step' => 1]) }}" class="btn btn-primary w-100">Preview</a> --}}
        <a href="{{ route('download-resume', $userId) }}" class="btn btn-primary mt-auto w-100" target="_blank">Preview</a>
    </div>
  </div>
  <div class="col-lg-3 col-md-6 col-12">
    <div class="cong-box-wrapper p-3 h-100 d-flex flex-column">
        <span class="icon-wrap mb-25">
            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 30 30" fill="none">
                <path d="M24.1406 24.375C24.1406 25.6694 23.0913 26.7188 21.7969 26.7188H3.51562C2.22123 26.7188 1.17188 25.6694 1.17188 24.375V12.6562C1.17188 11.3619 2.22123 10.3125 3.51562 10.3125H21.7969C23.0913 10.3125 24.1406 11.3619 24.1406 12.6562V24.375Z" stroke="#FF7D57" stroke-width="2" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                <path d="M24.1406 15H1.17188" stroke="#FF7D57" stroke-width="2" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                <path d="M14.7656 22.0312H19.4531" stroke="#FF7D57" stroke-width="2" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                <path d="M5.85938 10.3125V5.625C5.85938 4.33061 6.90873 3.28125 8.20312 3.28125H26.4844C27.7788 3.28125 28.8281 4.33061 28.8281 5.625V17.3438C28.8281 18.6381 27.7788 19.6875 26.4844 19.6875H24.1406" stroke="#FF7D57" stroke-width="2" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
        </span>
        <h3 class="mb-25">Download Resume</h3>
        <a href="{{ route('download-resume', $userId) }}" class="btn btn-primary mt-auto w-100" download>Download Resume</a>
    </div>
  </div>
  <div class="col-lg-3 col-md-6 col-12">
    <div class="cong-box-wrapper p-3 h-100 d-flex flex-column">
        <span class="icon-wrap mb-25">
            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 30 30" fill="none">
                <path d="M24.1406 24.375C24.1406 25.6694 23.0913 26.7188 21.7969 26.7188H3.51562C2.22123 26.7188 1.17188 25.6694 1.17188 24.375V12.6562C1.17188 11.3619 2.22123 10.3125 3.51562 10.3125H21.7969C23.0913 10.3125 24.1406 11.3619 24.1406 12.6562V24.375Z" stroke="#FF7D57" stroke-width="2" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                <path d="M24.1406 15H1.17188" stroke="#FF7D57" stroke-width="2" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                <path d="M14.7656 22.0312H19.4531" stroke="#FF7D57" stroke-width="2" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                <path d="M5.85938 10.3125V5.625C5.85938 4.33061 6.90873 3.28125 8.20312 3.28125H26.4844C27.7788 3.28125 28.8281 4.33061 28.8281 5.625V17.3438C28.8281 18.6381 27.7788 19.6875 26.4844 19.6875H24.1406" stroke="#FF7D57" stroke-width="2" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
        </span>
        <h3 class="mb-25">Find Jobs</h3>
        <a href="{{ route('search-jobs.index') }}" class="btn btn-primary w-100 mt-auto" >Find Jobs</a>
    </div>
  </div>
</div>
