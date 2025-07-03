<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Carbon;

class SitemapController extends Controller
{
    public function index()
    {
        // Static URLs
        $staticUrls = [
            '/',
            '/career-service',
            '/blog',
            '/feeds',
            '/search-jobs',
            '/terms-condition',
            '/events',
            '/about-us',
            '/contact-us'


        ];

        // Dynamic URLs from database (example)
        $dynamicUrls = [];

        // Example: products
        // if (class_exists(Product::class)) {
        //     $products = Product::all();
        //     foreach ($products as $product) {
        //         $dynamicUrls[] = '/products/' . $product->slug;
        //     }
        // }

        // Merge all URLs
        $urls = array_merge($staticUrls, $dynamicUrls);

        // Build XML
        $xml = '<?xml version="1.0" encoding="UTF-8"?>' . PHP_EOL;
        $xml .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . PHP_EOL;

        foreach ($urls as $url) {
            $xml .= '  <url>' . PHP_EOL;
            $xml .= '    <loc>' . htmlspecialchars(URL::to($url)) . '</loc>' . PHP_EOL;
            $xml .= '    <lastmod>' . Carbon::now()->toDateString() . '</lastmod>' . PHP_EOL;
            $xml .= '    <changefreq>weekly</changefreq>' . PHP_EOL;
            $xml .= '    <priority>0.8</priority>' . PHP_EOL;
            $xml .= '  </url>' . PHP_EOL;
        }

        $xml .= '</urlset>';

        return Response::make($xml, 200)->header('Content-Type', 'application/xml');
    }

}
