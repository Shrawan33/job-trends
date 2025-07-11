<?php

namespace App\Helpers;

use Carbon\Carbon;
use Illuminate\Support\Facades\URL as LaravelURL;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;
use Illuminate\Support\Facades\File;


class SitemapHelper
{
    public static function addNewRoute($routes)
    {
        $sitemapPath = public_path('sitemap.xml');
        $now = Carbon::now();

        $sitemap = Sitemap::create();

        foreach ($routes as [$path, $priority]) {
            $url = LaravelURL::to($path);
            $sitemap->add(
                Url::create($url)
                    ->setLastModificationDate($now)
                    ->setPriority($priority)
            );
        }

        // Render full XML
        $newSitemapXml = $sitemap->render();

        // Extract only <url>...</url> entries using regex
        preg_match_all('/<url>.*?<\/url>/s', $newSitemapXml, $matches);
        $newUrlEntries = implode("\n", $matches[0]);

        if (File::exists($sitemapPath)) {
            $existingContent = File::get($sitemapPath);

            // Remove existing closing </urlset>
            $existingContent = str_replace('</urlset>', '', $existingContent);

            // Append new <url> entries and close the tag again
            $updatedContent = $existingContent . "\n" . $newUrlEntries . "\n</urlset>";

            File::put($sitemapPath, $updatedContent);
        } else {
            // First time: let Spatie write the full file
            $sitemap->writeToFile($sitemapPath);
        }
    }


    public static function removeRoute($routes)
    {
        $sitemapPath = public_path('sitemap.xml');

        if (!File::exists($sitemapPath)) return;

        $content = File::get($sitemapPath);

        foreach ($routes as [$path]) {
            $url = LaravelURL::to($path);
            $pattern = sprintf('#<url>\s*<loc>%s</loc>.*?</url>\s*#s', preg_quote($url, '#'));
            $content = preg_replace($pattern, '', $content);
        }

        $content = trim($content);
        if (!str_ends_with($content, '</urlset>')) {
            $content .= "\n</urlset>";
        }

        File::put($sitemapPath, $content);
    }
}
