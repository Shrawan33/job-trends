 <!-- Navigation-->
 <header>
     <nav class="navbar navbar-expand-sm @yield('class') py-3">
         <div class="container">
             <a class="navbar-brand" href="#">
                <img src="{{ asset('img/main-logo.svg') }}" alt="TM">
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
             <ul class="navbar-nav">
             <li class="nav-item">
                 <a class="nav-link"  href="{{ route('front.register',['type'=>'employer']) }}">Register as Employer</a>
                 </li>
                 <li class="nav-item">
                    <a class="nav-link" href="{{ route('front.register',['type'=>'jobseeker']) }}">Register as Job seeker</a>
                 </li>
                 <li class="nav-item">
                     <a class="nav-link btn btn-primary rounded-pill px-4 text-white" href="{{ route('login') }}">Login</a>
                 </li>
             </ul>
         </div>
     </nav>
 </header>
