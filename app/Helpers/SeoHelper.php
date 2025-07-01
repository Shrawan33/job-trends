<?php

namespace App\Helpers;

use App\Models\Setting;

class SeoHelper
{
    public static function getMeta($page = null)
    {
        // If not provided, fallback to current route name
        if (!$page) {
            $page = request()->route()->getName();
        }

        $setting = Setting::where('key', 'seo_setting')
            ->where('page', $page)
            ->first();

        return $setting ? json_decode($setting->value, true) : [
            'meta_title' => config('app.name'),
            'meta_description' => '',
        ];
    }
    
}
