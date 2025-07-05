<?php

namespace App\Http\Controllers;

use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;
use Carbon\Carbon;
use App\Models\Blog;
use App\Models\Event;
use App\Models\EmployerJob;

class SitemapController extends Controller
{
      // Show sitemap in browser (optional)
      public function index()
      {
          $sitemap = $this->buildSitemap();
          return $sitemap->toResponse(request());
      }

      // Public method to generate & save sitemap.xml manually
      public function generateAndSave()
      {
          self::generateSitemapStatic(); // reuse static method
          return response()->json(['message' => 'Sitemap saved successfully!']);
      }

      // Static method for use in events, scheduler, etc.
      public static function generateSitemapStatic()
      {
          $sitemap = (new self)->buildSitemap();
          $sitemap->writeToFile(public_path('sitemap.xml'));
      }

      // Core sitemap logic
      protected function buildSitemap()
      {
          $sitemap = Sitemap::create();
          $now = Carbon::now();

          // Static pages
          $staticPages = [
              ['/', '1.0'],
              ['/login', '0.8'],
              ['/registration/jobseeker', '0.8'],
              ['/search-jobs', '0.8'],
              ['/career-service', '0.8'],
              ['/feeds', '0.8'],
              ['/interview-plans', '0.8'],
              ['/offer-register', '0.8'],
              ['/about-us', '0.8'],
              ['/privacy-policy', '0.8'],
              ['/terms-condition', '0.8'],
              ['/contact-us', '0.8'],
              ['/forgot-password', '0.64'],
          ];

          foreach ($staticPages as [$path, $priority]) {
              $sitemap->add(
                  Url::create(URL::to($path))
                      ->setLastModificationDate($now)
                      ->setPriority($priority)
              );
          }

          // Blogs
          foreach (Blog::latest()->get() as $blog) {
              $sitemap->add(
                  Url::create(URL::to('/blog/' . $blog->id))
                      ->setLastModificationDate($blog->updated_at ?? $blog->created_at)
                      ->setPriority(0.64)
              );
          }

          // Events
          foreach (Event::latest()->get() as $event) {
              $sitemap->add(
                  Url::create(URL::to('/events/' . $event->id))
                      ->setLastModificationDate($event->updated_at ?? $event->created_at)
                      ->setPriority(0.64)
              );
          }

          // Jobs
          foreach (EmployerJob::latest()->get() as $job) {
              $sitemap->add(
                  Url::create(URL::to('/job-detail/' . $job->slug))
                      ->setLastModificationDate($job->updated_at ?? $job->created_at)
                      ->setPriority(0.64)
              );
          }

          return $sitemap;
      }
  }