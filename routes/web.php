<?php

use App\Events\CreditUtilizationEvent;
use App\Events\ImageResize;
use App\Models\Document;
use App\Models\EmployerJob;
use App\Models\User;
use App\Models\UserPackageTransaction;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use Perception\Libraries\Ccavenue\Facades\Ccavenue;
use Perception\Libraries\Payment\Facades\PaymentFacade;
use Perception\Libraries\Payment\Payment;
use Softon\Indipay\Facades\Indipay;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;
use App\Http\View\Composers\FrontHomeComposer;
use App\Http\Controllers\CandidateController;



Route::impersonate();

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Start: test routes

// Route::get('test', function (Request $request) {
// $data = PaymentFacade::response($request->all());
// Log::info($data);
// return 'Payment has been completed successfully   =>   ' . $data;
// Ccavenue
// $parameters = [
//     'order_id' => '1233221223322',
//     'amount' => '1200.00',
//     'name' => 'Jon Doe',
//     'email' => 'jon@doe.com',
// ];
// // $ccavenue =
// $payment = Indipay::prepare($parameters);
// $order = Indipay::process($payment);
// // $order = $pat;
// return $order;
// $pay = $ccavenue->process($order);
// Mail::to('subash');
// dd($pay);

//     // Notification
// $users = App\Models\User::whereFirstName('Job Seeker 1')->first();
// dd($users->id);
//     $object = App\Models\EmployerJob::first();
// (new App\ClaErrorException

// Route::get('event/{event_name}', function ($event_name = '') {
//     $entity = [];
//     if ($event_name == 'job_posts') {
//         $entity = EmployerJob::whereId(1)->first();
//     } elseif ($event_name == 'profile') {
//         $user_id = 10;
//         $unlocked = UserPackageTransaction::whereHasMorph(
//             'transactable',
//             [User::class],
//             function (Builder $query) {
//                 $query->whereUserId(auth()->user()->id);
//             }
//         )->where('transactable_id', $user_id)->first();
//         if (empty($unlocked)) {
//             $entity = User::whereId($user_id)->first();
//         }
//         // dd($unlocked, $entity);
//     }

//     if (!empty($entity)) {
//         $userPackage = auth()->user()->activeUserPackage;
//         try {
//             throw_if(empty($userPackage), BadRequestException::class, trans('message.no_active_plan_available'));
//             CreditUtilizationEvent::dispatch($entity, $userPackage, $event_name);
//         } catch (Throwable $e) {
//             throw $e;
//         }
//     }
// });
// End: test routes
// Route::get('resize', function() {
//     $imagePath = Storage::path('images/banner_bg.png');
//     $img = Document::resize Image($imagePath, [100,100]);
//         $this->setDisk($this->disk);
//         //$img->resize(100,100);
//         Log::info('Image ', ['Image' => $img]);

//         $file_name = '_thumbnail'.'.'.$filename_array[1];
//         $file_path_name = $this->storage->uploadBase64('', $file_name, $img);
//         Log::info('Uploaded ', ['FilePath' => $file_path_name]);
// });
Route::get('test-mail', function () {
    // return Mail::to('mhdaamir67@gmail.com')->send();
    return Mail::raw('Hi, welcome user!', function ($message) {
        $message->to('mhdaamir67@gmail.com')
            ->subject("Testing this mail");
    });
});

Route::get('test-image', function () {
    // return Mail::to('mhdaamir67@gmail.com')->send();
    event(new ImageResize(79, []));
});


// Start: design routes
Route::get('/homenew', function () {
    return view('design/home');
});
Route::get('/makecv', function () {
    return view('design/make-cv');
});
Route::get('/socialPage', function () {
    return view('design/socialPage');
});

// route::get('/offerthank', function () {
//     return view('design/offer-thank');
// });
// Route::get('/events', function () {
//     return view('design/events');
// });


// Route::get('/events', function () {
//     // Resolve the FrontHomeComposer from the service container
//     $frontHomeComposer = app()->make(FrontHomeComposer::class);

//     // Create a view instance for 'design/events'
//     $view = view('design/events');

//     // Call the compose method of the FrontHomeComposer and pass the view instance
//     $frontHomeComposer->compose($view);

//     // Retrieve the 'events' data from the view
//     $events = $view->getData()['events'];

//     // Pass the events data to the 'design/events' view
//     return view('design/events', compact('events'));
// });

// Route::get('/blog', function () {
//     return view('design/blog');
// });
Route::get('/contact', function () {
    return view('design/contact');
});
Route::get('/faq', function () {
    return view('design/faq');
});

Route::get('/employer/view', function () {
    return view('design/viewemployer');
});
Route::get('/shortlist-candidate', function () {
    return view('design/shortlist-candidate');
});
Route::get('/message', function () {
    return view('design/message');
});
Route::get('/subscription', function () {
    return view('design/subscription');
});
Route::get('/about', function () {
    return view('design/about');
});
Route::get('/blogdetail', function () {
    return view('design/BlogDetail');
});
Route::get('/plan', function () {
    return view('design/plan');
});
Route::get('teacher', function () {
    return view('job-seeker');
})->name('jobseeker.landing');
Route::get('school', function () {
    return view('employer');
})->name('employer.landing');
// End: test routes

// Start: website routes
Route::get('/', 'HomeController@index')->name('home.verfied');

// Route::post('/langauge/{code}', 'HomeController@language')->name('home.language');

// registration Routes
Route::get('registration/{type}', 'Auth\RegisterController@create')->name('front.register');
Route::post('registration', 'Auth\RegisterController@store')->name('front.register.store');
Route::get('verification/{data}', 'Auth\RegisterController@createVerify')->name('front.register.verification.create');
Route::post('verification', 'Auth\RegisterController@verify')->name('front.register.verification');

Route::get('offer-register', 'Auth\RegisterController@guestRegister')->name('offer-register');
Route::post('guest-registration', 'Auth\RegisterController@storeGuestUser')->name('front.offer-register.store');
Route::get('offer-thank', 'Auth\RegisterController@offerThank')->name('offer-thank');

// login Routes
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('logout', 'Auth\LoginController@logout')->name('front.logout');
Auth::routes(['verify' => true]);

// social routes
Route::get('social/{provider}', 'Auth\SocialController@redirect')->name('social.login');
Route::get('social/{provider}/callback', 'Auth\SocialController@callback')->name('social.callback');

//password reset routes
Route::get('forgot-password', 'PasswordResetController@index')->name('forgot_password');
Route::post('forgot-password', 'PasswordResetController@store')->name('forgot_password.store');
Route::post('forgot-password/verify', 'PasswordResetController@create')->name('forgot_password.verify');
Route::get('forgot-password/reset/{token}', 'PasswordResetController@edit')->name('forgot_password.edit');
Route::post('forgot-password/reset', 'PasswordResetController@update')->name('forgot_password.reset');

// payment
Route::post('payment/{type}/initDirectTransaction', 'PaymentController@initDirectTransaction')->name('payment.initDirectTransaction');
// Route::get('payment/callback', 'PaymentController@commitTransaction')->name('payment.callback');
Route::post('payment/callback', 'PaymentController@commitTransaction')->name('payment.callback.post');

Route::get('/documents/make-thumbnail', 'DocumentController@makeThumbnail')->name('documents.makeThumbnail');
Route::get('userReview/{id}/review', 'UserReviewController@getRevieweFromUserList')->name('user_review.getRevieweFromUserList');

Route::post('/documents/create', 'DocumentController@create')->name('documents.create');
Route::post('/documents/delete', 'DocumentController@delete')->name('documents.delete');
Route::get('download/public-attachment/{id}', 'FrontUserController@downloadAttachment')->name('download-public-attachment');
Route::get('download/attachment/{id}', 'FrontUserController@downloadAttachment')->name('download-attachment');

Route::group(['middleware' => ['prevent-back-history', 'verified']], function () {
    // documents

    Route::post('/video/create', 'DocumentController@video')->name('video.create');
    Route::post('/audio/create', 'DocumentController@audio')->name('audio.create');

    // Route::post('/documents/ckeditor/upload', 'DocumentController@ckEditorUpload')->name('documents.ckeditor.upload');

    // to change email and phone
    Route::get('change-email-phone', 'ChangeEmailPhoneController@index')->name('change_email_phone');
    Route::post('change-email-phone', 'ChangeEmailPhoneController@store')->name('change_email_phone.store');
    Route::post('change-email-phone/verify', 'ChangeEmailPhoneController@create')->name('change_email_phone.verify');
});

// front guest
Route::get('ajax-skills', [CandidateController::class, 'ajaxSkills'])->name('ajax.skills');
Route::group(['namespace' => 'Front'], function () {
    Route::get('download/public-attachment/{id}', 'FrontUserController@downloadAttachment')->name('download-public-attachment');
    Route::get('interview-plans', 'SubscriptionController@interviewPlans')->name('subscription.interview-plan');
    Route::get('military-service', 'SubscriptionController@militaryService')->name('subscription.military-service');
    Route::get('career-service', 'SubscriptionController@career_service')->name('career-service');

    Route::get('order-detail/{order_number}', 'CartController@orderDetail')->name('order.detail');
    // search jobs in jobseeker

    if (config('constants.react_search_job')) {
        Route::get('search-jobs', function () {
            return view('search_jobs.react-search');
        })->name('search-jobs.index');
    } else {
        Route::resource('search-jobs', 'SearchJobController');
    }
    Route::get('{slug}/search-jobs', 'SearchJobController@categorySearch')->name('search-jobs.category.search');
    Route::post('{slug}/search-jobs', 'SearchJobController@categorySearch')->name('search-jobs.post.category.search');
    Route::post('search-jobs', 'SearchJobController@search')->name('search-jobs.search');
    Route::get('get-ajax-locations', 'SearchJobController@ajaxLocations')->name('ajax.locations');
    Route::get('get-ajax-states', 'SearchJobController@ajaxStates')->name('ajax.states');
    Route::get('get-ajax-countries', 'SearchJobController@ajaxCountries')->name('ajax.countries');
    Route::get('get-ajax-categories', 'SearchJobController@ajaxCategories')->name('ajax.categories');
    Route::get('get-ajax-skill', 'SearchJobController@ajaxSkill')->name('ajax.skill');
    Route::get('get-ajax-workType', 'SearchJobController@workType')->name('ajax.workType');
    Route::get('get-ajax-experience', 'SearchJobController@experience')->name('ajax.experience');



    Route::get('feeds', 'UserReviewController@feed')->name('userReviews.feed');
    Route::get('more-feeds', 'UserReviewController@loadMoreFeed')->name('userReviews.load-more-feed');


    //blog route
    Route::get('blog', 'PageController@blog')->name('blog');
    Route::get('blog/{id}', 'PageController@blogDetail')->name('blog.detail');

    //faq route
    Route::get('faq', 'PageController@faq')->name('faq');

    //contact route
    Route::get('events', 'FrontUserController@events')->name('events');
    Route::get('events/{event}', 'FrontUserController@eventshow')->name('eventShow');
    // Route::get('eventShow', 'FrontUserController@eventshow')->name('eventShow');
    Route::get('contact-us', 'PageController@contactUs')->name('contact-us');
    Route::get('contact-email', 'PageController@sendEnquiry')->name('contact-email');
    Route::get('terms-condition', 'PageController@terms')->name('terms-conditions');
    Route::get('privacy-policy', 'PageController@privacy')->name('privacy-policy');
    Route::get('career-advice', 'PageController@career_advice')->name('career-advice');
    Route::get('browse-companies', 'PageController@browse_companies')->name('browse-companies');
    Route::get('salaries', 'PageController@salaries')->name('salaries');
    // Route::get('events', 'PageController@events')->name('events');
    Route::get('work-with-us', 'PageController@work_with_us')->name('work-with-us');



    Route::get('employer-jobs', 'EmployerJobController@search')->name('employerJobs.search.jobs');
    Route::get('job-detail/{slug}', 'EmployerJobController@show')->name('job-detail');

    //about route
    Route::get('about-us', 'PageController@aboutUs')->name('about-us');

    Route::get('socialPage', 'PageController@socialPage')->name('socialPage');

    //employer view
    Route::get('company/{slug}', 'EmployerJobController@viewEmployer')->name('job-detail.employer.show');
    // Report Job
    Route::get('reports/{entity}/{id}', 'ReportController@create')->name('reports.create');
    Route::post('reports/{entity}/store', 'ReportController@store')->name('reports.store');

    Route::get('userReview/{id}/review', 'UserReviewController@getRevieweFromUserList')->name('user_review.getRevieweFromUserList');
    // Route::get
});
Route::group(['middleware' => ['prevent-back-history', 'verified']], function () {
    // Messages
    Route::group(['middleware' => ['role:employer|jobseeker']], function () {
        Route::group(['middleware' => ['role:employer|jobseeker']], function () {
            Route::get('messages', 'MessageController@index')->name('messages.index');
            Route::get('messages/{id}/create', 'MessageController@create')->name('send.messageForm');
            Route::get('messages/create-group-message', 'MessageController@createGroupMessage')->name('send.group.messageForm');
            Route::post('messages/send', 'MessageController@store')->name('send.message');
            Route::get('messages/{user_id}/list/{msg_type}', 'MessageController@list')->name('messages.list');
        });
    });
    Route::group(['middleware' => ['role:employer|jobseeker']], function () {
        // find candidate
        Route::get('jobseekers', 'CandidateController@index')->name('candidates.index');
        Route::get('jobseekers/{slug}', 'CandidateController@show')->name('candidates.show');
        Route::get('social-profile/{slug}', 'CandidateController@showSocial')->name('social-profile.show');
        Route::get('share-social/{slug}', 'CandidateController@shareSocial');

        //search
        Route::post('jobseekers', 'CandidateController@search')->name('candidates.search');
        Route::post('reviews', 'CandidateController@review')->name('reviews.search');
    });

    Route::group(['middleware' => ['role:jobseeker']], function () {
        Route::get('employers', 'EmployerController@index')->name('employers.index');
        Route::post('employers', 'EmployerController@search')->name('employers.search');
    });

    Route::group(['middleware' => ['role:account']], function () {
        Route::get('account/messages', 'MessageController@index')->name('account.messages.index');
        Route::get('account/messages/{id}/create', 'MessageController@create')->name('account.send.messageForm');
        Route::get('account/messages/create-group-message', 'MessageController@createGroupMessage')->name('account.send.group.messageForm');
        Route::post('account/messages/send', 'MessageController@store')->name('account.send.message');
        Route::get('account/messages/{user_id}/list/{msg_type}', 'MessageController@list')->name('account.messages.list');

        // find candidate
        Route::get('account/candidates', 'CandidateController@index')->name('account.candidates.index');

        //search
        Route::post('account/candidates', 'CandidateController@search')->name('account.candidates.search');
    });
    Route::group(['middleware' => ['role:mentor']], function () {
        // find candidate
        Route::get('mentor/candidates', 'CandidateController@index')->name('mentor.candidates.index');
        //search
        Route::post('mentor/candidates', 'CandidateController@search')->name('mentor.candidates.search');
    });
    // favourite candidate
    Route::get('candidates/{id}/favourite', 'CandidateController@makeFavourite')->name('candidates.favourit');
    Route::get('candidates/{id}/unfavourite', 'CandidateController@removeFavourite')->name('candidates.favourit.remove');
    Route::get('candidates/show/more', 'CandidateController@showMore')->name('candidates.show.more');
});
// front verified only [employer/jobseeker]
Route::group(['namespace' => 'Front', 'middleware' => ['prevent-back-history', 'verified']], function () {

    //Shopping cart
    //Route::get('add-to-cart/{id}', 'CartController@addToCart')->name('add-to-cart');
    //Route::get('cart', 'CartController@listCart')->name('cart.list');
    Route::post('update-cart', 'CartController@updateCart')->name('cart.update');
    Route::post('remove-cart', 'CartController@removeCart')->name('cart.remove');
    Route::get('checkout', 'CartController@checkout')->name('cart.checkout');
    //Shopping cart
    Route::post('add-to-cart', 'CartController@addToCart')->name('add-to-cart');
    Route::get('add-item-to-cart/{id}', 'CartController@addItemToCart')->name('add-item-to-cart');
    Route::get('cart', 'CartController@listCart')->name('cart.list');
    Route::post('process-payment', 'CartController@processPayment')->name('cart.process.payment');
    // Route::get('phonepay', 'CartController@phonePePayment')->name('cart.phonepay');
    Route::post('/payment/initiate', 'CartController@initiatePayment')->name('payment.initiate');
    Route::post('/payment/callback', 'CartController@paymentCallback')->name('payment.callback');
    Route::post('phonepay', 'CartController@phonepay')->name('payment.phonepay');
    Route::any('phonepay-response','CartController@response')->name('response');
    Route::get('pay/{order_number}', 'CartController@payOrder')->name('pay.order');
    Route::post('payment', 'CartController@payOrderStore')->name('cart.payment');
    //Route::get('order-detail/{order_number}', 'CartController@orderDetail')->name('order.detail');
    Route::get('orders', 'CartController@orderList')->name('order.list');

    Route::get('change-password', 'FrontUserController@changePassword')->name('change.password');
    Route::post('update-password', 'FrontUserController@updatePassword')->name('update.password');
    Route::post('remove-account', 'FrontUserController@removeAccount')->name('remove.account');
    Route::post('toggle-profile/{status}', 'FrontUserController@hideProfile')->name('toggle-profile-status');
    Route::get('pdf-header-html', 'FrontUserController@pdfHeader')->name('pdf-header-html');
    Route::get('pdf-footer-html', 'FrontUserController@pdfFooter')->name('pdf-footer-html');
    Route::get('make-a-cv/{id}', 'FrontUserController@makeCv')->name('make-cv');
    Route::get('download/cv/{id}', 'FrontUserController@downloadCv')->name('download-cv');
    Route::get('download/attachment/{id}', 'FrontUserController@downloadAttachment')->name('download-attachment');
    Route::get('download/order-attachment/{id}', 'OrderHistoryController@downloadAttachment')->name('download-order-attachment');
    Route::get('download/cover/{id}', 'FrontUserController@downloadCover')->name('download-cover');

    Route::get('download/profile/{seekerId}', 'FrontUserController@downloadProfile')->name('download-profile');

    Route::get('download/resume/{seekerId}', 'FrontUserController@downloadResume')->name('download-resume');


    Route::get('ajax-subcategories', 'EmployerJobController@ajaxSubcategories')->name('ajax.subcategories');

    // user profile
    Route::get('my-profile', 'FrontUserController@profile')->name('users.profile');
    Route::get('edit-profile/{mainTitle}', 'FrontUserController@editProfile')->name('users.edit.profile');
    Route::get('profile/{id}/delete/{type}', 'FrontUserController@deleteItemByType')->name('users.profile.destroy.list');
    // Route::get('edit-profile-help', 'FrontUserController@editProfileHelp')->name('profile.help');
    Route::get('edit-profile-help-payment', 'FrontUserController@payOrder')->name('profile.help.payment');
    Route::get('help', 'PageController@help')->name('help');



    // Route::group(['middleware' => ['role:employer|admin|mentor']], function () {

    //     Route::resource('candidateNotes', 'CandidateNoteController');
    //     Route::patch('candidateNotes/{id}/update-destroy', 'CandidateNoteController@updateDestroy')->name('candidateNotes.update-destroy');
    //     Route::delete('candidateNotes/{id}/update-destroy', 'CandidateNoteController@updateDestroy')->name('candidateNotes.update-destroy');

    //     // update employer profile
    //     Route::post('update-profile', 'FrontUserController@updateProfile')->name('users.update.profile');

    //     // job
    //     Route::resource('employerJobs', 'EmployerJobController');
    //     Route::patch('employerJobs/{id}/update-destroy', 'EmployerJobController@updateDestroy')->name('employerJobs.update-destroy');
    //     Route::delete('employerJobs/{id}/update-destroy', 'EmployerJobController@updateDestroy')->name('employerJobs.update-destroy');
    //     Route::get('employerJobs/{id}/clone', 'EmployerJobController@clone')->name('employerJobs.clone');
    //     Route::patch('employerJobs/{id}/clone', 'EmployerJobController@store')->name('employerJobs.clone-store');

    //     // find candidate
    //     // Route::resource('candidates', 'CandidateController');

    //     // Favorite Candidates
    //     Route::resource('shortlisted-candidate', 'FavoriteCandidateController');
    //     Route::patch('shortlisted-candidate/{id}/update-destroy', 'FavoriteCandidateController@updateDestroy')->name('shortlisted-candidate.update-destroy');
    //     Route::delete('shortlisted-candidate/{id}/update-destroy', 'FavoriteCandidateController@updateDestroy')->name('shortlisted-candidate.update-destroy');
    //     //Route::get('set-ajax-status', 'FavoriteCandidateController@ajaxStatus')->name('ajax.status-update');
    //     Route::get('set-suggest-title', 'FavoriteCandidateController@ajaxSuggestTitleSave')->name('ajax.suggesttitle.save');
    //     Route::get('shortlisted-candidate/applied-jobs-list/{id}', 'FavoriteCandidateController@appliedJobsList')->name('shortlisted-candidate.appliedJobs.list');

    //     Route::get('shortlisted-candidate/remark/{id}', 'FavoriteCandidateController@remarkCreate')->name('remark-create');
    //     Route::post('shortlisted-candidate/remark', 'FavoriteCandidateController@remarkStore')->name('remark-store');
    //     Route::post('shortlisted-candidate/remarks/remove', 'FavoriteCandidateController@remarkRemove')->name('shortlisted-candidate.remarks.remove');

    //     // Application Tracking
    //     // Route::resource('applicationTrackings', 'ApplicationTrackingController');
    //     Route::get('applicationTrackings/{employer_job_id}/index', 'ApplicationTrackingController@index')->name('applicationTrackings.index');
    //     Route::get('applicationTrackings/{id}/actions', 'ApplicationTrackingController@actions')->name('applicationTrackings.actions');
    //     Route::post('applicationTrackings/actions', 'ApplicationTrackingController@actionssave')->name('applicationTrackings.actionssave');
    //     Route::get('applicationTrackings/{id}/questionnaire', 'ApplicationTrackingController@questionnaire')->name('applicationTrackings.questionnaire');
    //     Route::get('set-ajax-status', 'ApplicationTrackingController@ajaxStatus')->name('ajax.status-update');
    //     //Questionnaire routes
    //     // Route::get('questionnaires', 'QuestionnaireController@index')->name('questionnaires.index');
    //     Route::get('questionnaires/{job}/create', 'QuestionnaireController@create')->name('questionnaires.create');
    //     Route::post('questionnaires/{job}/store', 'QuestionnaireController@store')->name('questionnaires.store');
    //     Route::post('questionnaires/{job}/remove-question', 'QuestionnaireController@removeQuestion')->name('questionnaire.remove');

    //     // Subscription
    //     Route::get('packages', 'SubscriptionController@plans')->name('subscription.plan');
    //     Route::post('subscribe', 'SubscriptionController@subscribe')->name('subscription.subscribe');
    //     Route::get('my-subscription', 'SubscriptionController@mySubscription')->name('subscription.my-subscription');
    //     Route::get('subscription/expire/{id}', 'SubscriptionController@expireCurrentPackage')->name('subscription.expire');
    //     Route::get('subscription/expire/grace/{id}', 'SubscriptionController@expireGraceCurrentPackage')->name('subscription.expire.grace');

    //     // Interview Schedule
    //     Route::resource('interviewschedules', 'InterviewScheduleController');
    //     Route::get('interviewschedules/{employer_job_id}/index/{user_id}', 'InterviewScheduleController@index')->name('interviewschedules.index');
    //     Route::get('interviewschedules/{employer_job_id}/create/{user_id}', 'InterviewScheduleController@create')->name('interviewschedules.create');
    //     Route::get('interviewschedules/{employer_job_id}/edit/{id}', 'InterviewScheduleController@edit')->name('interviewschedules.edit');
    //     Route::get('interviewschedules/show/{id}', 'InterviewScheduleController@show')->name('interviewschedules.show');
    //     //Route::post('interviewschedules/store', 'InterviewScheduleController@store')->name('interviewschedules.store');
    //     Route::patch('interviewschedules/{id}/update-destroy', 'InterviewScheduleController@updateDestroy')->name('interviewschedules.update-destroy');
    //     Route::delete('interviewschedules/{id}/update-destroy', 'InterviewScheduleController@updateDestroy')->name('interviewschedules.update-destroy');

    //     // unlock candidate
    //     Route::get('candidate/{id}/unlock', 'SubscriptionController@unlockCandidate')->name('unlock-candidate');
    //     Route::get('activate-plan/{id}', 'SubscriptionController@activatePlan')->name('subscription.activate-plan');
    // });
    Route::group(['middleware' => ['prevent-back-history', 'verified']], function () {


        Route::group(['middleware' => ['role:employer|admin|mentor']], function () {

            Route::resource('candidateNotes', 'CandidateNoteController');
            Route::patch('candidateNotes/{id}/update-destroy', 'CandidateNoteController@updateDestroy')->name('candidateNotes.update-destroy');
            Route::delete('candidateNotes/{id}/update-destroy', 'CandidateNoteController@updateDestroy')->name('candidateNotes.update-destroy');

            // update employer profile
            Route::post('update-profile', 'FrontUserController@updateProfile')->name('users.update.profile');

            // job
            Route::resource('employerJobs', 'EmployerJobController');
            Route::patch('employerJobs/{id}/update-destroy', 'EmployerJobController@updateDestroy')->name('employerJobs.update-destroy');
            Route::delete('employerJobs/{id}/update-destroy', 'EmployerJobController@updateDestroy')->name('employerJobs.update-destroy');
            Route::get('employerJobs/{id}/clone', 'EmployerJobController@clone')->name('employerJobs.clone');
            Route::patch('employerJobs/{id}/clone', 'EmployerJobController@store')->name('employerJobs.clone-store');

            // find candidate
            // Route::resource('candidates', 'CandidateController');

            // Favorite Candidates
            Route::resource('shortlisted-candidate', 'FavoriteCandidateController');
            Route::patch('shortlisted-candidate/{id}/update-destroy', 'FavoriteCandidateController@updateDestroy')->name('shortlisted-candidate.update-destroy');
            Route::delete('shortlisted-candidate/{id}/update-destroy', 'FavoriteCandidateController@updateDestroy')->name('shortlisted-candidate.update-destroy');
            //Route::get('set-ajax-status', 'FavoriteCandidateController@ajaxStatus')->name('ajax.status-update');
            Route::get('set-suggest-title', 'FavoriteCandidateController@ajaxSuggestTitleSave')->name('ajax.suggesttitle.save');
            Route::get('shortlisted-candidate/applied-jobs-list/{id}', 'FavoriteCandidateController@appliedJobsList')->name('shortlisted-candidate.appliedJobs.list');

            Route::get('shortlisted-candidate/remark/{id}', 'FavoriteCandidateController@remarkCreate')->name('remark-create');
            Route::post('shortlisted-candidate/remark', 'FavoriteCandidateController@remarkStore')->name('remark-store');
            Route::post('shortlisted-candidate/remarks/remove', 'FavoriteCandidateController@remarkRemove')->name('shortlisted-candidate.remarks.remove');

            // Application Tracking
            // Route::resource('applicationTrackings', 'ApplicationTrackingController');
            Route::get('applicationTrackings/{employer_job_id}/index', 'ApplicationTrackingController@index')->name('applicationTrackings.index');
            Route::get('applicationTrackings/{id}/actions', 'ApplicationTrackingController@actions')->name('applicationTrackings.actions');
            Route::post('applicationTrackings/actions', 'ApplicationTrackingController@actionssave')->name('applicationTrackings.actionssave');
            Route::get('applicationTrackings/{id}/questionnaire', 'ApplicationTrackingController@questionnaire')->name('applicationTrackings.questionnaire');
            Route::get('set-ajax-status', 'ApplicationTrackingController@ajaxStatus')->name('ajax.status-update');
            //Questionnaire routes
            // Route::get('questionnaires', 'QuestionnaireController@index')->name('questionnaires.index');
            Route::get('questionnaires/{job}/create', 'QuestionnaireController@create')->name('questionnaires.create');
            Route::post('questionnaires/{job}/store', 'QuestionnaireController@store')->name('questionnaires.store');
            Route::post('questionnaires/{job}/remove-question', 'QuestionnaireController@removeQuestion')->name('questionnaire.remove');
            Route::get(strtolower(trans('label.pricing')), 'SubscriptionController@plans')->name('subscription.plan');

            // Subscription
            Route::get('use-our-expertise-plans-for-employer', 'SubscriptionController@empsevices')->name('subscription.service.employer');

            Route::get('packages', 'SubscriptionController@plans')->name('subscription.plan');
            Route::post('subscribe', 'SubscriptionController@subscribe')->name('subscription.subscribe');
            Route::get('my-subscription', 'SubscriptionController@mySubscription')->name('subscription.my-subscription');
            Route::get('subscription/expire/{id}', 'SubscriptionController@expireCurrentPackage')->name('subscription.expire');
            Route::get('subscription/expire/grace/{id}', 'SubscriptionController@expireGraceCurrentPackage')->name('subscription.expire.grace');

            // Interview Schedule
            Route::resource('interviewschedules', 'InterviewScheduleController');
            Route::get('interviewschedules/{employer_job_id}/index/{user_id}', 'InterviewScheduleController@index')->name('interviewschedules.index');
            Route::get('interviewschedules/{employer_job_id}/create/{user_id}', 'InterviewScheduleController@create')->name('interviewschedules.create');
            Route::get('interviewschedules/{employer_job_id}/edit/{id}', 'InterviewScheduleController@edit')->name('interviewschedules.edit');
            Route::get('interviewschedules/show/{id}', 'InterviewScheduleController@show')->name('interviewschedules.show');
            //Route::post('interviewschedules/store', 'InterviewScheduleController@store')->name('interviewschedules.store');
            Route::patch('interviewschedules/{id}/update-destroy', 'InterviewScheduleController@updateDestroy')->name('interviewschedules.update-destroy');
            Route::delete('interviewschedules/{id}/update-destroy', 'InterviewScheduleController@updateDestroy')->name('interviewschedules.update-destroy');

            // unlock candidate
            Route::get('candidate/{id}/unlock', 'SubscriptionController@unlockCandidate')->name('unlock-candidate');
            Route::get('activate-plan/{id}', 'SubscriptionController@activatePlan')->name('subscription.activate-plan');
        });
    });
    Route::group(['middleware' => ['role:employer|jobseeker']], function () {
        Route::resource('userReviews', 'UserReviewController');
        Route::patch('userReviews/{id}/update-destroy', 'UserReviewController@updateDestroy')->name('userReviews.update-destroy');
        Route::delete('userReviews/{id}/update-destroy', 'UserReviewController@updateDestroy')->name('userReviews.update-destroy');
        Route::get('/advance-reviews', 'UserReviewController@getAdvanceReviewsByCurrentUser')->name('userReviews.advanceReviewsByCurrentUser');
    });

    // jobseeker
    Route::group(['middleware' => ['prevent-back-history', 'verified']], function () {
        Route::group(['middleware' => ['role:jobseeker|employer']], function () {
            // update jobseeker profile
            Route::post('jobseeker-update-profile/intro', 'FrontUserController@updateProfileSeeker')->name('users.update.profile.jobseeker.intro');
            Route::post('jobseeker-update-profile/experience', 'FrontUserController@updateSeekerExperience')->name('users.update.profile.jobseeker.experience');
            Route::post('jobseeker-update-profile/education', 'FrontUserController@updateSeekerEducation')->name('users.update.profile.jobseeker.education');
            Route::post('jobseeker-update-profile/license', 'FrontUserController@updateSeekerLicense')->name('users.update.profile.jobseeker.licenses');
            Route::post('jobseeker-update-profile/skill', 'FrontUserController@updateSeekerSkill')->name('users.update.profile.jobseeker.skill');
            Route::post('jobseeker-update-profile/language_skill', 'FrontUserController@updateSeekerLanguageSkill')->name('users.update.profile.jobseeker.language_skill');
            Route::post('jobseeker-update-profile/video', 'FrontUserController@updateSeekerVideo')->name('users.update.profile.jobseeker.video');
            Route::post('jobseeker-update-profile/personal', 'FrontUserController@updateSeekerPersonal')->name('users.update.profile.jobseeker.personal');
            Route::get('candidate', 'FrontUserController@loginCandidateProfile')->name('candidate');
            // Apply Job
            Route::resource('applyJobs', 'ApplyJobController');
            Route::patch('applyJobs/{id}/update-destroy', 'ApplyJobController@updateDestroy')->name('applyJobs.update-destroy');
            Route::delete('applyJobs/{id}/update-destroy', 'ApplyJobController@updateDestroy')->name('applyJobs.update-destroy');
            Route::get('applyJobs/{job_id}/apply-job', 'ApplyJobController@create')->name('applyJobs.create');
            Route::post('applyJobs/{job_id}/save-apply-job', 'ApplyJobController@store')->name('applyJobs.save');
            Route::get('thank-you/{slug}', 'ApplyJobController@thank_you')->name('thank_you');



            // Favorite Job
            Route::resource('favoriteJobs', 'FavoriteJobController');
            Route::patch('favouriteJobs/{id}/update-destroy', 'FavoriteJobController@updateDestroy')->name('favoriteJobs.update-destroy');
            Route::delete('favouriteJobs/{id}/update-destroy', 'FavoriteJobController@updateDestroy')->name('favoriteJobs.update-destroy');
            Route::get('favouriteJobs/{id}/store', 'FavoriteJobController@store')->name('favoriteJobs.store');
            Route::get('favouriteJobs/{id}/store-ajax', 'FavoriteJobController@storeAjax')->name('favoriteJobs.storeAjax');
            Route::get('favouriteJobs/{id}/unfavourit', 'FavoriteJobController@removeFromFavourit')->name('favoriteJobs.removeFromFavourit');
            Route::get('favouriteJobs/{id}/unfavourit-ajax', 'FavoriteJobController@removeFromFavouritAjax')->name('favoriteJobs.removeFromFavouritAjax');

            // Job Alert
            Route::resource('jobAlerts', 'JobAlertController');
            Route::patch('jobAlerts/{id}/update-destroy', 'JobAlertController@updateDestroy')->name('jobAlerts.update-destroy');
            Route::delete('jobAlerts/{id}/update-destroy', 'JobAlertController@updateDestroy')->name('jobAlerts.update-destroy');

            // Jobseeker Dashboard
            Route::resource('jobseekerDashboard', 'JobseekerDashboardController');

            // Interviews
            Route::resource('interviews', 'InterviewController');
            Route::patch('interviews/{id}/update-destroy', 'InterviewController@updateDestroy')->name('interviews.update-destroy');
            Route::delete('interviews/{id}/update-destroy', 'InterviewController@updateDestroy')->name('interviews.update-destroy');
            Route::get('interviews/{id}/create', 'InterviewController@create')->name('interview.detail');

            // Subscription
            Route::get('packages', 'SubscriptionController@plans')->name('subscription.plan');
            Route::get('use-our-expertise-plans', 'SubscriptionController@sevices')->name('subscription.service');
            //Route::get('use-our-expertise-plans/{id}/service', 'SubscriptionController@sevices')->name('subscription.service');
            Route::get('smart-resume-builder', 'SubscriptionController@servicePlan')->name('subscription.chatgpt-service-plan');
            Route::post('subscribe', 'SubscriptionController@subscribe')->name('subscription.subscribe');
            Route::get('my-subscription', 'SubscriptionController@mySubscription')->name('subscription.my-subscription');
            Route::get('subscription/expire/{id}', 'SubscriptionController@expireCurrentPackage')->name('subscription.expire');
            Route::get('subscription/expire/grace/{id}', 'SubscriptionController@expireGraceCurrentPackage')->name('subscription.expire.grace');
            // Route::get('interview-plans', 'SubscriptionController@interviewPlans')->name('subscription.interview-plan');
            // Route::get('military-service', 'SubscriptionController@militaryService')->name('subscription.military-service');
            // Route::get('career-service', 'SubscriptionController@career_service')->name('career-service');

            // //Shopping cart
            // //Route::get('add-to-cart/{id}', 'CartController@addToCart')->name('add-to-cart');
            // //Route::get('cart', 'CartController@listCart')->name('cart.list');
            // Route::post('update-cart', 'CartController@updateCart')->name('cart.update');
            // Route::post('remove-cart', 'CartController@removeCart')->name('cart.remove');
            // Route::get('checkout', 'CartController@checkout')->name('cart.checkout');

            // //Shopping cart
            // Route::post('add-to-cart', 'CartController@addToCart')->name('add-to-cart');
            // Route::get('add-item-to-cart/{id}', 'CartController@addItemToCart')->name('add-item-to-cart');
            // Route::get('cart', 'CartController@listCart')->name('cart.list');
            // Route::post('process-payment', 'CartController@processPayment')->name('cart.process.payment');
            // Route::get('pay/{order_number}', 'CartController@payOrder')->name('pay.order');
            // Route::post('payment', 'CartController@payOrderStore')->name('cart.payment');
            // //Route::get('order-detail/{order_number}', 'CartController@orderDetail')->name('order.detail');
            // Route::get('orders', 'CartController@orderList')->name('order.list');
            // Route::group(['middleware' => ['role:admin|employer|jobseeker']], function () {
            // Order History
            Route::resource('orderHistory', 'OrderHistoryController');
            Route::patch('orderHistory/{id}/update-destroy', 'OrderHistoryController@updateDestroy')->name('Fchat.update-destroy');
            Route::delete('orderHistory/{id}/update-destroy', 'OrderHistoryController@updateDestroy')->name('orderHistory.update-destroy');
            Route::get('orderHistory/download/orders/{id}', 'OrderHistoryController@downloadOrders')->name('orderHistory.download-orders');

            // });

            //Resume Builder

            // Route::resource('employerJobs', 'EmployerJobController');
            // Route::patch('employerJobs/{id}/update-destroy', 'EmployerJobController@updateDestroy')->name('employerJobs.update-destroy');
            // Route::delete('employerJobs/{id}/update-destroy', 'EmployerJobController@updateDestroy')->name('employerJobs.update-destroy');
            // Route::get('employerJobs/{id}/clone', 'EmployerJobController@clone')->name('employerJobs.clone');
            // Route::patch('employerJobs/{id}/clone', 'EmployerJobController@store')->name('employerJobs.clone-store');

            Route::resource('resume-builder', 'ResumeBuilderController');
            Route::patch('resume-builder/{id}/update-destroy', 'ResumeBuilderController@updateDestroy')->name('resume-builder.update-destroy');
            Route::delete('interviews/{id}/update-destroy', 'ResumeBuilderController@updateDestroy')->name('resume-builder.update-destroy');
            Route::get('/resume-builder/{userId}/{step}', 'ResumeBuilderController@editStep')->name('resume-builder.editStep');
            Route::patch('/resume-builder/{id}/updateStep', 'ResumeBuilderController@updateStep')->name('resume-builder.updateStep');
            Route::get('/make-primary/{id}', 'ResumeBuilderController@makePrimary')->name('resume-builder.makePrimary');
            // Route::put('resume-builder/{userId}/{step}', 'ResumeBuilderController@editStep')->name('resumeBuilder.edit_step');

            // Route::get('edit-profile/{mainTitle}', 'FrontUserController@editProfile')->name('users.edit.profile');

            Route::post('get-cv', 'ChatGptController@getCV')->name('generate.cv');
            Route::post('get-experince-cv', 'ChatGptController@getComplexCV')->name('generate.complex.cv');
        });
    });


    Route::group(['middleware' => ['role:employer']], function () {
        Route::resource('employerDashboard', 'EmployerDashboardController');

        // Route::post('add-to-cart', 'CartController@addToCart')->name('add-to-cart');
        // Route::get('add-item-to-cart/{id}', 'CartController@addItemToCart')->name('add-item-to-cart');
        // Route::get('cart', 'CartController@listCart')->name('cart.list');
        // Route::post('process-payment', 'CartController@processPayment')->name('cart.process.payment');
        // Route::get('pay/{order_number}', 'CartController@payOrder')->name('pay.order');
        // Route::post('payment', 'CartController@payOrderStore')->name('cart.payment');
        // //Route::get('order-detail/{order_number}', 'CartController@orderDetail')->name('order.detail');
        // Route::get('orders', 'CartController@orderList')->name('order.list');

        // Route::post('update-cart', 'CartController@updateCart')->name('cart.update');
        // Route::post('remove-cart', 'CartController@removeCart')->name('cart.remove');
        // Route::get('checkout', 'CartController@checkout')->name('cart.checkout');
    });
    // Meeting by video Route
    // Route::resource('meetings', 'MeetingController');
    // Route::get('meetings/create/{jobSeeker}/{employerJob}', 'MeetingController@createMetting')->name('meetings.create');
    // Route::get('meetings/index/{id}', 'MeetingController@index')->name('meetings.index');

    // Route::get('questionnaires/{id}/edit', 'QuestionnaireController@edit')->name('questionnaires.edit');
    // Route::post('questionnaires/update', 'QuestionnaireController@update')->name('questionnaires.update');

    // search jobs in jobseeker
    // Route::resource('search-jobs', 'SearchJobController');
    // Route::get('search-jobs/show/more', 'SearchJobController@showMore')->name('search-jobs.show.more');
});

//Admin Login Routes...
Route::get('staff', 'Auth\StaffLoginController@showLoginForm')->name('staff.login');
Route::get('/staff/login', 'Auth\StaffLoginController@showLoginForm')->name('staff-form.login');
Route::post('staff/login', 'Auth\StaffLoginController@login')->name('staff.login.store');
Route::post('staff/logout', 'Auth\StaffLoginController@logout')->name('staff.logout');

// admin only
Route::group(['namespace' => 'Admin', 'prefix' => 'admin', 'middleware' => ['role:admin', 'prevent-back-history', 'staff']], function () {
    Route::get('home', 'HomeController@index')->name('admin.home');
    Route::get('ajax/get-parent-categories', 'CategoryController@getParentCategories')->name('categories.parent');

    // roles
    Route::resource('roles', 'RoleController');
    Route::patch('roles/{id}/update-destroy', 'RoleController@updateDestroy')->name('roles.update-destroy');
    Route::delete('roles/{id}/update-destroy', 'RoleController@updateDestroy')->name('roles.update-destroy');
    Route::get('ajax-roles', 'RoleController@ajaxRoles')->name('ajax.roles');

    // users
    Route::resource('users', 'UserController');
    Route::patch('users/{id}/update-destroy', 'UserController@updateDestroy')->name('users.update-destroy');
    Route::delete('users/{id}/update-destroy', 'UserController@updateDestroy')->name('users.update-destroy');
    Route::get('users/verified/{id}', 'UserController@Verified')->name('users.verified');
    Route::get('users/loginbyid/{id}', 'UserController@loginbyid')->name('users.loginbyid');
    Route::get('users/{id}/assign-to-employer', 'UserController@assignToAccountManagerForm')->name('users.assign-to-employer-form');
    Route::post('users/assign-to-employer', 'UserController@assignTo')->name('users.assign-to-employer');

    // categories
    Route::resource('categories', 'CategoryController');
    Route::patch('categories/{id}/update-destroy', 'CategoryController@updateDestroy')->name('categories.update-destroy');
    Route::delete('categories/{id}/update-destroy', 'CategoryController@updateDestroy')->name('categories.update-destroy');

    // skills
    Route::resource('skills', 'SkillController');
    Route::patch('skills/{id}/update-destroy', 'SkillController@updateDestroy')->name('skills.update-destroy');
    Route::delete('skills/{id}/update-destroy', 'SkillController@updateDestroy')->name('skills.update-destroy');

    //Specialization
    // web.php or api.php

    // Route::get('/ajax/specializations', 'SpecializationController@index')->name('ajax.specializations');

    Route::resource('specializations', 'SpecializationController');
    Route::patch('specializations/{id}/update-destroy', 'SpecializationController@updateDestroy')->name('specializations.update-destroy');
    Route::delete('specializations/{id}/update-destroy', 'SpecializationController@updateDestroy')->name('specializations.update-destroy');

    // work types
    Route::resource('workTypes', 'WorkTypeController');
    Route::patch('workTypes/{id}/update-destroy', 'WorkTypeController@updateDestroy')->name('workTypes.update-destroy');
    Route::delete('workTypes/{id}/update-destroy', 'WorkTypeController@updateDestroy')->name('workTypes.update-destroy');

    // salaries
    Route::resource('salaries', 'SalaryController');
    Route::patch('salaries/{id}/update-destroy', 'SalaryController@updateDestroy')->name('salaries.update-destroy');
    Route::delete('salaries/{id}/update-destroy', 'SalaryController@updateDestroy')->name('salaries.update-destroy');

    // experiences
    Route::resource('experiences', 'ExperienceController');
    Route::patch('experiences/{id}/update-destroy', 'ExperienceController@updateDestroy')->name('experiences.update-destroy');
    Route::delete('experiences/{id}/update-destroy', 'ExperienceController@updateDestroy')->name('experiences.update-destroy');

    // qualifications
    Route::resource('qualifications', 'QualificationController');
    Route::patch('qualifications/{id}/update-destroy', 'QualificationController@updateDestroy')->name('qualifications.update-destroy');
    Route::delete('qualifications/{id}/update-destroy', 'QualificationController@updateDestroy')->name('qualifications.update-destroy');

    // interviewTypes
    Route::resource('interviewTypes', 'InterviewTypeController');
    Route::patch('interviewTypes/{id}/update-destroy', 'InterviewTypeController@updateDestroy')->name('interviewTypes.update-destroy');
    Route::delete('interviewTypes/{id}/update-destroy', 'InterviewTypeController@updateDestroy')->name('interviewTypes.update-destroy');

    // report abuses route
    Route::resource('reports-abuses', 'ReportAbuseController');
    Route::patch('reports-abuses/{id}/update-destroy', 'ReportAbuseController@updateDestroy')->name('reports-abuses.update-destroy');
    Route::delete('reports-abuses/{id}/update-destroy', 'ReportAbuseController@updateDestroy')->name('reports-abuses.update-destroy');
    Route::get('reports-abuses/index/{report_type}', 'ReportAbuseController@typeIndex')->name('reports-abuses.typeIndex');

    // //employerJobs
    // Route::patch('employerJobs/{id}/update-destroy', 'EmployerJobController@updateDestroy')->name('employerJobs.update-destroy');
    // Route::delete('employerJobs/{id}/update-destroy', 'EmployerJobController@updateDestroy')->name('employerJobs.update-destroy');

    Route::patch('{model}-status/{id}/active-inactive', 'ReportController@activeInactive')->name('reportedEntity.active-inactive');
    Route::delete('{model}-status/{id}/active-inactive', 'ReportController@activeInactive')->name('reportedEntity.active-inactive');

    // cms route
    Route::resource('cms', 'CmsController');
    Route::patch('cms/{id}/update-destroy', 'CmsController@updateDestroy')->name('cms.update-destroy');
    Route::delete('cms/{id}/update-destroy', 'CmsController@updateDestroy')->name('cms.update-destroy');

    // state route
    Route::resource('states', 'StateController');
    Route::patch('states/{id}/update-destroy', 'StateController@updateDestroy')->name('states.update-destroy');
    Route::delete('states/{id}/update-destroy', 'StateController@updateDestroy')->name('states.update-destroy');

    // location route
    Route::resource('locations', 'LocationController');
    Route::patch('locations/{id}/update-destroy', 'LocationController@updateDestroy')->name('locations.update-destroy');
    Route::delete('locations/{id}/update-destroy', 'LocationController@updateDestroy')->name('locations.update-destroy');

    // certification route
    Route::resource('certifications', 'CertificationController');
    Route::patch('certifications/{id}/update-destroy', 'CertificationController@updateDestroy')->name('certifications.update-destroy');
    Route::delete('certifications/{id}/update-destroy', 'CertificationController@updateDestroy')->name('certifications.update-destroy');
    Route::get('certifications/import/file', 'CertificationController@getImportfile')->name('certifications.import-file');
    Route::post('certifications/import', 'CertificationController@import')->name('certifications.import');

    //Banner Management Routes
    Route::resource('bannerManagements', 'BannerManagementController');
    Route::patch('bannerManagements/{id}/update-destroy', 'BannerManagementController@updateDestroy')->name('bannerManagements.update-destroy');
    Route::delete('bannerManagements/{id}/update-destroy', 'BannerManagementController@updateDestroy')->name('bannerManagements.update-destroy');

    //FAQ Routing
    Route::resource('faqs', 'FaqController');
    Route::patch('faqs/{id}/update-destroy', 'FaqController@updateDestroy')->name('faqs.update-destroy');
    Route::delete('faqs/{id}/update-destroy', 'FaqController@updateDestroy')->name('faqs.update-destroy');

    // configurations
    Route::get('configurations', 'ConfigurationController@configuration')->name('configurations');
    Route::post('configurations/{type}', 'ConfigurationController@update')->name('configurations.update');
    Route::post('configurations/others/generated-numbers', 'ConfigurationController@updateGeneratedNumbers')->name('configurations.generatedNumbers.update');
    Route::get('configurations/get-pattern-preview', 'ConfigurationController@getPatternPreview')->name('configurations.get-pattern-preview');

    //blogs
    Route::resource('blogs', 'BlogController');
    Route::patch('blogs/{id}/update-destroy', 'BlogController@updateDestroy')->name('blogs.update-destroy');
    Route::delete('blogs/{id}/update-destroy', 'BlogController@updateDestroy')->name('blogs.update-destroy');

    //Events
    Route::resource('events', 'EventController');
    Route::patch('events/{id}/update-destroy', 'EventController@updateDestroy')->name('events.update-destroy');
    Route::delete('events/{id}/update-destroy', 'EventController@updateDestroy')->name('events.update-destroy');

    // testimonial
    Route::resource('testimonials', 'TestimonialController');
    Route::patch('testimonials/{id}/update-destroy', 'TestimonialController@updateDestroy')->name('testimonials.update-destroy');
    Route::delete('testimonials/{id}/update-destroy', 'TestimonialController@updateDestroy')->name('testimonials.update-destroy');

    // package management
    Route::resource('packages', 'PackageController');
    Route::patch('packages/{id}/update-destroy', 'PackageController@updateDestroy')->name('packages.update-destroy');
    Route::delete('packages/{id}/update-destroy', 'PackageController@updateDestroy')->name('packages.update-destroy');

    // Dashboard
    Route::get('/dashboard', 'DashboardController@index')->name('dashboard.index');
    Route::post('/dashboard/statistics', 'DashboardController@statistics')->name('dashboard.statistics');

    // Job Posting
    Route::resource('job-posting', 'JobPostController');
    Route::patch('job-posting/{id}/update-destroy', 'JobPostController@updateDestroy')->name('job-posting.update-destroy');
    Route::delete('job-posting/{id}/update-destroy', 'JobPostController@updateDestroy')->name('job-posting.update-destroy');
    Route::get('ajax-is_featured', 'JobPostController@isFeatureUpdate')->name('ajax.is_featured.update');

    //import district
    Route::get('locations/import/file', 'LocationController@getImportfile')->name('locations.import-file');
    Route::post('locationsimport', 'LocationController@import')->name('locations.import');

    //import state
    Route::get('states/import/file', 'StateController@getImportfile')->name('states.import-file');
    Route::post('states/import', 'StateController@import')->name('states.import');

    //import Skill
    Route::get('skills/import/file', 'SkillController@getImportfile')->name('skills.import-file');
    Route::post('skills/import', 'SkillController@import')->name('skills.import');

    //import category
    Route::get('categories/import/file', 'CategoryController@getImportfile')->name('categories.import-file');
    Route::post('categories/import', 'CategoryController@import')->name('categories.import');



    //Criteria
    Route::resource('criterias', 'CriteriaController');
    Route::patch('criterias/{id}/update-destroy', 'CriteriaController@updateDestroy')->name('criterias.update-destroy');
    Route::delete('criterias/{id}/update-destroy', 'CriteriaController@updateDestroy')->name('criterias.update-destroy');

    //Criteria Level
    //Route::resource('criteriaLevels', 'CriteriaLevelController');
    //Route::patch('criteriaLevels/{id}/update-destroy', 'CriteriaLevelController@updateDestroy')->name('criteriaLevels.update-destroy');
    //Route::delete('criteriaLevels/{id}/update-destroy', 'CriteriaLevelController@updateDestroy')->name('criteriaLevels.update-destroy');

    // Route::group(['middleware' => ['can:view make_announcement']], function () {
        Route::get('important-announcement/make-announcements', 'ImportantAnnouncementController@create')->name('important-announcements.create');
        Route::post('important-announcement/send-announcement-notification', 'ImportantAnnouncementController@store')->name('important-announcements.store');
    // });

    // filter-reports route
    Route::get('filter-employers', 'ReportController@employerReports')->name('filter-employers');
    Route::get('filter-jobseekers', 'ReportController@jobseekerReports')->name('filter-jobseekers');
    Route::get('filter-employerjobs', 'ReportController@JobsReports')->name('filter-employerjobs');
    Route::get('filter-transaction', 'ReportController@packageReports')->name('filter-transaction');

    Route::resource('languages', 'LanguageController');
    Route::patch('languages/{id}/update-destroy', 'LanguageController@updateDestroy')->name('languages.update-destroy');
    Route::delete('languages/{id}/update-destroy', 'LanguageController@updateDestroy')->name('languages.update-destroy');

    Route::resource('levels', 'LevelController');
    Route::patch('levels/{id}/update-destroy', 'LevelController@updateDestroy')->name('levels.update-destroy');
    Route::delete('levels/{id}/update-destroy', 'LevelController@updateDestroy')->name('levels.update-destroy');

    Route::resource('jobTypes', 'JobTypeController');
    Route::patch('jobTypes/{id}/update-destroy', 'JobTypeController@updateDestroy')->name('jobTypes.update-destroy');
    Route::delete('jobTypes/{id}/update-destroy', 'JobTypeController@updateDestroy')->name('jobTypes.update-destroy');

    Route::resource('reviewCategories', 'ReviewCategoryController');
    Route::patch('reviewCategories/{id}/update-destroy', 'ReviewCategoryController@updateDestroy')->name('reviewCategories.update-destroy');
    Route::delete('reviewCategories/{id}/update-destroy', 'ReviewCategoryController@updateDestroy')->name('reviewCategories.update-destroy');

    Route::resource('reviewCategoryStrengthWeeknesses', 'ReviewCategoryStrengthWeeknessController');
    Route::patch('reviewCategoryStrengthWeeknesses/{id}/update-destroy', 'ReviewCategoryStrengthWeeknessController@updateDestroy')->name('reviewCategoryStrengthWeeknesses.update-destroy');
    Route::delete('reviewCategoryStrengthWeeknesses/{id}/update-destroy', 'ReviewCategoryStrengthWeeknessController@updateDestroy')->name('reviewCategoryStrengthWeeknesses.update-destroy');

    Route::resource('badges', 'BadgeController');
    Route::patch('badges/{id}/update-destroy', 'BadgeController@updateDestroy')->name('badges.update-destroy');
    Route::delete('badges/{id}/update-destroy', 'BadgeController@updateDestroy')->name('badges.update-destroy');

    Route::resource('ReviewUser', 'UsersReviewController');
    Route::post('ReviewUser/approve-review', 'UsersReviewController@approveReview')->name('approveReview');
    Route::post('ReviewUser/disapprove-review', 'UsersReviewController@disapproveReview')->name('disapproveReview');
    Route::delete('ReviewUser/{id}', 'UsersReviewController@permenentDelete')->name('ReviewUser.permenentDelete');


    Route::resource('packageCategories', 'PackageCategoryController');
    Route::patch('packageCategories/{id}/update-destroy', 'PackageCategoryController@updateDestroy')->name('packageCategories.update-destroy');
    Route::delete('packageCategories/{id}/update-destroy', 'PackageCategoryController@updateDestroy')->name('packageCategories.update-destroy');

    Route::get('package-category/{id}/addon', 'PackageController@getAddonList')->name('package.getAddonList');

    // orders
    Route::resource('orders', 'OrderController');
    Route::patch('orders/{id}/update-destroy', 'OrderController@updateDestroy')->name('orders.update-destroy');
    Route::delete('orders/{id}/update-destroy', 'OrderController@updateDestroy')->name('orders.update-destroy');
    Route::get('orders/mark-pending/{id}', 'OrderController@markAsPending')->name('orders.markAsPending');
    Route::get('orders/mark-complete/{id}', 'OrderController@markAsCompleted')->name('orders.markAsCompleted');
    Route::get('download/orders/{id}', 'OrderController@downloadOrders')->name('download-orders');
});

// mentor only
Route::group(['namespace' => 'Mentor', 'prefix' => 'mentor', 'middleware' => ['role:mentor', 'prevent-back-history', 'staff']], function () {
    // candidates
    Route::resource('mentor_candidates', 'ScoreBoardController');
    Route::get('mentor_candidates/score/{id}', 'ScoreBoardController@scorePopup')->name('mentor_candidate.score');
    Route::post('mentor_candidates/score', 'ScoreBoardController@scoreSave')->name('mentor_candidate.score.save');
    Route::post('get-change-score', 'ScoreBoardController@ajaxAverageScore')->name('mentor_candidate.ajaxAverageScore');
    Route::get('candidates/{id}', 'ScoreBoardController@show')->name('mentor.candidates.show');
});

Route::group(['namespace' => 'Admin', 'prefix' => 'mentor', 'middleware' => ['role:mentor', 'prevent-back-history', 'staff']], function () {
    // Job Posting
    Route::resource('job-posting-mentor', 'JobPostController');
    Route::patch('job-posting-mentor/{id}/update-destroy', 'JobPostController@updateDestroy')->name('job-posting-mentor.update-destroy');
    Route::delete('job-posting-mentor/{id}/update-destroy', 'JobPostController@updateDestroy')->name('job-posting-mentor.update-destroy');
    // Route::get('ajax-is_featured', 'JobPostController@isFeatureUpdate')->name('ajax.is_featured.update');
    Route::get('job-posting-mentor/{id}/editjobapproval', 'JobPostController@editJobApproval')->name('job-posting-mentor.edit-job-approval');
    Route::post('job-posting-mentor/updatejobapproval', 'JobPostController@updateJobApproval')->name('job-posting-mentor.update-job-approval');
});

// accountant only
Route::group(['namespace' => 'Account', 'prefix' => 'account', 'middleware' => ['role:account', 'prevent-back-history', 'staff']], function () {
    // employer

    Route::resource('account-dashboard', 'AssignBoardController');
    Route::get('ajax-jobseekers', 'AssignBoardController@ajaxJobseekers')->name('ajax.jobseekers');
    Route::get('ajax-employers', 'AssignBoardController@ajaxEmployers')->name('ajax.employers');
    Route::get('candidates/{id}', 'AssignBoardController@show')->name('account.candidates.show');
    Route::get('account-dashboard/{id}/employer', 'AssignBoardController@employerShow')->name('employer.show');
});
// End: website routes
