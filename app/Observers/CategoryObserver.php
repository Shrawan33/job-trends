<?php

namespace App\Observers;

use App\Models\Category;
use App\Repositories\UserPackageRepository;
use Illuminate\Support\Str;
use Throwable;

class CategoryObserver
{
    private $userPackageRepository;

    public function __construct(UserPackageRepository $userPackageRepository)
    {
        $this->userPackageRepository = $userPackageRepository;
    }

    public function creating(Category $category)
    {
        try {
            $slug = Str::slug($category->title);
            $category->slug = $slug;
        } catch (Throwable $e) {
            // throw $e;
        }
    }

    /**
     * Handle the category "created" event.
     *
     * @param  \App\Models\Category  $category
     * @return void
     */
    public function created(Category $category)
    {
        //
    }

    /**
     * Handle the category "updated" event.
     *
     * @param  \App\Models\Category  $category
     * @return void
     */
    public function updated(Category $category)
    {
        //
    }

    /**
     * Handle the category "deleted" event.
     *
     * @param  \App\Models\Category  $category
     * @return void
     */
    public function deleted(Category $category)
    {
    }

    /**
     * Handle the favorite candidate "restored" event.
     *
     * @param  \App\Models\Category  $category
     * @return void
     */
    public function restored(Category $category)
    {
        //
    }

    /**
     * Handle the favorite candidate "force deleted" event.
     *
     * @param  \App\Models\Category  $category
     * @return void
     */
    public function forceDeleted(Category $category)
    {
        //
    }
}
