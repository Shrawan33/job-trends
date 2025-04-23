<li class="nav-item">
    <a href="{{ route('dashboard.index') }}" class="nav-link {{ Request::is('*dashboard*') ? 'active' : '' }}">
        <i class="fa fa-tachometer-alt nav-icon"></i>
        <p>{!! __('label.dashboard') !!}</p>
    </a>
</li>
<li class="nav-item {{ isset($activeJobBoardMenu) && $activeJobBoardMenu ? 'menu-is-opening menu-open' : '' }}">
    <a href="#" class="nav-link">
        <i class="fa fa-tasks nav-icon"></i>
        <p>
            {!! __('label.job_board') !!}
            <i class="right fas fa-angle-left"></i>
        </p>
    </a>
    <ul class="nav nav-treeview">
        <li class="nav-item">
            <a href="{{ route('users.index') }}" class="nav-link {{ Request::is('*users*') ? 'active' : '' }}">
                <i class="fa fa-user nav-icon"></i>
                <p>{!! __('label.users') !!}</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('job-posting.index') }}"
                class="nav-link {{ Request::is('*job-posting*') ? 'active' : '' }}">
                <i class="fa fa-clipboard nav-icon"></i>
                <p>{!! __('label.job_posting') !!}</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('orders.index') }}" class="nav-link {{ Request::is('*orders*') ? 'active' : '' }}">
                <i class="fa fa-clipboard nav-icon"></i>
                <p>{!! __('label.orders') !!}</p>
            </a>
        </li>
        @if ($package_access)
            <li class="nav-item">
                <a href="{{ route('packages.index') }}"
                    class="nav-link {{ Request::is('*packages*') ? 'active' : '' }}">
                    <i class="fa fa-box-open nav-icon"></i>
                    <p>{!! __('label.package_mang') !!}</p>
                </a>
            </li>
        @endif
        <li class="nav-item">
            <a href="{{ route('categories.index') }}"
                class="nav-link {{ Request::is('*categories*') ? 'active' : '' }}">
                <i class="fa fa-list-alt nav-icon"></i>
                <p>{!! __('label.categories') !!}</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('packageCategories.index') }}"
                class="nav-link {{ Request::is('*packageCategories*') ? 'active' : '' }}">
                <i class="fa fa-list-alt nav-icon"></i>
                <p>{!! __('label.package_categories') !!}</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('skills.index') }}" class="nav-link {{ Request::is('*skills*') ? 'active' : '' }}">
                <i class="fa fa-cogs nav-icon"></i>
                <p>{!! __('label.skills') !!}</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('specializations.index') }}"
                class="nav-link {{ Request::is('*specializations*') ? 'active' : '' }}">
                <i class="fa fa-users-cog nav-icon"></i>
                <p>{!! __('label.specializations') !!}</p>
            </a>
        </li>

        <li class="nav-item">
            <a href="{{ route('salaries.index') }}" class="nav-link {{ Request::is('*salaries*') ? 'active' : '' }}">
                <i class="fa fa-credit-card nav-icon"></i>
                <p>{!! __('label.salaries') !!}</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('experiences.index') }}"
                class="nav-link {{ Request::is('*experiences*') ? 'active' : '' }}">
                <i class="fa fa-history nav-icon"></i>
                <p>{!! __('label.experiences') !!}</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('qualifications.index') }}"
                class="nav-link {{ Request::is('*qualifications*') ? 'active' : '' }}">
                <i class="fa fa-graduation-cap nav-icon"></i>
                <p>{!! __('label.qualifications') !!}</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('interviewTypes.index') }}"
                class="nav-link {{ Request::is('*interviewTypes*') ? 'active' : '' }}">
                <i class="fa fa-question-circle nav-icon"></i>
                <p>{!! __('label.interview_types') !!}</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('workTypes.index') }}"
                class="nav-link {{ Request::is('*workTypes*') ? 'active' : '' }}">
                <i class="fa fa-tasks nav-icon"></i>
                <p>{!! __('label.work_types') !!}</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('certifications.index') }}"
                class="nav-link {{ Request::is('*certifications*') ? 'active' : '' }}">
                <i class="fa fa-certificate nav-icon"></i>
                <p>{!! __('label.license_certification') !!}</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('jobTypes.index') }}" class="nav-link {{ Request::is('jobTypes*') ? 'active' : '' }}">
                <i class="fa fa-briefcase nav-icon"></i>
                <p>Job Types</p>
            </a>
        </li>

    </ul>
</li>
<li class="nav-item {{ isset($activeContentMenu) && $activeContentMenu ? 'menu-is-opening menu-open' : '' }}">
    <a href="#" class="nav-link">
        <i class="fa fa-file-alt nav-icon"></i>
        <p>
            {!! __('label.content_pages') !!}
            <i class="right fas fa-angle-left"></i>
        </p>
    </a>
    <ul class="nav nav-treeview">
        <li class="nav-item">
            <a href="{{ route('bannerManagements.index') }}"
                class="nav-link {{ Request::is('*bannerManagements*') ? 'active' : '' }}">
                <i class="fa fa-camera nav-icon"></i>
                <p>{!! __('label.banner_management') !!}</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('blogs.index') }}" class="nav-link {{ Request::is('*blogs*') ? 'active' : '' }}">
                <i class="fa fa-blog nav-icon"></i>
                <p>{!! __('label.blog') !!}</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('faqs.index') }}" class="nav-link {{ Request::is('*faqs*') ? 'active' : '' }}">
                <i class="fa fa-file-alt nav-icon"></i>
                <p>{!! __('label.faq') !!}</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('events.index') }}" class="nav-link {{ Request::is('*events*') ? 'active' : '' }}">
                <i class="fa fa-file-alt nav-icon"></i>
                <p>Events</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('testimonials.index') }}"
                class="nav-link {{ Request::is('*testimonials*') ? 'active' : '' }}">
                <i class="fa fa-comment-alt nav-icon"></i>
                <p>{!! __('label.testimonials') !!}</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('cms.index') }}" class="nav-link {{ Request::is('*cms*') ? 'active' : '' }}">
                <i class="fa fa-file nav-icon"></i>
                <p>{!! __('label.cms') !!}</p>
            </a>
        </li>

    </ul>
</li>
<li
    class="nav-item {{ isset($activeReportAbusesMenu) && $activeReportAbusesMenu ? 'menu-is-opening menu-open' : '' }}">
    <a href="#" class="nav-link">
        <i class="fa fa-flag nav-icon"></i>
        <p>
            {!! __('label.report_abuses') !!}
            <i class="right fas fa-angle-left"></i>
        </p>
    </a>
    <ul class="nav nav-treeview">
        <li class="nav-item">
            <a href="{{ route('reports-abuses.typeIndex', ['report_type' => 'employerjobs']) }}"
                class="nav-link {{ Request::is('*employerjobs*') ? 'active' : '' }}">
                <i class="fa fa-tasks nav-icon"></i>
                <p>{{ trans('label.jobs') }}</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('reports-abuses.typeIndex', ['report_type' => 'employers']) }}"
                class="nav-link {{ Request::is('*employers*') ? 'active' : '' }}">
                <i class="fa fa-users nav-icon"></i>
                <p>{!! __('label.employer') !!}</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('reports-abuses.typeIndex', ['report_type' => 'jobseekers']) }}"
                class="nav-link {{ Request::is('*jobseekers*') ? 'active' : '' }}">
                <i class="fa fa-user nav-icon"></i>
                <p>{!! __('label.jobseeker') !!}</p>
            </a>
        </li>
    </ul>
</li>

<li class="nav-item {{ isset($activeSettingsMenu) && $activeSettingsMenu ? 'menu-is-opening menu-open' : '' }}">
    <a href="#" class="nav-link">
        <i class="nav-icon fa fa-cogs"></i>
        <p>
            {!! __('label.setting') !!}
            <i class="right fas fa-angle-left"></i>
        </p>
    </a>
    <ul class="nav nav-treeview">

        <li class="nav-item">
            <a href="{{ route('roles.index') }}" class="nav-link {{ Request::is('*roles*') ? 'active' : '' }}">
                <i class="fa fa-user-plus nav-icon"></i>
                <p>{!! __('label.roles') !!}</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('states.index') }}" class="nav-link {{ Request::is('*states*') ? 'active' : '' }}">
                <i class="fa fa-flag nav-icon"></i>
                <p>{!! __('label.state') !!}</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('locations.index') }}"
                class="nav-link {{ Request::is('*locations*') ? 'active' : '' }}">
                <i class="fa fa-city nav-icon"></i>
                <p>{!! __('label.location') !!}</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('configurations') }}"
                class="nav-link {{ Request::is('*configurations*') ? 'active' : '' }}">
                <i class="fa fa-cog nav-icon"></i>
                <p>{{ trans('label.configurations') }}</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('criterias.index') }}"
                class="nav-link {{ Request::is('*criterias*') ? 'active' : '' }}">
                <i class="fa fa-asterisk nav-icon"></i>
                <p>{{ trans('label.criteria') }}</p>
            </a>
        </li>

        <li class="nav-item">
            <a href="{{ route('languages.index') }}"
                class="nav-link {{ Request::is('languages*') ? 'active' : '' }}">

                <i class="fa fa-language nav-icon"></i>
                <p>{{ trans('label.language') }}</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('levels.index') }}" class="nav-link {{ Request::is('levels*') ? 'active' : '' }}">
                <i class="fa fa-level-up-alt nav-icon"></i>
                <p>{{ trans('label.level') }}</p>
            </a>
        </li>

    </ul>
</li>
<li class="nav-item {{ isset($activeReportMenu) && $activeReportMenu ? 'menu-is-opening menu-open' : '' }}">
    <a href="#" class="nav-link">
        <i class="fa fa-flag nav-icon"></i>
        <p>
            {!! __('label.reports') !!}
            <i class="right fas fa-angle-left"></i>
        </p>
    </a>
    <ul class="nav nav-treeview">
        <li class="nav-item">
            <a href="{{ route('filter-employers') }}"
                class="nav-link {{ Request::is('*filter-employers*') ? 'active' : '' }}">
                <i class="fa fa-tasks nav-icon"></i>
                <p>{{ trans('label.employer') }}</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('filter-jobseekers') }}"
                class="nav-link {{ Request::is('*filter-jobseekers*') ? 'active' : '' }}">
                <i class="fa fa-users nav-icon"></i>
                <p>{!! __('label.jobseeker') !!}</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('filter-employerjobs') }}"
                class="nav-link {{ Request::is('*filter-employerjobs*') ? 'active' : '' }}">
                <i class="fa fa-user nav-icon"></i>
                <p>{!! __('label.jobs') !!}</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('filter-transaction') }}"
                class="nav-link {{ Request::is('*filter-transaction*') ? 'active' : '' }}">
                <i class="fa fa-box-open nav-icon"></i>
                <p>{!! __('label.packages') !!}</p>
            </a>
        </li>

    </ul>
</li>

<li class="nav-item {{ isset($activeReviewMenu) && $activeReviewMenu ? 'menu-is-opening menu-open' : '' }}">
    <a href="#" class="nav-link">
        <i class="fa fa-flag nav-icon"></i>
        <p>
            {!! __('label.feed') !!}
            <i class="right fas fa-angle-left"></i>
        </p>
    </a>
    <ul class="nav nav-treeview">
        {{-- <li class="nav-item">
            <a href="{{ route('reviewCategories.index') }}"
                class="nav-link {{ Request::is('*reviewCategories*') ? 'active' : '' }}">
                <i class="fa fa-tasks nav-icon"></i>
                <p>{{ trans('label.review_categories') }}</p>
            </a>
        </li> --}}
        <li class="nav-item">
            <a href="{{ route('reviewCategoryStrengthWeeknesses.index') }}"
                class="nav-link {{ Request::is('*reviewCategoryStrengthWeeknesses*') ? 'active' : '' }}">
                <i class="fa fa-tasks nav-icon"></i>
                <p>{{ trans('label.review_category_types') }}</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('badges.index') }}" class="nav-link {{ Request::is('*badges*') ? 'active' : '' }}">
                <i class="fa fa-tasks nav-icon"></i>
                <p>{{ trans('label.badges') }}</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('ReviewUser.index') }}"
                class="nav-link {{ Request::is('*ReviewUser*') ? 'active' : '' }}">
                <i class="fa fa-tasks nav-icon"></i>
                <p>{{ trans('label.user_review') }}</p>
            </a>
        </li>

    </ul>
</li>

{{-- Importent announcement menu --}}
{{-- @if (Auth::user()->can('view make_announcement')) --}}
<li class="nav-item {{ isset($impAnnouncements) && $impAnnouncements ? 'menu-is-opening menu-open' : '' }}">
    <a href="#" class="nav-link">
        {{-- <i class="fa fa-megaphone nav-icon"></i> --}}
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-megaphone-fill nav-icon" viewBox="0 0 16 16">
            <path d="M13 2.5a1.5 1.5 0 0 1 3 0v11a1.5 1.5 0 0 1-3 0zm-1 .724c-2.067.95-4.539 1.481-7 1.656v6.237a25 25 0 0 1 1.088.085c2.053.204 4.038.668 5.912 1.56zm-8 7.841V4.934c-.68.027-1.399.043-2.008.053A2.02 2.02 0 0 0 0 7v2c0 1.106.896 1.996 1.994 2.009l.496.008a64 64 0 0 1 1.51.048m1.39 1.081q.428.032.85.078l.253 1.69a1 1 0 0 1-.983 1.187h-.548a1 1 0 0 1-.916-.599l-1.314-2.48a66 66 0 0 1 1.692.064q.491.026.966.06"/>
          </svg>
        <p>
            {!! __('label.important_announcements') !!}
            <i class="right fas fa-angle-left"></i>
        </p>
    </a>
    <ul class="nav nav-treeview">
        {{-- @can('view make_announcement') --}}
        <li class="nav-item">
            <a href="{{ route('important-announcements.create') }}"
                class="nav-link {{ Request::is('*make-announcements*') ? 'active' : '' }}">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-broadcast nav-icon" viewBox="0 0 16 16">
                    <path d="M3.05 3.05a7 7 0 0 0 0 9.9.5.5 0 0 1-.707.707 8 8 0 0 1 0-11.314.5.5 0 0 1 .707.707m2.122 2.122a4 4 0 0 0 0 5.656.5.5 0 1 1-.708.708 5 5 0 0 1 0-7.072.5.5 0 0 1 .708.708m5.656-.708a.5.5 0 0 1 .708 0 5 5 0 0 1 0 7.072.5.5 0 1 1-.708-.708 4 4 0 0 0 0-5.656.5.5 0 0 1 0-.708m2.122-2.12a.5.5 0 0 1 .707 0 8 8 0 0 1 0 11.313.5.5 0 0 1-.707-.707 7 7 0 0 0 0-9.9.5.5 0 0 1 0-.707zM10 8a2 2 0 1 1-4 0 2 2 0 0 1 4 0"/>
                  </svg>
                <p>{{ trans('label.make_announcements') }}</p>
            </a>
        </li>
        {{-- @endcan --}}
    </ul>
</li>
{{-- @endif --}}