 <!-- Navigation-->
 <header>
    @role('employer|jobseeker')
    @impersonating($guard = null)
        <div class="admin-header bg-dark py-3">
            <div class="container">
                <div class="row">
                    <div class="col-12 ">
                        <a class="nav-link text-white text-md-right text-center p-0 d-block"
                            href="{{ route('impersonate.leave') }}">
                            <span class="icon mr-2">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="14" viewBox="0 0 18 14"
                                    fill="none">
                                    <path d="M1 7H17M17 7L11 13M17 7L11 1" stroke="white" stroke-width="1.5"
                                        stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            </span> {{ trans('Back to Admin Panel') }}
                        </a>
                    </div>
                </div>
            </div>
        </div>
    @endImpersonating
@endrole
     <nav class="navbar fixed-top navbar-expand-lg py-20">
         <div class="container">
             <a class="navbar-brand py-0" href="{{ route('home.verfied') }}">
                 <img src="{{ asset('images/Logo.svg') }}" alt="logo" class="main_logo">
             </a>

             <!-- <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup"
                aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button> -->
             <!-- <div class="collapse navbar-collapse " id="navbarNavAltMarkup">
                <div class="navbar-nav ml-auto">
                    <a class="nav-item nav-link active" href="#">Home <span class="sr-only">(current)</span></a>
                    <a class="nav-item nav-link" href="#">Features</a>
                    <a class="nav-item nav-link" href="#">Pricing</a>
                    <a class="nav-item nav-link disabled" href="#">Disabled</a>
                </div>
            </div> -->
             <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup"
                 aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                 {{-- <span class="navbar-toggler-icon"></span> --}}
                 <svg xmlns="http://www.w3.org/2000/svg" width="20" height="14" viewBox="0 0 20 14"
                     fill="none">
                     <path d="M1 7H19M1 1H19M1 13H19" stroke="black" stroke-width="2" stroke-linecap="round"
                         stroke-linejoin="round" />
                 </svg>
             </button>
             @if (Route::has('login'))
                 @auth

                     <div class="collapse navbar-collapse justify-content-center" id="navbarNavAltMarkup">
                         <div class="menu_close p-2 text-right d-lg-none">
                             <button class="navbar-toggler p-0 close_menu_btn" type="button" data-toggle="collapse"
                                 data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="true"
                                 aria-label="Toggle navigation">
                                 <svg width="32" height="32" fill="#fff" viewBox="0 0 24 24"
                                     xmlns="http://www.w3.org/2000/svg">
                                     <path fill-rule="evenodd"
                                         d="M19.505 4.975a.6.6 0 0 1 0 .85l-13.2 13.2a.6.6 0 0 1-.85-.85l13.2-13.2a.598.598 0 0 1 .85 0Z"
                                         clip-rule="evenodd"></path>
                                     <path fill-rule="evenodd"
                                         d="M5.456 4.975a.6.6 0 0 0 0 .85l13.2 13.2a.6.6 0 1 0 .85-.85l-13.2-13.2a.6.6 0 0 0-.85 0Z"
                                         clip-rule="evenodd"></path>
                                 </svg>
                             </button>
                         </div>
                         <ul class="navbar-nav inner-nav">
                             @role('employer')
                                 <li class="nav-item">
                                     <a class="nav-link @if (Route::is('employerDashboard.index')) active @endif"
                                         href="{{ route('employerDashboard.index') }}">{{ trans('label.dashboard') }}</a>
                                 </li>
                                 <li class="nav-item">
                                     <a class="nav-link @if (Route::is('employerJobs.index')) active @endif"
                                         href="{{ route('employerJobs.index') }}"> {{ trans('label.my_jobs') }}</a>
                                 </li>
                                 <li class="nav-item">
                                     <a class="nav-link @if (Route::is('candidates.index')) active @endif"
                                         href="{{ route('candidates.index') }}">{{ trans('label.candidates') }}</a>
                                 </li>
                                 {{-- <li class="nav-item">
                                     <a class="nav-link @if (Route::is('shortlisted-candidate.index')) active @endif"
                                         href="{{ route('shortlisted-candidate.index') }}">
                                         {{ trans('label.favorites') }}</a>
                                 </li> --}}
                                 @if ($package_access)
                                     {{-- Temporary commented for this project only as per client comment --}}
                                     {{-- <li class="nav-item">
                                <a class="nav-link @if (Route::is('subscription.my-subscription')) active @endif" href="{{ route('subscription.my-subscription') }}">
                                    {{trans('label.my-subscription')}}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link @if (Route::is('subscription.plan')) active @endif" href="{{ route('subscription.plan') }}">
                                    {{trans('label.packages')}}</a>
                            </li> --}}
                                 @endif
                             @endrole

                             @role('jobseeker')
                                 <li class="nav-item">
                                     <a class="nav-link @if (Route::is('jobseekerDashboard.index')) active @endif"
                                         href="{{ route('jobseekerDashboard.index') }}"> {{ trans('label.dashboard') }}</a>
                                 </li>
                                 <li class="nav-item">
                                     <a class="nav-link @if (Route::is('search-jobs.index')) active @endif"
                                         href="{{ route('search-jobs.index') }}"> {{ trans('label.searchBtn') }}</a>
                                 </li>
                                 <li class="nav-item">
                                     <a class="nav-link @if (Route::is('employers.index')) active @endif"
                                         href="{{ route('employers.index') }}"> {{ trans('label.employer') }}</a>
                                 </li>
                                 {{-- <li class="nav-item">
                                     <a class="nav-link @if (Route::is('applyJobs.index')) active @endif"
                                         href="{{ route('applyJobs.index') }}">{{ trans('label.applied_jobs') }}</a>
                                 </li> --}}
                                 {{-- <li class="nav-item">
                                     <a class="nav-link @if (Route::is('favoriteJobs.index')) active @endif"
                                         href="{{ route('favoriteJobs.index') }}">{{ trans('label.favorites') }}</a>
                                 </li> --}}
                                 <li class="nav-item">
                                     <a class="nav-link @if (Route::is('jobAlerts.index')) active @endif"
                                         href="{{ route('jobAlerts.index') }}">
                                         {{ trans('label.job_alerts') }}</a>
                                 </li>
                                 <li class="nav-item">
                                     <a class="nav-link @if (Route::is('career-service')) active @endif"
                                         href="{{ route('career-service') }}">
                                         {{ trans('label.career_services') }}</a>
                                 </li>

                                 {{-- @if ($package_access)
                            <li class="nav-item">
                                <a class="nav-link @if (Route::is('subscription.my-subscription')) active @endif" href="{{ route('subscription.my-subscription') }}">
                                    {{trans('label.my-subscription')}}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link @if (Route::is('subscription.plan')) active @endif" href="{{ route('subscription.plan') }}">
                                    {{trans('label.packages')}}</a>
                            </li>
                            @endif --}}
                             @endrole
                             {{-- <li class="nav-item">
                                 <a class="nav-link @if (Route::is('messages.index')) active @endif"
                                     href="{{ route('messages.index') }}"> {{ trans('label.messages') }}</a>
                             </li> --}}
                             {{-- <li class="nav-item">
                                 <a class="nav-link @if (Route::is('messages.index')) active @endif"
                                     href="{{ route('messages.index') }}">
                                     Messages @if (Auth::user()->id)
                                         ({{ $notificationUnreadCount }})
                                     @endif
                                 </a>
                             </li> --}}

                             <li class="nav-item">
                                 <a class="nav-link @if (Route::is('userReviews.feed')) active @endif"
                                     href="{{ route('userReviews.feed') }}"> {{ trans('label.feed') }}</a>
                             </li>
                             {{-- <li class="nav-item">
                         <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                             class="nav-link">
                             {{trans('label.logout')}}
                         </a>
                     </li> --}}
                             <form id="logout-form" action="{{ !empty($logoutRoute) ? $logoutRoute : route('logout') }}"
                                 method="POST" class="d-none">
                                 @csrf
                             </form>
                         </ul>
                     </div>
                     <div class="main-institute-profile-dropdown-main-wrapper">
                         <ul class="navbar-nav  ml-auto inner-nav flex-row">
                             @if ($cartCount > 0 && !Route::is('cart.list'))
                                 <li class="mr-2 pr-3 border-right d-flex align-items-center">
                                     <a href="{{ route('cart.list') }}" class="cart_icon position-relative">
                                         <svg width="25" height="25" fill="none" stroke="#000"
                                             stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                             viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                             <path fill="currentColor" d="M19.5 22a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3Z">
                                             </path>
                                             <path fill="currentColor" d="M9.5 22a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3Z">
                                             </path>
                                             <path d="M5 4c-.167-.667-1-2-3-2m3 2h17l-2 11H7L5 4Z"></path>
                                             <path d="M20 15H5.23c-1.784 0-2.73.781-2.73 2 0 1.219.946 2 2.73 2H19.5">
                                             </path>
                                         </svg>
                                         <span class="cart_count">{{ $cartCount }}</span>
                                     </a>
                                 </li>
                             @endif
                             <li class="nav-item">
                                 <div class="dropdown">
                                     <button class="dropdown-toggle d-flex align-items-center" type="button"
                                         data-toggle="dropdown" aria-expanded="false">
                                         {{-- <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25"
                                             viewBox="0 0 20 20" fill="none" class="mr-2">
                                             <path
                                                 d="M3.87197 16.8187C4.4296 15.5049 5.73154 14.5835 7.2487 14.5835H12.7487C14.2659 14.5835 15.5678 15.5049 16.1254 16.8187M13.6654 7.7085C13.6654 9.73354 12.0237 11.3752 9.9987 11.3752C7.97365 11.3752 6.33203 9.73354 6.33203 7.7085C6.33203 5.68345 7.97365 4.04183 9.9987 4.04183C12.0237 4.04183 13.6654 5.68345 13.6654 7.7085ZM19.1654 10.0002C19.1654 15.0628 15.0613 19.1668 9.9987 19.1668C4.93609 19.1668 0.832031 15.0628 0.832031 10.0002C0.832031 4.93755 4.93609 0.833496 9.9987 0.833496C15.0613 0.833496 19.1654 4.93755 19.1654 10.0002Z"
                                                 stroke="black" stroke-width="1.5" stroke-linecap="round"
                                                 stroke-linejoin="round" />
                                         </svg> --}}
                                         {{-- @dd($user->seekerDetail->logo) --}}

                                         @if (!empty(Auth::user()->seekerDetail) && Auth::user()->seekerDetail->logo->count())
                                             @include('vendor.image_upload.display', [
                                                 'document_type' => config('constants.document_type.image', 0),
                                                 'imageModel' => Auth::user()->seekerDetail,
                                                 'class_li' => '',
                                                 'thumbnail' => true,
                                             ])
                                         @elseif (!empty(Auth::user()->usersProfile) && Auth::user()->usersProfile->logo->count())
                                             @include('vendor.image_upload.display', [
                                                 'wrapper_class' => 'img-fluid user-90',
                                                 'document_type' => config('constants.document_type.image', 0),
                                                 'imageModel' => Auth::user()->usersProfile,
                                                 'thumbnail' => true,
                                             ])
                                         @else
                                             <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25"
                                                 viewBox="0 0 20 20" fill="none" class="mr-2">
                                                 <path
                                                     d="M3.87197 16.8187C4.4296 15.5049 5.73154 14.5835 7.2487 14.5835H12.7487C14.2659 14.5835 15.5678 15.5049 16.1254 16.8187M13.6654 7.7085C13.6654 9.73354 12.0237 11.3752 9.9987 11.3752C7.97365 11.3752 6.33203 9.73354 6.33203 7.7085C6.33203 5.68345 7.97365 4.04183 9.9987 4.04183C12.0237 4.04183 13.6654 5.68345 13.6654 7.7085ZM19.1654 10.0002C19.1654 15.0628 15.0613 19.1668 9.9987 19.1668C4.93609 19.1668 0.832031 15.0628 0.832031 10.0002C0.832031 4.93755 4.93609 0.833496 9.9987 0.833496C15.0613 0.833496 19.1654 4.93755 19.1654 10.0002Z"
                                                     stroke="black" stroke-width="1.5" stroke-linecap="round"
                                                     stroke-linejoin="round" />
                                             </svg>
                                         @endif



                                         @role('employer')
                                             <span class="pr-1"> {{ Auth::user()->company_name }} </span>
                                         @endrole

                                         @role('jobseeker')
                                             <span class="pr-1">
                                                 {{ Auth::user()->first_name . ' ' . Auth::user()->last_name }} </span>
                                         @endrole

                                     </button>
                                     <div class="dropdown-menu">
                                         @role('jobseeker')
                                             <a class="dropdown-item" href="{{ route('users.profile') }}">
                                                 <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                                                     viewBox="0 0 20 20" fill="none">
                                                     <path
                                                         d="M3.87197 16.8187C4.4296 15.5049 5.73154 14.5835 7.2487 14.5835H12.7487C14.2659 14.5835 15.5678 15.5049 16.1254 16.8187M13.6654 7.7085C13.6654 9.73354 12.0237 11.3752 9.9987 11.3752C7.97365 11.3752 6.33203 9.73354 6.33203 7.7085C6.33203 5.68345 7.97365 4.04183 9.9987 4.04183C12.0237 4.04183 13.6654 5.68345 13.6654 7.7085ZM19.1654 10.0002C19.1654 15.0628 15.0613 19.1668 9.9987 19.1668C4.93609 19.1668 0.832031 15.0628 0.832031 10.0002C0.832031 4.93755 4.93609 0.833496 9.9987 0.833496C15.0613 0.833496 19.1654 4.93755 19.1654 10.0002Z"
                                                         stroke="black" stroke-width="1.5" stroke-linecap="round"
                                                         stroke-linejoin="round" />
                                                 </svg>
                                                 {{ trans('label.profile') }}
                                             </a>
                                             <a class="dropdown-item @if (Route::is('applyJobs.index')) active @endif"
                                                 href="{{ route('applyJobs.index') }}">
                                                 <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                                                     viewBox="0 0 22 22" fill="none">
                                                     <path
                                                         d="M18.3333 11.458V6.23301C18.3333 4.69286 18.3333 3.92279 18.0336 3.33453C17.7699 2.81709 17.3492 2.39639 16.8318 2.13274C16.2435 1.83301 15.4734 1.83301 13.9333 1.83301H8.06663C6.52648 1.83301 5.75641 1.83301 5.16815 2.13274C4.65071 2.39639 4.23001 2.81709 3.96636 3.33453C3.66663 3.92279 3.66663 4.69286 3.66663 6.23301V15.7663C3.66663 17.3065 3.66663 18.0766 3.96636 18.6648C4.23001 19.1823 4.65071 19.603 5.16815 19.8666C5.75641 20.1663 6.52648 20.1663 8.06663 20.1663H11M12.8333 10.083H7.33329M9.16663 13.7497H7.33329M14.6666 6.41634H7.33329M13.2916 17.4163L15.125 19.2497L19.25 15.1247"
                                                         stroke="black" stroke-width="1.5" stroke-linecap="round"
                                                         stroke-linejoin="round" />
                                                 </svg>
                                                 {{ trans('label.applied_jobs') }}
                                             </a>
                                             {{-- <a class="dropdown-item @if (Route::is('subscription.expertise-plan')) active @endif"
                                                     href="{{ route('subscription.expertise-plan') }}">
                                                     <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                                                         viewBox="0 0 22 22" fill="none">
                                                         <path
                                                             d="M5.50004 5.49967L7.33337 3.66634M7.33337 3.66634L5.50004 1.83301M7.33337 3.66634H5.50004C3.475 3.66634 1.83337 5.30796 1.83337 7.33301M16.5 16.4997L14.6667 18.333M14.6667 18.333L16.5 20.1663M14.6667 18.333H16.5C18.5251 18.333 20.1667 16.6914 20.1667 14.6663M9.33998 5.95801C9.95054 3.58582 12.1039 1.83301 14.6667 1.83301C17.7043 1.83301 20.1667 4.29544 20.1667 7.33301C20.1667 9.89577 18.4139 12.0491 16.0418 12.6597M12.8334 14.6663C12.8334 17.7039 10.3709 20.1663 7.33337 20.1663C4.29581 20.1663 1.83337 17.7039 1.83337 14.6663C1.83337 11.6288 4.29581 9.16634 7.33337 9.16634C10.3709 9.16634 12.8334 11.6288 12.8334 14.6663Z"
                                                             stroke="black" stroke-width="1.5" stroke-linecap="round"
                                                             stroke-linejoin="round" />
                                                     </svg>
                                                     {{ trans('label.career_support_service') }}
                                            </a> --}}
                                             {{-- <a class="dropdown-item @if (Route::is('subscription.chatgpt-service-plan')) active @endif"
                                                 href="{{ route('subscription.chatgpt-service-plan') }}">
                                                 <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                                                     viewBox="0 0 24 24" fill="none">
                                                     <path
                                                         d="M19.4974 17.061C18.8016 17.647 17.9032 18 16.9224 18C14.7132 18 12.9224 16.2091 12.9224 14C12.9224 11.7909 14.7132 10 16.9224 10C19.1315 10 20.9224 11.7909 20.9224 14C20.9224 14.8043 20.685 15.5532 20.2764 16.1804"
                                                         stroke="black" stroke-width="1.5" stroke-miterlimit="10"
                                                         stroke-linecap="round" stroke-linejoin="round" />
                                                     <path
                                                         d="M18.4995 14.9269C18.5027 14.5313 18.331 14.2184 17.9885 13.9975C17.724 13.8274 17.403 13.7387 17.0925 13.6534C16.4458 13.4749 16.2582 13.3808 16.2582 13.0991C16.2582 12.7854 16.7059 12.6737 17.0892 12.6737C17.3683 12.6737 17.6894 12.7528 17.8889 12.8699L18.2843 12.3122C18.0236 12.1583 17.6669 12.0534 17.3146 12.0208V11.5H16.5852V12.0573C15.9369 12.1872 15.5285 12.5731 15.5285 13.0991C15.5285 13.4675 15.6965 13.7597 16.0271 13.9657C16.2785 14.123 16.5851 14.2075 16.8813 14.2893C17.5157 14.4639 17.7733 14.5703 17.7703 14.9227L17.7703 14.9253C17.7703 15.2211 17.3399 15.3263 16.9712 15.3263C16.6229 15.3263 16.2441 15.1872 16.0294 14.9805L15.4995 15.437C15.7714 15.6989 16.1665 15.8841 16.5852 15.9567V16.5H17.3146V15.9684C18.0351 15.8744 18.4988 15.4794 18.4995 14.9269Z"
                                                         fill="black" />
                                                     <path
                                                         d="M16.2961 20.3435V20.4233C16.2961 20.9796 15.8451 21.4306 15.2888 21.4306H4.00681C3.4505 21.4306 2.99951 20.9796 2.99951 20.4233V4.0073C2.99951 3.45098 3.4505 3 4.00681 3L15.6295 3.00017"
                                                         stroke="black" stroke-width="1.5" stroke-miterlimit="10"
                                                         stroke-linecap="round" stroke-linejoin="round" />
                                                     <path
                                                         d="M12.6875 3.00017L15.2891 3C15.8454 3 16.2964 3.45098 16.2964 4.0073V7.45965"
                                                         stroke="black" stroke-width="1.5" stroke-miterlimit="10"
                                                         stroke-linecap="round" stroke-linejoin="round" />
                                                     <path
                                                         d="M6.15711 6.72926C6.40622 6.72926 6.60816 6.52731 6.60816 6.2782C6.60816 6.02909 6.40622 5.82715 6.15711 5.82715C5.908 5.82715 5.70605 6.02909 5.70605 6.2782C5.70605 6.52731 5.908 6.72926 6.15711 6.72926Z"
                                                         stroke="black" stroke-width="1.5" stroke-miterlimit="10"
                                                         stroke-linecap="round" stroke-linejoin="round" />
                                                     <path d="M8.86328 6.27783H13.3738" stroke="black" stroke-width="1.5"
                                                         stroke-miterlimit="10" stroke-linecap="round"
                                                         stroke-linejoin="round" />
                                                     <path
                                                         d="M6.15711 10.3377C6.40622 10.3377 6.60816 10.1357 6.60816 9.8866C6.60816 9.63749 6.40622 9.43555 6.15711 9.43555C5.908 9.43555 5.70605 9.63749 5.70605 9.8866C5.70605 10.1357 5.908 10.3377 6.15711 10.3377Z"
                                                         stroke="black" stroke-width="1.5" stroke-miterlimit="10"
                                                         stroke-linecap="round" stroke-linejoin="round" />
                                                     <path d="M8.86279 9.88672H10.8628" stroke="black" stroke-width="1.5"
                                                         stroke-miterlimit="10" stroke-linecap="round"
                                                         stroke-linejoin="round" />
                                                     <path
                                                         d="M6.15711 13.9461C6.40622 13.9461 6.60816 13.7441 6.60816 13.495C6.60816 13.2459 6.40622 13.0439 6.15711 13.0439C5.908 13.0439 5.70605 13.2459 5.70605 13.495C5.70605 13.7441 5.908 13.9461 6.15711 13.9461Z"
                                                         stroke="black" stroke-width="1.5" stroke-miterlimit="10"
                                                         stroke-linecap="round" stroke-linejoin="round" />
                                                     <path d="M8.86328 13.4951H10.6675" stroke="black" stroke-width="1.5"
                                                         stroke-miterlimit="10" stroke-linecap="round"
                                                         stroke-linejoin="round" />
                                                     <path
                                                         d="M6.15711 17.5545C6.40622 17.5545 6.60816 17.3525 6.60816 17.1034C6.60816 16.8543 6.40622 16.6523 6.15711 16.6523C5.908 16.6523 5.70605 16.8543 5.70605 17.1034C5.70605 17.3525 5.908 17.5545 6.15711 17.5545Z"
                                                         stroke="black" stroke-width="1.5" stroke-miterlimit="10"
                                                         stroke-linecap="round" stroke-linejoin="round" />
                                                     <path d="M8.86328 17.1035H10.6675" stroke="black" stroke-width="1.5"
                                                         stroke-miterlimit="10" stroke-linecap="round"
                                                         stroke-linejoin="round" />
                                                 </svg>
                                                 {{ trans('label.ai_resume_generator') }}
                                             </a> --}}
                                             <a class="dropdown-item @if (Route::is('messages.index')) active @endif"
                                                 href="{{ route('messages.index') }}">
                                                 <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                                                     viewBox="0 0 18 18" fill="none">
                                                     <path
                                                         d="M4.46701 5.76714H8.80078M4.46701 8.80078H11.401M4.46701 14.0013V16.0256C4.46701 16.4875 4.46701 16.7184 4.56169 16.837C4.64402 16.9401 4.76888 17.0001 4.90086 17C5.05262 16.9998 5.23294 16.8556 5.59358 16.5671L7.66119 14.913C8.08356 14.5751 8.29474 14.4061 8.52991 14.286C8.73855 14.1794 8.96063 14.1015 9.19014 14.0544C9.44883 14.0013 9.71928 14.0013 10.2602 14.0013H12.4411C13.8974 14.0013 14.6256 14.0013 15.1818 13.7179C15.6711 13.4686 16.0689 13.0708 16.3182 12.5815C16.6016 12.0253 16.6016 11.2972 16.6016 9.84089V5.16042C16.6016 3.70413 16.6016 2.97599 16.3182 2.41977C16.0689 1.9305 15.6711 1.53271 15.1818 1.28341C14.6256 1 13.8974 1 12.4411 1H5.16042C3.70413 1 2.97599 1 2.41977 1.28341C1.9305 1.53271 1.53271 1.9305 1.28341 2.41977C1 2.97599 1 3.70413 1 5.16042V10.5343C1 11.3403 1 11.7434 1.0886 12.074C1.32904 12.9714 2.02993 13.6723 2.92726 13.9127C3.25793 14.0013 3.66096 14.0013 4.46701 14.0013Z"
                                                         stroke="black" stroke-width="1.5" stroke-linecap="round"
                                                         stroke-linejoin="round"></path>
                                                 </svg>
                                                 Messages @if (Auth::user()->id)
                                                     ({{ $notificationUnreadCount }})
                                                 @endif
                                             </a>
                                             {{-- @if ($package_access)
                                                 <a class="dropdown-item @if (Route::is('subscription.my-subscription')) active @endif"
                                                     href="{{ route('subscription.my-subscription') }}">
                                                     <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                                                         viewBox="0 0 22 22" fill="none">
                                                         <path
                                                             d="M5.50004 5.49967L7.33337 3.66634M7.33337 3.66634L5.50004 1.83301M7.33337 3.66634H5.50004C3.475 3.66634 1.83337 5.30796 1.83337 7.33301M16.5 16.4997L14.6667 18.333M14.6667 18.333L16.5 20.1663M14.6667 18.333H16.5C18.5251 18.333 20.1667 16.6914 20.1667 14.6663M9.33998 5.95801C9.95054 3.58582 12.1039 1.83301 14.6667 1.83301C17.7043 1.83301 20.1667 4.29544 20.1667 7.33301C20.1667 9.89577 18.4139 12.0491 16.0418 12.6597M12.8334 14.6663C12.8334 17.7039 10.3709 20.1663 7.33337 20.1663C4.29581 20.1663 1.83337 17.7039 1.83337 14.6663C1.83337 11.6288 4.29581 9.16634 7.33337 9.16634C10.3709 9.16634 12.8334 11.6288 12.8334 14.6663Z"
                                                             stroke="black" stroke-width="1.5" stroke-linecap="round"
                                                             stroke-linejoin="round" />
                                                     </svg>
                                                     {{ trans('label.my-subscription') }}
                                                 </a>
                                                 <a class="dropdown-item @if (Route::is('subscription.plan')) active @endif"
                                                     href="{{ route('subscription.plan') }}">
                                                     <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                                                         viewBox="0 0 22 22" fill="none">
                                                         <path
                                                             d="M5.50004 5.49967L7.33337 3.66634M7.33337 3.66634L5.50004 1.83301M7.33337 3.66634H5.50004C3.475 3.66634 1.83337 5.30796 1.83337 7.33301M16.5 16.4997L14.6667 18.333M14.6667 18.333L16.5 20.1663M14.6667 18.333H16.5C18.5251 18.333 20.1667 16.6914 20.1667 14.6663M9.33998 5.95801C9.95054 3.58582 12.1039 1.83301 14.6667 1.83301C17.7043 1.83301 20.1667 4.29544 20.1667 7.33301C20.1667 9.89577 18.4139 12.0491 16.0418 12.6597M12.8334 14.6663C12.8334 17.7039 10.3709 20.1663 7.33337 20.1663C4.29581 20.1663 1.83337 17.7039 1.83337 14.6663C1.83337 11.6288 4.29581 9.16634 7.33337 9.16634C10.3709 9.16634 12.8334 11.6288 12.8334 14.6663Z"
                                                             stroke="black" stroke-width="1.5" stroke-linecap="round"
                                                             stroke-linejoin="round" />
                                                     </svg>
                                                     {{ trans('label.packages') }}
                                                 </a>
                                             @endif --}}
                                             <a class="dropdown-item @if (Route::is('favoriteJobs.index')) active @endif"
                                                 href="{{ route('favoriteJobs.index') }}">
                                                 <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                                                     viewBox="0 0 22 22" fill="none">
                                                     <path
                                                         d="M14.7686 2.75C17.9973 2.75 20.1667 5.82313 20.1667 8.69C20.1667 14.4959 11.163 19.25 11 19.25C10.8371 19.25 1.83337 14.4959 1.83337 8.69C1.83337 5.82313 4.00282 2.75 7.23152 2.75C9.08523 2.75 10.2973 3.68844 11 4.51344C11.7028 3.68844 12.9149 2.75 14.7686 2.75Z"
                                                         stroke="black" stroke-width="1.5" stroke-linecap="round"
                                                         stroke-linejoin="round" />
                                                 </svg>
                                                 {{ trans('label.favorites') }}
                                             </a>
                                             <a class="dropdown-item @if (Route::is('subscription.chatgpt-service-plan')) active @endif"
                                                 href="{{ route('userReviews.advanceReviewsByCurrentUser') }}">
                                                 <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                                                     viewBox="0 0 24 24" fill="none">
                                                     <path
                                                         d="M19.4974 17.061C18.8016 17.647 17.9032 18 16.9224 18C14.7132 18 12.9224 16.2091 12.9224 14C12.9224 11.7909 14.7132 10 16.9224 10C19.1315 10 20.9224 11.7909 20.9224 14C20.9224 14.8043 20.685 15.5532 20.2764 16.1804"
                                                         stroke="black" stroke-width="1.5" stroke-miterlimit="10"
                                                         stroke-linecap="round" stroke-linejoin="round" />
                                                     <path
                                                         d="M18.4995 14.9269C18.5027 14.5313 18.331 14.2184 17.9885 13.9975C17.724 13.8274 17.403 13.7387 17.0925 13.6534C16.4458 13.4749 16.2582 13.3808 16.2582 13.0991C16.2582 12.7854 16.7059 12.6737 17.0892 12.6737C17.3683 12.6737 17.6894 12.7528 17.8889 12.8699L18.2843 12.3122C18.0236 12.1583 17.6669 12.0534 17.3146 12.0208V11.5H16.5852V12.0573C15.9369 12.1872 15.5285 12.5731 15.5285 13.0991C15.5285 13.4675 15.6965 13.7597 16.0271 13.9657C16.2785 14.123 16.5851 14.2075 16.8813 14.2893C17.5157 14.4639 17.7733 14.5703 17.7703 14.9227L17.7703 14.9253C17.7703 15.2211 17.3399 15.3263 16.9712 15.3263C16.6229 15.3263 16.2441 15.1872 16.0294 14.9805L15.4995 15.437C15.7714 15.6989 16.1665 15.8841 16.5852 15.9567V16.5H17.3146V15.9684C18.0351 15.8744 18.4988 15.4794 18.4995 14.9269Z"
                                                         fill="black" />
                                                     <path
                                                         d="M16.2961 20.3435V20.4233C16.2961 20.9796 15.8451 21.4306 15.2888 21.4306H4.00681C3.4505 21.4306 2.99951 20.9796 2.99951 20.4233V4.0073C2.99951 3.45098 3.4505 3 4.00681 3L15.6295 3.00017"
                                                         stroke="black" stroke-width="1.5" stroke-miterlimit="10"
                                                         stroke-linecap="round" stroke-linejoin="round" />
                                                     <path
                                                         d="M12.6875 3.00017L15.2891 3C15.8454 3 16.2964 3.45098 16.2964 4.0073V7.45965"
                                                         stroke="black" stroke-width="1.5" stroke-miterlimit="10"
                                                         stroke-linecap="round" stroke-linejoin="round" />
                                                     <path
                                                         d="M6.15711 6.72926C6.40622 6.72926 6.60816 6.52731 6.60816 6.2782C6.60816 6.02909 6.40622 5.82715 6.15711 5.82715C5.908 5.82715 5.70605 6.02909 5.70605 6.2782C5.70605 6.52731 5.908 6.72926 6.15711 6.72926Z"
                                                         stroke="black" stroke-width="1.5" stroke-miterlimit="10"
                                                         stroke-linecap="round" stroke-linejoin="round" />
                                                     <path d="M8.86328 6.27783H13.3738" stroke="black" stroke-width="1.5"
                                                         stroke-miterlimit="10" stroke-linecap="round"
                                                         stroke-linejoin="round" />
                                                     <path
                                                         d="M6.15711 10.3377C6.40622 10.3377 6.60816 10.1357 6.60816 9.8866C6.60816 9.63749 6.40622 9.43555 6.15711 9.43555C5.908 9.43555 5.70605 9.63749 5.70605 9.8866C5.70605 10.1357 5.908 10.3377 6.15711 10.3377Z"
                                                         stroke="black" stroke-width="1.5" stroke-miterlimit="10"
                                                         stroke-linecap="round" stroke-linejoin="round" />
                                                     <path d="M8.86279 9.88672H10.8628" stroke="black" stroke-width="1.5"
                                                         stroke-miterlimit="10" stroke-linecap="round"
                                                         stroke-linejoin="round" />
                                                     <path
                                                         d="M6.15711 13.9461C6.40622 13.9461 6.60816 13.7441 6.60816 13.495C6.60816 13.2459 6.40622 13.0439 6.15711 13.0439C5.908 13.0439 5.70605 13.2459 5.70605 13.495C5.70605 13.7441 5.908 13.9461 6.15711 13.9461Z"
                                                         stroke="black" stroke-width="1.5" stroke-miterlimit="10"
                                                         stroke-linecap="round" stroke-linejoin="round" />
                                                     <path d="M8.86328 13.4951H10.6675" stroke="black" stroke-width="1.5"
                                                         stroke-miterlimit="10" stroke-linecap="round"
                                                         stroke-linejoin="round" />
                                                     <path
                                                         d="M6.15711 17.5545C6.40622 17.5545 6.60816 17.3525 6.60816 17.1034C6.60816 16.8543 6.40622 16.6523 6.15711 16.6523C5.908 16.6523 5.70605 16.8543 5.70605 17.1034C5.70605 17.3525 5.908 17.5545 6.15711 17.5545Z"
                                                         stroke="black" stroke-width="1.5" stroke-miterlimit="10"
                                                         stroke-linecap="round" stroke-linejoin="round" />
                                                     <path d="M8.86328 17.1035H10.6675" stroke="black" stroke-width="1.5"
                                                         stroke-miterlimit="10" stroke-linecap="round"
                                                         stroke-linejoin="round" />
                                                 </svg>
                                                 {{ trans('label.my_review_my_feed') }}
                                             </a>
                                             <a class="dropdown-item @if (Route::is('subscription.chatgpt-service-plan')) active @endif"
                                                 href="{{route('contact-us')}}">
                                                 <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                                                     viewBox="0 0 24 24" fill="none">
                                                     <path
                                                         d="M19.4974 17.061C18.8016 17.647 17.9032 18 16.9224 18C14.7132 18 12.9224 16.2091 12.9224 14C12.9224 11.7909 14.7132 10 16.9224 10C19.1315 10 20.9224 11.7909 20.9224 14C20.9224 14.8043 20.685 15.5532 20.2764 16.1804"
                                                         stroke="black" stroke-width="1.5" stroke-miterlimit="10"
                                                         stroke-linecap="round" stroke-linejoin="round" />
                                                     <path
                                                         d="M18.4995 14.9269C18.5027 14.5313 18.331 14.2184 17.9885 13.9975C17.724 13.8274 17.403 13.7387 17.0925 13.6534C16.4458 13.4749 16.2582 13.3808 16.2582 13.0991C16.2582 12.7854 16.7059 12.6737 17.0892 12.6737C17.3683 12.6737 17.6894 12.7528 17.8889 12.8699L18.2843 12.3122C18.0236 12.1583 17.6669 12.0534 17.3146 12.0208V11.5H16.5852V12.0573C15.9369 12.1872 15.5285 12.5731 15.5285 13.0991C15.5285 13.4675 15.6965 13.7597 16.0271 13.9657C16.2785 14.123 16.5851 14.2075 16.8813 14.2893C17.5157 14.4639 17.7733 14.5703 17.7703 14.9227L17.7703 14.9253C17.7703 15.2211 17.3399 15.3263 16.9712 15.3263C16.6229 15.3263 16.2441 15.1872 16.0294 14.9805L15.4995 15.437C15.7714 15.6989 16.1665 15.8841 16.5852 15.9567V16.5H17.3146V15.9684C18.0351 15.8744 18.4988 15.4794 18.4995 14.9269Z"
                                                         fill="black" />
                                                     <path
                                                         d="M16.2961 20.3435V20.4233C16.2961 20.9796 15.8451 21.4306 15.2888 21.4306H4.00681C3.4505 21.4306 2.99951 20.9796 2.99951 20.4233V4.0073C2.99951 3.45098 3.4505 3 4.00681 3L15.6295 3.00017"
                                                         stroke="black" stroke-width="1.5" stroke-miterlimit="10"
                                                         stroke-linecap="round" stroke-linejoin="round" />
                                                     <path
                                                         d="M12.6875 3.00017L15.2891 3C15.8454 3 16.2964 3.45098 16.2964 4.0073V7.45965"
                                                         stroke="black" stroke-width="1.5" stroke-miterlimit="10"
                                                         stroke-linecap="round" stroke-linejoin="round" />
                                                     <path
                                                         d="M6.15711 6.72926C6.40622 6.72926 6.60816 6.52731 6.60816 6.2782C6.60816 6.02909 6.40622 5.82715 6.15711 5.82715C5.908 5.82715 5.70605 6.02909 5.70605 6.2782C5.70605 6.52731 5.908 6.72926 6.15711 6.72926Z"
                                                         stroke="black" stroke-width="1.5" stroke-miterlimit="10"
                                                         stroke-linecap="round" stroke-linejoin="round" />
                                                     <path d="M8.86328 6.27783H13.3738" stroke="black" stroke-width="1.5"
                                                         stroke-miterlimit="10" stroke-linecap="round"
                                                         stroke-linejoin="round" />
                                                     <path
                                                         d="M6.15711 10.3377C6.40622 10.3377 6.60816 10.1357 6.60816 9.8866C6.60816 9.63749 6.40622 9.43555 6.15711 9.43555C5.908 9.43555 5.70605 9.63749 5.70605 9.8866C5.70605 10.1357 5.908 10.3377 6.15711 10.3377Z"
                                                         stroke="black" stroke-width="1.5" stroke-miterlimit="10"
                                                         stroke-linecap="round" stroke-linejoin="round" />
                                                     <path d="M8.86279 9.88672H10.8628" stroke="black" stroke-width="1.5"
                                                         stroke-miterlimit="10" stroke-linecap="round"
                                                         stroke-linejoin="round" />
                                                     <path
                                                         d="M6.15711 13.9461C6.40622 13.9461 6.60816 13.7441 6.60816 13.495C6.60816 13.2459 6.40622 13.0439 6.15711 13.0439C5.908 13.0439 5.70605 13.2459 5.70605 13.495C5.70605 13.7441 5.908 13.9461 6.15711 13.9461Z"
                                                         stroke="black" stroke-width="1.5" stroke-miterlimit="10"
                                                         stroke-linecap="round" stroke-linejoin="round" />
                                                     <path d="M8.86328 13.4951H10.6675" stroke="black" stroke-width="1.5"
                                                         stroke-miterlimit="10" stroke-linecap="round"
                                                         stroke-linejoin="round" />
                                                     <path
                                                         d="M6.15711 17.5545C6.40622 17.5545 6.60816 17.3525 6.60816 17.1034C6.60816 16.8543 6.40622 16.6523 6.15711 16.6523C5.908 16.6523 5.70605 16.8543 5.70605 17.1034C5.70605 17.3525 5.908 17.5545 6.15711 17.5545Z"
                                                         stroke="black" stroke-width="1.5" stroke-miterlimit="10"
                                                         stroke-linecap="round" stroke-linejoin="round" />
                                                     <path d="M8.86328 17.1035H10.6675" stroke="black" stroke-width="1.5"
                                                         stroke-miterlimit="10" stroke-linecap="round"
                                                         stroke-linejoin="round" />
                                                 </svg>
                                                 {{ trans('label.help_center') }}
                                             </a>
                                         @endrole
                                         @role('employer')
                                             <a class="dropdown-item @if (Route::is('shortlisted-candidate.index')) active @endif"
                                                 href="{{ route('shortlisted-candidate.index') }}">
                                                 <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                                                     viewBox="0 0 22 22" fill="none">
                                                     <path
                                                         d="M14.7686 2.75C17.9973 2.75 20.1667 5.82313 20.1667 8.69C20.1667 14.4959 11.163 19.25 11 19.25C10.8371 19.25 1.83337 14.4959 1.83337 8.69C1.83337 5.82313 4.00282 2.75 7.23152 2.75C9.08523 2.75 10.2973 3.68844 11 4.51344C11.7028 3.68844 12.9149 2.75 14.7686 2.75Z"
                                                         stroke="black" stroke-width="1.5" stroke-linecap="round"
                                                         stroke-linejoin="round" />
                                                 </svg>
                                                 {{ trans('label.favorites') }}</a>
                                                 <a class="dropdown-item" href="{{ route('messages.index') }}">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18" fill="none">
                                                        <path d="M4.46701 5.76714H8.80078M4.46701 8.80078H11.401M4.46701 14.0013V16.0256C4.46701 16.4875 4.46701 16.7184 4.56169 16.837C4.64402 16.9401 4.76888 17.0001 4.90086 17C5.05262 16.9998 5.23294 16.8556 5.59358 16.5671L7.66119 14.913C8.08356 14.5751 8.29474 14.4061 8.52991 14.286C8.73855 14.1794 8.96063 14.1015 9.19014 14.0544C9.44883 14.0013 9.71928 14.0013 10.2602 14.0013H12.4411C13.8974 14.0013 14.6256 14.0013 15.1818 13.7179C15.6711 13.4686 16.0689 13.0708 16.3182 12.5815C16.6016 12.0253 16.6016 11.2972 16.6016 9.84089V5.16042C16.6016 3.70413 16.6016 2.97599 16.3182 2.41977C16.0689 1.9305 15.6711 1.53271 15.1818 1.28341C14.6256 1 13.8974 1 12.4411 1H5.16042C3.70413 1 2.97599 1 2.41977 1.28341C1.9305 1.53271 1.53271 1.9305 1.28341 2.41977C1 2.97599 1 3.70413 1 5.16042V10.5343C1 11.3403 1 11.7434 1.0886 12.074C1.32904 12.9714 2.02993 13.6723 2.92726 13.9127C3.25793 14.0013 3.66096 14.0013 4.46701 14.0013Z" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                    </svg>
                                                    {{ trans('label.messages') }} @if (Auth::user()->id)
                                                    ({{ $notificationUnreadCount }})@endif
                                                </a>
                                             <a class="dropdown-item" href="{{ route('users.profile') }}">
                                                 <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                                                     viewBox="0 0 20 20" fill="none">
                                                     <path
                                                         d="M3.87197 16.8187C4.4296 15.5049 5.73154 14.5835 7.2487 14.5835H12.7487C14.2659 14.5835 15.5678 15.5049 16.1254 16.8187M13.6654 7.7085C13.6654 9.73354 12.0237 11.3752 9.9987 11.3752C7.97365 11.3752 6.33203 9.73354 6.33203 7.7085C6.33203 5.68345 7.97365 4.04183 9.9987 4.04183C12.0237 4.04183 13.6654 5.68345 13.6654 7.7085ZM19.1654 10.0002C19.1654 15.0628 15.0613 19.1668 9.9987 19.1668C4.93609 19.1668 0.832031 15.0628 0.832031 10.0002C0.832031 4.93755 4.93609 0.833496 9.9987 0.833496C15.0613 0.833496 19.1654 4.93755 19.1654 10.0002Z"
                                                         stroke="black" stroke-width="1.5" stroke-linecap="round"
                                                         stroke-linejoin="round" />
                                                 </svg>
                                                 {{ trans('label.profile') }}
                                             </a>
                                             <a class="dropdown-item @if (Route::is('subscription.service.employer')) active @endif"
                                             href="{{ route('subscription.service.employer') }}">
                                             <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                                                 viewBox="0 0 22 22" fill="none">
                                                 <path
                                                     d="M5.50004 5.49967L7.33337 3.66634M7.33337 3.66634L5.50004 1.83301M7.33337 3.66634H5.50004C3.475 3.66634 1.83337 5.30796 1.83337 7.33301M16.5 16.4997L14.6667 18.333M14.6667 18.333L16.5 20.1663M14.6667 18.333H16.5C18.5251 18.333 20.1667 16.6914 20.1667 14.6663M9.33998 5.95801C9.95054 3.58582 12.1039 1.83301 14.6667 1.83301C17.7043 1.83301 20.1667 4.29544 20.1667 7.33301C20.1667 9.89577 18.4139 12.0491 16.0418 12.6597M12.8334 14.6663C12.8334 17.7039 10.3709 20.1663 7.33337 20.1663C4.29581 20.1663 1.83337 17.7039 1.83337 14.6663C1.83337 11.6288 4.29581 9.16634 7.33337 9.16634C10.3709 9.16634 12.8334 11.6288 12.8334 14.6663Z"
                                                     stroke="black" stroke-width="1.5" stroke-linecap="round"
                                                     stroke-linejoin="round" />
                                             </svg>
                                             {{ trans('label.packages') }}
                                         </a>

                                         @endrole


                                         <a href="#"
                                             onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                                             class="dropdown-item">
                                             <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                                                 viewBox="0 0 20 18" fill="none">
                                                 <path
                                                     d="M15.4987 5.33333L19.1654 9M19.1654 9L15.4987 12.6667M19.1654 9H7.2487M12.7487 1.8537C11.5802 1.15175 10.2235 0.75 8.77648 0.75C4.38888 0.75 0.832031 4.44365 0.832031 9C0.832031 13.5563 4.38888 17.25 8.77648 17.25C10.2235 17.25 11.5802 16.8482 12.7487 16.1463"
                                                     stroke="black" stroke-width="1.5" stroke-linecap="round"
                                                     stroke-linejoin="round" />
                                             </svg>
                                             {{ trans('label.logout') }}
                                         </a>

                                     </div>
                                 </div>

                             </li>
                         </ul>
                     </div>
                 @else
                     <ul class="navbar-nav outer-nav order-lg-1 justify-content-end mr-0 login_menu_wraper">
                         <li class="nav-item mr-0">
                             <a class="nav-link btn btn-white"
                                 href="{{ route('front.register', ['type' => 'jobseeker']) }}">{{ trans('label.register') }}</a>
                         </li>
                         <li class="nav-item mr-0">
                             <a class="nav-link btn btn-black text-white" href="{{ route('login') }}">Sign In</a>
                         </li>
                     </ul>
                     <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                         <div class="menu_close p-2 text-right d-lg-none">
                             <button class="navbar-toggler p-0 close_menu_btn" type="button" data-toggle="collapse"
                                 data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup"
                                 aria-expanded="true" aria-label="Toggle navigation">
                                 <svg width="32" height="32" fill="#fff" viewBox="0 0 24 24"
                                     xmlns="http://www.w3.org/2000/svg">
                                     <path fill-rule="evenodd"
                                         d="M19.505 4.975a.6.6 0 0 1 0 .85l-13.2 13.2a.6.6 0 0 1-.85-.85l13.2-13.2a.598.598 0 0 1 .85 0Z"
                                         clip-rule="evenodd"></path>
                                     <path fill-rule="evenodd"
                                         d="M5.456 4.975a.6.6 0 0 0 0 .85l13.2 13.2a.6.6 0 1 0 .85-.85l-13.2-13.2a.6.6 0 0 0-.85 0Z"
                                         clip-rule="evenodd"></path>
                                 </svg>
                             </button>
                         </div>
                         <ul class="navbar-nav mx-auto">
                             <li class="nav-item">
                                 <a class="nav-link @if (Route::is('search-jobs.index')) active @endif"
                                     href="{{ route('search-jobs.index') }}"> {{ trans('label.find_jobs') }}</a>
                             </li>
                             <li class="nav-item">
                                 <a class="nav-link @if (Route::is('career-service')) active @endif"
                                     href="{{ route('career-service') }}" {{-- href="{{ route('subscription.service') }}" --}}>
                                     {{ trans('label.career_services') }}</a>
                             </li>
                             <li class="nav-item">
                                 <a class="nav-link @if (Route::is('candidates.index')) active @endif"
                                     href="{{ route('candidates.index') }}"> {{ trans('label.employees') }}</a>
                             </li>
                             <li class="nav-item">
                                 <a class="nav-link @if (Route::is('jobseeker.landing')) active @endif"
                                     href="{{ route('employers.index') }}"> {{ trans('label.employers') }}</a>
                             </li>
                             <li class="nav-item">
                                 <a class="nav-link @if (Route::is('employer.landing')) active @endif"
                                     href="{{ route('userReviews.feed') }}"> {{ trans('label.feed') }}</a>
                             </li>
                         </ul>
                     </div>
                 @endauth
             @endif

         </div>
     </nav>
 </header>
