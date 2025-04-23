<ul class="list-unstyled">
    @role('jobseeker')
    {{-- <li><a href="{{route('make-cv',auth()->user()->id)}}" class="d-flex align-items-center">
      <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" class="mr-2">
        <path d="M19.7501 7.55566H15.8941C14.9581 7.55566 14.1992 6.79681 14.1992 5.86075V2.00482" stroke="#357de8" stroke-width="1.5" stroke-miterlimit="10" stroke-linejoin="round"/>
        <path d="M19.7499 7.55555V20.3051C19.7499 21.2411 18.9911 22 18.055 22H5.94101C5.00495 22 4.24609 21.2411 4.24609 20.3051V3.69491C4.24609 2.75881 5.00495 2 5.94101 2H14.2226L19.7499 7.55555Z" stroke="#357de8" stroke-width="1.5" stroke-miterlimit="10"/>
        <path d="M6.82812 18.6099H17.2095" stroke="#357de8" stroke-width="1.5" stroke-miterlimit="10"/>
        <path d="M7.67969 16.0254C7.67969 14.3873 9.00765 13.0593 10.6458 13.0593C12.2839 13.0593 13.6119 14.3873 13.6119 16.0254" stroke="#357de8" stroke-width="1.5" stroke-miterlimit="10" stroke-linejoin="round"/>
        <path d="M8.99219 11.3647C8.99219 10.4286 9.75104 9.66974 10.6871 9.66974C11.6232 9.66974 12.382 10.4286 12.382 11.3647C12.382 12.3008 11.6232 13.0596 10.6871 13.0596C9.75104 13.0596 8.99219 12.3008 8.99219 11.3647Z" stroke="#357de8" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
      </svg>
        {{ trans('label.make_a_cv') }}</a></li> --}}

    @endrole
    <li><a href="{{route('change.password')}}" class="d-flex align-items-center">
      <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" class="mr-2">
        <g clip-path="url(#clip0_1130_4415)">
        <path d="M10.2444 22.1821C5.37452 21.3492 1.66797 17.1073 1.66797 12C1.66797 6.89265 5.37452 2.65075 10.2444 1.81787" stroke="#357de8" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
        <path d="M10.2429 1.81787L9.18359 3.69812" stroke="#357de8" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
        <path d="M10.2463 1.81791L8.39844 0.703125" stroke="#357de8" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
        <path d="M13.7539 1.81787C18.6237 2.65075 22.3303 6.89265 22.3303 12C22.3303 17.1073 18.6238 21.3492 13.7539 22.1821" stroke="#357de8" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
        <path d="M13.7539 22.182L14.8132 20.3018" stroke="#357de8" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
        <path d="M13.7539 22.1821L15.6018 23.2969" stroke="#357de8" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
        <path d="M15.4732 17.4842H8.52678C7.84752 17.4842 7.29688 16.9335 7.29688 16.2543V11.8119C7.29688 11.1327 7.84752 10.582 8.52678 10.582H15.4732C16.1525 10.582 16.7031 11.1327 16.7031 11.8119V16.2543C16.7031 16.9335 16.1525 17.4842 15.4732 17.4842Z" stroke="#357de8" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
        <path d="M15.6094 10.5822V9.46875C15.6094 7.47534 13.9934 5.85938 12 5.85938C10.0066 5.85938 8.39062 7.47534 8.39062 9.46875V10.5822" stroke="#357de8" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
        <path d="M12 13.5469V14.5197" stroke="#357de8" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
        </g>
        <defs>
        <clipPath id="clip0_1130_4415">
        <rect width="24" height="24" fill="white"/>
        </clipPath>
        </defs>
        </svg>
        {{ trans('label.change_password') }}</a></li>
    {{-- @role('jobseeker')
    <li>
        @auth
        <a href="javascript:void();" class="d-block @if (!auth()->user()->hide_profile) @else text-primary @endif" onclick="event.preventDefault(); document.getElementById('hide-profile-form').submit();">
            @if (!auth()->user()->hide_profile) {{ trans('label.hide') }} @else {{ trans('label.unhide') }} @endif {{ trans('label.profile') }}
        </a>
        <form id="hide-profile-form" action="{{ route('toggle-profile-status', ['status' => auth()->user()->hide_profile == 1 ? 'false' : 'true']) }}"
            method="POST" class="d-none">
            @csrf
        </form>
        @endauth
    </li>
    @endrole --}}
    <li>
        @include('components.remove_account')
    </li>
</ul>
