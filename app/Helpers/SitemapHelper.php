<?php

namespace App\Helpers;
use Carbon\Carbon;
use Illuminate\Support\Facades\URL as LaravelURL;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;

class SitemapHelper
{
    public static function addNewRoute($routes) {

        $sitemap = Sitemap::create();
        $now = Carbon::now();

        foreach ($routes as [$path, $priority]) {
            $url = LaravelURL::to($path);
                $sitemap->add(
                Url::create($url)
                ->setLastModificationDate($now)
                ->setPriority($priority)
            );
        }
    }

}
