<?php

namespace App\Http\View\Composers;

use Illuminate\View\View;

class CategoryComposer
{
    public function __construct()
    {
    }

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $parent_list = [];

        switch ($view->getName()) {
            case 'categories.fields':
                if (!empty($view->category->parent)) {
                    $parent_list = [$view->category->parent->id => $view->category->parent->title];
                }
                break;
        }

        $view->with([
            'parent_list' => $parent_list,
        ]);
    }
}
