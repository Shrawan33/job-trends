@auth
<a href="#" class="py-1 mb-2 d-inline-block font-weight-medium text-black-50" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
    {{ trans('label.logout') }}
</a>
<form id="logout-form" action="{{ !empty($logoutRoute) ? $logoutRoute : route('logout') }}"
    method="POST" class="d-none">
    @csrf
</form>
@endauth
