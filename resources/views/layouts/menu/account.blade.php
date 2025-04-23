<li class="nav-item">

    <a href="{{ route('account-dashboard.index') }}" class="nav-link {{ Request::is('*account-dashboard.index*') ? 'active' : '' }}">
        <i class="fa fa-user nav-icon"></i>
        <p>{!! __('label.assign_board') !!}</p>
    </a>
</li>
<li class="nav-item">
    <a href="{{ route('account.messages.index') }}" class="nav-link {{ Request::is('*account.messages.index*') ? 'active' : '' }}">
        <i class="fa fa-envelope nav-icon"></i>
        <p>{!! __('label.messages') !!}</p>
    </a>
</li>
