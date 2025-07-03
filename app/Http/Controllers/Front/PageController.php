<?php
namespace App\Http\Controllers\Front;

use App\Classes\NotifyAdminInquiry;
use App\Helpers\SeoHelper;
use App\Repositories\BlogRepository;
use App\Http\Controllers\AppBaseController;
use App\Repositories\CmsRepository;
use App\Repositories\ConfigurationRepository;
use App\Repositories\FaqRepository;
use Illuminate\Http\Request;
use Laracasts\Flash\Flash;
use Throwable;
use InfyOm\Generator\Utils\ResponseUtil;

class PageController extends AppBaseController
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public $blogRepository;
    public $faqRepository;
    public $configurationRepository;
    public $cmsRepository;

    public function __construct(BlogRepository $blogRepo, FaqRepository $faqRepo, ConfigurationRepository $configurationRepo, CmsRepository $cmsRepo)
    {
        $this->blogRepository = $blogRepo;
        $this->faqRepository = $faqRepo;
        $this->configurationRepository = $configurationRepo;
        $this->cmsRepository = $cmsRepo;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function blog()
    {
        $meta = SeoHelper::getMeta('Blog');

        return view('front_pages.blog')->with('meta',$meta);
    }

    public function faq()
    {
        $meta = SeoHelper::getMeta('Faq');

        return view('front_pages.faq')->with('meta',$meta);
    }

    public function contactUs()
    {
        $meta = SeoHelper::getMeta('Contact Us');

        return view('front_pages.contact')->with('meta',$meta);
    }

    public function aboutUs()
    {
        $meta = SeoHelper::getMeta('About Us');
        return view('front_pages.about')->with('meta',$meta);
    }
    public function socialPage()
    {
        return view('design.socialPage');
    }

    private function renderView($view)
    {
        if (request()->ajax()) {
            return response()->json(ResponseUtil::makeResponse('', $view->render()));
        }
        return $view;
    }

    public function terms()
    {
        $terms = $this->cmsRepository->all(['page_name' => 'terms-condition']);
        $terms1 = $terms->first();
        $terms1->description  = nl2br($terms1->description);
        $meta = SeoHelper::getMeta('Terms Condition');

        $view = view('front_pages.terms')->with('terms', $terms1)->with('meta',$meta);
        return $this->renderView($view);
    }

    public function privacy()
    {
        $content = $this->cmsRepository->all(['page_name' => 'privacy-policy']);
        $view = view('front_pages.privacy')->with('content', $content->first());
        return $this->renderView($view);
    }
    public function help()
    {
        $help = $this->cmsRepository->all(['page_name' => 'help']);
        $view = view('auth.job_seeker.profile.help')->with('help', $help->first());
        return $this->renderView($view);
    }

    public function career_advice()
    {
        $career_advice = $this->cmsRepository->all(['page_name' => 'career-advice']);
        $view = view('front_pages.career_advice')->with('career_advice', $career_advice->first());
        return $this->renderView($view);
    }
    public function browse_companies()
    {
        $browse_companies = $this->cmsRepository->all(['page_name' => 'browse-companies']);
        $view = view('front_pages.browse_companies')->with('browse_companies', $browse_companies->first());
        return $this->renderView($view);
    }
    public function salaries()
    {
        $salaries = $this->cmsRepository->all(['page_name' => 'salaries']);
        $view = view('front_pages.salaries')->with('salaries', $salaries->first());
        return $this->renderView($view);
    }
    // public function events()
    // {
    //     $events = $this->cmsRepository->all(['page_name' => 'events']);
    //     $view = view('front_pages.events')->with('events', $events->first());
    //     return $this->renderView($view);
    // }
    public function work_with_us()
    {
        $work_with_us = $this->cmsRepository->all(['page_name' => 'work-with-us']);
        $view = view('front_pages.work_with_us')->with('work_with_us', $work_with_us->first());
        return $this->renderView($view);
    }
    public function sendEnquiry(Request $request)
    {
        (new NotifyAdminInquiry($request->except('_token'), 'Inquiry'))->notify();
        // Flash::success('Mail send successfully.');
        return redirect()->back()->withInput(['success' => true]);
    }

    public function blogDetail($id)
    {
        try {
            $blog = $this->blogRepository->find($id, ['*']);

            $meta = [
                'meta_title' => $blog->meta_title ?? 'JobTrends' ?? config('app.name'),
                'meta_description' => $blog->meta_description ?? str()->limit(strip_tags('JobTrends'), 160),
            ];

            if (empty($blog)) {
                Flash::error('Record not found');

                return redirect()->back();
            }

            return view('front_pages.blog_detail', ['blog' => $blog ,'meta'  => $meta,]);
        } catch (Throwable $e) {
            Flash::error($e->getMessage());
            return redirect()->back();
        }
    }
}
