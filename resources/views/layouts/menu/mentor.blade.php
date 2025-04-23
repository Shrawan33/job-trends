{{-- <li class="nav-item">

    <a href="{{ route('mentor_candidates.index') }}" class="nav-link {{ Request::is('*mentor_candidates.index*') ? 'active' : '' }}">
        <i class="fa fa-user nav-icon"></i>
        <p>{!! __('label.candidates') !!}</p>
    </a>
</li> --}}
<li class="nav-item">
    <a href="{{ route('job-posting-mentor.index') }}"
       class="nav-link {{ Request::is('*job-posting-mentor*') ? 'active' : '' }}">
       <i class="fa fa-clipboard nav-icon"></i>
        <p>{!! __('label.job_posting') !!}</p>
    </a>
</li>
