<?php

use App\Models\Category;
use Illuminate\Database\Seeder;

class UpdateCategorySlug extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = Category::whereNull('slug')->withTrashed()->get();

        foreach ($categories as $category) {
            $title = $category->title;

            $slug = \Illuminate\Support\Str::slug("$title", '-');

            echo "\n",
            $category->slug = $slug;
            $category->save();
        }
    }
}
