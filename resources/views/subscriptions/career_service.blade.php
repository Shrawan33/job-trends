@extends('layouts.front')

@section('content')
<div class="career_Page_main_wraper feeds_Page_main_wraper home_main_baneer mb-40 mb-lg-100">
    <div class="job_top_banner bg_frame position-relative">
        <img src="{{ asset('images/career_banner.png') }}" alt="fea_img" width="100%" class="inner_banner">
        <div class="container">
            <div class="text-center position-relative pt-lg-30">
                <h1 class="text-parimary"> {{ trans('label.career_service') }}</h1>
                <p class="mb-30 mb-lg-50">
                    Every organization seeks the right resources to fuel its growth, each recruiter with a unique perspective. Be that sought-after resource by presenting yourself impeccably with our comprehensive Career Services. From our advanced AI-powered Smart Resume Builder to expert-level Professional CV Writing and Professional Resume Writing services offered by seasoned HR professionals, we offer a full spectrum of solutions. Elevate your professional profile with us, optimizing your CV and resume for success in today's competitive job market.
                </p>
                <img src="{{ asset('images/career_banner_tag.png') }}" alt="fea_img" class="inner_tag">
            </div>
        </div>
    </div>

    <div class="container">
    <div class="row career_box_wraper">
        <div class="col-md-6 col-lg-3 mb-4">
          <div class="inner_box">
            <div class="icon_wraper">
                <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 40 40" fill="none">
                    <path d="M31 31.4737V31.7347V32.9957C31 35.7572 28.7614 37.9957 26 37.9957L21.8977 37.9957L7.59156 38C5.05572 38 3 35.9511 3 33.4237V6.57627C3 4.04887 5.05572 2 7.59156 2H9.77517H21.0671H26.4084C28.9443 2 31 4.04887 31 6.57627V17.6039" stroke="#FF7D57" stroke-width="2" stroke-miterlimit="10" stroke-linecap="round"/>
                    <path d="M9 29H12.1167M15.1725 29H25.9267" stroke="#FF7D57" stroke-width="2" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M25.9267 32.3867H22.8099M19.7541 32.3867H9" stroke="#FF7D57" stroke-width="2" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M24.7996 13.0028C23.9927 8.40018 19.6075 5.3216 15.0029 6.12844C10.3984 6.93528 7.32165 11.3224 8.1285 15.927C8.93534 20.5296 13.3205 23.6082 17.9251 22.8014C22.5297 21.9946 25.6083 17.6074 24.7996 13.0028Z" stroke="#FF7D57" stroke-width="2" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M16.464 10.3008C18.2284 10.3008 19.6589 11.7314 19.6589 13.4957C19.6589 15.2601 18.2284 16.6907 16.464 16.6907C14.6997 16.6907 13.2691 15.2601 13.2691 13.4957C13.2691 11.7314 14.6997 10.3008 16.464 10.3008Z" stroke="#FF7D57" stroke-width="2" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M14.3411 15.8838C12.5443 16.6506 11.2777 18.4359 11.2777 20.5055V21.1521M21.6504 21.1521V20.5055C21.6504 18.4359 20.3839 16.6506 18.587 15.8838" stroke="#FF7D57" stroke-width="2" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M26.253 21.3344C26.9245 20.3769 28.2578 20.1423 29.2153 20.8137L34.5103 24.5294C35.4679 25.2009 35.7025 26.536 35.0311 27.4936C34.3577 28.4511 33.0263 28.6839 32.0669 28.0124L26.7718 24.2967C25.8143 23.6253 25.5816 22.2901 26.253 21.3344Z" stroke="#FF7D57" stroke-width="2" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                  </svg>
                </div>
                  <h5 class="title">Smart Resume Builder</h5>
              <p class="info">Take control of your career journey with our Smart Resume Builder. It's easy, affordable, and all about you. Craft a standout resume that reflects your story. Your future begins with the right words on paper. Start building Now!</p>
              <a href="{{ route('subscription.chatgpt-service-plan') }}" class="btn btn-primary">Explore more
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18" fill="none">
                    <path d="M3 9H15M15 9L10.5 13.5M15 9L10.5 4.5" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                  </svg>
              </a>

              {{-- <a href="javascript:void(0);" class="btn btn-primary" onclick="showContentModal('', '<div class=\'alert alert-info\' role=\'alert\'>We will bring this feature soon</div>')">Explore more
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18" fill="none">
                    <path d="M3 9H15M15 9L10.5 13.5M15 9L10.5 4.5" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                  </svg>
              </a> --}}
          </div>
        </div>
        <div class="col-md-6 col-lg-3 mb-4">
          <div class="inner_box">
            <div class="icon_wraper">
                <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 40 40" fill="none">
                    <path d="M31 27.4737V31.7347V32.9957C31 35.7572 28.7614 37.9957 26 37.9957L21.8977 37.9957L7.59156 38C5.05572 38 3 35.9511 3 33.4237V6.57627C3 4.04887 5.05572 2 7.59156 2H9.77517H21.0671H26.4084C28.9443 2 31 4.04887 31 6.57627V11.6039" stroke="#FF7D57" stroke-width="2" stroke-miterlimit="10" stroke-linecap="round"/>
                    <path d="M24 27L28.3066 25.3436C28.582 25.2377 28.7197 25.1847 28.8486 25.1155C28.963 25.0541 29.0722 24.9832 29.1748 24.9036C29.2903 24.8139 29.3947 24.7096 29.6034 24.5009L38.3571 15.7471C39.2143 14.8899 39.2143 13.5001 38.3571 12.6429C37.4999 11.7857 36.1101 11.7857 35.2529 12.6429L26.4991 21.3966C26.2904 21.6053 26.1861 21.7097 26.0964 21.8252C26.0168 21.9278 25.9459 22.0369 25.8845 22.1514C25.8153 22.2803 25.7623 22.418 25.6564 22.6934L24 27ZM24 27L25.5972 22.8473C25.7115 22.5501 25.7687 22.4015 25.8667 22.3335C25.9523 22.274 26.0583 22.2515 26.1608 22.2711C26.278 22.2934 26.3906 22.406 26.6157 22.6311L28.3689 24.3843C28.594 24.6095 28.7066 24.722 28.729 24.8392C28.7485 24.9417 28.726 25.0477 28.6665 25.1333C28.5985 25.2314 28.4499 25.2885 28.1527 25.4028L24 27Z" stroke="#FF7D57" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M12 24.9062L21.2925 24.9019" stroke="#FF7D57" stroke-width="2" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M12 29.9062L21.2925 29.9019" stroke="#FF7D57" stroke-width="2" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M12.6562 9.35938C12.6562 7.50406 14.1603 6 16.0156 6C17.8709 6 19.375 7.50406 19.375 9.35938C19.375 11.2147 17.8709 12.7188 16.0156 12.7188C14.1603 12.7188 12.6562 11.2147 12.6562 9.35938Z" stroke="#FF7D57" stroke-width="2" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M21.0011 18.8125C21.6568 18.8125 22.1427 18.2075 22.009 17.5641C21.4343 14.7973 18.9876 12.7188 16.0565 12.7188H15.9747C13.0436 12.7188 10.597 14.7973 10.0222 17.5641C9.88856 18.2075 10.3745 18.8125 11.0302 18.8125H21.0011Z" stroke="#FF7D57" stroke-width="2" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                  </svg>
            </div>
                  <h5 class="title">Professional CV Writing</h5>
              <p class="info">Kickstart your professional CV writing journey by selecting your experience level and placing an order. Choose from our range of services tailored to meet your unique career needs.</p>
              <a href="{{ route('subscription.service') }}" class="btn btn-primary">Explore more
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18" fill="none">
                    <path d="M3 9H15M15 9L10.5 13.5M15 9L10.5 4.5" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                  </svg>
              </a>

          </div>
        </div>
        <div class="col-md-6 col-lg-3 mb-4">
            <div class="inner_box">
              <div class="icon_wraper">
                <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 40 40" fill="none">
                    <path d="M24.6094 22.4375C24.6094 22.9898 24.1617 23.4375 23.6094 23.4375H9.20312C8.65084 23.4375 8.20312 22.9898 8.20312 22.4375V12.7188C8.20312 12.1665 8.65084 11.7188 9.20312 11.7188H23.6094C24.1617 11.7188 24.6094 12.1665 24.6094 12.7187V22.4375Z" stroke="#FF7D57" stroke-width="2" stroke-miterlimit="10"/>
                    <path d="M12.8906 11.7188V10.2742C12.8906 8.94811 13.4354 7.61337 14.7124 7.25564C15.185 7.12323 15.7496 7.03125 16.4062 7.03125C17.0629 7.03125 17.6275 7.12323 18.1001 7.25564C19.3771 7.61337 19.9219 8.94811 19.9219 10.2742V11.7188" stroke="#FF7D57" stroke-width="2" stroke-miterlimit="10"/>
                    <path d="M8.20312 16.4062H24.6094" stroke="#FF7D57" stroke-width="2" stroke-miterlimit="10"/>
                    <path d="M16.4062 19.9219V16.4062" stroke="#FF7D57" stroke-width="2" stroke-miterlimit="10" stroke-linecap="round"/>
                    <path d="M16.4062 31.6406C8.00625 31.6406 1.17188 24.8062 1.17188 16.4062C1.17188 8.00625 8.00625 1.17188 16.4062 1.17188C24.8062 1.17188 31.6406 8.00625 31.6406 16.4062C31.6406 24.8062 24.8062 31.6406 16.4062 31.6406Z" stroke="#FF7D57" stroke-width="2" stroke-miterlimit="10"/>
                    <path d="M29.3636 26.0494L36.6866 33.3724C37.6018 34.2876 37.6018 35.7714 36.6866 36.6866V36.6866C35.7714 37.6018 34.2876 37.6018 33.3724 36.6866L25.8681 29.1823" stroke="#FF7D57" stroke-width="2" stroke-miterlimit="10" stroke-linecap="square" stroke-linejoin="round"/>
                  </svg>
              </div>
                  <h5 class="title">Military Transition Resumes & Career Guidance</h5>
                <p class="info">Are you an Indian Defence services veteran transitioning to civilian life? Your unique skills and experiences deserve a resume that speaks the language of both worlds. </p>
                <a href="{{ route('subscription.military-service') }}" class="btn btn-primary">Explore more
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18" fill="none">
                        <path d="M3 9H15M15 9L10.5 13.5M15 9L10.5 4.5" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                      </svg>
                </a>

            </div>
        </div>
        <div class="col-md-6 col-lg-3 mb-4">
          <div class="inner_box">
            <div class="icon_wraper">
              <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 40 40" fill="none">
                  <path d="M12.9686 36.4062H27.0311" stroke="#FF7D57" stroke-width="2" stroke-miterlimit="22.9256" stroke-linecap="round" stroke-linejoin="round"/>
                  <path d="M15.3186 36.3839L16.9813 30.1787" stroke="#FF7D57" stroke-width="2" stroke-miterlimit="22.9256" stroke-linecap="round" stroke-linejoin="round"/>
                  <path d="M24.6813 36.3839L23.0187 30.1787" stroke="#FF7D57" stroke-width="2" stroke-miterlimit="22.9256" stroke-linecap="round" stroke-linejoin="round"/>
                  <path d="M4.6875 25.8598V24.7631C4.6875 20.6743 8.03281 17.3291 12.1216 17.3291C16.2103 17.3291 19.5556 20.6744 19.5556 24.7631V25.8598" stroke="#FF7D57" stroke-width="2" stroke-miterlimit="22.9256" stroke-linecap="round" stroke-linejoin="round"/>
                  <path d="M13.4586 17.1074C15.6359 16.3689 16.8023 14.0051 16.0638 11.8277C15.3253 9.65034 12.9615 8.4839 10.7842 9.2224C8.60687 9.9609 7.44048 12.3247 8.17899 14.502C8.91751 16.6794 11.2813 17.8459 13.4586 17.1074Z" stroke="#FF7D57" stroke-width="2" stroke-miterlimit="22.9256" stroke-linecap="round" stroke-linejoin="round"/>
                  <path fill-rule="evenodd" clip-rule="evenodd" d="M21.9527 7.5H33.3263C34.2954 7.5 35.0883 8.29414 35.0883 9.26484V16.7584C35.0883 17.7291 34.2954 18.5233 33.3263 18.5233H27.2467L22.7991 21.2057V18.5233H21.9528C20.9837 18.5233 20.1908 17.7291 20.1908 16.7584V9.26484C20.1907 8.29414 20.9836 7.5 21.9527 7.5Z" stroke="#FF7D57" stroke-width="2" stroke-miterlimit="2.6131" stroke-linecap="round" stroke-linejoin="round"/>
                  <path d="M24.0969 11.4062H31.182M28.8383 14.617H24.097" stroke="#FF7D57" stroke-width="2" stroke-miterlimit="22.9256" stroke-linecap="round" stroke-linejoin="round"/>
                  <rect x="1" y="2" width="38" height="25" rx="4" stroke="#FF7D57" stroke-width="2" stroke-miterlimit="22.9256" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </div>
              <h5 class="title">Quick Real Time Interviews with Industry Experts</h5>
              <p class="info">Stop facing rejections and experience success in every interview! Unlock insights to elevate your interview game and secure your dream job.</p>
              <a href="{{ route('subscription.interview-plan') }}" class="btn btn-primary">Explore more
                  <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18" fill="none">
                      <path d="M3 9H15M15 9L10.5 13.5M15 9L10.5 4.5" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
              </a>

          </div>
        </div>
      </div>

    </div>
      @endsection

