<?php

namespace App\Http\View\Composers;

use App\Models\Configuration;
use App\Repositories\ApplyJobRepository;
use App\Repositories\BlogRepository;
use App\Repositories\CmsRepository;
use App\Repositories\ConfigurationRepository;
use App\Repositories\EmployerJobRepository;
use App\Repositories\FaqRepository;
use App\Repositories\TestimonialRepository;
use App\Repositories\UserRepository;
use Illuminate\View\View;

class FrontPageComposer
{
    public $blogRepository;
    public $faqRepository;
    public $configurationRepository;
    public $cmsRepository;
    public $userRepository;
    public $employerJobRepository;
    public $applyJobRepository;
    public $testimonialRepository;

    public function __construct(BlogRepository $blogRepo, FaqRepository $faqRepo, ConfigurationRepository $configurationRepo, CmsRepository $cmsRepo, UserRepository $userRepo, EmployerJobRepository $employerJobRepo, ApplyJobRepository $applyJobRepo, TestimonialRepository $testimonialRepo)
    {
        $this->blogRepository = $blogRepo;
        $this->faqRepository = $faqRepo;
        $this->configurationRepository = $configurationRepo;
        $this->cmsRepository = $cmsRepo;
        $this->userRepository = $userRepo;
        $this->employerJobRepository = $employerJobRepo;
        $this->applyJobRepository = $applyJobRepo;
        $this->testimonialRepository = $testimonialRepo;
    }

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $blogs = $faqs = $contact = $about = $testimonials = [];
        $tagLine = $location = $email = $phone = $total_registerUser = $total_jobs = $employer = $applicant = null;

        switch ($view->getName()) {
            case 'front_pages.about':
                $about = $this->cmsRepository->all(['page_name' => 'about-us']);
                $about = $about->first();

                $query = $this->userRepository->allQuery();
                $query->WithRole();
                $query->selectRaw('users.*, model_has_roles.role_id');
                $query->whereIn('model_has_roles.role_id', [2, 3]);

                //total registered user count
                $total_registerUser = $query->count();

                //total jobs count
                $total_jobs = $this->employerJobRepository->all()->count();

                //employer count
                $query->where('model_has_roles.role_id', 2);
                $employer = $query->count();

                //application count
                $applicant = $this->applyJobRepository->all()->count();

                //Testimonials
                $testimonials = $this->testimonialRepository->all();
                break;

            case 'front_pages.blog':
                $blogs = $this->blogRepository->all();

                break;
            case 'job-seeker':
                //Testimonials
                $testimonials = $this->testimonialRepository->all();
                break;

            case 'front_pages.contact':
                Configuration::setSessionConfiguration();
                $tagLine = Configuration::getSessionConfigurationName(['contact'], null, 'tag_line');
                $location = Configuration::getSessionConfigurationName(['contact'], null, 'location');
                $email = Configuration::getSessionConfigurationName(['contact'], null, 'email');
                $phone = Configuration::getSessionConfigurationName(['contact'], null, 'phone');
                $contact = $this->cmsRepository->all(['page_name' => 'contact-us']);
                $contact = $contact->first();
                break;

            case 'front_pages.faq':
                $faqs = $this->faqRepository->all();

                 break;
        }

        return $view->with([
            'faqs' => $faqs,
            'blogs' => $blogs,
            'tagLine' => $tagLine,
            'location' => $location,
            'email' => $email,
            'phone' => $phone,
            'contact' => $contact,
            'about' => $about,
            'total_registerUser' => $total_registerUser,
            'total_jobs' => $total_jobs,
            'employer' => $employer,
            'applicant' => $applicant,
            'testimonials' => $testimonials
        ]);
    }
}
