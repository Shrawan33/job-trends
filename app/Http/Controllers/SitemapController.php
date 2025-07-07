<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Blog;
use App\Models\Event;
use App\Models\EmployerJob;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\URL as LaravelURL;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;

class SitemapController extends Controller
{
    // public function generateAndSave()
    // {
    //     self::generateSitemapStatic();
    //     return response()->json(['message' => 'Sitemap updated successfully']);
    // }

    // public static function generateSitemapStatic()
    // {
    //     $sitemapPath = public_path('sitemap.xml');
    //     $existingContent = File::exists($sitemapPath) ? File::get($sitemapPath) : '';

    //     $sitemap = Sitemap::create();
    //     $now = Carbon::now();

    //     // Add static pages
    //     $staticPages = [
    //         ['/', '1.0'],
    //         ['/login', '0.8'],
    //         ['/registration/jobseeker', '0.8'],
    //         ['/search-jobs', '0.8'],
    //         ['/career-service', '0.8'],
    //         ['/feeds', '0.8'],
    //         ['/interview-plans', '0.8'],
    //         ['/offer-register', '0.8'],
    //         ['/about-us', '0.8'],
    //         ['/privacy-policy', '0.8'],
    //         ['/terms-condition', '0.8'],
    //         ['/contact-us', '0.8'],
    //         ['/forgot-password', '0.64'],
    //     ];

    //     foreach ($staticPages as [$path, $priority]) {
    //         $url = LaravelURL::to($path);
    //         if (!str_contains($existingContent, $url)) {
    //             $sitemap->add(
    //                 Url::create($url)
    //                     ->setLastModificationDate($now)
    //                     ->setPriority($priority)
    //             );
    //         }
    //     }

    //     // Add Blogs
    //     foreach (Blog::latest()->get() as $blog) {
    //         $url = LaravelURL::to('/blog/' . $blog->id);
    //         if (!str_contains($existingContent, $url)) {
    //             $sitemap->add(
    //                 Url::create($url)
    //                     ->setLastModificationDate($blog->updated_at ?? $blog->created_at)
    //                     ->setPriority(0.7)
    //             );
    //         }
    //     }

    //     // Add Events
    //     foreach (Event::latest()->get() as $event) {
    //         $url = LaravelURL::to('/events/' . $event->id);
    //         if (!str_contains($existingContent, $url)) {
    //             $sitemap->add(
    //                 Url::create($url)
    //                     ->setLastModificationDate($event->updated_at ?? $event->created_at)
    //                     ->setPriority(0.7)
    //             );
    //         }
    //     }

    //     // Add Jobs
    //     foreach (EmployerJob::latest()->get() as $job) {
    //         $url = LaravelURL::to('/job-detail/' . $job->slug);
    //         if (!str_contains($existingContent, $url)) {
    //             $sitemap->add(
    //                 Url::create($url)
    //                     ->setLastModificationDate($job->updated_at ?? $job->created_at)
    //                     ->setPriority(0.7)
    //             );
    //         }
    //     }

    //     if ($existingContent) {
    //         $existingContent = str_replace('</urlset>', '', $existingContent);
    //         File::put($sitemapPath, $existingContent);
    //         File::append($sitemapPath, $sitemap->render()->renderBody());
    //         File::append($sitemapPath, '</urlset>');
    //     } else {
    //         $sitemap->writeToFile($sitemapPath);
    //     }
    // }
}